<?php
/**
 * @author Alexandrine C. Sévigny <asevigny@outlook.fr>
 * @version 1.0.0
 * Fichier des fonctions du thèmes
 */
?>

<?php
@ini_set('upload_max_size', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '300');

/* Ajout de l'utilisation de la sidebar par défaut */
if (function_exists('register_sidebar')) {
    register_sidebar(
        array(
            'name' => 'Emplacement gauche',
            'id' => 'gauche', // ID doit être en minuscules
            'description' => 'Emplacement gauche des widgets',
            'class' => '',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>'
        )
    );

    register_sidebar(
        array(
            'name' => 'Emplacement droite',
            'id' => 'droite', // ID doit être en minuscules
            'description' => 'Emplacement droite des widgets',
            'class' => '',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>'
        )
    );
}

/* Création du réglage Image à la une */
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
}

/* Ajout d'un emplacement de menu */
if (function_exists('register_nav_menus')) {
    register_nav_menus(
        array(
            'principal' => 'Menu principal',
            'secondaire' => 'Menu secondaire'
        )
    );
}

/* Ajout des formats d'article */
add_theme_support('post-formats', array(
    'aside', 'image', 'video', 'quote', 'link', 'gallery',
    'status', 'audio', 'chat'
));

// Personnalisation du thème avec l'api customizer
function theme_customize_register($wp_customize)
{
    // Ajout de la section
    $wp_customize->add_section('ma_section', array(
        'title' => 'Options de mon thème complet',
        'description' => 'Personnalisation du thème Tim',
        'priority' => 200
    ));

    /*********** Sélecteur de couleur *************/
    // Ajout de réglage
    $wp_customize->add_setting('couleur_liens', array(
        'default' => '000',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability' => 'edit_theme_options',
        'type' => 'theme_mod',
        'transport' => 'refresh'
    ));

    // Ajout de contrôle
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'label' => 'couleur des liens',
        'section' => 'ma_section',
        'settings' => 'couleur_liens'
    )));

    /******** Chargement d'une image ************/
    // Ajout d'un réglage
    $wp_customize->add_setting('charge_image');
    // Ajout du contrôle
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'charge_image', array(
        'label' => 'Image d\'arrière-plan : 1140x250 px',
        'section' => 'ma_section',
        'settings' => 'charge_image'
    )));
}

add_action('customize_register', 'theme_customize_register');

/*********** Création de la règle css ***********/
function theme_customize_css()
{ ?>
    <style type="text/css">
        a {
            color: <?php echo get_theme_mod('couleur_liens', '#000000'); ?>;
        }

        header.unit-100 {
            background-image: url(<?php echo get_theme_mod('charge_image', 'none'); ?>);
            height: <?php if (get_theme_mod('charge_image') !== '')
                { echo '250px';} else {echo 'auto';} ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'theme_customize_css');


// Déclaration du type d'articles personnalisés des responsables
function tim_responsable_custom_post()
{

    // On rentre les différentes nominations de notre articles personnalisée type
    // qui seront affiché dans l'interface adminstrative
    $labels = array(
        // Le nom au pluriel
        'name' => _x('Responsables de la TIM', 'Post Type General Name'),
        // Le nom au singulier
        'singular_name' => _x('Responsables', 'Post Type Singular Name'),
        //Le libellé affiché dans le menu
        'menu_name' => __('Responsables 2020'),
        // Les différents libellés de l'interface administrative
        'all_items' => __('Tous nos responsables'),
        'view_item' => __('Voir nos responsables'),
        'add_new_item' => __('Ajouter un nouveau responsable'),
        'add_new' => __('Ajouter'),
        'edit_item' => __('Éditer un responsable'),
        'update_item' => __('Modifier un responsable'),
        'search_items' => __('Rechercher un responsable'),
        'not_found' => __('Non trouvé'),
        'not_found_in_trash' => __('Non trouvé dans la corbeille'),
    );

    // On peut définir ici d'autres options pour notre type d'article personnalisé
    $args = array(
        'label' => __('Nos responsables'),
        'description' => __('Tout sur nos responsables'),
        'labels' => $labels,
        // On définit les options possibles dans l'éditeur  notre type d'articles personnalisé
        // (un titre, un auteur...)
        'supports' => array('title', 'editor', 'excerp', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        // Différentes options supplémentaires
        'hierarchival' => true, // Dans le tp, était a false
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'responsables')
    );

    // On enregistre notre type d'articles personnalisé qu'on nomme ici "Responsables" et ses arguments
    register_post_type('responsables', $args);
}

add_action('init', 'tim_responsable_custom_post', 0);
//******************************************************************

// Déclaration du type d'articles personnalisés des diplômés
function tim_diplome_custom_post()
{

    // On rentre les différentes nominations de notre articles personnalisée type
    // qui seront affiché dans l'interface adminstrative
    $labels = array(
        // Le nom au pluriel
        'name' => _x('Diplômés de la TIM', 'Post Type General Name'),
        // Le nom au singulier
        'singular_name' => _x('Diplômés', 'Post Type Singular Name'),
        //Le libellé affiché dans le menu
        'menu_name' => __('Diplômés 2020'),
        // Les différents libellés de l'interface administrative
        'all_items' => __('Tous nos diplômés'),
        'view_item' => __('Voir nos diplômés'),
        'add_new_item' => __('Ajouter un nouveau diplômé'),
        'add_new' => __('Ajouter'),
        'edit_item' => __('Éditer un diplômé'),
        'update_item' => __('Modifier un diplômé'),
        'search_items' => __('Rechercher un diplômé'),
        'not_found' => __('Non trouvé'),
        'not_found_in_trash' => __('Non trouvé dans la corbeille'),
    );

    // On peut définir ici d'autres options pour notre type d'article personnalisé
    $args = array(
        'label' => __('Nos diplômés'),
        'description' => __('Tout sur nos diplômés'),
        'labels' => $labels,
        // On définit les options possibles dans l'éditeur  notre type d'articles personnalisé
        // (un titre, un auteur...)
        'supports' => array('title', 'editor', 'excerp', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        // Différentes options supplémentaires
        'hierarchival' => true, // Dans le tp, était a false
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'diplomes')
    );

    // On enregistre notre type d'articles personnalisé qu'on nomme ici "Responsables" et ses arguments
    register_post_type('diplomes', $args);
}

add_action('init', 'tim_diplome_custom_post', 0);
//******************************************************************

// Déclaration du type d'articles personnalisés des projets
function tim_projet_custom_post()
{

    // On rentre les différentes nominations de notre articles personnalisée type
    // qui seront affiché dans l'interface adminstrative
    $labels = array(
        // Le nom au pluriel
        'name' => _x('Projets de la TIM', 'Post Type General Name'),
        // Le nom au singulier
        'singular_name' => _x('Projets', 'Post Type Singular Name'),
        //Le libellé affiché dans le menu
        'menu_name' => __('Projets'),
        // Les différents libellés de l'interface administrative
        'all_items' => __('Tous nos projets'),
        'view_item' => __('Voir nos projets'),
        'add_new_item' => __('Ajouter un nouveau projet'),
        'add_new' => __('Ajouter'),
        'edit_item' => __('Éditer un projet'),
        'update_item' => __('Modifier un projet'),
        'search_items' => __('Rechercher un projet'),
        'not_found' => __('Non trouvé'),
        'not_found_in_trash' => __('Non trouvé dans la corbeille'),
    );

    // On peut définir ici d'autres options pour notre type d'article personnalisé
    $args = array(
        'label' => __('Nos projets'),
        'description' => __('Tout sur nos projets'),
        'labels' => $labels,
        // On définit les options possibles dans l'éditeur  notre type d'articles personnalisé
        // (un titre, un auteur...)
        'supports' => array('title', 'editor', 'excerp', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        // Différentes options supplémentaires
        'hierarchival' => true, // Dans le tp, était a false
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'projets')
    );

    // On enregistre notre type d'articles personnalisé qu'on nomme ici "Responsables" et ses arguments
    register_post_type('projets', $args);
}

add_action('init', 'tim_projet_custom_post', 0);
//******************************************************************

// Déclaration du type d'articles personnalisés des témoignages
function tim_temoignage_custom_post()
{

    // On rentre les différentes nominations de notre articles personnalisée type
    // qui seront affiché dans l'interface adminstrative
    $labels = array(
        // Le nom au pluriel
        'name' => _x('Témoignages de la TIM', 'Post Type General Name'),
        // Le nom au singulier
        'singular_name' => _x('Témoignages', 'Post Type Singular Name'),
        //Le libellé affiché dans le menu
        'menu_name' => __('Témoignages'),
        // Les différents libellés de l'interface administrative
        'all_items' => __('Tous nos témoignages'),
        'view_item' => __('Voir nos témoignages'),
        'add_new_item' => __('Ajouter un nouveau témoignage'),
        'add_new' => __('Ajouter'),
        'edit_item' => __('Éditer un témoignage'),
        'update_item' => __('Modifier un témoignage'),
        'search_items' => __('Rechercher un témoignage'),
        'not_found' => __('Non trouvé'),
        'not_found_in_trash' => __('Non trouvé dans la corbeille'),
    );

    // On peut définir ici d'autres options pour notre type d'article personnalisé
    $args = array(
        'label' => __('Nos témoignages'),
        'description' => __('Tout sur nos témoignages'),
        'labels' => $labels,
        // On définit les options possibles dans l'éditeur  notre type d'articles personnalisé
        // (un titre, un auteur...)
        'supports' => array('title', 'editor', 'excerp', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        // Différentes options supplémentaires
        'hierarchival' => true, // Dans le tp, était a false
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'temoignages')
    );

    // On enregistre notre type d'articles personnalisé qu'on nomme ici "Responsables" et ses arguments
    register_post_type('temoignages', $args);
}

add_action('init', 'tim_temoignage_custom_post', 0);
//******************************************************************

// Déclaration du type d'articles personnalisés des perspectives d'emploi
function tim_perspectives_custom_post()
{

    // On rentre les différentes nominations de notre articles personnalisée type
    // qui seront affiché dans l'interface adminstrative
    $labels = array(
        // Le nom au pluriel
        'name' => _x('Perspectives d\'emploi', 'Post Type General Name'),
        // Le nom au singulier
        'singular_name' => _x('Perspectives d\'emploi', 'Post Type Singular Name'),
        //Le libellé affiché dans le menu
        'menu_name' => __('Perspectives'),
        // Les différents libellés de l'interface administrative
        'all_items' => __('Toutes les perspectives d\'emploi'),
        'view_item' => __('Voir nos perspectives d\'emploi'),
        'add_new_item' => __('Ajouter une nouvelle perspective d\'emploi'),
        'add_new' => __('Ajouter'),
        'edit_item' => __('Éditer une perspective'),
        'update_item' => __('Modifier une perspective'),
        'search_items' => __('Rechercher une perspective'),
        'not_found' => __('Non trouvé'),
        'not_found_in_trash' => __('Non trouvé dans la corbeille'),
    );

    // On peut définir ici d'autres options pour notre type d'article personnalisé
    $args = array(
        'label' => __('Nos perspectives d\'emploi'),
        'description' => __('Tout sur nos perspectives d\'emploi'),
        'labels' => $labels,
        // On définit les options possibles dans l'éditeur  notre type d'articles personnalisé
        // (un titre, un auteur...)
        'supports' => array('title', 'editor', 'excerp', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        // Différentes options supplémentaires
        'hierarchival' => true, // Dans le tp, était a false
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'perspectives')
    );

    // On enregistre notre type d'articles personnalisé qu'on nomme ici "Responsables" et ses arguments
    register_post_type('perspectives', $args);
}

add_action('init', 'tim_perspectives_custom_post', 0);

//******************************************************************

// Déclaration du type d'articles personnalisés des technologies utilisées
function tim_technologies_custom_post()
{
    // On rentre les différentes nominations de notre articles personnalisée type
    // qui seront affiché dans l'interface adminstrative
    $labels = array(
        // Le nom au pluriel
        'name' => _x('Techonologies', 'Post Type General Name'),
        // Le nom au singulier
        'singular_name' => _x('Technologie', 'Post Type Singular Name'),
        //Le libellé affiché dans le menu
        'menu_name' => __('Technologies'),
        // Les différents libellés de l'interface administrative
        'all_items' => __('Toutes les technologies'),
        'view_item' => __('Voir nos technologies'),
        'add_new_item' => __('Ajouter une nouvelle technologie'),
        'add_new' => __('Ajouter'),
        'edit_item' => __('Éditer une technologie'),
        'update_item' => __('Modifier une technologie'),
        'search_items' => __('Rechercher une technologie'),
        'not_found' => __('Non trouvé'),
        'not_found_in_trash' => __('Non trouvé dans la corbeille'),
    );

    // On peut définir ici d'autres options pour notre type d'article personnalisé
    $args = array(
        'label' => __('Nos technologies'),
        'description' => __('Tout sur nos technologies'),
        'labels' => $labels,
        // On définit les options possibles dans l'éditeur  notre type d'articles personnalisé
        // (un titre, un auteur...)
        'supports' => array('title', 'editor', 'excerp', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        // Différentes options supplémentaires
        'hierarchival' => true, // Dans le tp, était a false
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'technologies')
    );

    // On enregistre notre type d'articles personnalisé qu'on nomme ici "Responsables" et ses arguments
    register_post_type('technologies', $args);
}

add_action('init', 'tim_technologies_custom_post', 0);

//******************************************************************

add_action('after_setup_theme', 'aw_custom_add_image_sizes');
function aw_custom_add_image_sizes()
{
    add_image_size('fiche_projet@2x', 980, 735, false);
    add_image_size('vie_etudiante@2x', 640, 480, false);
    add_image_size('fiche_projet', 490, 368, false);
    add_image_size('vie_etudiante', 320, 240, false);
    add_image_size('vie_etudiante_mobile@2x', 280, 210, false);
    add_image_size('vie_etudiante_mobile', 140, 105, false);
}

add_theme_support('post-thumbnails');

// Retire les formats de base qui ne servent pas
add_filter('intermediate_image_sizes_advanced', 'prefix_remove_default_images');
function prefix_remove_default_images($sizes)
{
    unset($sizes['large']); // 1024px
    unset($sizes['medium_large']); // 768px
    unset($sizes['1536x1536']);
    unset($sizes['2048x2048']);
    return $sizes;
}

// Fait en sorte qu'il n'y a pas de compression
add_filter('jpeg_quality', function ($arg) {
    return 100;
});

// Rend possible l'utilisation des champs personnalisés de Wordpress alors que ACF les bloquait.
//add_filter('acf/settings/remove_wp_meta_box', '__return_false');
?>