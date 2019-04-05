function changeDivVisibility(id) {
    let div = document.getElementById(id);
    if (div != undefined) {
        if (div.style.display === "") {
            div.style.display = "none";
        } else {
            div.style.display = "";
        }

        /*let title = document.getElementById(id + "_title");
        if (title != undefined) {
            if (div.style.display === "none") {
                title.className = "mobile-shortcodes-title-hidden";
            } else {
                title.className = "mobile-shortcodes-title";
            }
        }
        */
        $("#" + id + "_title").toggleClass("mobile-shortcodes-title-hidden");
    }
}