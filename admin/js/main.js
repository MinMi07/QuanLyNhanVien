const localhost = "localhost";
const inputs = document.querySelectorAll(".input");

function addcl() {
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
    let loi = document.querySelector("#loi");
    if (loi != null) loi.style.display = "none";
}

function remcl() {
    let parent = this.parentNode.parentNode;
    if (this.value == "") {
        parent.classList.remove("focus");
    }
}

inputs.forEach((input) => {
    input.addEventListener("focus", addcl);
    input.addEventListener("blur", remcl);
});

// Add class css cho Menu chính
const limenus = document.querySelectorAll(".taga");

function add_taga_i() {
    limenus.forEach((element) => {
        let tagchild = element.childNodes;
        tagchild[0].classList.remove("i_to");
        tagchild[1].classList.remove("to");
        element.parentNode.classList.remove("test");
    });
    let tagchild = this.childNodes;
    tagchild[0].classList.add("i_to");
    tagchild[1].classList.add("to");
    this.parentNode.classList.add("test");

    var check_section_menu = document.querySelectorAll(".infor_main h1");
    for (var i = 0; i < check_section_menu.length - 2; i++) {
        if (this.childNodes[1].innerHTML == check_section_menu[i].innerHTML) {
            for (var j = 0; j < check_section_menu.length; j++) {
                if (i != j) {
                    check_section_menu[j].parentNode.parentNode.classList.add(
                        "infor_hidden"
                    );
                } else {
                    check_section_menu[j].parentNode.parentNode.classList.remove(
                        "infor_hidden"
                    );
                }
            }
            break;
        } else {
            check_section_menu[i].parentNode.parentNode.parentNode.classList.remove(
                "infor_hidden"
            );
        }
    }
}

// Section Menu Content
const class_content = document.querySelectorAll(".class");

function bold(item) {
    for (var i = 0; i < item.length; i++) {
        item[i].classList.remove("class_bold");
    }
    for (var i = 0; i < item.length; i++) {
        if (i % 2 == 0) {
            item[i].classList.add("class_bold");
        }
    }
}

bold(class_content);

for (var i = 0; i < class_content.length; i++) {
    class_content[i].addEventListener("click", function () {
        if (this.className.indexOf("class_background") >= 0) {
            this.classList.remove("class_background");
        } else this.classList.add("class_background");
    });
}

//function t├¼m radio checked
function radioCheck(list) {
    for (var i = 0; i < list.length; i++) {
        if (list[i].checked == true) {
            return list[i].value;
        }
    }
    return "";
}

var todam = document.getElementsByClassName("class");
for (var i = 0; i < todam.length; i++) {
    todam[i].onclick = function () {
        if (this.className.search("todam") >= 0) this.classList.remove("todam");
        else this.classList.add("todam");
    };
}

function todam_hang(a) {
    if (a.className.search("todam") >= 0) a.classList.remove("todam");
    else a.classList.add("todam");
}

const hidden_box_fun = document.querySelectorAll(".hidden");
const logout = document.getElementById("logout");
const add_box = document.getElementById("add");
const update_box = document.getElementById("update");
const dataDetecFace = document.getElementById("DataDetecFace");

var add_btn = document.getElementById("add_btn");

var update_btn = document.getElementById("update_btn");
var logout_btn = document.getElementById("logout_btn");
var data_to_detect_btn = document.getElementById("data_to_detect_btn");

if (data_to_detect_btn != null) {
    data_to_detect_btn.onclick = function () {
        dataDetecFace.style.display = "block";
    };
}

if (logout != null) {
    logout_btn.onclick = function () {
        logout.style.display = "block";
    };
}
if (add_btn != null) {
    add_btn.onclick = function () {
        add_box.style.display = "block";
    };
}

function get_ma(ma, chucnang, infor) {
    check = false;
    var ii = 0;
    for (var i = 0; i < todam.length; i++) {
        if (todam[i].className.search("todam") >= 0) {
            ma[ii] = todam[i].children[0].innerHTML;
            ii++;
            check = true;
        }
    }
    if (ii > 0) {
        if (chucnang != "") {
            update_box.style.display = "block";
        }
    }

    if (!check) {
        document.getElementById("thongbao_chucnang_1").innerHTML = `
            <h2 style=\"color: rgb(1, 82, 233);\">Thông báo</h2>
            <p style=\"font-size: 15px; margin-top: 20px;\">Vui long ${infor} xxx ${infor}</p>
        `;
        document.getElementById("thongbao_chucnang").style.display = "block";
    }
}

function get_ma1(ma, j) {
    check = false;
    var ii = 0;
    for (var i = 0; i < todam.length; i++) {
        if (todam[i].className.search("todam") >= 0) {
            ma[ii] = todam[i].children[j].innerHTML;
            ii++;
            check = true;
        }
    }
}

const close_box_fun = document.querySelectorAll(".close");
for (var i = 0; i < close_box_fun.length; i++) {
    close_box_fun[i].onclick = function () {
        var parent = this.parentNode.parentNode.parentNode;
        parent.style.display = "none";
    };
}

//Search
function search(search_php, search_column, search_infor) {
    var request = new XMLHttpRequest();

    request.open(
        "get",
        "" + search_php + "?col=" + search_column + "&inf=" + search_infor
    );
    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("table_class").innerHTML = this.responseText;
        }
    };

    request.send();
}

// Add
function add(add_php, infor) {
    var request = new XMLHttpRequest();

    request.open("get", "" + add_php + "?" + infor + "");
    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("thongbao_chucnang_1").innerHTML =
                this.responseText;
        }
    };

    request.send();
    document.getElementById("thongbao_chucnang").style.display = "block";
}

//Update
function update(update_php, infor) {
    var request = new XMLHttpRequest();

    request.open("get", "" + update_php + "?" + infor + "");
    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("thongbao_chucnang_1").innerHTML =
                this.responseText;
        }
    };

    request.send();
    document.getElementById("thongbao_chucnang").style.display = "block";
}

//Delete
function del(delete_php, infor) {
    var request = new XMLHttpRequest();

    request.open("get", "" + delete_php + "?" + infor + "");
    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("thongbao_chucnang_1").innerHTML =
                this.responseText;
        }
    };

    request.send();
    document.getElementById("thongbao_chucnang").style.display = "block";
}

function getListMonHoc(data) {
    var request = new XMLHttpRequest();

    request.open("get", "getListMonHocPhanCong.php?MaLop=" + data);
    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById('MonHoc').innerHTML = this.responseText;
        }
    }

    request.send();
}
