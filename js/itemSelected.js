select = document.getElementById("course");

function itemSelected() {
    var elemCurs = document.querySelector(".sliderCurs");
    var elemDemo = document.querySelector(".sliderDemo");
    var elemRecup = document.querySelector(".sliderRecup");

    if (select.value == "curs") {
        elemCurs.style.display = "block";
        elemDemo.style.display = "none";
        elemRecup.style.display = "none";

    } else if (select.value == "demo") {
        elemCurs.style.display = "none";
        elemDemo.style.display = "block";
        elemRecup.style.display = "none";
    } else if (select.value == "recup") {
        elemCurs.style.display = "none";
        elemDemo.style.display = "none";
        elemRecup.style.display = "block";
    } else {
        elemCurs.style.display = "none";
        elemDemo.style.display = "none";
        elemRecup.style.display = "none";
    }
}