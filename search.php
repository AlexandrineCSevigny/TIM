<?php get_header(); ?> <!-- Appel au template de l'en-tête -->
<main class="unit-100">
    <?php if (have_posts()) : ?>
        <h1> Résultat de la recherche pour : <?php echo get_search_query(); ?> </h1>
        <?php while (have_posts()) : the_post(); ?>
            <?php
            get_template_part('content', 'search');
        endwhile;
// Affichage si pas de contenu trouvé
    else :
        get_template_part('content', 'none');
    endif;
    ?>
</main>
<?php get_footer(); ?> <!-- Appel au template du pied de page -->