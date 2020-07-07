<?php
/* Template name: Contact */

// Responsables
$posts = get_posts(array(
    'post_type' => 'responsables',
    'posts_per_page' => -1,
    'post_status' => 'published',
    'meta_query' => array(
        array(
            'key' => 'est_responsonsable',
            'value' => '1',
        )
    )
));

//  --------------   Récupération du contenu des messages en format JSON   -------------------
$contenuFichierJson = file_get_contents("wp-content/themes/tim/ressources/liaisons/js/messages-erreur.json");
$tMessagesJson = json_decode($contenuFichierJson, true);

$tValidation = array();

// Fonction qui valide les champs du formulaire
function validerChamp(string $nomChamp, $motif, $messagesJson, array $tValidation, bool $champRequis): array
{
    $valeurChamp = '';
    $champValide = false;
    $message = '';

    // Si le nom du champs est en POST
    if (isset($_POST[$nomChamp])) {

        // On retire les espaces blancs
        $valeurChamp = trim($_POST[$nomChamp]);

        // Si le champ est vide alors qu'il est obligatoire, on met le message d'erreur - vide
        if ($valeurChamp == '' && $champRequis == true) {
            $message = $messagesJson[$nomChamp]['erreurs']['vide'];
        } else {
            $resultatValidation = preg_match($motif, $_POST[$nomChamp]);

            // S'il y a une valeur, on le teste avec le regex. S'il est mauvais, on met le message de motif
            if ($resultatValidation == false) {
                $message = $messagesJson[$nomChamp]['erreurs']['motif'];
            } else {
                // Le champ est valide
                $champValide = true;
            }
        }
    } else {
        if ($champRequis == false) {
            $champValide = true;
        } else {
            $message = $messagesJson[$nomChamp]['erreurs']['vide'];
        }
    }

    $tValidation[$nomChamp] = ['valeur' => $valeurChamp, "champValide" => $champValide, "message" => $message];
    return $tValidation;
}

//  ------------------------   Validation des champs simples   -------------------------------
$tValidation = validerChamp("nom", "#^[a-zA-ZÀ-ÿ\- ]{1,50} [a-zA-ZÀ-ÿ\- ]{1,50}$#", $tMessagesJson, $tValidation, true);
$tValidation = validerChamp("courriel", "#^[a-zA-Z0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,}$#", $tMessagesJson, $tValidation, true);
$tValidation = validerChamp("destinataire", "#^[0-9]$#", $tMessagesJson, $tValidation, true);
$tValidation = validerChamp("sujet", "#^[a-zA-ZÀ-ÿ\- ]{1,200}$#", $tMessagesJson, $tValidation, true);
$tValidation = validerChamp("message", "#^[a-zA-ZÀ-ÿ\-!@$%?&*().;:+:{}<>^'\" ]{1,1000}$#", $tMessagesJson, $tValidation, true);

// -----  Vérifie s'il y a des champs invalides parmi le tableau créé à partir des données reçues -----
$tChampsValides = array_column($tValidation, 'champValide');
$invalide = in_array(false, $tChampsValides);

// Classe qui serviral à indiquer la rétroaction de l'envoi de courriel
$classeCourriel = '';

if ($invalide) {
    // Des champs sont invalides donc, le courriel n'est pas envoyé, le formulaire non plus
    $tValidation['retroaction'] = $tMessagesJson['retroactions']['courriel']['completer'];
    $classeCourriel = 'warning';
} else {
// On valide le captcha
    if (isset($_POST["g-recaptcha-response"])) {
        $captcha = $_POST["g-recaptcha-response"];
    }

    if ($captcha) {
        // S'il n'y a pas d'erreur $arrChampsErreur

        // Vérifier captcha
        $secretKey = "6Ld2xZAUAAAAAKTP2SAEIyikTTN2uzxmgcNRaiLv";
        $ip = $_SERVER['REMOTE_ADDR'];

        // Éléments de secret key et ip envoyé à Google
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $captcha . "&remoteip=.$ip");
        $responseKeys = json_decode($response, true);

        // Si on a un succès au niveau des clées, on envoie le courriel
        if (intval($responseKeys["success"]) === 1) {
            // Envoyer courriel avec paramètres php mailer

            // On fait une boucle pour trouver le courriel du destinataire sélectionné
            foreach ($posts as $post) {
                if (get_field('id') == $tValidation['destinataire']['valeur']) {
                    $to = get_field('courriel');
                }
            }

            // On crée le courriel
            $subject = "Quelqu'un a envoyé un message depuis le site " . get_bloginfo('name');
            $headers = array('Content-Type: Text/html; charset=UTF-8', 'From: ' . $tValidation['courriel']['valeur'], 'Reply: ' . $tValidation['courriel']['valeur']);
            $envoi = wp_mail($to, $subject, 'De : ' . $tValidation['nom']['valeur'] . ' | <b>' . $tValidation['courriel']['valeur'] . '</b> ' . '<br/> Sujet : ' . $tValidation['sujet']['valeur'] . ' <br/> ' . stripslashes($tValidation['message']['valeur']), $headers);

            if ($envoi) {
                //Si envoyé
                $tValidation['retroaction'] = $tMessagesJson['retroactions']['courriel']['envoyer'];
                $classeCourriel = 'succes';
            } else {
                //Sinon message d'erreur
                $tValidation['retroaction'] = $tMessagesJson['retroactions']['courriel']['avorter'];
                $classeCourriel = 'warning';
            }
        } else {
            // Le captcha n'a pas fonctionné
            $tValidation['g-recaptcha-response']['message'] = $tMessagesJson['humain']['erreurs']['motif'];
        }
    } else {
        // Le captcha n'a pas été rempli
        $tValidation['g-recaptcha-response']['message'] = $tMessagesJson['humain']['erreurs']['vide'];
    }
}

get_header(); ?> <!-- Appel au template de l 'en-tête -->
<main class="joindre">
    <div class="background background--blanc">
        <div class="conteneur contact">
            <h1 class="contact__titre">Des questions ou commentaires sur...</h1>
            <div class="prof__conteneur">
                <?php foreach ($posts as $post) { ?>
                    <article class="prof">
                        <header>
                            <h2 class="h4"><?php the_field('domaine'); ?></h2>
                        </header>
                        <img class="prof__photo"
                             src="
            <?php echo get_field('photo_responsable')['sizes']['medium']; ?>"
                             srcset="
            <?php echo get_field('photo_responsable')['sizes']['medium']; ?> 2x,
            <?php echo get_field('photo_responsable')['sizes']['thumbnail']; ?> 1x"
                             alt="Photographie : <?php echo get_field('prenom'); ?> <?php echo get_field('nom'); ?>">
                        <div class="info">
                            <p class="prof__nom"><?php echo get_field('prenom'); ?> <?php echo get_field('nom'); ?></p>
                            <p class="prof__responsabilite"><?php echo get_field('responsabilite'); ?></p>
                            <p class="prof__telephone"><?php echo get_field('telephone'); ?></p>
                        </div>
                    </article>
                <?php } ?>
            </div>
        </div>
        <div class="conteneur form">
            <div class="form__conteneur">
                <h2>Contactez-nous!</h2>
                <span class="icone arrowDown"></span>
            </div>
            <?php
            if (isset($_POST['g-recaptcha-response']) && isset($tValidation['retroaction'])) { ?>
                <div class="envoiCourriel <?php echo $classeCourriel; ?>">
                    <?php echo $tValidation['retroaction']; ?>
                </div>
            <?php } ?>
            <form action="" method="post" class="formulaire">
                <fieldset>
                    <legend class="screen-reader-only">Formulaire de contact</legend>
                    <div class="nom ctnForm">
                        <label for="nom">Nom complet<span class="succes"></span></label>
                        <input type="text" id="nom" name="nom"
                               pattern="^[a-zA-ZÀ-ÿ\- ]{1,50} [a-zA-ZÀ-ÿ\- ]{1,50}$"
                               title="Veuillez écrire votre prénom et votre nom." required
                               class="form__nom input
                               <?php if (isset($_POST['nom'])) {
                                   if ($tValidation['nom']['valeur'] == "" || $tValidation['nom']['champValide'] == false) {
                                       echo 'input--erreur';
                                   }
                               } ?>"
                            <?php
                            if (isset($_POST['nom'])) { ?>
                                value="<?php echo $tValidation['nom']['valeur'] ?>"
                            <?php } ?> >
                        <p class="validation__message" aria-live="assertive">
                            <?php if (isset($_POST['nom'])) {
                                if ($tValidation['nom']['valeur'] == "" || $tValidation['nom']['champValide'] == false) {
                                    echo $tValidation['nom']['message'];
                                }
                            } ?>
                        </p>
                    </div>
                    <div class="email ctnForm">
                        <label for="courriel">Courriel<span class="succes"></span></label>
                        <input class="large form__courriel input
                        <?php if (isset($_POST['courriel'])) {
                            if ($tValidation['courriel']['valeur'] == "" || $tValidation['courriel']['champValide'] == false) {
                                echo 'input--erreur';
                            }
                        } ?>" type="email" id="courriel" name="courriel"
                               pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$"
                               title="Vérifiez votre adresse courriel, il semble y avoir une erreur." required
                            <?php
                            if (isset($_POST['courriel'])) { ?>
                                value="<?php echo $tValidation['courriel']['valeur'] ?>"
                            <?php } ?> >
                        <p class="validation__message" aria-live="assertive">
                            <?php if (isset($_POST['courriel'])) {
                                if ($tValidation['courriel']['valeur'] == "" || $tValidation['courriel']['champValide'] == false) {
                                    echo $tValidation['courriel']['message'];
                                }
                            } ?>
                        </p>
                    </div>
                    <div class="destinataire ctnForm">
                        <label for="destinataire">Destinataire</label>
                        <select name="destinataire" id="destinataire" class="form__destinataire input
                        <?php if (isset($_POST['destinataire'])) {
                            if ($tValidation['destinataire']['valeur'] == "" || $tValidation['destinataire']['champValide'] == false) {
                                echo 'input--erreur';
                            }
                        } ?>">
                            <option value="">Choisir un destinataire</option>
                            <?php foreach ($posts as $post) { ?>
                                <option value="<?php echo get_field('id'); ?>"
                                    <?php if (isset($_POST['destinataire'])) {
                                        if ($tValidation['destinataire']['valeur'] == get_field('id')) { ?>
                                            selected="selected"
                                        <?php }
                                    } elseif (isset($_GET['id'])) {
                                        if (get_field('id', $_GET['id']) == get_field('id')) { ?>
                                            selected="selected"
                                        <?php }
                                    }
                                    ?>
                                ><?php echo get_field('prenom'); ?> <?php echo get_field('nom'); ?>
                                    (<?php echo get_field('responsabilite'); ?>)
                                </option>
                            <?php } ?>
                        </select>
                        <p class="validation__message" aria-live="assertive">
                            <?php if (isset($_POST['destinataire'])) {
                                if ($tValidation['destinataire']['champValide'] == false) {
                                    echo $tValidation['destinataire']['message'];
                                }
                            } ?>
                        </p>
                    </div>
                    <div class="sujet ctnForm">
                        <label for="sujet">Sujet<span class="succes"></span></label>
                        <input type="text" id="sujet" name="sujet" class="form__sujet input
                        <?php if (isset($_POST['sujet'])) {
                            if ($tValidation['sujet']['valeur'] == "" || $tValidation['sujet']['champValide'] == false) {
                                echo 'input--erreur';
                            }
                        } ?>"
                               pattern="^[a-zA-ZÀ-ÿ\- ]{1,200}$"
                               title="Veuillez saisir le sujet du message." required
                            <?php
                            if (isset($_POST['sujet'])) { ?>
                                value="<?php echo $tValidation['sujet']['valeur'] ?>"
                            <?php } ?> >
                        <p class="validation__message" aria-live="assertive">
                            <?php if (isset($_POST['sujet'])) {
                                if ($tValidation['sujet']['valeur'] == "" || $tValidation['sujet']['champValide'] == false) {
                                    echo $tValidation['sujet']['message'];
                                }
                            } ?>
                        </p>
                    </div>
                    <div class="message ctnForm">
                        <label for="message">Message<span class="succes"></span></label>
                        <textarea class="form__message input
                        <?php if (isset($_POST['message'])) {
                            if ($tValidation['message']['valeur'] == "" || $tValidation['message']['champValide'] == false) {
                                echo 'input--erreur';
                            }
                        } ?>" name="message" id="message" cols="30" rows="10"
                                  title="Veuillez saisir un message." maxlength="10000"
                                  required><?php if (isset($_POST['message'])) {
                                echo $tValidation['message']['valeur'];
                            } ?></textarea>
                        <p class="validation__message" aria-live="assertive">
                            <?php if (isset($_POST['message'])) {
                                if ($tValidation['message']['valeur'] == "" || $tValidation['message']['champValide'] == false) {
                                    echo $tValidation['message']['message'];
                                }
                            } ?>
                        </p>
                    </div>
                    <div class="ctnForm captcha">
                        <div class="captcha ctnForm g-recaptcha input"
                             data-sitekey="6Ld2xZAUAAAAAJ2AKX2HBkO1X3vSb6vuQ4ireXAK"></div>
                        <p class="validation__message" aria-live="assertive">
                            <?php if (isset($_POST['g-recaptcha-response'])) {
                                if (isset($tValidation['g-recaptcha-response']['message'])) {
                                    echo $tValidation['g-recaptcha-response']['message'];
                                }
                            } ?>
                        </p>
                    </div>
                    <button type="submit" class="btn btn_inscription bouton bouton--blanc">
                        Soumettre le formulaire de contact
                    </button>
                </fieldset>
            </form>
        </div>
    </div>
</main>
<?php get_footer(); ?> <!-- Appel au template du pied de page -->