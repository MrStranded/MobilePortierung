function testPhp() {
    alert("template directory: " + params.template_uri);
}

function openSidePanel() {
    document.getElementById("slide-menu-button-open").style.display = "none";
    document.getElementById("slide-menu-button-close").style.display = "";
    document.getElementById("sidebar-id").style.visibility = "visible";
}

function closeSidePanel() {
    document.getElementById("slide-menu-button-open").style.display = "";
    document.getElementById("slide-menu-button-close").style.display = "none";
    document.getElementById("sidebar-id").style.visibility = "hidden";
}

let prevScrollpos = window.pageYOffset;

window.onscroll = function() {
    let currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("menu-container-id").style.top = "0";
    } else {
        document.getElementById("menu-container-id").style.top = "-50px";
    }
    prevScrollpos = currentScrollPos;
}