let divToScrollTo = null;

function changeDivVisibility(id, levelClass) {
    let title = $("#" + id + "_title");

    if (title !== undefined) {
        // do we have to open this spoiler afterwards?
        let isOpen = title.hasClass("mobile-shortcodes-title-open");

        // close all spoilers of the corresponding level
        $("." + levelClass + "-title").removeClass("mobile-shortcodes-title-open");
        $("." + levelClass).slideUp(420);

        if (!isOpen) {
            // open this spoiler if it was previously closed
            title.addClass("mobile-shortcodes-title-open");

            divToScrollTo = title;
            let content = $("#" + id);
            content.slideDown(500, scrollToDiv);
        }
    }
}

function scrollToDiv() {
    $('html, body').animate({
        scrollTop: divToScrollTo.offset().top - 79
    }, 350);
}