<?php
/* Template name: Stage */

// On stocke les infos de la page en variable
$stageATE = get_field('stage_ATE');
$stage3 = get_field('stage_credite');
$france = get_field('texte_france');
$franceImg = get_field('image_france');

//Lien responsable
$lien = get_field_object('lien_responsable');
$post_object = $lien['value'];

get_header(); ?> <!-- Appel au template de l 'en-tête -->

<main class="stage">
    <div class="background background--blanc">
        <div class="conteneur stages">
            <h1 class="stages__titre">Stages</h1>
            <div class="stagesInfo">
                <div class="stagesInfo__1">
                    <h2 class="stagesInfo__1Titre">1re et 2e année (ATE)</h2>
                    <div class="stages__bloc">
                        <div class="stages__blocDate">
                            <p class="stages__blocDateDebut">Débute le
                                <span class="date"><?php echo $stageATE['date_debut']; ?></span>
                            </p>
                            <p class="stages__blocDateDuree">Durée
                                <span class="date"><?php echo $stageATE['duree_des_stages']; ?> semaines</span>
                            </p>
                        </div>
                        <div class="stages__blocTexte">
                            <?php echo $stageATE['texte_explicatif_sur_le_stage']; ?>
                        </div>
                    </div>
                </div>
                <div class="stagesInfo__3">
                    <h2 class="stagesInfo__3Titre">3e année (CRÉDITÉ)</h2>
                    <div class="stages__bloc">
                        <div class="stages__blocDate">
                            <p class="stages__blocDateDebut">Débute le
                                <span class="date"><?php echo $stage3['date_debut']; ?></span>
                            </p>
                            <p class="stages__blocDateDuree">Durée
                                <span class="date"><?php echo $stage3['duree_des_stages']; ?> semaines</span>
                            </p>
                        </div>
                        <div class="stages__blocTexte">
                            <?php echo $stage3['texte_explicatif_sur_le_stage']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="background background--bleu">
        <div class="conteneur france">
            <h2 class="france__titre">Saviez-vous que..?</h2>
            <div class="france__info">
                <div class="france__infoTexte"><?php echo $france; ?></div>
                <img class="france__infoImage"
                     src="<?php echo $franceImg['sizes']['fiche_projet@2x']; ?>"
                     srcset="<?php echo $franceImg['sizes']['fiche_projet']; ?> 1x, <?php echo $franceImg['sizes']['fiche_projet@2x']; ?> 2x"
                     alt="Image de la tour Eiffel">
            </div>
        </div>
    </div>
    <div class="background background--blanc">
        <div class="conteneur info">
            <h2 class="h1 info__titre">Pour plus d'informations</h2>
            <a href="<?php echo add_query_arg('id', $post_object->ID, get_the_permalink(388)) ?>" class="bouton bouton--noir">Contacte <?php echo $post_object->post_title; ?> pour en savoir plus</a>
            <a data-fancybox href="<?php the_field('pdf_competences'); ?>" class="bouton bouton--noir">Consulter le profil de
                compétences des étudiants</a>
        </div>
        <div class="conteneur temoignages temoignages--stage">
            <?php get_template_part('content-temoignage', 'page'); ?>
        </div>
    </div>
</main>
<?php get_footer(); ?> <!-- Appel au template du pied de page -->