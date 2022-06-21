<?php require '../db/connect.php';

if (isset($_SESSION['user'])) {
    header('Location: ../manage');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr_FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whitelist RP</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <?php

    if (isset($_POST['login'])) {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = mysqli_real_escape_string($con, $_POST['username']);
            $password = mysqli_real_escape_string($con, sha1(sha1(sha1(sha1(sha1($_POST['password']))))));

            $result = mysqli_query($con, "SELECT * FROM `hwhitelist-staff` WHERE `username` = '$username'") or die(mysqli_error($con));
            if (mysqli_num_rows($result) < 1) {
                echo "<script>
                              $(document).ready(function () {
                                   toastr[\"error\"](\"Ce compte est introuvable.\", \"Erreur:\")
                              });
                           </script>";
            }

            while ($row = mysqli_fetch_array($result)) {
                if ($password != $row['password']) {
                    echo "<script>
                              $(document).ready(function () {
                                   toastr[\"error\"](\"Identifiants invalides.\", \"Erreur:\")
                              });
                           </script>";
                } elseif ($row['status'] == "0") {
                    echo "<script>
                              $(document).ready(function () {
                                   toastr[\"warning\"](\"Vous devez attentre la validation.\", \"Erreur:\")
                              });
                           </script>";
                    $info = '<div class="callout alert" data-closable="">.</div>';
                } else {
                    $_SESSION['user'] = $row;
                    $_SESSION['ID'] = $row['ID'];

                    $usernameTemp = $_SESSION['user']['username'];

                    echo  "<script>
                                  $(document).ready(function () {
                                       toastr[\"success\"](\"Connexion réussie !\", \"Bravo:\")
                                  });
                                  </script> <META http-equiv=\"refresh\" content=\"2;URL=../manage\"></div>";
                }
            }
        } else {
            echo "<script>
              $(document).ready(function () {
                   toastr[\"error\"](\"Veuillez remplir tous les champs.\", \"Erreur:\")
              });
           </script>";
        }
    }
    ?>

<body>
    <div class="container">
        <img src="../assets/logofivedev.png" width="270">
        <div class="form-outer">
            <h2>Procédure de Connexion</h2>
            <h5 style="color:brown">Pas encore de compte? <a href="../inscription">clique ici</a></h5>
            <form class="form" action="#" method="POST">
                <div class="page slide-page">
                    <div class="field">
                        <div class="label">Pseudonyme:</div>
                        <input type="text" name="username" required placeholder="Exemple: HydraDev" />
                    </div>
                    <div class="field">
                        <div class="label">Mot de passe:</div>
                        <input type="password" name="password" required placeholder="Exemple: *************" />
                    </div>
                    <div class="field">
                        <button type="submit" name="login" class="firstNext">Connexion</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="../assets/script.js"></script>
</body>

</html>