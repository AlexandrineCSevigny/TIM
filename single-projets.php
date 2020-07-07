<?php
/**
 * @author Alexandrine C. Sévigny <asevigny@outlook.fr>
 * @version 1.0.0
 * Template pour un article
 */
?>
<?php get_header(); ?><!--Appel de l'en-tête de page -->
    <main class="une-realisation">
        <div class="background background--blanc">
            <div class="conteneur projet">
                <a href="<?php echo get_site_url(); ?>?page_id=384" class="retour hyperlien">
                    <span class="icone arrow"></span>
                    Retour vers les réalisations
                </a>
                <h1><?php the_field('titre'); ?></h1>
                <div class="projetInfo">
                    <div class="projetInfo__images">
                        <?php
                        $i = 1;
                        while ($i <= 4) { ?>
                            <?php if (get_field('photo' . $i)) { ?>
                                <a href="<?php echo get_field('photo' . $i)['sizes']['fiche_projet@2x']; ?>"
                                   data-fancybox="gallery"
                                   data-caption="Photographie du projet : <?php echo get_field('titre'); ?>">
                                    <img class="projetInfo__img"
                                         src="<?php echo get_field('photo' . $i)['sizes']['fiche_projet@2x']; ?>"
                                         srcset="<?php echo get_field('photo' . $i)['sizes']['fiche_projet']; ?> 1x, <?php echo get_field('photo' . $i)['sizes']['fiche_projet@2x']; ?> 2x"
                                         alt="Photographie du projet : <?php echo get_field('titre'); ?>">
                                </a>
                            <?php } ?>
                            <?php $i++; ?>
                        <?php } ?>
                    </div>
                    <div class="projetInfo__description">
                        <p class="projetInfo__descriptionTexte"><?php the_field('description'); ?></p>
                        <div class="projetInfo__descriptionTechno">
                            <span>Technologies utilisées : </span><?php the_field('technologies'); ?>
                        </div>
                        <?php if (get_field('url')) { ?>
                            <a href="<?php the_field('url'); ?>" class="bouton bouton--noir" target="_blank"
                               rel="noreferrer">Voir le projet <span class="lienExterne"></span></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="background background--bleu">
            <div class="conteneur sectionEtudiant etudiant">
                <?php $posts = get_posts(array(
                    'post_type' => 'diplomes',
                    'posts_per_page' => -1,
                    'post_status' => 'published',
                    'meta_query' => array(
                        array(
                            'key' => 'id_diplome',
                            'value' => get_field('diplome_id'),
                        )
                    )
                ));
                $arrDiplomes = array();
                if ($posts) :
                    foreach ($posts as $post) :
                        array_push($arrDiplomes, $post);
                    endforeach;
                endif;
                ?>
                <h2 class="etudiantNom"><?php echo get_field('prenom_diplome', $arrDiplomes[0]); ?> <?php echo get_field('nom_diplome', $arrDiplomes[0]); ?></h2>
                <div class="etudiantdiv presentation">
                    <div class="etudiantPresentation">
                        <?php echo get_field('presentation_diplome', $arrDiplomes[0]); ?>
                    </div>
                    <h3 class="etudiantInteret">Intérêts</h3>
                    <div class="gestion interet">
                        <div class="barre">
                            <div class="barre__interne interet__<?php echo get_field('interet_gestion_projet', $arrDiplomes[0]); ?>">
                            </div>
                        </div>
                        <span class="interet__nom">Gestion de projet</span>
                    </div>
                    <div class="traitement interet">
                        <div class="barre">
                            <div class="barre__interne interet__<?php echo get_field('interet_traitement_medias', $arrDiplomes[0]); ?>">
                            </div>
                        </div>
                        <span class="interet__nom">Traitement de médias</span>
                    </div>
                    <div class="conception interet">
                        <div class="barre">
                            <div class="barre__interne interet__<?php echo get_field('interet_design_interface', $arrDiplomes[0]); ?>">
                            </div>
                        </div>
                        <span class="interet__nom">Conception</span>
                    </div>
                    <div class="integration interet">
                        <div class="barre">
                            <div class="barre__interne interet__<?php echo get_field('interet_integration', $arrDiplomes[0]); ?>">
                            </div>
                        </div>
                        <span class="interet__nom">Intégration</span>
                    </div>
                    <div class="programmation interet">
                        <div class="barre">
                            <div class="barre__interne interet__<?php echo get_field('interet_programmation', $arrDiplomes[0]); ?>">
                            </div>
                        </div>
                        <span class="interet__nom">Programmation</span>
                    </div>
                </div>
                <div class="etudiantdiv image">
                    <div class="image__div">

                        <?php if (get_field('image2', $arrDiplomes[0])) { ?>
                            <img
                                 src="<?php echo get_field('image2', $arrDiplomes[0])['sizes']['medium']; ?>"
                                 srcset="<?php echo get_field('image2', $arrDiplomes[0])['sizes']['thumbnail']; ?> 1x, <?php echo get_field('image2', $arrDiplomes[0])['sizes']['medium']; ?> 2x"
                                 alt="Photographie de l'étudiant.e : <?php echo get_field('prenom_diplome', $arrDiplomes[0]); ?> <?php echo get_field('nom_diplome', $arrDiplomes[0]); ?>">
                        <?php } else { ?>
                            <img
                                 src="<?php echo get_field('image1', $arrDiplomes[0])['sizes']['medium']; ?>"
                                 srcset="<?php echo get_field('image1', $arrDiplomes[0])['sizes']['thumbnail']; ?> 1x, <?php echo get_field('image1', $arrDiplomes[0])['sizes']['medium']; ?> 2x"
                                 alt="Photographie de l'étudiant.e : <?php echo get_field('prenom_diplome', $arrDiplomes[0]); ?> <?php echo get_field('nom_diplome', $arrDiplomes[0]); ?>">
                        <?php } ?>
                    </div>
                    <div class="etudiantLien">
                        <?php if (get_field('courriel_diplome', $arrDiplomes[0])) { ?>
                            <a href="mailto:<?php echo get_field('courriel_diplome', $arrDiplomes[0]); ?>"
                               class="bouton bouton--blanc">Courriel</a>
                        <?php } ?>
                        <?php if (get_field('pseudo_twitter', $arrDiplomes[0])) { ?>
                            <a href="https://twitter.com/<?php echo get_field('pseudo_twitter', $arrDiplomes[0]); ?>"
                               class="bouton bouton--blanc" target="_blank" rel="noreferrer">Twitter <span
                                        class="lienExterne lienExterne--blanc"></span></a>
                        <?php } ?>
                        <?php if (get_field('linkedin', $arrDiplomes[0])) { ?>
                            <a href="<?php echo get_field('linkedin', $arrDiplomes[0]); ?>"
                               class="bouton bouton--blanc" target="_blank" rel="noreferrer">LinkedIn <span class="lienExterne lienExterne--blanc"></span></a>
                        <?php } ?>
                        <?php if (get_field('site_web', $arrDiplomes[0])) { ?>
                            <a href="<?php echo get_field('site_web', $arrDiplomes[0]); ?>"
                               class="bouton bouton--blanc" target="_blank" rel="noreferrer">Site Web <span
                                        class="lienExterne lienExterne--blanc"></span></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--Appel de pied de page -->
<?php get_footer(); ?>