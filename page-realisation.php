<?php
/* Template name: Réalisation */

// Array des diplomés
$posts = get_posts(array(
    'post_type' => 'diplomes',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'meta_key' => 'id_diplome',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
));
$arrDiplomes = array();
if ($posts) :
    foreach ($posts as $post) :
        array_push($arrDiplomes, $post);
    endforeach;
endif;
wp_reset_postdata();;

/* Filtres */
$meta_query = array();
$valeurs = array();
$arrEtudiant = array();

// On regarde les années sélectionnés en filtre et on les push en tableau
if (isset($_POST['annee'])) {
    foreach ($_POST['annee'] as $annee) {
        switch ($annee) {
            case '1':
                array_push($valeurs, '1', '2');
                break;
            case '2':
                array_push($valeurs, '3', '4');
                break;
            case '3':
                array_push($valeurs, '5', '6');
                break;
        }
    }
}

// On regarde si des étudiants sont filtrés
if (isset($_POST['etudiant'])) {
    foreach ($_POST['etudiant'] as $etudiant) {
        array_push($arrEtudiant, $etudiant);
    }
}

// On construit le meta_query
$meta_query = array(
    'relation' => 'AND',
    array(
        'key' => 'session_realisation',
        'value' => $valeurs,
        'compare' => 'IN'
    ),
    array(
        'key' => 'diplome_id',
        'value' => $arrEtudiant,
        'compare' => 'IN'
    )
);

//-----------------------------

get_header(); ?> <!-- Appel au template de l 'en-tête -->
<main class="realisations">
    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    // Requête filtrée
    $posts = new WP_Query(array(
        'post_type' => 'projets',
        'posts_per_page' => 12,
        'post_status' => 'publish',
        'meta_key' => 'session_realisation',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => $meta_query,
        'paged' => $paged
    ));
    ?>
    <div class="conteneur bg__realisations"></div>
    <div class="conteneur">
        <h1 class="realisations__titre">Réalisations</h1>
        <div class="realisations__filtre">
            <p class="realisations__filtreTexte">Filtrer par</p>
            <form action="" method="post">
                <fieldset>
                    <legend class="screen-reader-only">Filtres</legend>
                    <div class="flex flex--space">
                        <div class="annee ctnForm">
                            <input type="checkbox" id="annee1" name="annee[]" value="1"
                                <?php if (isset($_POST['annee']) && in_array('1', $_POST['annee'])) {
                                    echo "checked";
                                } ?>>
                            <label for="annee1" class="bouton--filtre bouton">1ere Année</label>
                            <input type="checkbox" id="annee2" name="annee[]" value="2"
                                <?php if (isset($_POST['annee']) && in_array('2', $_POST['annee'])) {
                                    echo "checked";
                                } ?>>
                            <label for="annee2" class="bouton--filtre bouton">2e Année</label>
                            <input type="checkbox" id="annee3" name="annee[]" value="3"
                                <?php if (isset($_POST['annee']) && in_array('3', $_POST['annee'])) {
                                    echo "checked";
                                } ?>>
                            <label for="annee3" class="bouton--filtre bouton">3e Année</label>
                        </div>
                        <div class="etudiant ctnForm">
                            <div class="collapsible">
                                <div class="select">
                                    <input type="checkbox" id="rd1" name="rd">
                                    <label class="select__label" for="rd1">Étudiant</label>
                                    <div class="select__content">
                                        <?php for ($i = 0; $i < count($arrDiplomes); $i++) { ?>
                                            <div class="etudiantInput">
                                                <input type="checkbox"
                                                       id="etudiant<?php echo get_field('id_diplome', $arrDiplomes[$i]); ?>"
                                                       name="etudiant[]"
                                                       value="<?php echo get_field('id_diplome', $arrDiplomes[$i]); ?>"
                                                    <?php if (isset($_POST['etudiant']) && in_array(get_field('id_diplome', $arrDiplomes[$i]), $_POST['etudiant'])) {
                                                        echo "checked";
                                                    } ?>>
                                                <label class="label"
                                                       for="etudiant<?php echo get_field('id_diplome', $arrDiplomes[$i]); ?>">
                                                    <?php echo get_field('prenom_diplome', $arrDiplomes[$i]); ?>
                                                    <?php echo get_field('nom_diplome', $arrDiplomes[$i]); ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>
                <div class="soumettre ctnForm">
                    <button type="submit" class="bouton bouton--vert">Filtrer</button>
                </div>
            </form>
        </div>
    </div>
    <div class="conteneur realisations__div">
        <?php
        if ($posts->have_posts()) : ?>
        <?php while ($posts->have_posts()): $posts->the_post(); ?>
            <a class="realisation lienAnime" href="<?php the_permalink(); ?>">
                <article>
                    <header class="realisation__header">
                        <p class="realisation__headerAuteur">
                            <?php for ($i = 0; $i < count($arrDiplomes); $i++) {
                                $projetID = get_field('diplome_id');
                                $diplomeID = get_field('id_diplome', $arrDiplomes[$i]);

                                if ($projetID == $diplomeID) { ?>
                                    <?php echo get_field('prenom_diplome', $arrDiplomes[$i]); ?>
                                    <?php echo get_field('nom_diplome', $arrDiplomes[$i]); ?>
                                <?php }
                            } ?>
                        </p>
                    </header>
                    <div class="realisation__contenu">
                        <p class="realisation__contenuChiffre">
                            Session <?php echo get_field('session_realisation'); ?></p>
                        <img class="realisation__contenuImg filter"
                             src="<?php echo get_field('photo1')['sizes']['fiche_projet@2x']; ?>"
                             srcset="<?php echo get_field('photo1')['sizes']['fiche_projet']; ?> 1x, <?php echo get_field('photo1')['sizes']['fiche_projet@2x']; ?> 2x"
                             alt="Photographie du projet : <?php echo get_field('titre'); ?>">
                    </div>
                    <footer class="realisation__footer">
                        <p class="realisation__footerLien"><?php echo get_field('titre'); ?></p>
                    </footer>
                </article>
            </a>
        <?php endwhile; ?>


            <?php
            $total_pages = $posts->max_num_pages;;
            if ($total_pages > 1) { ?>
            <div class="pagination">
                <?php
                $current_page = max(1, get_query_var('paged'));

                echo paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => 'page/%#%',
                    'current' => $current_page,
                    'total' => $total_pages,
                    'prev_text' => __('Précédent'),
                    'next_text' => __('Suivant'),
                ));
            } ?>
            </div>
            <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?> <!-- Appel au template du pied de page -->