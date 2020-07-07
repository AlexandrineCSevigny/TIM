<?php
/**
 * @author Alexandrine C. Sévigny <asevigny@outlook.fr>
 * @version 1.0.0
 * Template pour le pied de page
 */
?>

<!-- Fermeture de la boîte #contenu -->
</div>

<!-- Ouverture de #pied-de-page -->
<footer id="pied-de-page" class="footer">
    <div class="background background--gris">
        <div class="conteneur flex">
            <div class="footer__logo">
                <a href="<?php echo get_site_url(); ?>" class="footer__logoLien">
                    <span class="screen-reader-only">Logo de la techniques d'intgration multimédia</span>
                    <img class="footer__logo--tim"
                         src="<?php echo get_template_directory_uri(); ?>/ressources/liaisons/images/TIM.svg"
                         alt="Logo de la Techniques en Intégration multimédia">
                </a>
                <a href="https://www.cegep-ste-foy.qc.ca/accueil/?no_cache=1"
                   class="footer__logoLien footer__logoLien--csf">
                    <span class="screen-reader-only">Logo du cégep de Sainte-Foy</span>
                    <img class="footer__logo--csf"
                         src="<?php echo get_template_directory_uri(); ?>/ressources/liaisons/images/logoCSF__noir.svg"
                         alt="Logo du Cégep de Sainte-Foy">
                </a>
            </div>
            <div class="footer__media">
                <a href="https://www.facebook.com/timcsf" class="footer__media--facebook">
                    <span class="screen-reader-only">Facebook</span>
                    <img class="footer__media--facebookImg"
                         src="<?php echo get_template_directory_uri(); ?>/ressources/liaisons/images/facebook.svg"
                         alt="Logo de Facebook">
                </a>
                <a href="https://www.linkedin.com/groups/2211970" class="footer__media--linkedIn">
                    <span class="screen-reader-only">LinkedIn</span>
                    <img class="footer__media--linkedinImg"
                         src="<?php echo get_template_directory_uri(); ?>/ressources/liaisons/images/linkedin.svg"
                         alt="Logo de LinkedIn">
                </a>
                <a href="https://twitter.com/timcsf" class="footer__media--twitter">
                    <span class="screen-reader-only">Twitter</span>
                    <img class="footer__media--twitterImg"
                         src="<?php echo get_template_directory_uri(); ?>/ressources/liaisons/images/twitter.svg"
                         alt="Logo de LinkedIn">
                </a>
            </div>
        </div>
        <div class="footer__copyright">
            <div class="conteneur">
                <p class="footer__copyright--cegep">TOUS DROITS RÉSERVÉS © 2020 - TECHNIQUES INTÉGRATION MULTIMÉDIA,
                    CÉGEP DE SAINTE-FOY,</p>
                <p class="footer__copyright--alex">© Alexandrine C. Sévigny</p>
            </div>
        </div>
    </div>
</footer>

<!-- Fermeture de #pied-de-page -->
<?php wp_footer(); ?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script src="<?php bloginfo('template_url'); ?>/node_modules/@fancyapps/fancybox/dist/jquery.fancybox.min.js" async
        defer></script>
<script src="<?php bloginfo('template_url'); ?>/node_modules/@glidejs/glide/dist/glide.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script src="<?php bloginfo('template_url'); ?>/node_modules/requirejs/require.js"
        data-main="<?php echo get_bloginfo('url'); ?>/wp-content/themes/tim/ressources/liaisons/js/app.min.js" async
        defer></script>
<script src="<?php echo get_bloginfo('url'); ?>/wp-content/themes/tim/ressources/liaisons/js/messagesValidationClient.min.js"
        async defer></script>

<script>
    let conteneurPage = $('main');

    // On crée les caroussels des témoignage et des responsables
    if (conteneurPage.hasClass('accueil') || conteneurPage.hasClass('stage') ) {
        new Glide('.glide--temoignages', {
            type: 'slider',
            startAt: 0,
            perView: 1,
            hoverpause: true,
            autoplay: 5000,
            keyboard: true,
        }).mount();
    }
    if (conteneurPage.hasClass('accueil')) {
        new Glide('.glide--prof', {
            type: 'slider',
            startAt: 0,
            perView: 1,
            hoverpause: true,
            keyboard: true,
        }).mount();

        // Fonction qui permet l'apparition d'une navigation fixe dans la page d'accuei au scroll
        function scrollFunction() {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                document.getElementById("principal").style.top = "0";
            } else {
                document.getElementById("principal").style.top = "-200px";
            }
        }
        // Lorsqu'on scroll, on appelle la fonction. Après 50px, on fait descendre la navigation.
        window.onscroll = function () {
            scrollFunction()
        };
    }
</script>
</body>
</html>