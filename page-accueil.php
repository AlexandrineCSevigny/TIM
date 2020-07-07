<?php
/* Template Name: Accueil */

// On stocke l'information de la page dans des variables
$conception = get_field('conception_traitement_medias');
$integration = get_field('integration');
$programmation = get_field('programmation');
$gestion = get_field('gestion');
$videoPromo = get_field('video_promo');
$image1 = get_field('image1');
$image2 = get_field('image2');
$videoEtudiant = get_field('video_etudiant');
$texteEtudiant = get_field('etudiant_jour');
$texteInscription = get_field('texte_inscription');
$urlInscription = get_field('url_inscription');
$tour1 = get_field('tour1');
$tour2 = get_field('tour2');
$tour3 = get_field('tour3');
$tour4 = get_field('tour4');

//Lien responsable
$lien = get_field_object('lien_responsable');
$post_object = $lien['value'];

// Technologies et logiciels
$posts_techno = get_posts(array(
    'post_type' => 'technologies',
    'posts_per_page' => -1,
    'post_status' => 'published',
    'orderby' => 'date',
    'order' => 'asc'
));

// Responsables
$posts_profs = get_posts(array(
    'post_type' => 'responsables',
    'posts_per_page' => -1,
    'post_status' => 'published',
    'orderby' => 'date',
    'order' => 'asc'
));

// Perspectives
$posts_perspectives = get_posts(array(
    'post_type' => 'perspectives',
    'posts_per_page' => -1,
    'post_status' => 'published',
    'orderby' => 'date',
    'order' => 'asc'
));

//-----------------------------

get_header(); ?> <!-- Appel au template de l 'en-tête -->

<main class="accueil">
    <div class="background background--stat">
        <div class="conteneur statistiques">
            <h2 class="statistiques__titre">En moyenne</h2>
            <article class="stat stat__1">
                <div class="stat__border">
                    <?php
                    $image = get_field('icone_stat_1');
                    if (!empty($image)): ?>
                        <img class="statIcone" src="<?php echo esc_url($image['url']); ?>"
                             alt="<?php echo esc_attr($image['alt']); ?>"/>
                    <?php endif; ?>
                    <p class="statChiffre"><?php the_field('stat_1'); ?></p>
                    <p class="statTexte"><?php the_field('texte_stat_1'); ?></p>
                </div>
            </article>
            <article class="stat stat__2">
                <div class="stat__border">
                    <?php
                    $image = get_field('icone_stat_2');
                    if (!empty($image)): ?>
                        <img class="statIcone" src="<?php echo esc_url($image['url']); ?>"
                             alt="<?php echo esc_attr($image['alt']); ?>"/>
                    <?php endif; ?>
                    <p class="statChiffre"><?php the_field('stat_2'); ?></p>
                    <p class="statTexte"><?php the_field('texte_stat_2'); ?></p>
                </div>
            </article>
            <article class="stat stat__3">
                <div class="stat__border">
                    <?php
                    $image = get_field('icone_stat_3');
                    if (!empty($image)): ?>
                        <img class="statIcone" src="<?php echo esc_url($image['url']); ?>"
                             alt="<?php echo esc_attr($image['alt']); ?>"/>
                    <?php endif; ?>
                    <p class="statChiffre"><?php the_field('stat_3'); ?></p>
                    <p class="statTexte"><?php the_field('texte_stat_3'); ?></p>
                </div>
            </article>
            <article class="stat stat__4">
                <div class="stat__border">
                    <?php
                    $image = get_field('icone_stat_4');
                    if (!empty($image)): ?>
                        <img class="statIcone" src="<?php echo esc_url($image['url']); ?>"
                             alt="<?php echo esc_attr($image['alt']); ?>"/>
                    <?php endif; ?>
                    <p class="statChiffre"><?php the_field('stat_4'); ?></p>
                    <p class="statTexte"><?php the_field('texte_stat_4'); ?></p>
                </div>
            </article>
        </div>
        <div class="conteneur formation">
            <h2 class="formation__titre h1">Une formation variée</h2>
            <div class="onglets conteneur">
                <input type="radio" name="onglets" id="onglet1" class="onglets__input" checked="checked">
                <label for="onglet1" class="onglets__label lienAnime">Conception et traitements de médias <span
                            class="icone arrow"></span></label>
                <div class="onglet conception">
                    <div class="conception__titre titre">
                        <h3 class="conception__titreConception"><?php echo $conception['competence_conception']; ?></h3>
                        <h3 class="conception__titreTraitement"><?php echo $conception['competences_traitement_medias']; ?></h3>
                    </div>
                    <div class="logiciels">
                        <h4 class="logiciels__titre">Compétences ou logiciels</h4>
                        <?php foreach ($posts_techno as $post) { ?>
                            <?php if (get_field('domaine_techno') == "conception") { ?>
                                <article class="logiciel">
                                    <span class="logiciels__nom"><?php echo get_field('nom_techno'); ?></span>
                                    <img class="logiciels__logo" src="<?php echo get_field('icone_techno'); ?>"
                                         alt="Icone représentatant : <?php echo get_field('nom_techno'); ?>">
                                </article>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="etapes">
                        <h4 class="etapes__titre">Étapes de projet</h4>
                        <div class="etape">
                            <h5 class="etape__titre"><?php echo $conception['etapes_de_projet']['nom_etape_1']; ?></h5>
                            <a href="<?php echo $conception['etapes_de_projet']['image_etape_1']['sizes']['vie_etudiante@2x']; ?>"
                               data-fancybox="gallery">
                                <img class="etape__image"
                                     src="<?php echo $conception['etapes_de_projet']['image_etape_1']['sizes']['vie_etudiante@2x']; ?>"
                                     srcset="<?php echo $conception['etapes_de_projet']['image_etape_1']['sizes']['vie_etudiante_mobile@2x']; ?> 1x, <?php echo $conception['etapes_de_projet']['image_etape_1']['sizes']['vie_etudiante@2x']; ?> 2x"
                                     alt="Image de la tuile de style de l'équipe de Griserie pour Traces">
                            </a>
                        </div>
                        <?php if (!empty($conception['etapes_de_projet']['nom_etape_2'])) { ?>
                            <div class="etape">
                                <h5 class="etape__titre"><?php echo $conception['etapes_de_projet']['nom_etape_2']; ?></h5>
                                <a href="<?php echo $conception['etapes_de_projet']['image_etape_2']['sizes']['vie_etudiante@2x']; ?>"
                                   data-fancybox="gallery">
                                    <img class="etape__image"
                                         src="<?php echo $conception['etapes_de_projet']['image_etape_2']['sizes']['vie_etudiante@2x']; ?>"
                                         srcset="<?php echo $conception['etapes_de_projet']['image_etape_2']['sizes']['vie_etudiante_mobile@2x']; ?> 1x, <?php echo $conception['etapes_de_projet']['image_etape_2']['sizes']['vie_etudiante@2x']; ?> 2x"
                                         alt="Image d'une esquisse fonctionnelle de l'équipe de Griserie pour Traces">
                                </a>

                            </div>
                        <?php } ?>
                        <?php if (!empty($conception['etapes_de_projet']['nom_etape_3'])) { ?>
                            <div class="etape">
                                <h5 class="etape__titre"><?php echo $conception['etapes_de_projet']['nom_etape_3']; ?></h5>
                                <a href="<?php echo $conception['etapes_de_projet']['image_etape_3']['sizes']['vie_etudiante@2x']; ?>"
                                   data-fancybox="gallery">
                                    <img class="etape__image"
                                         src="<?php echo $conception['etapes_de_projet']['image_etape_3']['sizes']['vie_etudiante@2x']; ?>"
                                         srcset="<?php echo $conception['etapes_de_projet']['image_etape_3']['sizes']['vie_etudiante_mobile@2x']; ?> 1x, <?php echo $conception['etapes_de_projet']['image_etape_3']['sizes']['vie_etudiante@2x']; ?> 2x"
                                         alt="Image de la maquette de l'accueil de l'équipe de Griserie pour Traces">
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <input type="radio" name="onglets" id="onglet2" class="onglets__input">
                <label for="onglet2" class="onglets__label lienAnime">Intégration <span
                            class="icone arrow"></span></label>
                <div class="onglet integration">
                    <div class="integration__titre titre">
                        <h3 class="integration__titreIntegration"><?php echo $integration['competence_integration']; ?></h3>
                    </div>
                    <div class="logiciels">
                        <h4 class="logiciels__titre">Compétences ou logiciels</h4>
                        <?php foreach ($posts_techno as $post) { ?>
                            <?php if (get_field('domaine_techno') == "integration") { ?>
                                <article class="logiciel">
                                    <p class="logiciels__nom"><?php echo get_field('nom_techno'); ?></p>
                                    <img class="logiciels__logo" src="<?php echo get_field('icone_techno'); ?>"
                                         alt="Icone représentatant : <?php echo get_field('nom_techno'); ?>">
                                </article>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="etapes">
                        <h4 class="etapes__titre">Étapes de projet</h4>
                        <div class="etape">
                            <h5 class="etape__titre"><?php echo $integration['etapes_de_projet']['nom_etape_1']; ?></h5>
                            <a href="<?php echo $integration['etapes_de_projet']['image_etape_1']['sizes']['vie_etudiante@2x']; ?>"
                               data-fancybox="gallery">
                                <img class="etape__image"
                                     src="<?php echo $integration['etapes_de_projet']['image_etape_1']['sizes']['vie_etudiante@2x']; ?>"
                                     srcset="<?php echo $integration['etapes_de_projet']['image_etape_1']['sizes']['vie_etudiante_mobile@2x']; ?> 1x, <?php echo $integration['etapes_de_projet']['image_etape_1']['sizes']['vie_etudiante@2x']; ?> 2x"
                                     alt="HTML de l'équipe de Griserie pour Traces">
                            </a>
                        </div>
                        <?php if (!empty($integration['etapes_de_projet']['nom_etape_2'])) { ?>
                            <div class="etape">
                                <h5 class="etape__titre"><?php echo $integration['etapes_de_projet']['nom_etape_2']; ?></h5>
                                <a href="<?php echo $integration['etapes_de_projet']['image_etape_2']['sizes']['vie_etudiante@2x']; ?>"
                                   data-fancybox="gallery">
                                    <img class="etape__image"
                                         src="<?php echo $integration['etapes_de_projet']['image_etape_2']['sizes']['vie_etudiante@2x']; ?>"
                                         srcset="<?php echo $integration['etapes_de_projet']['image_etape_2']['sizes']['vie_etudiante_mobile@2x']; ?> 1x, <?php echo $integration['etapes_de_projet']['image_etape_2']['sizes']['vie_etudiante@2x']; ?> 2x"
                                         alt="CSS de l'équipe de Griserie pour Traces">
                                </a>
                            </div>
                        <?php } ?>
                        <?php if (!empty($integration['etapes_de_projet']['nom_etape_3'])) { ?>
                            <div class="etape">
                                <h5 class="etape__titre"><?php echo $integration['etapes_de_projet']['nom_etape_3']; ?></h5>
                                <a href="<?php echo $integration['etapes_de_projet']['image_etape_3']['sizes']['vie_etudiante@2x']; ?>"
                                   data-fancybox="gallery">
                                    <img class="etape__image" data-fancybox="gallery"
                                         src="<?php echo $integration['etapes_de_projet']['image_etape_3']['sizes']['vie_etudiante@2x']; ?>"
                                         srcset="<?php echo $integration['etapes_de_projet']['image_etape_3']['sizes']['vie_etudiante_mobile@2x']; ?> 1x, <?php echo $integration['etapes_de_projet']['image_etape_3']['sizes']['vie_etudiante@2x']; ?> 2x"
                                         alt="">
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <input type="radio" name="onglets" id="onglet3" class="onglets__input">
                <label for="onglet3" class="onglets__label lienAnime">Programmation <span
                            class="icone arrow"></span></label>
                <div class="onglet programmation">
                    <div class="programmation__titre titre">
                        <h3 class="programmation__titreProgrammation"><?php echo $programmation['competence_programmation']; ?></h3>
                    </div>
                    <div class="logiciels">
                        <h4 class="logiciels__titre">Compétences ou logiciels</h4>
                        <?php foreach ($posts_techno as $post) { ?>
                            <?php if (get_field('domaine_techno') == "programmation") { ?>
                                <article class="logiciel">
                                    <p class="logiciels__nom"><?php echo get_field('nom_techno'); ?></p>
                                    <img class="logiciels__logo" src="<?php echo get_field('icone_techno'); ?>"
                                         alt="Icone représentatant : <?php echo get_field('nom_techno'); ?>">
                                </article>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="etapes">
                        <h4 class="etapes__titre">Étapes de projet</h4>
                        <div class="etape">
                            <h5 class="etape__titre"><?php echo $programmation['etapes_de_projet']['nom_etape_1']; ?></h5>
                            <a href="<?php echo $programmation['etapes_de_projet']['image_etape_1']['sizes']['vie_etudiante@2x']; ?>"
                               data-fancybox="gallery">
                                <img class="etape__image"
                                     src="<?php echo $programmation['etapes_de_projet']['image_etape_1']['sizes']['vie_etudiante@2x']; ?>"
                                     srcset="<?php echo $programmation['etapes_de_projet']['image_etape_1']['sizes']['vie_etudiante_mobile@2x']; ?> 1x, <?php echo $programmation['etapes_de_projet']['image_etape_1']['sizes']['vie_etudiante@2x']; ?> 2x"
                                     alt="Diagramme UML de l'équipe de Griserie pour Traces">
                            </a>
                        </div>
                        <?php if (!empty($programmation['etapes_de_projet']['nom_etape_2'])) { ?>
                            <div class="etape">
                                <h5 class="etape__titre"><?php echo $programmation['etapes_de_projet']['nom_etape_2']; ?></h5>
                                <a href="<?php echo $programmation['etapes_de_projet']['image_etape_2']['sizes']['vie_etudiante@2x']; ?>"
                                   data-fancybox="gallery">
                                    <img class="etape__image"
                                         src="<?php echo $programmation['etapes_de_projet']['image_etape_2']['sizes']['vie_etudiante@2x']; ?>"
                                         srcset="<?php echo $programmation['etapes_de_projet']['image_etape_2']['sizes']['vie_etudiante_mobile@2x']; ?> 1x, <?php echo $programmation['etapes_de_projet']['image_etape_2']['sizes']['vie_etudiante@2x']; ?> 2x"
                                         alt="Code de programmation de l'équipe Griserie pour Traces">
                                </a>
                            </div>
                        <?php } ?>
                        <?php if (!empty($programmation['etapes_de_projet']['nom_etape_3'])) { ?>
                            <div class="etape">
                                <h5 class="etape__titre"><?php echo $programmation['etapes_de_projet']['nom_etape_3']; ?></h5>
                                <a href="<?php echo $programmation['etapes_de_projet']['image_etape_3']['sizes']['vie_etudiante@2x']; ?>"
                                   data-fancybox="gallery">
                                    <img class="etape__image"
                                         src="<?php echo $programmation['etapes_de_projet']['image_etape_3']['sizes']['vie_etudiante@2x']; ?>"
                                         srcset="<?php echo $programmation['etapes_de_projet']['image_etape_3']['sizes']['vie_etudiante_mobile@2x']; ?> 1x, <?php echo $programmation['etapes_de_projet']['image_etape_3']['sizes']['vie_etudiante@2x']; ?> 2x"
                                         alt="">
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <input type="radio" name="onglets" id="onglet4" class="onglets__input lienAnime">
                <label for="onglet4" class="onglets__label onglet4 lienAnime">Gestion de projet <span
                            class="icone arrow"></span></label>
                <div class="onglet gestion">
                    <div class="gestion__titre titre">
                        <h3 class="gestion__titreGestion"><?php echo $gestion['competence_gestion']; ?></h3>
                    </div>
                    <div class="logiciels">
                        <h4 class="logiciels__titre">Compétences ou logiciels</h4>
                        <?php foreach ($posts_techno as $post) { ?>
                            <?php if (get_field('domaine_techno') == "gestion") { ?>
                                <article class="logiciel">
                                    <p class="logiciels__nom"><?php echo get_field('nom_techno'); ?></p>
                                    <img class="logiciels__logo" src="<?php echo get_field('icone_techno'); ?>"
                                         alt="Icone représentatant : <?php echo get_field('nom_techno'); ?>">
                                </article>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="etapes">
                        <h4 class="etapes__titre">Étapes de projet</h4>
                        <div class="etape">
                            <h5 class="etape__titre"><?php echo $gestion['etapes_de_projet']['nom_etape_1']; ?></h5>
                            <a href="<?php echo $gestion['etapes_de_projet']['image_etape_1']['sizes']['vie_etudiante@2x']; ?>"
                               data-fancybox="gallery">
                                <img class="etape__image"
                                     src="<?php echo $gestion['etapes_de_projet']['image_etape_1']['sizes']['vie_etudiante@2x']; ?>"
                                     srcset="<?php echo $gestion['etapes_de_projet']['image_etape_1']['sizes']['vie_etudiante_mobile@2x']; ?> 1x, <?php echo $gestion['etapes_de_projet']['image_etape_1']['sizes']['vie_etudiante@2x']; ?> 2x"
                                     alt="Diagramme UML de l'équipe de Griserie pour Traces">
                            </a>
                        </div>
                        <?php if (!empty($gestion['etapes_de_projet']['nom_etape_2'])) { ?>
                            <div class="etape">
                                <h5 class="etape__titre"><?php echo $gestion['etapes_de_projet']['nom_etape_2']; ?></h5>
                                <a href="<?php echo $gestion['etapes_de_projet']['image_etape_2']['sizes']['vie_etudiante@2x']; ?>"
                                   data-fancybox="gallery">
                                    <img class="etape__image"
                                         src="<?php echo $gestion['etapes_de_projet']['image_etape_2']['sizes']['vie_etudiante@2x']; ?>"
                                         srcset="<?php echo $gestion['etapes_de_projet']['image_etape_2']['sizes']['vie_etudiante_mobile@2x']; ?> 1x, <?php echo $gestion['etapes_de_projet']['image_etape_2']['sizes']['vie_etudiante@2x']; ?> 2x"
                                         alt="Code de programmation de l'équipe Griserie pour Traces">
                                </a>
                            </div>
                        <?php } ?>
                        <?php if (!empty($gestion['etapes_de_projet']['nom_etape_3'])) { ?>
                            <div class="etape">
                                <h5 class="etape__titre"><?php echo $gestion['etapes_de_projet']['nom_etape_3']; ?></h5>
                                <a href="<?php echo $gestion['etapes_de_projet']['image_etape_3']['sizes']['vie_etudiante@2x']; ?>"
                                   data-fancybox="gallery">
                                    <img class="etape__image"
                                         src="<?php echo $gestion['etapes_de_projet']['image_etape_3']['sizes']['vie_etudiante@2x']; ?>"
                                         srcset="<?php echo $gestion['etapes_de_projet']['image_etape_3']['sizes']['vie_etudiante_mobile@2x']; ?> 1x, <?php echo $gestion['etapes_de_projet']['image_etape_3']['sizes']['vie_etudiante@2x']; ?> 2x"
                                         alt="">
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="boutons">
                <a class="boutons__lien bouton bouton--noir" target="_blank" rel="noreferrer"
                   href="https://www.cegep-ste-foy.qc.ca/programmes/programmes-techniques/techniques-dintegration-multimedia-web-et-apps/">Voir
                    la grille de cours <span class="icone lienExterne"></span></a>
                <a class="boutons__lien bouton  bouton--noir" target="_blank" rel="noreferrer"
                   href="https://www.cegep-ste-foy.qc.ca/programmes/programmes-techniques/techniques-dintegration-multimedia-web-et-apps/autoevaluation/">Faire
                    le quiz <span class="icone lienExterne"></span></a>
                <a class="boutons__lien bouton bouton--noir"
                   href="./realisations">Voir les réalisations</a>
            </div>
        </div>
    </div>
    <div class="background background--bleu">
        <div class="conteneur promo">
            <h2 class="promo__titre">Vidéo promotionnelle</h2>
            <div class="promo__video">
                <div class='embed-container'>
                    <iframe src='https://player.vimeo.com/video/394995603?title=0&byline=0&portrait=0' frameborder='0'
                            webkitAllowFullScreen
                            mozallowfullscreen allowFullScreen title="Vidéo promotionnelle sur la techniques produite par Christine Daneau-Pelletier dans le cadre du cours plurimédia.">
                    </iframe>
                </div>
            </div>
            <div class="promo__images">
                <picture class="promo__image--1 promo__image">
                    <source media="(min-width: 601px)"
                            srcset="<?php echo $image1['sizes']['vie_etudiante@2x']; ?> 2x, <?php echo $image1['sizes']['vie_etudiante']; ?> 1x">
                    <source media="(max-width: 60px)"
                            srcset="<?php echo $image1['sizes']['vie_etudiante_mobile@2x']; ?> 2x, <?php echo $image1['sizes']['vie_etudiante_mobile']; ?> 1x">
                    <img src="<?php echo $image1['sizes']['vie_etudiante@2x']; ?>"
                         alt="Image de vie étudiante">
                </picture>
                <picture class="promo__image--2 promo__image">
                    <source media="(min-width: 601px)"
                            srcset="<?php echo $image2['sizes']['vie_etudiante@2x']; ?> 2x, <?php echo $image2['sizes']['vie_etudiante']; ?> 1x">
                    <source media="(max-width: 60px)"
                            srcset="<?php echo $image2['sizes']['vie_etudiante_mobile@2x']; ?> 2x, <?php echo $image2['sizes']['vie_etudiante_mobile']; ?> 1x">
                    <img src="<?php echo $image2['sizes']['vie_etudiante@2x']; ?>"
                         alt="Image de vie étudiante">
                </picture>
            </div>
        </div>
    </div>
    <div class="background background--prof">
        <div class="conteneur profs">
            <h2 class="h1">Une équipe stimulante</h2>
            <div class="profs__conteneur bureau">
                <?php foreach ($posts_profs as $post) { ?>
                    <article class="prof">
                        <img class="prof__photo"
                             src="
            <?php echo get_field('photo_responsable')['sizes']['medium']; ?>"
                             srcset="
            <?php echo get_field('photo_responsable')['sizes']['medium']; ?> 2x,
            <?php echo get_field('photo_responsable')['sizes']['thumbnail']; ?> 1x"
                             alt="Photographie : <?php echo get_field('prenom'); ?>
            <?php echo get_field('nom'); ?>">
                        <p class="prof__nom"><?php echo get_field('prenom'); ?> <?php echo get_field('nom'); ?></p>
                        <?php if (get_field('responsabilite') != null) { ?>
                            <p class="prof__responsabilite">
                                <?php echo get_field('responsabilite'); ?></p>
                        <?php } ?>
                    </article>
                <?php } ?>
            </div>
            <div class="glide__conteneur profs__conteneur mobile">
                <?php
                if ($posts) : ?>
                <div class="glide glide--prof">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">
                            <?php foreach ($posts_profs as $post) { ?>
                                <li class="glide__slide">
                                    <article class="">
                                        <img class="prof__photo"
                                             src="<?php echo get_field('photo_responsable')['sizes']['medium']; ?>"
                                             srcset="<?php echo get_field('photo_responsable')['sizes']['medium']; ?> 2x, <?php echo get_field('photo_responsable')['sizes']['thumbnail']; ?> 1x"
                                             alt="Photographie : <?php echo get_field('prenom'); ?> <?php echo get_field('nom'); ?>">
                                        <p class="prof__nom"><?php echo get_field('prenom'); ?> <?php echo get_field('nom'); ?></p>
                                        <?php if (get_field('responsabilite') != null) { ?>
                                            <p class="prof__responsabilite"><?php echo get_field('responsabilite'); ?></p>
                                        <?php } ?>
                                    </article>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <div class="glide__arrows" data-glide-el="controls">
                        <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
                            <span class="screen-reader-only">Précédent</span>
                            <span class="icone arrow--left arrow"></span>
                        </button>
                        <button class="glide__arrow glide__arrow--right " data-glide-dir=">">
                            <span class="screen-reader-only">Suivant</span>
                            <span class="icone arrow--right arrow"></span>
                        </button>
                    </div>
                    <div class="glide__bullets" data-glide-el="controls[nav]">
                        <?php
                        $i = 0;
                        while ($i < count($posts_profs)) : ?>
                            <button class="glide__bullet" data-glide-dir="=
                    <?php echo $i; ?>"><span class="screen-reader-only">
                                    <?php echo get_field('prenom'); ?>
                                    <?php echo get_field('nom'); ?></span></button>
                            <?php
                            $i++;
                        endwhile; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="background background--bleu">
        <div class="conteneur etudiant">
            <h2 class="etudiant__titre">Pas encore convaincu..?</h2>
            <h3 class="etudiant__sousTitre">Viens nous voir!</h3>
            <div class="etudiant__video">
                <div class='embed-container'>
                    <iframe src='https://www.youtube.com/embed/Gajeel23WUg' frameborder='0'
                            allowfullscreen title="Vidéo produite par le cégep de Sainte-Foy présentant la techniques d'intégration multimédia"></iframe>
                </div>
            </div>
            <div class="etudiant__texte">
                <h4 class="h4">Étudiant d'un jour</h4>
                <div class="etudiant__texteP"><?php echo $texteEtudiant; ?></div>
                <a href="<?php echo add_query_arg('id', $post_object->ID, get_the_permalink(388)) ?>"
                   class="etudiant__bouton bouton bouton--blanc">Contacte <?php echo $post_object->post_title; ?> pour
                    en savoir plus</a>
            </div>
        </div>
    </div>
    <div class="background background--placement">
        <div class="placement conteneur">
            <?php foreach ($posts_perspectives as $post) { ?>
                <h3>Un taux de placement supérieur&nbsp;à <span
                            class="placement__stat"><?php echo get_field('taux_placement'); ?><span
                                class="pourcent">%</span></span></h3>
                <div class="border">
                    <div class="placementEmploi">
                        <h4 class="placementEmploi__titre">Emplois possibles avec le diplôme</h4>
                        <?php echo get_field('emplois_possibles'); ?>
                    </div>
                    <div class="placementUniversite">
                        <h4 class="placementUniversite__titre">Liste de programmes universitaires</h4>
                        <?php echo get_field('programmes_universitaires'); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="background background--blanc">
        <div class="conteneur temoignages">
            <h2 class="h1">Témoignages</h2>
            <?php get_template_part('content-temoignage', 'page'); ?>
        </div>
    </div>
    <div class="background background--bleu">
        <div class="conteneur inscription">
            <h2 class="inscription__titre">Viens nous rejoindre!</h2>
            <div class="inscriptionInfo">
                <?php echo $texteInscription; ?>
                <a href="<?php echo $urlInscription; ?>" class="bouton bouton--vert" target="_blank" rel="noreferrer">Inscris-toi! <span
                            class="lienExterne lienExterne--blanc"></span></a>
            </div>
            <div class="inscriptionTours">
                <p class="inscriptionTours__titre">1er Tour</p>
                <p class="inscriptionTours__date"><?php echo $tour1; ?></p>
                <p class="inscriptionTours__titre">2e Tour</p>
                <p class="inscriptionTours__date"><?php echo $tour2; ?></p>
                <p class="inscriptionTours__titre">3e Tour</p>
                <p class="inscriptionTours__date"><?php echo $tour3; ?></p>
                <p class="inscriptionTours__titre">4e Tour</p>
                <p class="inscriptionTours__date"><?php echo $tour4; ?></p>
            </div>
        </div>
    </div>
    <div class="background background--feed">
        <div class="conteneur medias">
            <div class="feed">
                <?php echo do_shortcode("[custom-facebook-feed]"); ?>
            </div>
            <div class="feed">
                <?php echo do_shortcode("[custom-twitter-feed]"); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?> <!-- Appel au template du pied de page -->