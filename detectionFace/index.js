const video = document.getElementById('videoItem');
let faceMatcher = null;

function toastify(type, message) {
    switch (type) {
        case 'notify':
            Toastify({
                text: message,
                duration: 3000,
                gravity: "top",
                position: "right",
                // backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)"
            }).showToast();
            break;
        case 'warning':
            Toastify({
                text: message,
                duration: 3000,
                gravity: "top",
                position: "right",
                // backgroundColor: "linear-gradient(to right, #ff9800, #ff5722)"
            }).showToast();
            break;
        case 'error':
            Toastify({
                text: message,
                duration: 3000,
                gravity: "top",
                position: "right",
                // backgroundColor: "linear-gradient(to right, #FF7043, #E64A19)"
            }).showToast();
            break;
        default:
            Toastify({
                text: message,
                duration: 3000,
                gravity: "top",
                position: "right",
                // backgroundColor: "linear-gradient(to right, #757575, #424242)"
            }).showToast();
            break
    }
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
                    toastify('warning', `Không tìm thấy khuân mặt: ${label}/${i}.jpg`);
                }
            } catch (error) {
                toastify('error', `Lỗi thực hiên ${label}/${i}.jpg:`, error);
            }
        }
        if (descriptors.length > 0) {
            faceDescriptors.push(new faceapi.LabeledFaceDescriptors(label, descriptors));
            toastify('notify', `Nhận diện thành công: ${label}`);
        } else {
            toastify('warning', `Đang thực hiện cho ${label}`);
        }
    }
    return faceDescriptors;
}

const loadFaceAPI = async () => {
    await Promise.all([faceapi.nets.faceLandmark68Net.loadFromUri('./models'), faceapi.nets.faceExpressionNet.loadFromUri('./models'), faceapi.nets.tinyFaceDetector.loadFromUri('./models'), faceapi.nets.ssdMobilenetv1.loadFromUri('./models'), faceapi.nets.faceLandmark68TinyNet.loadFromUri('./models'), faceapi.nets.faceRecognitionNet.loadFromUri('./models')]);
    toastify('notify', "xxx!");
    const labeledDescriptors = await loadTrainingData();
    if (labeledDescriptors.length > 0) {
        faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.6);
        toastify('notify', "Huấn luyện xong!");
    } else {
        toastify('warning', "Đang thực hiện...!");
    }
};

function getCameraStream() {
    if (navigator.mediaDevices?.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true }).then(stream => {
            video.srcObject = stream;
        }).catch(error => {
            toastify('error', `lỗi quyền truy cập camera: ${error}`);
        });
    } else {
        toastify('warning', "Đang thực hiện kết nối camera");
    }
}

video.addEventListener('playing', () => {
    const canvas = faceapi.createCanvasFromMedia(video);
    document.body.append(canvas);
    const displaySize = { width: video.videoWidth, height: video.videoHeight };
    faceapi.matchDimensions(canvas, displaySize);
    setInterval(async () => {
        if (!faceMatcher) {
            toastify('warning', "Đang thực hiện...");
            return;
        }
        const detects = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptors().withFaceExpressions();
        const resizedDetects = faceapi.resizeResults(detects, displaySize);
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, displaySize.width, displaySize.height);
        resizedDetects.forEach(detection => {
            const bestMatch = faceMatcher.findBestMatch(detection.descriptor);
            const box = detection.detection.box;
            const nameFace = bestMatch.label !== "unknown" ? bestMatch.label : "Không xác định";
            const drawBox = new faceapi.draw.DrawBox(box);
            drawBox.draw(canvas);
            const textField = new faceapi.draw.DrawTextField([`${nameFace}`], box.bottomRight);
            textField.draw(canvas);
        });
        faceapi.draw.drawDetections(canvas, resizedDetects);
        faceapi.draw.drawFaceExpressions(canvas, resizedDetects);
    }, 300);
});


loadFaceAPI().then(getCameraStream);