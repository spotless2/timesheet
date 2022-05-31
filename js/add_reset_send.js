var ore_curs = 0;
var ore_recup = 0;
var ore_demo = 0;
var ore_tabara = 0;
var totalMinutes = 0;
var data_curenta;
var ora_sosirii;
var ora_plecarii;
// var username;


function buttonPress() {
    var startTime = document.querySelector('input[name="startTime"]');
    var endTime = document.querySelector('input[name="endTime"]');
    var endHour = Number(endTime.value[0]) * 10 + Number(endTime.value[1]);
    var startHour = Number(startTime.value[0]) * 10 + Number(startTime.value[1]);
    var endMinutes = Number(endTime.value[3]) * 10 + Number(endTime.value[4]);
    var startMinutes = Number(startTime.value[3]) * 10 + Number(startTime.value[4]);
    var hoursToMinutes = (endHour - startHour) * 60;
    totalMinutes = hoursToMinutes + (endMinutes - startMinutes);
    var data = document.querySelector('input[type="date"]');
    data_curenta = data.value;
    ora_sosirii = startTime.value;
    ora_plecarii = endTime.value;
    alert(ora_sosirii);
    alert(ora_plecarii);
    // selectUsername = document.getElementById("trainer");
    // username = selectUsername.value;
    saveCookies();
}

function getValue(value) {
    return value;
}

function addType() {
    var finalText = document.getElementById('outText');
    finalText.style.visibility = "visible";
    document.getElementById("btnSend").style.display = "block";
    var addedText;
    select = document.getElementById("course");
    if (select.value == "curs") {
        addedText = document.getElementById("rangeValue1");
        finalText.innerHTML += addedText.innerHTML + ", ";
        ore_curs += Number(document.getElementById("rangeCurs").value);

    } else if (select.value == "demo") {
        addedText = document.getElementById("rangeValue3");
        finalText.innerHTML += addedText.innerHTML + ", ";
        ore_demo += (Number(document.getElementById("rangeDemo").value)) / 60;

    } else if (select.value == "recup") {
        addedText = document.getElementById("rangeValue2");
        finalText.innerHTML += addedText.innerHTML + ", ";
        ore_recup += (Number(document.getElementById("rangeRecup").value) / 60);

    }
    else if (select.value == "tabara") {
        finalText.innerHTML += "O zi de tabara";
        ore_tabara += 3.5;

    }
    else {
        alert("Nu ai selectat ce doresti sa adaugi!");

    }
}
function resetAll() {
    finalText = document.getElementById("outText");
    finalText.innerHTML = "Ai adaugat: ";
    ore_curs = 0;
    ore_recup = 0;
    ore_demo = 0;
    ore_tabara = 0;
}

function saveCookies() {
    createCookie("ore_curs", ore_curs, "10");
    createCookie("ore_recup", ore_recup, "10");
    createCookie("ore_tabara", ore_tabara, "10");
    createCookie("ore_demo", ore_demo, "10");
    createCookie("totalMinutes", totalMinutes, "10");
    createCookie("data_curenta", data_curenta, "10");
    createCookie("ora_sosirii", ora_sosirii, "10");
    createCookie("ora_plecarii", ora_plecarii, "10");
    // createCookie('username', username, "10");
}
// Function to create the cookie
function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }

    document.cookie = escape(name) + "=" +
        escape(value) + expires + "; path=/";
}

