$('#form-log').on('beforeSubmit', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    var data = $(this).serialize();
    $.ajax({
        url: '/user/log-in',
        type: 'POST',
        data: data,
        success: function () {
        },
        error: function () {
            alert('error');
        }
    });
    return false;
});
$('#form-auth').on('beforeSubmit', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    var data = $(this).serialize();
    $.ajax({
        url: '/user/sign-up',
        type: 'POST',
        data: data,
        success: function () {
        },
        error: function () {
            alert('error');
        }
    });
    return false;
});