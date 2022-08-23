<?php
/**
 *   Plugin Name: Kinship Management
 *   Plugin URI: https://github.com/nmupoia/Kinship-Management
 *   Description: A Wordpress plugin to manage people and kinships
 *   Version: 0.1.0
 *   Author: Elton Julio
 *   Author URI: https://github.com/eltonnjulio
 */

class Plugin {


    public function __construct()
    {
        add_action( 'init', array($this,'Create_manage_kinships') );
    }
    
    function Create_manage_kinships() {
        register_post_type( 'manage_kinships',
            array(
                'labels' => array(
                    'name' => _x('Manage kinships','Manage_kinships','text_domain'),
                    'singular_name' => _x('Manage kinships','Manage_kinships','text_domain'),
                    'menu_name' => __('Manage kinships','text_domain'),
                    'name_admin_bar' => __('Manage kinships','text_domain'),
                ),
    
                'public' => true,
                'menu_position' => 15,
                'supports' => array( 'Name', 'Email', 'kinships'),
                'taxonomies' => array( '' ),
                'has_archive' => true
            )
        );
    }
    
    function createTables(){
    
    
    
    }
    
    public function activate(){
        $this->Create_manage_kinships();
        $this->createTables();
    
        flush_rewrite_rules();
    }
    
    public function deactivate(){
    
        flush_rewrite_rules();
    
    }
    
    public function uninstall(){}
    
    
    
    }
    
    if( class_exists('Plugin') ){
    
        $plugin = new Plugin();
    
        register_activation_hook(__FILE__, array($plugin, 'activate'));
        register_deactivation_hook(__FILE__, array($plugin, 'deactivate'));
        register_uninstall_hook(__FILE__, array($plugin, 'uninstall'));
    
    
        }