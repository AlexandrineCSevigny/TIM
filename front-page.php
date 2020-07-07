<?php
/** Gabarit pour la page front-page */

get_header(); /** Appel au gabarit de l'entete */

if ( 'posts' == get_option('show_on_front') ) {
    include( get_home_template() );
} else {
    include( get_page_template('content', 'accueil') );
}

get_footer(); /** Appel du pied de page */