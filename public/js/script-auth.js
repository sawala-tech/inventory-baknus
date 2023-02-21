$(document).ready(function () {
    $("#tooglePassword").click(function () {
        if ($("#password").attr("type") == "password") {
            $("#password").attr("type", "text");
            $("#password1").attr("type", "text");
            $("#tooglePassword").removeClass("fa-eye-slash").addClass("fa-eye");
        } else {
            $("#password").attr("type", "password");
            $("#password1").attr("type", "password");
            $("#tooglePassword").removeClass("fa-eye").addClass("fa-eye-slash");
        }
    });
});
