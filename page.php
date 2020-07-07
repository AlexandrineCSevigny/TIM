<?php
/**
 * @author Alexandrine C. Sévigny <asevigny@outlook.fr>
 * @version 1.0.0
 * Template pour les pages du site
 */
?>

<?php get_header(); ?><!--Appel de l'en-tête de page -->

<main>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="article">
            <!-- Choix du modèle de page -->
            <?php get_template_part('content', 'page'); ?>
        </div>
        <?php endwhile ; ?>
        <?php endif ; ?>
</main>

<!--Appel de pied de page -->
<?php get_footer(); ?>
