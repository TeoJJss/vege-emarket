<style>
    div.login-alert {
        padding: 20px;
        background-color: #f44336;
        color: white;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-size: 2.5vh;
        width: 85%;

        max-height: 2.5vh;
    }
    .login-alert-closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }
    .login-alert-closebtn:hover {
        color: black;
    }
</style>
<div class="login-alert" id="login-alert">
    <span class="login-alert-closebtn" onclick="document.getElementById('login-alert').style.display='none';">&times;</span> 
    <strong>Wrong username or password.</strong> Please try again.
</div>

<!-- 
    How To Create an Alert Message Box. (2023). W3schools.com. https://www.w3schools.com/howto/howto_js_alert.asp
 -->