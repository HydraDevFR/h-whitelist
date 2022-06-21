<?php require '../db/connect.php';

if (!isset($_SESSION['user'])) {
  header('Location: ../connexion');
  exit();
}

if ($status < 1 or $status > 1) {
  header('Location: ../whitelist/');
  exit();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Gestion | H-Whitelist</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'>
  <link rel='stylesheet' href='https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css'>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/boxicons@2.0.0/css/boxicons.min.css'>
  <link rel="stylesheet" href="../assets/css-manage/style.css">
  <meta property="og:locale" content="fr_FR" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="Système de Whitelist" />
  <meta property="og:description" content="Rejoint nous dès maintenant !" />
  <meta property="og:site_name" content="Système de Whitelist" />
  <meta property="og:image" content="../assets/logofivedev.png" />
  <meta property="og:image:width" content="1920" />
  <meta property="og:image:height" content="1080" />
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:label1" content="Écrit par">
  <meta name="twitter:data1" content="HydraDev">
  <meta name="twitter:label2" content="Durée de lecture est.">
  <meta name="twitter:data2" content="0 minute">
  <link rel="shortcut icon" href="../assets/logofivedev.png" type="image/x-icon">
  <link rel="icon" href="../assets/logofivedev.png" type="image/x-icon">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
</head>

<body>
  <div class="container"><br>
    <center><img src="../assets/logofivedev.png" width="350"></center>
    <div class="row py-5">
      <div class="col-12">
        <div class="container p-3 my-3 bg-white text-dark" style="border-radius:10px;">
          <table id="example" class="table table-hover responsive nowrap" style="width:100%">
            <thead>
              <tr>
                <th>Prenom</th>
                <th>Age</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $result = mysqli_query($con, "SELECT * FROM hwhitelist ORDER BY id DESC") or die(mysqli_error($con));
              while ($resultatInfos = mysqli_fetch_array($result)) {
                $id = $resultatInfos['id'];
                $ip = $resultatInfos['ip'];
                $validation = $resultatInfos['validation'];
                $prenom = $resultatInfos['prenom'];
                $age = $resultatInfos['age'];
                $discord = $resultatInfos['discord'];
                $heuresteam = $resultatInfos['heuresteam'];
                $freekill = $resultatInfos['freekill'];
                $carkill = $resultatInfos['carkill'];
                $nopainrp = $resultatInfos['nopainrp'];
                $nofearp = $resultatInfos['nofearp'];
                $situation = $resultatInfos['situation'];
                $background = $resultatInfos['background'];

                if ($resultatInfos['validation'] == '1') {
                  $stats = '<div class="badge badge-success badge-success-alt">Whitelist Actif</div>';
                } else if ($resultatInfos['validation'] == '2') {
                  $stats = '<div class="badge badge-danger badge-danger-alt">Whitelist Refusé</div>';
                } else {
                  $stats = '<div class="badge badge-warning badge-warning-alt">En attente !</div>';
                }
              ?>
                <form class="form" action="#" method="POST">
                  <tr>
                    <td>
                      <a href="#">
                        <div class="d-flex align-items-center">
                          <div class="avatar avatar-blue mr-3">🐌</div>

                          <div class="">
                            <p class="font-weight-bold mb-0"><?php echo $prenom; ?></p>
                            <p class="text-muted mb-0"><?php echo $discord; ?></p>
                          </div>
                        </div>
                      </a>
                    </td>
                    <td><?php echo $age; ?> Ans</td>
                    <td>Le <?php echo date("d-m-Y à H:i:s", $resultatInfos['date']); ?></td>
                    <td>
                      <?php echo $stats; ?>
                    </td>
                    <td><button class="btn btn-success" onclick="window.location.href='edit-whitelist.php?id=<?php echo $resultatInfos['id']; ?>'">Consulter</button></td>
                  </tr>
                </form>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- partial -->
  <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js'></script>
  <script src='https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js'></script>
  <script src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script>
  <script src="../assets/css-manage/script.js"></script>

</body>

</html>