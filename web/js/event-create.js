$(document).ready(function () {
    var wrap = $('.cover-flex');
    var model = $('.small-form').eq(0);
    $('#addTickets').click(function () {
        $('#addTickets').fadeOut(500);
        wrap.fadeIn(500).css('display', 'flex');
        model.fadeIn(500).css('display', 'flex');
        model.addClass('current');
        $('#addMore').fadeIn(500);
    });
    $('#addMore').click(function () {
        var form = $('.small-form.current');
        var idx = form.index();
        var nextidx = idx + 1;
        var nextform = $('.small-form').eq(nextidx);
        if (nextidx == $('.small-form:last').index() + 1) {
            alert('Типов билетов больше нет')
        } else {
            form.removeClass('current');
            nextform.fadeIn(500).css('display', 'flex').addClass('current');
        }
    })
})