<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Sulphur+Point&display=swap" rel="stylesheet">
<?php
wp_head(); 
?>
</head>
<!-- Page : Home -->

    <!-- Layout : Header -->
    <header class="headerEvent">
       
 
        <!-- Component : Menu -->
        <nav class="menu">

            <ul class="menu__list">

         <?php    wp_nav_menu([
	'theme_location' => 'main'
]);?>
                
               
        <!-- Burger menu button -->
        <a href="#" class="header__menu-icon"><i class=""></i></a>
    </header>