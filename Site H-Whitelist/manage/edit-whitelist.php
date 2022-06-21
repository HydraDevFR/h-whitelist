<?php require '../db/connect.php';
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

if (!isset($_SESSION['user'])) {
    header('Location: ../connexion');
    exit();
}

if ($status < 1 or $status > 1) {
    header('Location: ../whitelist/');
    exit();
}

$idUser = mysqli_real_escape_string($con, $_GET['id']);
$result = mysqli_query($con, "SELECT * FROM `hwhitelist` WHERE `id` = '$idUser' LIMIT 1") or die(mysqli_error($con));

while ($userInfo = mysqli_fetch_array($result)) {
    $id = $userInfo['id'];
    $ip = $userInfo['ip'];
    $validation = $userInfo['validation'];
    $prenom = $userInfo['prenom'];
    $age = $userInfo['age'];
    $discord = $userInfo['discord'];
    $heuresteam = $userInfo['heuresteam'];
    $freekill = $userInfo['freekill'];
    $carkill = $userInfo['carkill'];
    $nopainrp = $userInfo['nopainrp'];
    $nofearp = $userInfo['nofearp'];
    $situation = $userInfo['situation'];
    $background = $userInfo['background'];
    $confirmation = $userInfo['confirmation'];

    if ($userInfo['validation'] == '1') {
        $stats = '<font color=green>Whitelist Actif</font>';
    } else if ($userInfo['validation'] == '2') {
        $stats = '<font color=red>Whitelist Refusé</font>';
    } else {
        $stats = '<font color=orange>En attente !</font>';
    }
    

}



?>
<!DOCTYPE html>
<html lang="fr_FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage | Whitelist RP</title>
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
    <?php

    if (isset($_POST['supprimer'])) {
        mysqli_query($con, "DELETE FROM `hwhitelist` WHERE `id` = '$idUser'") or die(mysqli_error($con));

        //Embeds
        $authorname = "✈ H-WHITELIST ✈";
        $icon_url = "https://cdn1.iconfinder.com/data/icons/cybersecurity-1/512/Whitelisting-512.png";
        $title = "📢 Formulaire Supprimer";
        $color = 25500;
        $thumbnail_url = "https://cdn1.iconfinder.com/data/icons/cybersecurity-1/512/Whitelisting-512.png";
        $description = "Prénom: **$prenom** \n age: **$age** \n Discord **$discord** \n\n 🙍‍♂️ Refusé par **$username**";
        $footer_text = "HydraDev#1278 | Whitelist";
        $footer_icon_url = "https://cdn1.iconfinder.com/data/icons/cybersecurity-1/512/Whitelisting-512.png";

        $message = [
            'content' => null,
            'avatar_url' => $avatar,
            'embeds' => [[
                'author' => [
                    'name' => $authorname,
                    'url' => $url,
                    'icon_url' => $icon_url,
                ],
                'title' => $title,
                'description' => $description,
                'color' => $color,
                'thumbnail' => [
                    'url' => $thumbnail_url,
                ],
                'image' => [
                    'url' => $image_url,
                ],
                'footer' => [
                    'text' => $footer_text,
                    'icon_url' => $footer_icon_url
                ]
            ]]
        ];

        $encoded_message = json_encode($message, JSON_PRETTY_PRINT);

        //var_dump($encoded_message);

        $webhook_url = WEBHOOK_DISCORD;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $webhook_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded_message);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($encoded_message)
            )
        );

        curl_exec($ch);
        curl_close($ch);

        echo '<script>
    $(document).ready(function () {
        toastr["success"]("Vous venez de supprimer le formulaire !", "Bravo:")
    });
</script><META http-equiv="refresh" content="2;URL=../manage">';
    }

    if (isset($_POST['accepter'])) {
        mysqli_query($con, "UPDATE `hwhitelist` SET `validation` = '1' WHERE `id` = '$idUser'") or die(mysqli_error($con));

        //Embeds
        $authorname = "✈ H-WHITELIST ✈";
        $icon_url = "https://cdn1.iconfinder.com/data/icons/cybersecurity-1/512/Whitelisting-512.png";
        $title = "📢 Whitelist Accepté";
        $color = 25500;
        $thumbnail_url = "https://www.pngmart.com/files/16/Green-Check-Mark-PNG-Pic.png";
        $description = "Prénom: **$prenom** \n age: **$age** \n Discord **$discord** \n\n 🙍‍♂️ Accepté par **$username**";
        $footer_text = "HydraDev#1278 | Whitelist";
        $footer_icon_url = "https://cdn1.iconfinder.com/data/icons/cybersecurity-1/512/Whitelisting-512.png";

        $message = [
            'content' => null,
            'avatar_url' => $avatar,
            'embeds' => [[
                'author' => [
                    'name' => $authorname,
                    'url' => $url,
                    'icon_url' => $icon_url,
                ],
                'title' => $title,
                'description' => $description,
                'color' => $color,
                'thumbnail' => [
                    'url' => $thumbnail_url,
                ],
                'image' => [
                    'url' => $image_url,
                ],
                'footer' => [
                    'text' => $footer_text,
                    'icon_url' => $footer_icon_url
                ]
            ]]
        ];

        $encoded_message = json_encode($message, JSON_PRETTY_PRINT);

        //var_dump($encoded_message);

        $webhook_url = WEBHOOK_DISCORD;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $webhook_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded_message);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($encoded_message)
            )
        );

        curl_exec($ch);
        curl_close($ch);


        echo '<script>
    $(document).ready(function () {
        toastr["success"]("Vous venez de valider la whitelist !", "Bravo:")
    });
</script><META http-equiv="refresh" content="2;URL=../manage">';
    }

    if (isset($_POST['refuser'])) {
        mysqli_query($con, "UPDATE `hwhitelist` SET `validation` = '2' WHERE `id` = '$idUser'") or die(mysqli_error($con));

                //Embeds
                $authorname = "✈ H-WHITELIST ✈";
                $icon_url = "https://cdn1.iconfinder.com/data/icons/cybersecurity-1/512/Whitelisting-512.png";
                $title = "📢 Whitelist Refusé";
                $color = 25500;
                $thumbnail_url = "https://www.assurance-pret-pas-cher.com/wp-content/uploads/2016/06/refus-assurance-pret-surpoid.png";
                $description = "Prénom: **$prenom** \n age: **$age** \n Discord **$discord** \n\n 🙍‍♂️ Refusé par **$username**";
                $footer_text = "HydraDev#1278 | Whitelist";
                $footer_icon_url = "https://cdn1.iconfinder.com/data/icons/cybersecurity-1/512/Whitelisting-512.png";
        
                $message = [
                    'content' => null,
                    'avatar_url' => $avatar,
                    'embeds' => [[
                        'author' => [
                            'name' => $authorname,
                            'url' => $url,
                            'icon_url' => $icon_url,
                        ],
                        'title' => $title,
                        'description' => $description,
                        'color' => $color,
                        'thumbnail' => [
                            'url' => $thumbnail_url,
                        ],
                        'image' => [
                            'url' => $image_url,
                        ],
                        'footer' => [
                            'text' => $footer_text,
                            'icon_url' => $footer_icon_url
                        ]
                    ]]
                ];
        
                $encoded_message = json_encode($message, JSON_PRETTY_PRINT);
        
                //var_dump($encoded_message);
        
                $webhook_url = WEBHOOK_DISCORD;
        
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $webhook_url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $encoded_message);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($encoded_message)
                    )
                );
        
                curl_exec($ch);
                curl_close($ch);
        

        echo '<script>
    $(document).ready(function () {
        toastr["success"]("Vous venez de refuser la whitelist !", "Bravo:")
    });
</script><META http-equiv="refresh"
content="2;URL=../manage">';
    }

    ?>

    <div class="container">
        <img src="../assets/logofivedev.png" width="270">
        <div class="form-outer">
            <header>Modification du formulaire</header>
            <div class="progress-bar">
                <div class="step">
                    <p></p>
                    <div class="bullet">
                        <span>1</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p></p>
                    <div class="bullet">
                        <span>2</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <div class="bullet">
                        <span>3</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p></p>
                    <div class="bullet">
                        <span>4</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p></p>
                    <div class="bullet">
                        <span>5</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p></p>
                    <div class="bullet">
                        <span>6</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
            </div>

            <form class="form" action="#" method="POST">
                <div class="page slide-page">
                    <div class="title">Information IRL:</div>
                    <div class="field">
                        <div class="label">Prénom:</div>
                        <input type="text" required placeholder="<?php echo $prenom; ?>" disabled />
                    </div>
                    <div class="field">
                        <div class="label">Age:</div>
                        <input type="text" required placeholder="<?php echo $age; ?> Ans" disabled />
                    </div>
                    <div class="field">
                        <button class="firstNext next">Page suivante -></button>
                    </div>
                    <p class="btn btn-success" onclick="window.location.href='../manage'"><- Retour sur la liste des formulaires</p>
                </div>

                <div class="page">
                    <div class="field">
                        <div class="label">Discord</div>
                        <input type="text" required placeholder="<?php echo $discord; ?>" disabled />
                    </div>
                    <div class="field">
                        <div class="label">Nombre d'heures FiveM</div>
                        <input type="text" required placeholder="<?php echo $heuresteam; ?>" disabled />
                    </div>
                    <div class="field btns">
                        <button class="prev-1 prev">
                            <- Revenir </button>
                                <button class="next-1 next">Suivant -></button>
                    </div>
                </div>
                <div class="page">
                    <div class="field">
                        <div class="label">Definition du FreeKill</div>
                        <input type="text" required placeholder="<?php echo $freekill; ?>" disabled />
                    </div>
                    <div class="field">
                        <div class="label">Definition du CarKill</div>
                        <input type="text" required placeholder="<?php echo $carkill; ?>" disabled />
                    </div>
                    <div class="field btns">
                        <button class="prev-2 prev">
                            <- Revenir </button>
                                <button class="next-2 next">Suivant -></button>
                    </div>
                </div>
                <div class="page">
                    <div class="field">
                        <div class="label">Definition du NoPainRP</div>
                        <input type="text" required placeholder="<?php echo $nopainrp; ?>" disabled />
                    </div>
                    <div class="field">
                        <div class="label">Definition du NoFeaRP</div>
                        <input type="text" required placeholder="<?php echo $nofearp; ?>" disabled />
                    </div>
                    <div class="field btns">
                        <button class="prev-3 prev">
                            <- Revenir </button>
                                <button class="next-3 next">Suivant -></button>
                    </div>
                </div>

                <div class="page">
                    <div class="field">
                        <div class="label" class="label">Situation Roleplay</div>
                        <textarea type="textarea" rows="5" cols="33" disabled>Un braqueur braque un pompier en service et cette personne ne possède pas d’argent sur elle mais le braqueur ne lui a pas retiré ces moyens de communication donc elle prévient la police discrètement, le braqueur la conduit jusqu'à la banque et lui demande de retirer tout l’argent qu’elle possède sur son compte ensuite elle part en course poursuite avec la police puis elle quitte le jeu.                            </textarea>
                    </div><br><br>
                    <div class="field">
                        <div class="label">Réponse</div>
                        <input type="text" required placeholder="<?php echo $situation; ?>" disabled />
                    </div>
                    <div class="field btns">
                        <button class="prev-4 prev">
                            <- Revenir </button>
                                <button class="next-4 next">Suivant -></button>
                    </div>
                </div>

                <div class="page">
                    <div class="field">
                        <div class="label" class="label">Background</div>
                        <textarea type="textarea" id="background" rows="5" cols="33" required placeholder="<?php echo $background; ?>" disabled></textarea>
                    </div><br><br>
                    <div class="field">
                        <div class="label">Confirmation du Règlement</div>
                        <input type="text" required placeholder="<?php echo $confirmation; ?>" disabled />
                    </div>
                    <div class="field btns">
                        <button class="prev-5 prev">
                            <- Revenir </button>
                                <button class="next-5 next">Suivant -></button>
                    </div>
                </div>
                <div class="page">
                    <button class="btn btn-success" type="submit" name="accepter">Accepter la whitelist</button>
                    <button class="btn btn-danger" type="submit" name="refuser">Refuser la whitelist</button><br><br>
                    <button class="btn btn-dark" type="submit" name="supprimer">Supprimer la whitelist</button><br><br><br>
                    <h2>Status du formulaire: <?php echo $stats; ?></h2>
                    <div class="field btns">
                        <button class="prev-5 prev">
                            <- Revenir </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="../assets/script.js"></script>
</body>

</html>