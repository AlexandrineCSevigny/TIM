<?php
/**
 * @author Alexandrine C. Sévigny <asevigny@outlook.fr>
 * @version 1.0.0
 * Template pour l'entête du site
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <title>
        <?php bloginfo('name');
        if (is_home() || is_front_page()) : ?>
            &mdash; <?php bloginfo('description');
        else : ?>
            &mdash; <?php wp_title("", true);
        endif; ?>
    </title>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Alexandrine C. Sévigny">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_url'); ?>/ressources/liaisons/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_url'); ?>/ressources/liaisons/images/favicon-16x16.png">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/styles.min.css">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php bloginfo('template_url'); ?>/node_modules/@fancyapps/fancybox/dist/jquery.fancybox.min.css">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="entete <?php if (is_home() || is_front_page()) : ?> entete--accueil <?php else : ?> entete--autre<?php endif; ?>">
    <?php if (is_home() || is_front_page()) : ?>
        <!--    Entête pour l'accueil-->
        <div class="conteneur">
            <h1 class="entete__titre screen-reader-only">
                <?php bloginfo('name'); ?> &mdash; <?php bloginfo('description'); ?>
            </h1>
            <a href="https://www.cegep-ste-foy.qc.ca/accueil/?no_cache=1"
               class="entete__logoLien--csf entete--accueil--csf">
                <span class="screen-reader-only">Logo du cégep de Sainte-Foy</span>
                <img class="entete__logo--csf"
                     src="<?php echo get_template_directory_uri(); ?>/ressources/liaisons/images/logoCSF__noir.svg"
                     alt="Logo du Cégep de Sainte-Foy"/>
            </a>
            <div class="center">
                <a href="<?php echo get_site_url(); ?>" class="entete__logoLien">
                    <span class="screen-reader-only">Logo de la techniques d'intgration multimédia</span>
                    <img class="entete__logo--tim"
                         src="<?php echo get_template_directory_uri(); ?>/ressources/liaisons/images/TIM.svg"
                         alt="Logo de la Techniques en Intégration multimédia"/>
                </a>
                <a class="entete__play" href="https://vimeo.com/394993700" data-fancybox>
                    <span class="screen-reader-only">Regarder la vidéo</span>
                    <img class="entete__icone--play pulsate-bck"
                         src="<?php echo get_template_directory_uri(); ?>/ressources/liaisons/images/play.svg"
                         alt="Bouton pour démarrer la vidéo"/>
                </a>
            </div>
            <div class="intro">
                <p class="intro__texte">La Tim, c'est...</p>
                <span class="icone arrow--down slide-bottom"></span>
            </div>
        </div>
    <?php endif; ?>

    <!-- Menu "principal" actif -->
    <?php if (has_nav_menu('principal')) : ?>
        <nav id="principal" class="nav--principale">
            <div class="conteneur nav">
                <a href="<?php echo get_site_url(); ?>" class="entete__logoLien entete__logoLien--tim">
                    <span class="screen-reader-only">Logo de la techniques d'intgration multimédia</span>
                    <span class="entete__logo--tim"></span>
                </a>
                <?php wp_nav_menu(array('theme_location' => 'principal')); ?>
                <a href="https://www.cegep-ste-foy.qc.ca/accueil/?no_cache=1"
                   class="entete__logoLien entete__logoLien--csf">
                    <span class="screen-reader-only">Logo du cégep de Sainte-Foy</span>
                    <span class="entete__logo--csf"></span>
                </a>
            </div>
        </nav>
    <?php endif; ?>

    <!-- Menu "secondaire" actif -->
    <?php if (has_nav_menu('secondaire')) : ?>
        <nav id="secondaire" class="conteneur nav nav--secondaire">
            <?php wp_nav_menu(array('theme_location' => 'secondaire')); ?>
        </nav>
    <?php endif; ?>
</header>

<!-- Ouverture du conteneur #contenu -->
<div id="contenu">
    <noscript class="warning">Votre navigateur ne supporte présentement pas le javascript. Veuillez l'activer afin de vivre une
        expérience optimale du site.
    </noscript>