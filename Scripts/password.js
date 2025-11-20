let password = document.getElementById("password");
let hideShowImg = document.getElementById("hide-show-img");
document.getElementById("hide-show").addEventListener("click", function () {
    if (password.type === "password") {
            password.type = "text"
            hideShowImg.src = "../Files/show.png";
    }
    else if (password.type === "text") {
        password.type = "password"
        hideShowImg.src = "../Files/hide.png";
    }
});