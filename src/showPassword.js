function showPassword(button) {
    if (button == "show-password-btn") {
        var inputField = document.getElementById("passwordInput");
    } else if (button == "show-confirm-btn") {
        var inputField = document.getElementById("confirmInput");
    }
    var showBtn = document.getElementById(button);
    if (inputField.type === "password") {
        inputField.type = "text";
        showBtn.style.border = "1px solid"
    } else {
        inputField.type = "password";
        showBtn.style.border = "none"
    }
}