<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v5.6.8, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.6.8, mobirise.com">
  <meta name="twitter:card" content="summary_large_image"/>
  <meta name="twitter:image:src" content="">
  <meta property="og:image" content="">
  <meta name="twitter:title" content="Home">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo5.png" type="image/x-icon">
  <meta name="description" content="">
  
  <title>Home</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap"></noscript>
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
</head>
<body>
  <section data-bs-version="5.1" class="header5 cid-t6R5DAwFjv mbr-fullscreen" id="header5-0">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-12 col-lg-7">
                <h1 class="mbr-section-title mbr-fonts-style mbr-white mb-3 display-1"><strong>Panou administrator</strong></h1>
                
                <p class="mbr-text mbr-fonts-style mbr-white display-7">Aici poti vedea detalii despre fiecare trainer in parte.</p>
            </div>
        </div>
    </div>
</section>
      <section class="u-align-left u-clearfix u-image u-shading u-typography-custom-page-typography-8--Introduction u-white u-section-3" src="" id="sec-7370">
        <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
<div class = "container">
          <div>
          <h1 class="u-text u-text-default u-text-white u-text-1">Verificare Trainer</h1>
          </div>
          <br>
          <h3>Trainer: 
          <?php
 
          ?>
          </h3>
          <br>
          <input type="submit" name="updateTable" class="btn btn-warning display-7" value="Update" />
          </div>
        </div>
      </section>
</section>

<?php

require_once('vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$connect = new PDO(
    "mysql:host=logiscool;dbname=userdb",
    "root",
    ""
);

$query = "SELECT * FROM timesheet WHERE utilizator = 'florin'";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();


if (isset($_POST["export"])) {
    $file = new Spreadsheet();

    $active_sheet = $file->getActiveSheet();

    $active_sheet->setCellValue('A1', 'Nume');
    $active_sheet->setCellValue('B1', 'Data');
    $active_sheet->setCellValue('C1', 'Durata cursuri:');
    $active_sheet->setCellValue('D1', 'Durata recuperari:');
    $active_sheet->setCellValue('E1', 'Durata demo:');
    $active_sheet->setCellValue('F1', 'Durata tabara:');
    $active_sheet->setCellValue('G1', 'Timp petrecut:');
    $active_sheet->setCellValue('H1', 'Timp total:');

    $count = 2;
    foreach ($result as $row) {
        $active_sheet->setCellValue('A' . $count, $row["utilizator"]);
        $active_sheet->setCellValue('B' . $count, $row["dataCurenta"]);
        $active_sheet->setCellValue('C' . $count, $row['cursH']);
        $active_sheet->setCellValue('D' . $count, $row["recupH"]);
        $active_sheet->setCellValue('E' . $count, $row["demoH"]);
        $active_sheet->setCellValue('F' . $count, $row["tabaraH"]);
        $active_sheet->setCellValue('G' . $count, $row["timp_petrecut"]);
        $active_sheet->setCellValue('H' . $count, $row["timp_total"]);

        $count = $count + 1;
    }
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::
createWriter($file, $_POST["file_type"]);

        $file_name = time() . '.' . strtolower($_POST["file_type"]);

        $writer->save($file_name);

        header('Content-Type: application/x-www-form-urlencoded');

        header('Content-Transfer-Encoding: Binary');

        header("Content-disposition: attachment; filename=\"".
        $file_name."\"");

        readfile($file_name);

        unlink($file_name);

        exit;
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
        <h3 allign="center">Export data from mysql</h3>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">user data</div>
                        <div class="col-md-4">
                            <select name="file_type" class="form-control
                                input-sm">
                                <option value="Xlsx">Xlsx</option>
                                <option value="Xls">Xls</option>
                                <option value="Csv">Csv</option>
                            </select>
                        </div>                        <div class="col-md-5">
                            <select name="trainer" class="form-control
                                input-sm">
                                <option value="Xlsx">Xlsx</option>
                                <option value="Xls">Xls</option>
                                <option value="Csv">Csv</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="submit" name="export" class="btn btn-primary btn-sm" value="Export" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Nume</th>
                            <th>Data</th>
                            <th>Durata cursuri:</th>
                            <th>Durata recuperari:</th>
                            <th>Durata demo:</th>
                            <th>Durata tabara:</th>
                            <th>Timp petrecut:</th>
                            <th>Timp total:</th>
                        </tr>
                        <?php

                        foreach ($result as $row) {
                            echo '
                            <tr>
                                <td>' . $row["utilizator"] . '</td>
                                <td>' . $row["dataCurenta"] . '</td>
                                <td>' . $row["cursH"] . '</td>
                                <td>' . $row["recupH"] . '</td>
                                <td>' . $row["demoH"] . '</td>
                                <td>' . $row["tabaraH"] . '</td>
                                <td>' . $row["timp_petrecut"] . '</td>
                                <td>' . $row["timp_total"] . '</td>
                            </tr>
                            ';
                        }
                        ?>
                    </table>

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

</body>
</html>
