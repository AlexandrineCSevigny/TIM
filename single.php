<?php
/**
 * @author Alexandrine C. Sévigny <asevigny@outlook.fr>
 * @version 1.0.0
 * Template pour un article
 */
?>
<?php get_header(); ?><!--Appel de l'en-tête de page -->
    <main>
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post(); ?>
                <div id="article-seul">
                    <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                    <p class="metadata">Par : <?php the_author(); ?></p>
                    <p class="metadata">Publié le : <?php the_date(); ?></p>
                    single.php
                </div>
            <?php endwhile;
        endif;
        ?>
    </main>

    <!--Appel de pied de page -->
<?php get_footer(); ?>