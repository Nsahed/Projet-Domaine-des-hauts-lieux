<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'domaine-des-hauts-lieux' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'domaine-des-hauts-lieux' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'wordpress' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'W/_+%gb!-|A;sW6,Rhm4SH-g{W%];$-Z-,z-Up[[*4pEn)yg>QZJ~1[%j 4}j+S/');
define('SECURE_AUTH_KEY',  '!P0]8BU2&:Y-vRfWAQ`U: o)tka6*?h||+d+n:9+q0j/|;;jB`L(}uCaqU]~zGH|');
define('LOGGED_IN_KEY',    'd0xhVPZUR}8^2 RnoolG]?( ip>2<PY7,~<&>GJPS)M:Xrnd?#eEVnB>6.j=>,$m');
define('NONCE_KEY',        'TZ)T$zEF<BV(W{n<3-PjIJ^%V+vLXK$hi0T%J.`5L19mJL8s?MWp3R.>1T&n:t^,');
define('AUTH_SALT',        'r:rK%$Z1?>-TNTT+Inf#?I/7ujiv6$!<Jn7p]WBa3|M$iz[T#{-eoji$a}OhtZWf');
define('SECURE_AUTH_SALT', 'rLTU;+OMmx7Y?w-;-rY9V)Fo;wi6ooYa}NF&FJV+7(GEjbUb_MAl~:1hy|e&LN P');
define('LOGGED_IN_SALT',   'mCVH~)+>1H,,|zMpm>-3-}pXj$%L03)=-/G%/im=9rO^cS):e|R 290[CS<2^mbr');
define('NONCE_SALT',       '8&ugXlLyII$>Rti&`gI6a17&GO/2kM*F-6Uvr+ceOY9X!NInlNdjkuV%dY?Y BoN');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');

define('FS_METHOD','direct');

