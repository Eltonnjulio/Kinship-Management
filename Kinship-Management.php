<?php
/**
 *   Plugin Name: Kinship Management
 *   Plugin URI: https://github.com/eltonnjulio/Kinship-Management
 *   Description: A Wordpress plugin to manage people and kinships
 *   Version: 0.1.0
 *   Author: Elton Julio
 *   Author URI: https://github.com/eltonnjulio
 *   Text Domain: Manage_kinships
 */
if (!defined('ABSPATH')){

    die('Nothing i can do when im called directly!');
}

 class Manage_kinships {


    public function __construct()
    {
        add_action( 'init', array($this,'create_manage_kinships') );
    }
    
    function create_manage_kinships() {
       
        register_post_type( 'manage_kinships',
            array(
                'labels' => array(
                    'name' => _x('Manage kinships','Manage_kinships','text_domain'),
                    'singular_name' => _x('Manage kinships','Manage_kinships','text_domain'),
                    'menu_name' => __('Manage kinships','text_domain'),
                    'name_admin_bar' => __('Manage kinships','text_domain'),
                ),
    
                'public' => true,
                'menu_position' => 16,
                'supports' => array( 'Name', 'Email', 'kinships'),
                'taxonomies' => array( '' ),
                'has_archive' => true
            )
        );
    }
    
     function create_peopleTable(){
        global $wpdb;

        $people_details = $wpdb->prefix.'people_details';
        $charset = $wpdb->get_charset_collate;

        $people_det = "CREATE TABLE IF NOT EXISTS" .$people_details."(
            id int AUTO_INCREMENT primary key,
            name text not null,
            avatar text not null,
            age int not null,
            status int CHECK(status in 0,1),
            constraint CKT_name_size check ( LENGTH(name) > 5 ),
            constraint CKT_age check ( age>0 ),
            UNIQUE KEY thekey (name,age)

        )$charset;";

            require_once(ABSPATH.'wp-admin/includes/upgrade.php');

          dbDelta($people_det);

        //   return var_dump(dbDelta($people_det))

    }

     function create_kinshipTable(){
        
        global $wpdb;

        $kinship_details = $wpdb->prefix.'people_kinships';
        $charset = $wpdb->get_charset_collate;

        $kinship_det = "CREATE TABLE IF NOT EXISTS" .$kinship_details."(
            id int AUTO_INCREMENT primary key,
            kinship_name text not null,
            kinship_owner int not null,
            kinship int not null,
            status int CHECK(status in 0,1),
            constraint fk_kinship_owner (kinship_owner) REFERENCES people_details(id),
            constraint fk_kinship (kinship) REFERENCES people_details(id),
            constraint ck_kinship_name CHECK (kinship_name in 'mother','father','son','daughter','brother','sister')

        ) $charset;";

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');

        //  var_dump(dbDelta($kinship_det));

        dbDelta($kinship_det);

    }


     function createTables(){
        
        $this->create_peopleTable();
        $this->create_kinshipTable();
    }
    
    public function activate(){
        $this->Create_manage_kinships();
        $this->createTables();
    
        flush_rewrite_rules();
    }
    
    public function deactivate(){
    
        // flush_rewrite_rules();
    
    }
    
    public function uninstall(){
        flush_rewrite_rules();
    }
    
    
    
    }
    
    if( class_exists('Manage_kinships') ){
    
        $plugin = new Manage_kinships();
    
        register_activation_hook(__FILE__, array($plugin, 'activate'));
        register_deactivation_hook(__FILE__, array($plugin, 'deactivate'));
        register_uninstall_hook(__FILE__, array($plugin, 'uninstall'));
    
    
        }