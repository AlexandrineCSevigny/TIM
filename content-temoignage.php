<?php

// Requête des témoignages
$posts = get_posts(array(
    'post_type' => 'Temoignages',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'order_by' => 'post_date',
    'order' => 'DESC',
));
?>
<div class="glide__conteneur">
    <?php
    if ($posts) : ?>
    <div class="glide glide--temoignages">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                <?php foreach ($posts as $post): ?>
                    <li class="glide__slide">
                        <div class="flex">
                            <img class="temoignages__photo"
                                 src="<?php echo get_field('image_temoin')['sizes']['medium']; ?>"
                                 srcset="<?php echo get_field('image_temoin')['sizes']['medium']; ?> 2x, <?php echo get_field('image_temoin')['sizes']['thumbnail']; ?> 1x"
                                 alt="Photographie : <?php echo get_field('temoin_temoignage'); ?>">
                            <p class="temoignages__nom"><?php echo get_field('temoin_temoignage'); ?></p>
                            <p class="temoignages__annee">Diplômé en <?php echo get_field('annee_diplomation'); ?></p>
                        </div>
                        <div class="citation">
                            <span class="icone citationIcone citationIcone--left"></span>
                            <?php echo get_field('temoignage'); ?>
                            <span class="icone citationIcone citationIcone--right"></span>
                        </div>
                    </li>
                <?php endforeach; ?>
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
    </div>
</div>
