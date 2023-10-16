function showPassword(button) {
    if (button == "show-password-btn") {
        var inputField = document.getElementById("passwordInput");
    } else if (button == "show-confirm-btn") {
        var inputField = document.getElementById("confirmInput");
    }
    var showBtn = document.getElementById(button);
    if (inputField.type === "password") {
        inputField.type = "text";
        showBtn.src = "../images/hidePassword.png";
        showBtn.title = "Click to hide password";
    } else {
        inputField.type = "password";
        showBtn.src = "../images/showPassword.png";
        showBtn.title = "Click to show password";
    }
}