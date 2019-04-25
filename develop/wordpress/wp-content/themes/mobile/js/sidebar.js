let previousScrollPosition = 0;
let menuWasOpen = false;
let alreadyToggled = false;

function clickMenu() {
    let $hamburger = $(".hamburger");
    menuWasOpen = $hamburger.hasClass("is-active");
    $hamburger.toggleClass("is-active");

    if (!menuWasOpen) {
        previousScrollPosition = $(document).scrollTop();

    }

    alreadyToggled = false;
    $('html, body').animate({
        scrollTop: 0
    }, 350, "swing", toggleMenu);
}

function toggleMenu() {
    if (!alreadyToggled) {
        alreadyToggled = true;

        let sidebar = document.getElementById("sidebar-id");

        let $sidebar = $("#sidebar-id");
        let $content = $("#content-id");

        if (sidebar.style.display === "none") {
            sidebar.style.display = "";
            $sidebar.slideUp();
        }

        $sidebar.slideToggle(350);
        $content.slideToggle(350, goToPreviousScrollPosition);
    }
}

function goToPreviousScrollPosition() {
    if (menuWasOpen) {
        $('html, body').animate({
            scrollTop: previousScrollPosition
        }, 350);
    }
}
