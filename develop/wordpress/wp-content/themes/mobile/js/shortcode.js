let divToScrollTo = null;

function changeDivVisibility(id, levelClass) {
    let title = $("#" + id + "_title");

    if (title !== undefined) {
        // do we have to open this spoiler afterwards?
        let isOpen = title.hasClass("mobile-shortcodes-title-open");

        // close all spoilers of the corresponding level
        $("." + levelClass + "-title").removeClass("mobile-shortcodes-title-open");

        let sameLevelContents = $("." + levelClass);
        //sameLevelContents.removeClass("mobile-shortcodes-content-open");
        //sameLevelContents.addClass("mobile-shortcodes-content-closed");
        sameLevelContents.slideUp();

        if (!isOpen) {
            // open this spoiler if it was previously closed
            title.addClass("mobile-shortcodes-title-open");

            let content = $("#" + id);
            //content.removeClass("mobile-shortcodes-content-closed");
            //content.addClass("mobile-shortcodes-content-open");
            divToScrollTo = title;
            content.slideDown('fast', scrollToDiv);
        }
    }
}

function scrollToDiv() {
    $('html, body').animate({
        scrollTop: divToScrollTo.offset().top - 80
    }, 350);
}