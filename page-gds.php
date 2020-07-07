<?php
/* Template name: Guide de style */ ?>

<?php get_header(); ?>

<div class="conteneur">

</div>
<section class="gds">

    <h2 class="gds__sousTitre"> Couleurs</h2>

    <ul class="palette">
        <li class="palette__item">
            <div class="palette__couleur palette__couleur--grisPale"></div>
            <p class="palette__description"><code> $grisPale</code> <br>#EFEFEF</p>
        </li>
        <li class="palette__item">
            <div class="palette__couleur palette__couleur--ligneGris"></div>
            <p class="palette__description"><code> $ligneGris</code> <br>#D1D1D1</p>
        </li>
        <li class="palette__item">
            <div class="palette__couleur palette__couleur--vert"></div>
            <p class="palette__description"><code> $vert</code> <br>#00FFC2</p>
        </li>
        <li class="palette__item">
            <div class="palette__couleur palette__couleur--bleu"></div>
            <p class="palette__description"><code> $bleu</code> <br>#13173D</p>
        </li>
        <li class="palette__item">
            <div class="palette__couleur palette__couleur--bleuLigne"></div>
            <p class="palette__description"><code> $bleuLigne</code> <br>#3D4271</p>
        </li>
        <li class="palette__item">
            <div class="palette__couleur palette__couleur--vertFonce"></div>
            <p class="palette__description"><code> $vertFonce</code> <br>#1CE7B6</p>
        </li>
        <li class="palette__item">
            <div class="palette__couleur palette__couleur--noir"></div>
            <p class="palette__description"><code> $noir</code> <br>#000000</p>
        </li>
        <li class="palette__item">
            <div class="palette__couleur palette__couleur--blanc"></div>
            <p class="palette__description"><code> $blanc</code> <br>#ffffff</p>
        </li>
    </ul>

    <table class="gds__tableau">
        <thead>
        <tr>
            <th><h2 class="gds__sousTitre"> Textes - Desktop</h2></th>
            <th><h2 class="gds__sousTitre"> Textes - Mobile</h2></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <p class="titreNiveau1 titreNiveau1--desktop"> Titre niveau 1 </p>
                <p>
                    <small> PLayfair display, 40pts sur écran large </small>
                </p>
            </td>
            <td>
                <p class="titreNiveau1 titreNiveau1--mobile"> Titre niveau 1 </p>
                <p>
                    <small> Playfair display, 22 pts sur écran étroit </small>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="titreNiveau2 titreNiveau2--desktop"> Titre niveau 2 </p>
                <p>
                    <small> Montserrat black, 70pts sur écran large, en capitales </small>
                </p></td>
            <td>
                <p class="titreNiveau2 titreNiveau2--mobile"> Titre niveau 2 </p>
                <p>
                    <small> Montserrat black, 40 pts sur écran étroit, en capitales </small>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="titreNiveau3 titreNiveau3--desktop"> Titre niveau 3 </p>
                <p>
                    <small> Montserrat black, 40pts sur écran large </small>
                </p>
            </td>
            <td>
                <p class="titreNiveau3 titreNiveau3--mobile"> Titre niveau 3 </p>
                <p>
                    <small> Montserrat black, 20 pts sur écran étroit </small>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="titreNiveau4 titreNiveau4--desktop"> Titre niveau 4 </p>
                <p>
                    <small> Montserrat bold, 22pts sur écran large </small>
                </p>
            </td>
            <td>
                <p class="titreNiveau4 titreNiveau4--mobile"> Titre niveau 4 </p>
                <p>
                    <small> Montserrat bold, 20 pts sur écran étroit </small>
                </p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="texte texte--desktop"> Texte courant lorem ipsum dolor sit amet, consectetur adipisicing elit
                    . A corporis dolores enim eveniet id inventore laborum modi nam necessitatibus officia, perspiciatis
                    quasi sint soluta, suscipit voluptates ? Esse ex harum incidunt .</p>
                <p><small> (Raleway, 16pts avec interlignage de 24 pts)</small></p>
            </td>
            <td>
                <p class="texte texte--mobile"> Texte courant lorem ipsum dolor sit amet, consectetur adipisicing elit .
                    A corporis dolores enim eveniet id inventore laborum modi nam necessitatibus officia, perspiciatis
                    quasi sint soluta, suscipit voluptates ? Esse ex harum incidunt .</p>
                <p><small> (Raleway, 16pts avec interlignage de 22 pts)</small></p>
            </td>
        </tr>

        </tbody>
    </table>


    <h2 class="gds__sousTitre"> Boutons / Éléments interactifs </h2>

    <h3 class="gds__categorie"> Hyperliens de base(pas de classe)</h3>

    <ul class="listeInteractivite">
        <li class="listeInteractivite__item">
            <p><a class="hyperlien" href="#"> a:link </a></p>
            <p> Couleur $hyperlien + sous-titrage <br>(équivalente à $noir et $vert)</p>
        </li>
        <li class="listeInteractivite__item">
            <p><a class="hyperlien hyperlien--visited" href="#"> a:visited </a></p>
            <p> Identique à l'état normal</p>
        </li>
        <li class="listeInteractivite__item">
            <p><a class="hyperlien hyperlien--hover" href="#"> a:hover </a></p>
            <p> Background $vert qui recouvre le mot / Texte en bold</p>

        </li>
        <li class="listeInteractivite__item">
            <p><a class="hyperlien hyperlien--active" href="#"> a:active </a></p>
            <p> Identique au survol </p>
        </li>
    </ul>

    <h3 class="gds__categorie"> Boutons</h3>

    <ul class="listeInteractivite">
        <li class="listeInteractivite__item">
            <p><a href="#" class="bouton"> Bouton</a></p>
            <p> État de base </p>
            <p> Couleur $vertLime, <code> border - radius</code> de 18px </p>
        </li>
        <li class="listeInteractivite__item">
            <p><a href="#" class="bouton bouton--filtre"> Bouton filtre</a></p>
            <p> border-radius: 25px et texte noir </p>
        </li>
        <li class="listeInteractivite__item">
            <p><a href="#" class="bouton bouton--filtreActif"> Bouton filtre actif</a></p>
            <p> Inversion de couleur </p>
        </li>
    </ul>

    <ul class="listeInteractivite listeInteractivite--bleu">
        <li class="listeInteractivite__item">
            <p><a href="#" class="bouton bouton--blanc"> Bouton</a></p>
            <p> Bordure et texte en blanc sur fond bleu </p>
            <p> Texte en bold </p>
        </li>
        <li class="listeInteractivite__item">
            <p><a href="#" class="bouton bouton--vert"> Bouton</a></p>
            <p> Bordure $vert </p>
            <p> Texte en black, blanc</p>
        </li>

    </ul>

</section>
</body>
</html>