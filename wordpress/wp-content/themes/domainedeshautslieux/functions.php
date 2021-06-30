<?php
define(' DOMAINEDESHAUTSLIEUX_THEME_VERSION','1.0.0');
if ( ! function_exists('oprofile_theme_setup')){
    function domainedeshautslieux_theme_setup(){
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails');
        add_theme_support( 'html5');
    }
}
add_action ( 'after_setup_theme','domainedeshautslieux_theme_setup' );
//déclaration de la fonction
if ( ! function_exists( 'domainedeshautslieux_theme_enqueue_scripts') ) {
    function domainedeshautslieux_theme_enqueue_scripts() {
        // Déclaration du Thème
        wp_enqueue_style(
            'domainedeshautslieux-theme-style',
            get_theme_file_uri('/public/css/style.css'),
            [],
            'DOMAINEDESHAUTSLIEUX_THEME_VERSION'
        );
        // Déclaration du JS
        wp_enqueue_script( 
            'domainedeshautslieux-theme-script',
            get_theme_file_uri('public/js/app.js'),
            [],
            'DOMAINEDESHAUTSLIEUX_THEME_VERSION',
            true
        );
    }
}
add_action ('wp_enqueue_scripts','domainedeshautslieux_theme_enqueue_scripts' );
?>



<?php 
//Ajouter la prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );
//Ajouter automatiqument le titre du site d'en l'en-tête du site
add_theme_support( 'title-tag');
add_theme_support( 'menus' );

function traitement_formulaire_inscriptions() {
	if (isset($_POST['name']) && isset($_POST['inscription-verif']))  {
		if (wp_verify_nonce($_POST['inscription-verif'], 's\'inscrire')) {
            $name= $_POST["name"];
            $address=$_POST['address'];
            $email=$_POST['email'];
            $eventname=$_POST['event'];
            $eventcount=$_POST['count'];
            $eventcountmax=$_POST['countmax'];
            global $wpdb;
	
	
	
	$table_name = $wpdb->prefix . 'inscriptions';
	if ($eventcount< $eventcountmax) {
	$wpdb->insert( 
		$table_name, 
		array( 
			
            'name' => $name, 
            'address'=>$address,
            'email'=>$email,
            'type'=>$eventname
			 
		) 
    );
    echo 'vous êtes inscrit';
    $url = add_query_arg('success', 'inscrit','http://localhost/speWordpress/s01/projet-domaine-des-hauts-lieux/wordpress/confirmation-inscription/' );
    wp_safe_redirect($url);
    exit();
   
} 
else 
$url = add_query_arg('erreur', 'trop', wp_get_referer());
    wp_safe_redirect($url);
    exit();
    
		}
	}
}
add_action('template_redirect', 'traitement_formulaire_inscriptions');
register_nav_menus([
	'main' => 'Principal',
	'social' => 'Social'
]);

function wpc_show_admin_bar() {
	return false;
}
add_filter('show_admin_bar' , 'wpc_show_admin_bar');