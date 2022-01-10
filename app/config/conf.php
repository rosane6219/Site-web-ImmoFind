<?php
class Conf
{
    static $debug = 1 ;
    static $databases = array(
        'default' => array(
            'host' => 'localhost',
            'port' => '5432',
            'database' => 'immofind',
            'login' => 'postgres',
            'password' => '1234',
            )
        );

}
/**
 * Admin
 */

Router::prefix('cockpit','admin');

/**
 * User
 */
Router::connect('bien/:slug-:id','bien/view/id:([0-9]+)/slug:([a-z0-9\-]+)');//+= 1..* /* =0..* slug:([a-z0-9\-]+)=> a-z ou 0-9 ou -
Router::connect('collaborateurs','collabo/index');
Router::connect('partenaires','partner/index');
Router::connect('notre-agence','agence/agence');
Router::connect('nous-contacter','contact/contact');
Router::connect('home','accueil/index');
Router::connect('connexion','user/connexion');
Router::connect('inscription','user/inscription');
Router::connect('recherche','bien/search');
Router::connect('logout','user/logout');
Router::connect('panier/:id', 'panier/index/id:([0-9]+)');
Router::connect('panier/add/:userid-:bienid', 'panier/add/userid:([0-9]+)/bienid:([0-9]+)');
Router::connect('panier/delete/:id', 'panier/delete/id:([0-9]+)');
Router::connect('image/download/:url', 'image/download/url:([a-zA-Z.0-9\-]+)');







?>