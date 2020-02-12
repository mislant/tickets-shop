$(document).ready(function () {
    $(".next").click(function () {
        var button = $(this);
        button.addClass(' disabled');
        button.css('opacity', 0.5);
        var currentEvent = $(".slider-item.curry");
        var currentIndex = $(".slider-item.curry").index();
        var nextIndex = currentIndex + 1;
        var nextEvent = $(".slider-item").eq(nextIndex);
        currentEvent.fadeOut(1000);
        currentEvent.removeClass("curry");
        if (nextIndex == $(".slider-item:last").index() + 1) {
            setTimeout(function () {
                $(".slider-item").eq(0).fadeIn(1000);
                $(".slider-item").eq(0).addClass("curry");
            }, 999);
            setTimeout(function () {
                button.removeClass(' disabled');
                button.css('opacity', 1);
            }, 1500)

        } else {
            setTimeout(function () {
                nextEvent.fadeIn(1000);
                nextEvent.addClass("curry");
            }, 999);
            setTimeout(function () {
                button.removeClass(' disabled');
                button.css('opacity', 1);
            }, 1500)
        }
    });
    $(".prev").click(function () {
        var button = $(this);
        button.addClass(' disabled');
        button.css('opacity', 0.5);
        var currentEvent = $(".slider-item.curry");
        var currentIndex = $(".slider-item.curry").index();
        var prevIndex = currentIndex - 1;
        var prevEvent = $(".slider-item").eq(prevIndex);
        currentEvent.fadeOut(1000);
        currentEvent.removeClass("curry");
        setTimeout(function () {
            prevEvent.fadeIn(1000);
            prevEvent.addClass('curry');
        }, 999);
        setTimeout(function () {
            button.removeClass(' disabled');
            button.css('opacity', 1);
        }, 1500)
    });
});
