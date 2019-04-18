function changeDivVisibility(id, levelClass) {
    let selfTitle = $("#" + id + "_title");

    if (selfTitle !== undefined) {
        // do we have to open this spoiler afterwards?
        let isOpen = selfTitle.hasClass("mobile-shortcodes-title-open");

        // close all spoilers of the corresponding level
        $("." + levelClass + "-title").removeClass("mobile-shortcodes-title-open");

        let sameLevelContents = $("." + levelClass);
        sameLevelContents.removeClass("mobile-shortcodes-content-open");
        sameLevelContents.addClass("mobile-shortcodes-content-closed");

        if (!isOpen) {
            // open this spoiler if it was previously closed
            selfTitle.addClass("mobile-shortcodes-title-open");

            let selfContent = $("#" + id);
            selfContent.removeClass("mobile-shortcodes-content-closed");
            selfContent.addClass("mobile-shortcodes-content-open");
        }
    }
}