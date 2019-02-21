function testPhp() {
    alert("template directory: " + params.template_uri);
};

function openSidePanel() {
    document.getElementById("slide-menu-button-open").style.display = "none";
    document.getElementById("slide-menu-button-close").style.display = "";
    document.getElementById("sidebar-mobile-id").style.display = "";
};

function closeSidePanel() {
    document.getElementById("slide-menu-button-open").style.display = "";
    document.getElementById("slide-menu-button-close").style.display = "none";
    document.getElementById("sidebar-mobile-id").style.display = "none";
}