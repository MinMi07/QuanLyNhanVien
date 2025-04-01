function addcl(a) {
    let parent = a.parentNode.parentNode;
    parent.classList.add("focus");
    let loi = document.querySelector("#loi");
    if (loi != null) loi.style.display = "none";
}

let user_login = document.getElementById("user_login");
let pass_login = document.getElementById("pass_login");

setTimeout(function () {
    if (user_login.value != "") {
        addcl(user_login);
    }

    if (pass_login.value != "") {
        addcl(pass_login);
    }
}, 100);