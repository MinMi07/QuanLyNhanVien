const video = document.getElementById('videoItem');

let faceMatcher = null;
const recognizedFaces = new Set();

function toastify(type, message) {
    const colors = {
        notify: "linear-gradient(to right, #00b09b, #96c93d)",
        warning: "linear-gradient(to right, #ff9800, #ff5722)",
        error: "linear-gradient(to right, #FF7043, #E64A19)",
        default: "linear-gradient(to right, #757575, #424242)"
    };

    Toastify({
        text: message,
        duration: 3000,
        gravity: "top",
        position: "right",
        backgroundColor: colors[type] || colors.default
    }).showToast();
}

async function loadTrainingData() {
    let response = await fetch('./getLabels.php');
    let labels = await response.json();
    const faceDescriptors = [];

    for (const label of labels) {
        const descriptors = [];
        for (let i = 1; i <= 4; i++) {
            try {
                const image = await faceapi.fetchImage(`./dataset/${label}/${i}.jpg`);
                const detection = await faceapi.detectSingleFace(image).withFaceLandmarks().withFaceDescriptor();
                if (detection) {
                    descriptors.push(detection.descriptor);
                } else {
                    toastify('warning', `Không tìm thấy khuôn mặt: ${label}/${i}.jpg`);
                }
            } catch (error) {
                toastify('error', `Lỗi xử lý ${label}/${i}.jpg: ${error.message}`);
            }
        }
        if (descriptors.length > 0) {
            faceDescriptors.push(new faceapi.LabeledFaceDescriptors(label, descriptors));
            toastify('notify', `Huấn luyện thành công: ${label}`);
        } else {
            toastify('warning', `Huấn luyện thất bại: ${label}`);
        }
    }
    return faceDescriptors;
}

async function loadFaceAPI() {
    await Promise.all([
        faceapi.nets.faceLandmark68Net.loadFromUri('./models'),
        faceapi.nets.faceExpressionNet.loadFromUri('./models'),
        faceapi.nets.tinyFaceDetector.loadFromUri('./models'),
        faceapi.nets.ssdMobilenetv1.loadFromUri('./models'),
        faceapi.nets.faceLandmark68TinyNet.loadFromUri('./models'),
        faceapi.nets.faceRecognitionNet.loadFromUri('./models')
    ]);

    toastify('notify', "Tải xong model nhận diện!");
    const labeledDescriptors = await loadTrainingData();

    if (labeledDescriptors.length > 0) {
        faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.6);
        toastify('notify', "Huấn luyện xong!");
    } else {
        toastify('warning', "Đang thực hiện...!");
    }
}

function getCameraStream() {
    navigator.mediaDevices?.getUserMedia({ video: true })
        .then(stream => { video.srcObject = stream; })
        .catch(error => { toastify('error', `Lỗi truy cập camera: ${error.message}`); });
}

function drawFrameNotiCheckin(video, type) {
    switch (type) {
        case 'red':
            video.style.border = "10px solid red";
            video.style.borderRadius = "5px"; 
        break;

        case 'green':
            video.style.border = "10px solid green";
            video.style.borderRadius = "5px"; 
        break;
    }
}

function addHoursToTime(timeStr, hoursToAdd) {
    let [h, m, s] = timeStr.split(":").map(Number);
    let date = new Date();
    date.setHours(h + hoursToAdd, m, s || 0, 0);
    return date;
}

video.addEventListener('playing', async () => {
    const canvas = faceapi.createCanvasFromMedia(video);
    document.body.append(canvas);

    const displaySize = { width: video.videoWidth, height: video.videoHeight };
    faceapi.matchDimensions(canvas, displaySize);

    // Lấy cấu hình thời gian chấm công
    let thoiGianChamCong = await fetch('../admin/getDataById.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            Table: "cauhinhthongso",
            IdBang: "thoiGianChamCong",
            TenCotId: "CauHinh"
        })
    });

    let dataThoiGianChamCong = await thoiGianChamCong.text();
    let thoiGianChamCongConfig = JSON.parse(dataThoiGianChamCong);

    // Lấy cấu hình thời gian chấm công về
    let thoiGianChamCongVe = await fetch('../admin/getDataById.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            Table: "cauhinhthongso",
            IdBang: "thoiGianChamCongVe",
            TenCotId: "CauHinh"
        })
    });

    let dataThoiGianChamCongVe = await thoiGianChamCongVe.text();
    let thoiGianChamCongVeConfig = JSON.parse(dataThoiGianChamCongVe);

    setInterval(async () => {
        if (!faceMatcher) {
            toastify('warning', "Đang thực hiện...");
            return;
        }

        const detects = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
            .withFaceLandmarks()
            .withFaceDescriptors()
            .withFaceExpressions();

        const resizedDetects = faceapi.resizeResults(detects, displaySize);
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, displaySize.width, displaySize.height);

        for (const detection of resizedDetects) {
            const bestMatch = faceMatcher.findBestMatch(detection.descriptor);
            const box = detection.detection.box;
            const nameFace = bestMatch.label !== "unknown" ? bestMatch.label : "Không xác định";

            drawFrameNotiCheckin(video, 'red');

            if (bestMatch.distance < 0.7 && nameFace !== "Không xác định") {
                if (!recognizedFaces.has(nameFace)) {
                    recognizedFaces.add(nameFace);

                    try {
                        let checkResponse = await fetch('./kiemTraChamCong.php', {
                            
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ name: nameFace })
                        });

                        let responseText = await checkResponse.text();
                        let checkResult = JSON.parse(responseText);

                        let checkResponseTangCa = await fetch('./kiemTraChamCongTangCa.php', {

                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ name: nameFace })
                        });

                        let responseTextTangCa = await checkResponseTangCa.text();
                        let checkResultTangCa = JSON.parse(responseTextTangCa);

                        if (checkResult.is_checkin && !checkResultTangCa.is_checkin) {

                            var time = checkResult.check_in;
                            // Chuyển chuỗi thành đối tượng Date
                            let originalTime = new Date(time);

                            // Cộng thêm 1 giờ
                            let timePlus1h = new Date(originalTime.getTime() + 60 * 60 * 1000);

                            // Lấy thời gian hiện tại
                            let now = new Date();
                            
                            if (timePlus1h > now) {
                                drawFrameNotiCheckin(video, 'green');
                                toastify('notify', `Người dùng ${nameFace} đã chấm công hôm nay!`);
                                setTimeout(() => { }, 8000);
                            }

                            if (timePlus1h < now) {
                                // Kiểm tra nếu chưa có dữ liệu checkout thì chấm công checkout cho nhân viên
                                if (checkResult.check_out === null || checkResult.check_out === '') {
                                    let response = await fetch('./chamCongVe.php', {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/json' },
                                        body: JSON.stringify({ 
                                            machamcong: checkResult.ma_cham_cong
                                        })
                                    });

                                    let result = await response.json();
                                    if (result.success) {
                                        drawFrameNotiCheckin(video, 'green');
                                        toastify('notify', `Chấm công về thành công: ${nameFace}`);
                                        setTimeout(() => { }, 8000);
                                    }
                                } else {
                                    let timeCheckout = thoiGianChamCongVeConfig.data.GiaTri;
                                    let [h, m, s] = timeCheckout.split(":").map(Number);
                                    // Tạo object Date với thời gian checkout là hôm nay
                                    let checkoutTime = new Date();
                                    checkoutTime.setHours(h, m, s || 0, 0);

                                    // Thời gian hiện tại
                                    let now = new Date();

                                    if (now > checkoutTime) {
                                        let response = await fetch('./chamCongTangCa.php', {
                                            method: 'POST',
                                            headers: { 'Content-Type': 'application/json' },
                                            body: JSON.stringify({ manhanvien: checkResult.ma_nhan_vien })
                                        });

                                        let result = await response.json(); if (result.success) {
                                            drawFrameNotiCheckin(video, 'green');
                                            toastify('notify', `Chấm công tăng ca thành công: ${nameFace}`);
                                            setTimeout(() => { }, 8000);
                                        } else {
                                            toastify('error', `Chấm công tăng ca thất bại: ${result.message}`);
                                        }

                                    }
                                }
                            }
                        } 
                        
                        // chưa có dữ liệu chấm công thường và công tăng ca => cần chấm công thường
                        if (!checkResult.is_checkin && !checkResultTangCa.is_checkin){
                            let response = await fetch('./chamCong.php', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ manhanvien: checkResult.ma_nhan_vien})
                            });

                            let result = await response.json();
                            if (result.success) {
                                drawFrameNotiCheckin(video, 'green');
                                toastify('notify', `Chấm công thành công: ${nameFace}`);
                                setTimeout(() => {}, 8000);
                            } else {
                                toastify('error', `Chấm công thất bại: ${result.message}`);
                            }
                        }

                        if (
                            checkResult.is_checkin && 
                            checkResult.check_out !== null && 
                            checkResultTangCa.is_checkin
                        ) {
                            if (checkResultTangCa.check_out === null || checkResultTangCa.check_out === '') {
                                var time = checkResultTangCa.check_in;
                                // Chuyển chuỗi thành đối tượng Date
                                let originalTime = new Date(time);

                                // Cộng thêm 1 giờ
                                let timePlus1h = new Date(originalTime.getTime() + 60 * 60 * 1000);

                                // Lấy thời gian hiện tại
                                let now = new Date();

                                if (timePlus1h < now) {
                                    let response = await fetch('./chamCongVe.php', {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/json' },
                                        body: JSON.stringify({ machamcong: checkResultTangCa.ma_cham_cong })
                                    });
    
                                    let result = await response.json();
                                    if (result.success) {
                                        drawFrameNotiCheckin(video, 'green');
                                        toastify('notify', `Chấm công về tăng ca thành công: ${nameFace}`);
                                        setTimeout(() => { }, 8000);
                                    } else {
                                        toastify('error', `Chấm công về tăng ca thất bại: ${result.message}`);
                                    }
                                } else {
                                    drawFrameNotiCheckin(video, 'green');
                                    toastify('notify', `Người dùng ${nameFace} đã chấm công tăng ca hôm nay!`);
                                    setTimeout(() => { }, 8000);
                                }
                            }
                        }

                    } catch (error) {
                        toastify('error', `Lỗi kiểm tra chấm công: ${error.message}`);
                    }

                    setTimeout(() => recognizedFaces.delete(nameFace), 5000);
                }
            }

            new faceapi.draw.DrawBox(box).draw(canvas);
            new faceapi.draw.DrawTextField([nameFace], box.bottomRight).draw(canvas);
        }

        faceapi.draw.drawDetections(canvas, resizedDetects);
        faceapi.draw.drawFaceExpressions(canvas, resizedDetects);
    }, 500);
});

loadFaceAPI().then(getCameraStream);
