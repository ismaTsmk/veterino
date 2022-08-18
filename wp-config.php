<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'veterino' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'SkjhF`;bpOI<Z;/2B]AQCc4iVRT:6w+,@6a2vpQ>K@p!.Kb3%$g! T+F#o*e|9>T' );
define( 'SECURE_AUTH_KEY',  'h.AJ-?UDM6[c]`+Rrd}P/7zvZ[N{ZvGYpv_8WF-VrlCjsP<a~Q{N_Jk]__ZNu)<m' );
define( 'LOGGED_IN_KEY',    'rTg;luIRZ8`FOK~TG%+BDbF5~ONf!dYMxVhL^Ja11VjPV(USGN{|8Tu-l^QM8C+P' );
define( 'NONCE_KEY',        'r;D<Ek>qu5o_Wk0;1&Udz/rzN<^EzSn7%YRLR:z*1Jnm&fyYz=uzVs@1(W=)WYEd' );
define( 'AUTH_SALT',        'd(Nb1l<v[?L-1hiFjU6mO*G.ewLhF@/%t#pmY8GP]vZ Y9N?c)ZXN02sZwxg?OYC' );
define( 'SECURE_AUTH_SALT', 'EyAB0|f&Km>8VCX^J~mu4(~!}7V!]C+IcVqk,>JMP8x=} `O5o*@Jh{}&F7O;+m/' );
define( 'LOGGED_IN_SALT',   'w{Tzl{v85{ES#>OuV>pdK+d 2:I_hgX.)S=s.Suqr~58Z`Wm.Is,e2g=tO2!f&e/' );
define( 'NONCE_SALT',       'Pu;wUSh#zR`j(A3edtZ3qQR!|y])`F}?=oXS>lH3Ee*%T***/{H9:IPc,*St/spZ' );
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
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
