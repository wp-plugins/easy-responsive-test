<?php
/*
  Plugin Name: Easy Responsive Test
  Plugin URI: http://www.oscitasthemes.com
  Description: Check Responsive Site.
  Version: 2.0
  Author: oscitas
  Author URI: http://www.oscitasthemes.com
  License: Under the GPL v2 or later
 */
define('ERTP_VERSION', '2.0');
define('ERTP_BASE_URL', plugins_url('',__FILE__));
define('ERTP_ASSETS_URL', ERTP_BASE_URL . '/assets/');
define('ERTP_BASE_DIR_LONG', dirname(__FILE__));
define('ERTP_SIZES','320:480, 480:600, 540:960, 600:960, 1024:600, 1280:1024');
define('ERTP_BG','#444444');
define('ERTP_FG','#ffffff');
class easyResponsiveTestPlugin {
    private $erpjs_path;
    private $plugin_name;
    private $erp_page;
    private $erp_sizes;
    private $erp_bg;
    private $erp_fg;
    private $erp_page_id;
    function __construct(){
        session_start();
        $pluginmenu=explode('/',plugin_basename(__FILE__));
        $this->plugin_name=$pluginmenu[0];
        $this->erpjs_path='js/erp_admin.js';
        $this->erp_page='erp_check_site';
        $this->erp_sizes=ERTP_SIZES;
        $this->erp_bg=ERTP_BG;
        $this->erp_fg=ERTP_FG;
        add_action('admin_menu', array($this, 'erp_register_admin_menu'));
        add_filter( "plugin_action_links_".plugin_basename( __FILE__ ), array($this, 'osc_erp_settings_link' ));
        add_action('admin_init', array($this, 'ERTP_admin_createpage'));
        add_action('admin_enqueue_scripts', array($this, 'erp_admin_scripts'));
        add_filter('page_template', array($this, 'ERTP_sitedemo_page_template'));
        add_action( 'pre_get_posts' , array($this, 'ERTP_exclude_this_page') );
    }

    public function ERTP_activate_plugin(){
        update_option( 'erp_sizes', $this->erp_sizes);
        update_option( 'erp_bg_color', $this->erp_bg );
        update_option( 'erp_fg_color',  $this->erp_fg );

    }

    public function ERTP_deactivate_plugin(){
        delete_option( 'erp_sizes');
        delete_option( 'erp_bg_color');
        delete_option( 'erp_fg_color');
    }

    public function erp_admin_scripts(){
        $screen=get_current_screen();
        if($screen->id=='toplevel_page_'. $this->plugin_name){
            wp_enqueue_script('jquery');
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_script('wp-color-picker');
            wp_enqueue_style('erp_admin', ERTP_ASSETS_URL.'css/erp_admin.css');
            wp_enqueue_script('erp_admin', ERTP_ASSETS_URL.$this->erpjs_path);
        }
    }
    public function osc_erp_settings_link( $links ) {

        $settings_link = '<a href="admin.php?page='.$this->plugin_name.'">Settings</a>';
        array_push( $links, $settings_link );

        return $links;
    }
    public function erp_register_admin_menu(){

        add_menu_page('ERTP Settings', ' ERTP Settings', 'manage_options', $this->plugin_name,array( $this,'osc_ebs_setting_page' ), ERTP_ASSETS_URL.'images/menu_icon.png');

    }

    public function osc_ebs_setting_page(){
        if (isset($_POST['erp_submit'])) {
            update_option( 'erp_sizes', $_POST['erp_sizes'] );
            update_option( 'erp_bg_color', $_POST['erp_bg_color'] );
            update_option( 'erp_fg_color', $_POST['erp_fg_color'] );

            $erp_sizes = $_POST['erp_sizes'];
            $erp_bg_color= $_POST['erp_bg_color'];
            $erp_fg_color= $_POST['erp_fg_color'];


        }
        else {
            $erp_sizes = get_option( 'erp_sizes', $this->erp_sizes );
            $erp_bg_color = get_option( 'erp_bg_color', $this->erp_bg );
            $erp_fg_color= get_option( 'erp_fg_color',  $this->erp_fg);

        }

        include 'lib/erp_settings.php';
    }
    public function ERTP_admin_createpage(){
        $new_page_title = 'ERTP Site Check';
        $new_page_content = 'This is the page content';
        $page_check = get_page_by_path( $this->erp_page);
        $new_page = array(
            'post_type' => 'page',
            'post_title' => $new_page_title,
            'post_content' => $new_page_content,
            'post_name' =>  $this->erp_page,
            'post_status' => 'publish',
            'post_author' => 1,
        );
        if (!isset($page_check->ID)) {
            $this->erp_page_id = wp_insert_post($new_page);
        } else{
            $this->erp_page_id=$page_check->ID;
            $new_page['ID']=$page_check->ID;
            wp_insert_post($new_page);
        }
    }
    public function ERTP_exclude_this_page( $query ) {
        if( !is_admin() )
            return $query;

        global $pagenow;

        if( 'edit.php' == $pagenow && ( $query->get('post_type') && 'page' == $query->get('post_type') ) )
        {
            $query->set( 'post__not_in', array($this->erp_page_id) );
        }


        return $query;
    }
    function ERTP_sitedemo_page_template($page_template) {


        if (is_page($this->erp_page)) {
//            $_SESSION['ert']=1;
            $page_template = dirname(__FILE__) . '/lib/erp_template.php';
        }else{
//            $_SESSION['ert']=0;
        }

        return $page_template;
    }


}
$ERTPsite= new easyResponsiveTestPlugin();
register_activation_hook(__FILE__, array($ERTPsite,'ERTP_activate_plugin'));
register_deactivation_hook(__FILE__, array($ERTPsite,'ERTP_deactivate_plugin'));
