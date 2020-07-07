<?php
/**
 * @author Alexandrine C. Sévigny <asevigny@outlook.fr>
 * @version 1.0.0
 * Template pour du contenu en passant
 */
?>
<?php
/* Template d'article avec le format En passant */
?>
<header class="article">
    <h1> <?php the_title() ?> </h1>
</header>
<div class="contenu">
    <?php the_content() ?>
</div>
<footer class="article">
    <?php the_date() ?> - <?php the_author() ?>
</footer>