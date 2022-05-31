<?php
$servername = "logiscool";
$username = "root";
$password = "";
$dbname = "userdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$data_curenta = $_COOKIE["data_curenta"];
$ore_curs = $_COOKIE["ore_curs"];
$ore_tabara = $_COOKIE["ore_tabara"];
$ore_recup =    $_COOKIE["ore_recup"];
$ore_demo = $_COOKIE["ore_demo"];
$totalMinutes = $_COOKIE["totalMinutes"];
$ora_sosirii = $_COOKIE["ora_sosirii"];
$ora_plecarii = $_COOKIE["ora_plecarii"];
$trainer = $_POST['trainerName']; 

settype($totalMinutes, "float");
settype($ore_curs, "float");
settype($ore_demo, "float");
settype($ore_recup, "float");
settype($ore_tabara, "float");

$timp_total = $totalMinutes / 60;
$timp_petrecut = $timp_total - $ore_curs - $ore_demo - $ore_recup - $ore_tabara;

if (isset($_POST['testSend'])) {
    $sql = "INSERT INTO timesheet (utilizator, dataCurenta, cursH, recupH, demoH, tabaraH, ora_sosirii, ora_plecarii, timp_petrecut, timp_total)
                        VALUES ('$trainer', '$data_curenta', $ore_curs, $ore_recup, $ore_demo, $ore_tabara, '$ora_sosirii', '$ora_plecarii', $timp_petrecut, $timp_total)";
    if ($conn->query($sql) === TRUE) { 
        echo "<br>New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>