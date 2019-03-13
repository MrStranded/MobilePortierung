let prevScrollpos = window.pageYOffset;

window.onscroll = function() {
    let currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("menu-container-id").style.top = "0";
    } else {
        document.getElementById("menu-container-id").style.top = "-80px";
    }
    prevScrollpos = currentScrollPos;
}