$('#ticket-form').on('submit', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    var data = $(this).serialize();
    $.ajax({
        url: 'show-event-details',
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

$('#main-form').on('submit', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    var data = $(this).serialize();
    $.ajax({
        url: 'show-event-details',
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
