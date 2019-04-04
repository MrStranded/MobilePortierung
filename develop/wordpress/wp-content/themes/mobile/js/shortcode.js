function changeDivVisibility($id) {
    alert("used! " + $id);

    $div = document.getElementById($id);
    if ($div != undefined) {
        if ($div.style.display === "") {
            $div.style.display = "none";
        } else {
            $div.style.display = "";
        }
    }
}