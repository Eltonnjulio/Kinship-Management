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
        // add_action( 'init', array($this,'create_manage_kinships') );

        add_action( 'admin_menu', array($this, 'add_admin_pages') );
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

        $sql = "CREATE TABLE `$people_details` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(30) CHARACTER SET latin1 NOT NULL check ( LENGTH(`name`) > 5 ),
            `avatar` varchar(15) NULL,
            `age` int(11) NOT NULL check ( `age`>0 ),
            `status` varchar(15) NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY thekey (`name`,`age`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
            
          dbDelta($sql);
    }

     function create_kinshipTable(){
        
        global $wpdb;

        $kinship_details = $wpdb->prefix.'people_kinships';

        $people_details = $wpdb->prefix.'people_details';

        $sql = "CREATE TABLE `$kinship_details` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `kinship_name` varchar(30) CHARACTER SET latin1 NOT NULL,
            `kinship_owner` int(11) NOT NULL,
            `kinship` int(11) NOT NULL,
            `status` varchar(15) NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`kinship_owner`) REFERENCES `$people_details`(`id`),
            FOREIGN KEY (`kinship`) REFERENCES `$people_details`(`id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
            
          dbDelta($sql);

    }


     function createTables(){
        
        $this->create_peopleTable();
        $this->create_kinshipTable();
    }
    
    function add_admin_pages(){

        add_menu_page( 'People List', 'kinship', 'manage_options', 'Kinship Management', array($this,'admin_index'),'dashicons-store',110);
        
    }

    public function admin_index(){

        require_once plugin_dir_path( __FILE__ ).'views/admin_index.php';

    }

    public function create_people(){

        require_once plugin_dir_path( __FILE__ ).'views/create_people.php';

    }

    function insert_people(){

        $name = $_POST['name'];
        $age = $_POST['age'];

        global $wpdb;

        $people_details = $wpdb->prefix.'people_details';

        $wpdb->insert(
            $people_details,
            [
                'name' => $name,
                'age' => $age  

            ]

        );


    }

    public function activate(){
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