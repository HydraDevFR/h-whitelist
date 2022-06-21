<?php require '../db/connect.php'; 

$result = mysqli_query($con, "SELECT * FROM `hwhitelist`") or die(mysqli_error($con));
while ($userInfo = mysqli_fetch_array($result)) {
	$ip = $userInfo['ip'];}

if ($ip == $_SERVER['REMOTE_ADDR']) {
    header('Location: ../error');
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
if (isset($_POST['submit'])) {
    if (isset($_POST['prenom']) && isset($_POST['age']) && isset($_POST['discord']) && isset($_POST['heuresteam']) && isset($_POST['freekill']) && isset($_POST['carkill']) && isset($_POST['nopainrp']) && isset($_POST['nofearp']) && isset($_POST['situation']) && isset($_POST['background'])) {
        $prenom = mysqli_real_escape_string($con, $_POST['prenom']);
        $age = mysqli_real_escape_string($con, $_POST['age']);
        $discord = mysqli_real_escape_string($con, $_POST['discord']);
        $heuresteam = mysqli_real_escape_string($con, $_POST['heuresteam']);
        $freekill = mysqli_real_escape_string($con, $_POST['freekill']);
        $carkill = mysqli_real_escape_string($con, $_POST['carkill']);
        $nopainrp = mysqli_real_escape_string($con, $_POST['nopainrp']);
        $nofearp = mysqli_real_escape_string($con, $_POST['nofearp']);
        $situation = mysqli_real_escape_string($con, $_POST['situation']);
        $background = mysqli_real_escape_string($con, $_POST['background']);
        $ipremote = mysqli_real_escape_string($con, $_SERVER['REMOTE_ADDR']);
        $confirmation = mysqli_real_escape_string($con, $_POST['confirmation']);
        $date = time();

        mysqli_query($con, "INSERT INTO hwhitelist (`prenom`, `age`, `discord`, `heuresteam`, `freekill`, `carkill`, `nopainrp`, `nofearp`, `situation`, `background`, `ip`, `date`, `confirmation`) VALUES('$prenom', '$age', '$discord', '$heuresteam', '$freekill', '$carkill', '$nopainrp', '$nofearp', '$situation', '$background', '$ipremote', '$date', '$confirmation')") or die(mysqli_error($con));

        //Embeds
        $authorname = "✈ H-WHITELIST ✈";
        $icon_url = "https://cdn1.iconfinder.com/data/icons/cybersecurity-1/512/Whitelisting-512.png";
        $title = "📢 Nouvelle demande de Whitelist";
        $color = 25500;
        $thumbnail_url = "https://cdn1.iconfinder.com/data/icons/cybersecurity-1/512/Whitelisting-512.png";
        $description = "Prénom: **$prenom** \n age: **$age** \n Discord **$discord** \n Nombre d'heures **$heuresteam** \n Définition Freekill **$freekill** \n Définition Carkill **$carkill** \n Définition NoPainRP **$nopainrp** \n Définition NoFeaRP **$nofearp** \n Situation **$situation** \n Background **$background**";
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
                                                      toastr["success"]("Demande de whitelist !", "Bravo:")
                                                  });
                                              </script><META http-equiv="refresh" content="2;URL=../success">';
    }
} ?>

<body>
    <div class="container">
        <img src="../assets/logofivedev.png" width="270">
        <div class="form-outer">
            <header>NOM SERVEUR</header>
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
                    <div class="title">1️⃣ - Information IRL:</div>
                    <div class="field">
                        <div class="label">Prénom:</div>
                        <input type="text" name="prenom" required placeholder="Exemple: Patrice" />
                    </div>
                    <div class="field">
                        <div class="label">Age:</div>
                        <input type="number" name="age" required placeholder="Exemple: 18 ans" />
                    </div>
                    <div class="field">
                        <button class="firstNext next">Page suivante -></button>
                    </div>
                </div>

                <div class="page">
                    <div class="title">2️⃣ - Information IRL:</div>
                    <div class="field">
                        <div class="label">Votre Discord</div>
                        <input type="text" name="discord" required placeholder="Exemple: HydraDev#1278" />
                    </div>
                    <div class="field">
                        <div class="label">Nombre d'heures FiveM</div>
                        <input type="number" name="heuresteam" required placeholder="Exemple: 1500 Heures" />
                    </div>
                    <div class="field btns">
                        <button class="prev-1 prev">
                            <- Revenir </button>
                                <button class="next-1 next">Suivant -></button>
                    </div>
                </div>
                <div class="page">
                    <div class="title">3️⃣ - Information RP:</div>
                    <div class="field">
                        <div class="label">Definition du FreeKill</div>
                        <input type="text" name="freekill" required placeholder="Exemple: Voler des voitures" />
                    </div>
                    <div class="field">
                        <div class="label">Definition du CarKill</div>
                        <input type="text" name="carkill" required placeholder="Exemple: Voler des avions" />
                    </div>
                    <div class="field btns">
                        <button class="prev-2 prev">
                            <- Revenir </button>
                                <button class="next-2 next">Suivant -></button>
                    </div>
                </div>
                <div class="page">
                    <div class="title">4️⃣ - Information RP:</div>
                    <div class="field">
                        <div class="label">Definition du NoPainRP</div>
                        <input type="text" name="nopainrp" required placeholder="Exemple: Faire des peintures interdite" />
                    </div>
                    <div class="field">
                        <div class="label">Definition du NoFeaRP</div>
                        <input type="text" name="nofearp" required placeholder="Exemple: Insulter des personnes" />
                    </div>
                    <div class="field btns">
                        <button class="prev-3 prev">
                            <- Revenir </button>
                                <button class="next-3 next">Suivant -></button>
                    </div>
                </div>

                <div class="page">
                    <div class="title">5️⃣ - Situation RP</div>
                    <div class="field">
                        <div class="label" class="label">Situation Roleplay</div>
                        <textarea type="textarea" rows="5" cols="33" disabled>Un braqueur braque un pompier en service et cette personne ne possède pas d’argent sur elle mais le braqueur ne lui a pas retiré ces moyens de communication donc elle prévient la police discrètement, le braqueur la conduit jusqu'à la banque et lui demande de retirer tout l’argent qu’elle possède sur son compte ensuite elle part en course poursuite avec la police puis elle quitte le jeu.                            </textarea>
                    </div><br><br>
                    <div class="field">
                        <div class="label">Votre réponse</div>
                        <select required name="situation">
                            <option value="Le pompier est en faute (Radio)">Le pompier est en faute (Radio)</option>
                            <option value="Le braqueur est en faute (ALT F4)">Le braqueur est en faute (ALT F4)</option>
                            <option value="Le braqueur est en faute (Braque un pompier, ForceRP, ALT F4)">Le braqueur est en faute (Braque un pompier, ForceRP, ALT F4)</option>
                            <option value="Le braqueur est en faute (ForceRP)">Le braqueur est en faute (ForceRP)</option>
                            <option value="Aucune Faute">Aucune Faute</option>
                        </select>
                    </div>
                    <div class="field btns">
                        <button class="prev-4 prev">
                            <- Revenir </button>
                                <button class="next-4 next">Suivant -></button>
                    </div>
                </div>

                <div class="page">
                    <div class="title">6️⃣ - Information WL:</div>
                    <div class="field">
                        <div class="label" class="label">Votre Background</div>
                        <textarea type="textarea" id="background" name="background" rows="5" cols="33" required placeholder="Exemple: Frank Pacino a grandi dans les quartiers mal famés de Blaine County. Vivant dans une famille nombreuses et ayant un fort caractères, il ce faisait souvent tabassez par ces frères et soeurs qui ne le supportaient pas. Son père étant un chomeur et sa mère femme de ménage, leur situation était vraiment précaire: c'est pourquoi Frank compris qu'il devait ce débrouillez lui même. Tandis que c'est frères ainés trainait avec différents cartel , il découvrit rapidement que sont fort caractère et c'est capacité de chimiste lui permetrait de ce faire une réputation dans les différents trafics illégales. Vers c'est 19 ans (après des années a cuisiner la meth aux cartels ), Frank comprit que le vrai commerce, celui qui rapportait gros, c'était de la vendre pour lui même . Frank décida se lancer dans l'aventure."></textarea>
                    </div><br><br>
                    <div class="field">
                        <div class="label">Confirmation du Règlement</div>
                        <select required name="confirmation">
                            <option value="Totalement d'accord">✅ Totalement d'accord</option>
                            <option value="Je ne suis pas d'accord">❌ Je ne suis pas d'accord</option>
                        </select>
                    </div>
                    <div class="field btns">
                        <button class="prev-5 prev">
                            <- Revenir </button>
                                <button class="submit" name="submit">Envoyé</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="../assets/script.js"></script>
</body>

</html>