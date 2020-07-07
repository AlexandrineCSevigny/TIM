<?php
/* Template name: Diplomes */

// Diplômés
$posts_diplome = get_posts(array(
    'post_type' => 'diplomes',
    'posts_per_page' => -1,
    'post_status' => 'published',
    'order_by' => 'post_date',
    'order' => 'DESC',
));

get_header(); ?> <!-- Appel au template de l 'en-tête -->
<main class="unit-100 conteneur">
    <?php
    if ($posts_diplome) : ?>
        <ul>
            <?php foreach ($posts_diplome as $post): ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <p><?php echo get_field('id_diplome'); ?></p>
                    <p><?php echo get_field('nom_diplome'); ?></p>
                    <p><?php echo get_field('prenom_diplome'); ?></p>
                    <p><?php echo get_field('presentation_diplome'); ?></p>
                    <p><?php echo get_field('interet_gestion_projet'); ?></p>
                    <p><?php echo get_field('interet_design_interface'); ?></p>
                    <p><?php echo get_field('interet_traitement_medias'); ?></p>
                    <p><?php echo get_field('interet_integration'); ?></p>
                    <p><?php echo get_field('interet_programmation'); ?></p>
                    <p><?php echo get_field('courriel_diplome'); ?></p>
                    <p><?php echo get_field('pseudo_twitter'); ?></p>
                    <p><?php echo get_field('linkedin'); ?></p>
                    <p><?php echo get_field('site_web'); ?></p>
                    <p><?php echo get_field('nom_usager_admin'); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</main>
<?php get_footer(); ?> <!-- Appel au template du pied de page -->