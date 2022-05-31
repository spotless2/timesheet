<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Logiscool Craiova</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/afterUpdate.css">

</head>
<?php
$uname = ucfirst($_GET["uname"]);
if (!$uname)
{
    echo '<script>
    alert("Sesiune expirata, te rugam sa te reloghezi");
    location.href = "index.php";
    </script>';
}
$now = new DateTime();

$now->setTimezone(new DateTimeZone('Europe/Bucharest'));    // Another way
// MySQL datetime format
?>

<body id="page-top">
    <!-- Navigation-->
    <link rel="stylesheet" href="css/toggleSwitch.css">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#page-top">Logiscool Craiova - Trainer:
                <?php echo $uname; ?>
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#timesheet">Time Sheet</a></li>
                    <li class="nav-item"><a class="nav-link" href="#work">Work</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" ></a></li> -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- About-->
    <section class="about-section text-center" id="timesheet">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <form method="post" action="insertToDb.php">
                        <h2 class="text-white mb-4">Bine ai venit, <?php echo $uname; ?>!</h2>
                        <script type="text/javascript" src="js/add_reset_send.js"></script>

                        <p class="text-white-50">
                            Aici iti poti contoriza timpul lucrat.
                            <br>
                            <br>
                            <label for="start">Data:</label>
                            <input type="date" id="startDate" name="startDate" value="<?php echo $now->format('Y-m-d'); ?>" min="2022-01-01" max="2022-12-31">
                            Ora sosirii:
                            <input type="time" id="startTime" name="startTime" min="06:00" max="23:00" required>
                            <label for="end">Ora plecarii:</label>
                            <input type="time" id="endTime" name="endTime" min="06:00" max="23:00" required>
                            <br>
                            <label for="course">Alege tipul cursului:</label>
                            <br>
                            <span id="outText"><small><b>Ai adaugat: <br /></b></small></span>
                            <br>
                            <class id="selectSection">
                                <class id="select_main1">
                                    <select name="course" id="course" onchange="itemSelected()">
                                        <option value="none"></option>
                                        <option value="curs">Curs</option>
                                        <option value="demo">Demo</option>
                                        <option value="recup">Recuperare</option>
                                        <option value="tabara">Tabara</option>
                                    </select>
                                </class>
                                <br>
                                <script type="text/javascript" src="js/itemSelected.js"></script>
                                <div class="sliderCurs">
                                    <input type="range" id="rangeCurs" min="1" max="8" step="0.5" value="1" oninput="rangeValue1.innerText = 'Durata cursuri in ore: ' + this.value">
                                    <p id="rangeValue1">Durata cursuri in ore: 1</p>
                                </div>
                                <div class="sliderRecup">
                                    <input type="range" id="rangeRecup" min="0" max="60" value="30" step="1" oninput="rangeValue2.innerText = 'Durata recuperari in minute: ' + this.value">
                                    <p id="rangeValue2">Durata recuperari in minute: 30</p>
                                </div>
                                <div class="sliderDemo">
                                    <input type="range" id="rangeDemo" min="0" max="60" value="30" oninput="rangeValue3.innerText = 'Durata demo in minute: ' + this.value">
                                    <p id="rangeValue3">Durata demo in minute: 30</p>
                                </div>
                                <center>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="addType()">Adauga</button>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="resetAll()">Reset</button>
                                    <br>
                                    <br>
                                    <input type="hidden" value="<?php echo $uname; ?>" name="trainerName" id="trainerName">
                                    <input type="submit" class="btn btn-primary btn-sm" id="btnSend" name="testSend" onclick="buttonPress()" value="Send Data" />
                    </form>
                    </center>
                    </class>

                </div>
            </div>
            </p>
        </div>
    </section>
    <!-- Work-->

    <section class="about-section text-center" id="work">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-white mb-4">Timp lucrat</h2>
                    <p class="text-white-50">
                        In aceasta sectiune vei regasii detalii despre timpul pe care l-ai lucrat.
                    </p>
                    <?php
                    $connect = new PDO(
                        "mysql:host=logiscool;dbname=userdb",
                        "root",
                        ""
                    );

                    $name = $_GET['uname'];

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
                    $name = $_GET['uname'];
                        $result = mysqli_query($conn, "SELECT SUM($coloana) AS value_sum FROM timesheet WHERE utilizator = '$name'"); 
                        $row = mysqli_fetch_assoc($result); 
                        $sum = $row['value_sum'];
                        return $sum;
                    }
                    ?>
                    <h3 class="text-white-50" allign="center">Fisa de lucru - trainer: <?php echo ucfirst($name) ?></h3>
                    <br />
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th class="text-white-50">Data</th>
                                        <th class="text-white-50">Durata cursuri:</th>
                                        <th class="text-white-50">Durata recuperari:</th>
                                        <th class="text-white-50">Durata demo:</th>
                                        <th class="text-white-50">Durata tabara:</th>
                                        <th class="text-white-50">Ora sosirii:</th>
                                        <th class="text-white-50">Ora plecarii:</th>
                                        <th class="text-white-50">Timp petrecut:</th>
                                        <th class="text-white-50">Timp total:</th>
                                    </tr>
                                    <?php
                                    foreach ($result as $row) {
                                        echo '
                            <tr>
                                <td class="text-white-50">' . $row["dataCurenta"] . '</td>
                                <td class="text-white-50">' . $row["cursH"] . '</td>
                                <td class="text-white-50">' . $row["recupH"] . '</td>
                                <td class="text-white-50">' . $row["demoH"] . '</td>
                                <td class="text-white-50">' . $row["tabaraH"] . '</td>
                                <td class="text-white-50">' . $row["ora_sosirii"] . '</td>
                                <td class="text-white-50">' . $row["ora_plecarii"] . '</td>
                                <td class="text-white-50">' . $row["timp_petrecut"] . '</td>
                                <td class="text-white-50">' . $row["timp_total"] . '</td>
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
                    <br />
                    <br />
                    <script scr="https://ajax.googleapis.com/ajax/libs/
        jquery/2.2.0/jquery.min.js"></script>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container px-4 px-lg-5">Made by &copy; Florin for Logiscool Craiova </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>