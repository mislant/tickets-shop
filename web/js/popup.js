$(document).mouseup(function (e) {
    var popup_reg = $("#popup-reg");
    if (e.target != popup_reg[0] && popup_reg.has(e.target).length == 0) {
        $("#popup-reg").fadeOut();
    }
});
$(document).mouseup(function (e) {
    var popup_auth = $("#popup-auth");
    if (e.target != popup_auth[0] && popup_auth.has(e.target).length == 0) {
        $("#popup-auth").fadeOut();
    }
});
$("#auth").click(function () {
    $("#popup-auth").fadeIn(500);
});
$("#reg").click(function () {
    $("#popup-reg").fadeIn(500);
});
$("#auth-reg").click(function () {
    $("#popup-auth").fadeOut(500);
    $("#popup-reg").fadeIn(500);
});
$("#reg-auth").click(function () {
    $("#popup-reg").fadeOut(500);
    $("#popup-auth").fadeIn(500);
});
