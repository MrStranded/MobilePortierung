let previousScrollPosition = 0;
let menuWasOpen = false;

function toggleMenu() {
    let $hamburger = $(".hamburger");
    menuWasOpen = $hamburger.hasClass("is-active");
    $hamburger.toggleClass("is-active");

    if (!menuWasOpen) {
        previousScrollPosition = $(document).scrollTop();
    }

    let sidebar = document.getElementById("sidebar-id");

    let $sidebar = $("#sidebar-id");
    let $content = $("#content-id");

    if (sidebar.style.display === "none") {
        sidebar.style.display = "";
        $sidebar.slideUp();
    }

    $sidebar.slideToggle("fast");
    $content.slideToggle("fast", goToPreviousScrollPosition);
}

function goToPreviousScrollPosition() {
    if (menuWasOpen) {
        $('html, body').animate({
            scrollTop: previousScrollPosition
        }, 0);
    }
}