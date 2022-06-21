<?php require '../db/connect.php'; 

$result = mysqli_query($con, "SELECT * FROM `hwhitelist`") or die(mysqli_error($con));
while ($userInfo = mysqli_fetch_array($result)) {
	$ipclient = $userInfo['ip'];}

if ($ipclient == $_SERVER["REMOTE_ADDR"]) {
    // REDIRECT SI WHITELIST MAIS PAS LE CAS
} else { 
    header('Location: ../whitelist');
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

<body>
    <div class="container">
        <img src="../assets/logofivedev.png" width="270">
        <div class="form-outer">
            <header>NOM SERVEUR</header>
            <h2 style="color:red">Vous avez déjà fait une demande !</h2>
            <h4>Si cela est une erreur veuillez contactez un membre du staff.</h4><br>
            <button class="btn btn-success" onclick="window.location.href='../success'">Consulter les resultats</button>
        </div>
    </div>
    <script src="../assets/script.js"></script>
</body>

</html>