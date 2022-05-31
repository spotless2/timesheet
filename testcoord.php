<!DOCTYPE html>
<html>

<head>
  <!-- Site made with Mobirise Website Builder v5.6.8, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.6.8, mobirise.com">
  <meta name="twitter:card" content="summary_large_image" />
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
  <noscript>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost:100,200,300,400,500,600,700,800,900,100i,200i,300i,400i,500i,600i,700i,800i,900i&display=swap">
  </noscript>
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
</head>

<body>
  <section data-bs-version="5.1" class="header5 cid-t6R5DAwFjv mbr-fullscreen" id="header5-0">
    <div class="container">
      <div class="row justify-content-end">
        <div class="col-12 col-lg-7">
          <h1 class="mbr-section-title mbr-fonts-style mbr-white mb-3 display-1"><strong>Panou coordonator</strong></h1>

          <p class="mbr-text mbr-fonts-style mbr-white display-7">Aici poti vedea detalii despre fiecare trainer in parte.</p>
          <?php
          $conn = new mysqli('logiscool', 'root', '', 'userdb')
            or die('Cannot connect to db');

          $result = $conn->query("select username from login where type <> 'coordonator'");

          echo "<html>";
          echo "<body>";

          while ($row = $result->fetch_assoc()) {

            unset($name);
            $numeTrainer = ucfirst($row['username']);
            echo "<a class='btn btn-primary display-12' type='submit' href='tabele.php?name=" . $numeTrainer . "'>" . $numeTrainer . "</a>";
          }
          echo "</body>";
          echo "</html>";
          ?>
        </div>
      </div>
      <center>
        <script type="text/javascript">
          function youSure() {
            var beSure = confirm('Atentie! Esti pe cale sa resetezi pontajul total, esti sigur?')
            if (beSure) {
              location.href = 'reset.php';
            }
          }
        </script>
        <button type="button" type="submit" class="btn btn-danger" onclick="youSure()">Reseteaza fisele</button>
      </center>
    </div>
  </section>

</body>

</html>