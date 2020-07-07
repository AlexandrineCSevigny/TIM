<?php
/**
 * @author Alexandrine C. Sévigny <asevigny@outlook.fr>
 * @version 1.0.0
 * Template pour de la page par défaut
 */
echo 'index.php';
?>

    <!--Appel de l'en-tête de page -->
<?php get_header(); ?>

    <!-- Les deux sidebars sont actives -->
<?php if (is_active_sidebar('gauche') && is_active_sidebar('droite')) : ?>
    <aside id="gauche" class="unit-25">
        <?php get_sidebar('gauche'); ?>
    </aside>
    <main class="unit-50">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="article">
                <!-- Choix du gabarit d'article -->
                <?php get_template_part('content-accueil', get_post_format()); ?>
                <?php the_post_navigation(); ?>
                <?php // Affichage des commentaires
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </div>
        <?php endwhile; ?>
        <?php endif; ?>
    </main>
    <aside id="droite" class="unit-25">
        <?php get_sidebar('droite'); ?>
    </aside>

    <!-- La sidebar de gauche est inactive - La sidebar de droite est active -->
<?php elseif (is_active_sidebar('gauche') == false && is_active_sidebar('droite')) : ?>
    <main class="unit-75">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="article">
                <!-- Choix du gabarit d'article -->
                <?php get_template_part('content', get_post_format()); ?>
                <?php the_post_navigation(); ?>
                <?php // Affichage des commentaires
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </div>
        <?php endwhile; ?>
        <?php endif; ?>
    </main>
    <aside id="droite" class="unit-25">
        <?php get_sidebar('droite'); ?>
    </aside>

    <!-- La sidebar de gauche est actif - La sidebar de droite est inactif -->
<?php elseif (is_active_sidebar('gauche') && is_active_sidebar('droite') == false) : ?>
    <aside id="gauche" class="unit-25">
        <?php get_sidebar('gauche'); ?>
    </aside>

    <main class="unit-75">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="article">
                <!-- Choix du gabarit d'article -->
                <?php get_template_part('content', get_post_format()); ?>
                <?php the_post_navigation(); ?>
                <?php // Affichage des commentaires
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </div>
        <?php endwhile; ?>
        <?php endif; ?>
    </main>

    <!-- Les deux sidebars sont inactives -->
<?php elseif (is_active_sidebar('gauche') == false && is_active_sidebar('droite') == false) : ?>
    <main class="unit-100">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="article">
                <!-- Choix du gabarit d'article -->
                <?php get_template_part('content', get_post_format()); ?>
                <?php the_post_navigation(); ?>
                <?php // Affichage des commentaires
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </div>
        <?php endwhile; ?>
        <?php endif; ?>
    </main>
<?php endif; ?>

    <!--Appel de pied de page -->
<?php get_footer(); ?>