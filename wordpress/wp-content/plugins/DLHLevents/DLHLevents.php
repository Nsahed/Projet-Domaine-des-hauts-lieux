<?php
/**
 * Plugin Name: DLHL-Events
 * Author: Vortex
 * Author URI:
 * Version: 1.0.0
 * Description: Gestion d'évenements du domaine les hauts lieux
*/
function events_custom_post_type() {
// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
$labels = array(
    // Le nom au pluriel
    'name'                => _x( 'Voici le tableau d\'évènements', 'Post Type General Name'),
    // Le nom au singulier
    'singular_name'       => _x( 'évènement', 'Post Type Singular Name'),
    // Le libellé affiché dans le menu
    'menu_name'           => __( 'Evènements'),
    // Les différents libellés de l'administration
    'all_items'           => __( 'Tous les évènements'),
    'view_item'           => __( 'Voir les évènement'),
    'add_new_item'        => __( 'Ajouter un évènement'),
    'add_new'             => __( 'Ajouter'),
    'edit_item'           => __( 'Editer nouveau évènement'),
    'update_item'         => __( 'Modifier évènement'),
    'search_items'        => __( 'Rechercher un évènement'),
    'not_found'           => __( 'Non trouvée'),
    'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
);
// On peut définir ici d'autres options pour notre custom post type
$args = array(
    'label'               => __( 'évènements'),
    'description'         => __( 'Soumission d\'un évènement'),
    'labels'              => $labels,
    'menu_icon'           => 'dashicons-calendar-alt',
    'register_meta_box_cb' => 'wpt_add_event_metaboxes',
    // On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
    'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
    /*
    * Différentes options supplémentaires
    */
    'show_in_rest'        => true,
    'hierarchical'        => false,
    'public'              => true,
    'has_archive'         => true,
    'rewrite'			  => array( 'slug' => 'évènements'),
    'taxonomies'          => array( 'category', 'post_tag' ),
    'show_in_menu'        => true,
    'menu_position'       => 20
);
// On enregistre notre custom post type qu'on nomme ici "évènements" et ses arguments
register_post_type( 'évènements', $args );
}
  
add_action( 'init', 'events_custom_post_type', 0 );
// Création de la table custom "évènements"
global $wpdb;
$charset_collate = $wpdb->get_charset_collate();
$event_table_name = $wpdb->prefix . 'évènement';
$event_sql = "CREATE TABLE IF NOT EXISTS $event_table_name (
	id int(9) NOT NULL AUTO_INCREMENT, 
	name varchar(45) DEFAULT NULL,
	date datetime NOT NULL,
    time time NOT NULL,
    type longtext NULL,
    maxpeople int NULL,
    minpeople int NULL,
    price int NULL,
    user_id bigint(20) UNSIGNED NOT NULL,
    PRIMARY KEY  (id)
) $charset_collate;";
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($event_sql);
// Création de la table custom "inscriptions"    
global $wpdb;
$charset_collate = $wpdb->get_charset_collate();
$register_table_name = $wpdb->prefix . 'inscriptions';
$register_sql = "CREATE TABLE IF NOT EXISTS $register_table_name (
	id int(9)  NOT NULL AUTO_INCREMENT, 
	name varchar(45) DEFAULT NULL,
  address varchar(45)  NOT NULL,
  email varchar(45)  NOT NULL,
	time datetime DEFAULT CURRENT_TIMESTAMP  NOT NULL,
   
    type longtext  NULL,
    
    user_id bigint(20) UNSIGNED  NOT NULL,
    PRIMARY KEY  (id)
) $charset_collate;";
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($register_sql);
    
    
// ajout des métabox dans le CPT "évènements"
add_action('add_meta_boxes','initialisation_metaboxes');
function initialisation_metaboxes(){
  //on utilise la fonction add_metabox() pour initialiser une metabox
  add_meta_box('lieux', 'Lieux de l\'évènement', 'lieux_function', 'évènements', 'normal', 'high');
  
  add_meta_box('date', 'Date de l\'évènement', 'date_function', 'évènements', 'normal', 'high');
  add_meta_box('count', 'Nombre maximum d\'inscrits', 'count_function', 'évènements', 'normal', 'high');
}
// build meta box, and get meta
function lieux_function($post){
  // on récupère la valeur actuelle pour la mettre dans le champ
  $valadresse  = get_post_meta($post->ID,'_mon_adresse',true);
  echo '<label for="adresse">Adresse : </label>';
  echo '<input id="adresse" type="text" name="_mon_adresse" value="'.$valadresse.'" />';
}
function date_function($post){
  // on récupère la valeur actuelle pour la mettre dans le champ
  wp_enqueue_script( 'jquery-ui-datepicker' );
wp_enqueue_style( 'jquery-ui-style', '//ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);
  $valdate = get_post_meta($post->ID,'_ma_date',true);
  echo '<label for="date">Date : </label>';
  echo '<input id="date" type="date" name="_ma_date" value="'.$valdate.'" />';
}
function count_function($post){
  // on récupère la valeur actuelle pour la mettre dans le champ
  $valcount  = get_post_meta($post->ID,'_mon_nombre',true);
  echo '<label for="count">Nombre maximum d\'inscrits : </label>';
  echo '<input id="count" type="number" name="_mon_nombre"  value="'.$valcount.'" />';
}
// save meta box with update
add_action('save_post','save_metaboxes');
function save_metaboxes($post_ID){
  // si la metabox est définie, on sauvegarde sa valeur
  if(isset($_POST['_mon_adresse'])){
    update_post_meta($post_ID,'_mon_adresse', esc_html($_POST['_mon_adresse']));
  }
  if(isset($_POST['_ma_date'])){
    update_post_meta($post_ID,'_ma_date', esc_html($_POST['_ma_date']));
  }
  if(isset($_POST['_mon_nombre'])){
    update_post_meta($post_ID,'_mon_nombre', esc_html($_POST['_mon_nombre']));
  }
}
// Création d'un tableau pour afficher les inscriptions dans le BO
if(is_admin())
{
    new DLHL_Wp_List_Table();
}
class DLHL_Wp_List_Table
{
    /**
     * Constructor will create the menu item
     */
    public function __construct()
    {
        add_action( 'admin_menu', array($this, 'add_menu_example_list_table_page' ));
    }
    /**
     * Menu item will allow us to load the page to display the table
     */
    public function add_menu_example_list_table_page()
    {
        add_menu_page( 'Inscritions évènements', 'Inscritions évènements', 'manage_options', 'example-list-table.php', array($this, 'list_table_page') );
        /* add_menu_page( 'Inscritions ', 'Inscritions ', 'manage_options', 'example-list-table.php', array($this, 'list_table_page') ); */
    }
    /**
     * Display the list table page
     *
     * @return Void
     */
    public function list_table_page()
    {
        $exampleListTable = new Example_List_Table();
        $exampleListTable->prepare_items();
        ?>
            <div class="wrap">
                <div id="icon-users" class="icon32"></div>
                <h2>Inscritions évènements</h2>
                <?php $exampleListTable->display(); ?>
            </div>
        <?php
    }
}
// WP_List_Table is not loaded automatically so we need to load it in our application
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
/**
 * Create a new table class that will extend the WP_List_Table
 */
class Example_List_Table extends WP_List_Table
{
    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();
        $data = $this->table_data();
        usort( $data, array( &$this, 'sort_data' ) );
        $perPage = 10;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);
        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );
        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);
        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }
    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
        $columns = array(
            'id'          => 'ID',
            'type'        => 'type',
            'name'        =>'nom',
            'address'     => 'Adresse',
            'date'        => 'Date',
            'count'    => 'Nombre d\'inscrit',
        );
        return $columns;
    }
    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        return array();
    }
    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
        return array('title' => array('title', false));
    }
    // Insertion des données de la table custom "inscription" dans le tableau
    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'inscriptions';
         $results = $GLOBALS['wpdb']->get_results( "SELECT * FROM {$table_name} ", OBJECT);
         $data = array();
         foreach ($results as $post) {
            //var_dump($post->name) ;
            //var_dump($post->id) ;
             $monnom=$post->name;
             $postid=$post->id;
             $posttype=$post->type;
             $postadress=$post->address;
             $postdate=$post->time;
           $count= $GLOBALS['wpdb']->get_var( "SELECT COUNT(*) FROM {$table_name} WHERE type= '$posttype'");
            //var_dump($count);
                $data[] = array(
                         'id'          =>$postid ,
                         'type'        => $posttype,
                         'name'       => $monnom,
                         'address' => $postadress,
                         'date'        => $postdate,
                         'count'    => $count,
                         );
                        }
                        return $data;
    }
    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default( $item, $column_name )
    {
        switch( $column_name ) {
            case 'id':
            case 'type':
            case 'name':
            case 'address':
            case 'date':
            case 'count':
                return $item[ $column_name ];
            default:
                return print_r( $item, true ) ;
        }
    }
    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data( $a, $b )
    {
        // Set defaults
        $orderby = 'title';
        $order = 'asc';
        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby']))
        {
            $orderby = $_GET['orderby'];
        }
        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = $_GET['order'];
        }
        $result = strcmp( $a[$orderby], $b[$orderby] );
        if($order === 'asc')
        {
            return $result;
        }
        return -$result;
    }
}
?>