function testPhp() {
    alert("template directory: " + params.template_uri);
}

function openSidePanel() {
    document.getElementById("slide-menu-button-open").style.display = "none";
    document.getElementById("slide-menu-button-close").style.display = "";
    document.getElementById("sidebar-id").style.visibility = "visible";

    document.getElementById("content-id").style.display = "none";
}

function closeSidePanel() {
    document.getElementById("slide-menu-button-open").style.display = "";
    document.getElementById("slide-menu-button-close").style.display = "none";
    document.getElementById("sidebar-id").style.visibility = "hidden";

    document.getElementById("content-id").style.display = "";
}

function toggleMenu() {
    $(".hamburger").toggleClass("is-active");

    /*let sidebar = document.getElementById("sidebar-id");
    let content = document.getElementById("content-id");

    if (sidebar.style.visibility === "visible") {
        sidebar.style.visibility = "hidden";
        content.style.display = "";
    } else {
        sidebar.style.visibility = "visible";
        content.style.display = "none";
    }*/

    let sidebar = $("#sidebar-id");
    let content = $("#content-id");

    alert(">"+sidebar.attr("visibility")+"<");

    if (sidebar.visibility === "hidden") {
        sidebar.slideUp();
        sidebar.visibility = "visible";
    }

    sidebar.slideToggle();
    content.slideToggle();
}