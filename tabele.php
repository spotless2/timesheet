<?php

require_once('vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$connect = new PDO(
    "mysql:host=logiscool;dbname=userdb",
    "root",
    ""
);

$name = $_GET['name'];

$query = "SELECT * FROM timesheet WHERE utilizator = '$name' ORDER BY datacurenta";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

function calculTotal($coloana) {
    $servername = "logiscool";
    $username = "root";
    $password = "";
    $dbname = "userdb";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
$name = $_GET['name'];
    $result = mysqli_query($conn, "SELECT SUM($coloana) AS value_sum FROM timesheet WHERE utilizator = '$name'"); 
    $row = mysqli_fetch_assoc($result); 
    $sum = $row['value_sum'];
    return $sum;
}

if (isset($_POST["export"])) {
    $file = new Spreadsheet();

    $active_sheet = $file->getActiveSheet();

    $active_sheet->setCellValue('A1', 'Data');
    $active_sheet->setCellValue('B1', 'Durata cursuri:');
    $active_sheet->setCellValue('C1', 'Durata recuperari:');
    $active_sheet->setCellValue('D1', 'Durata demo:');
    $active_sheet->setCellValue('E1', 'Durata tabara:');
    $active_sheet->setCellValue('F1', 'Ora sosirii:');
    $active_sheet->setCellValue('G1', 'Ora plecarii:');
    $active_sheet->setCellValue('H1', 'Timp petrecut:');
    $active_sheet->setCellValue('I1', 'Timp total:');

    $count = 2;
    foreach ($result as $row) {
        $active_sheet->setCellValue('A' . $count, $row["dataCurenta"]);
        $active_sheet->setCellValue('B' . $count, $row['cursH']);
        $active_sheet->setCellValue('C' . $count, $row["recupH"]);
        $active_sheet->setCellValue('D' . $count, $row["demoH"]);
        $active_sheet->setCellValue('E' . $count, $row["tabaraH"]);
        $active_sheet->setCellValue('F' . $count, $row["ora_sosirii"]);
        $active_sheet->setCellValue('G' . $count, $row["ora_plecarii"]);
        $active_sheet->setCellValue('H' . $count, $row["timp_petrecut"]);
        $active_sheet->setCellValue('I' . $count, $row["timp_total"]);

        $count = $count + 1;
    }
    if ($_POST["file_type"] === "none"){
        echo "<script>alert('Nu ai ales tipul fisierului')</script>";
    }
    else 
    {
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, $_POST["file_type"]);

    $file_name = $name . '.' . strtolower($_POST["file_type"]);

    $writer->save($file_name);

    header('Content-Type: application/x-www-form-urlencoded');

    header('Content-Transfer-Encoding: Binary');

    header("Content-disposition: attachment; filename=\"" .
        $file_name . "\"");

    readfile($file_name);

    unlink($file_name);

    exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Export data</title>
    <meta name="viewport" content="width=device-width,
        initial-scale=1.0">
    <link rel="stylesheet" href="
        https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>

<body>
    <div class="container">
        <br />
        <h3 allign="center">Fisa de lucru - trainer: <?php echo $name?></h3>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <form method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <select name="file_type" class="form-control
                                input-sm">
                                <option value="none">Choose file type</option>
                                <option value="Xlsx">Xlsx</option>
                                <option value="Xls">Xls</option>
                                <option value="Csv">Csv</option>
                            </select>
                        </div>
                            <input type="submit" name="export" class="btn btn-primary btn-sm" value="Export" />
                    </div>
                </form>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Data</th>
                            <th>Durata cursuri:</th>
                            <th>Durata recuperari:</th>
                            <th>Durata demo:</th>
                            <th>Durata tabara:</th>
                            <th>Ora sosirii:</th>
                            <th>Ora plecarii:</th>
                            <th>Timp petrecut:</th>
                            <th>Timp total:</th>
                        </tr>
                        <?php
                        foreach ($result as $row) {
                            echo '
                            <tr>
                                <td>' . $row["dataCurenta"] . '</td>
                                <td>' . $row["cursH"] . '</td>
                                <td>' . $row["recupH"] . '</td>
                                <td>' . $row["demoH"] . '</td>
                                <td>' . $row["tabaraH"] . '</td>
                                <td>' . $row["ora_sosirii"] . '</td>
                                <td>' . $row["ora_plecarii"] . '</td>
                                <td>' . $row["timp_petrecut"] . '</td>
                                <td>' . $row["timp_total"] . '</td>
                            </tr>
                            ';
                        }
                        ?>
                    </table>
                    <div class="text-white-50">
                                    <?php 
                                    echo ("Total ore curs: <b>" . calculTotal('cursH') . "</b>, total ore recuperare: <b>" . calculTotal('recupH') 
                                    . "</b>, total ore demo: <b>" . calculTotal('demoH') . "</b>, total ore tabara: <b>" . calculTotal('tabaraH') 
                                    . "</b>, total timp petrecut in scoala: <b>" . calculTotal('timp_petrecut'). "</b>");
                                    ?>
                                </div>
                </div>
            </div>
        </div>
    </div>
    <br />
    <br />
    <script scr="https://ajax.googleapis.com/ajax/libs/
        jquery/2.2.0/jquery.min.js"></script>
</body>

</html>