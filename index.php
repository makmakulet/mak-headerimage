<?php
/**
 * @package Header Image
 */
/*
Plugin Name: Header Image Selector
Plugin URI: http://makmakulet.com
Description: Adds a Header Image on each page or Post and custom post types
Version: 1
Author: Mak | makmakulet@gmail.com
*/

class MakHeaderImageSelection{
	
	public $admin_option_name = '';
        
        public $plugin_url;
	
	public function __construct(){
            
            $this->plugin_url = plugins_url() . '/mak_headerimage_selector/';
            
	}
	
	public function run(){
            
            add_action( 'add_meta_boxes', array($this, 'initMetaBoxes'));
            
            add_action( 'save_post', array($this, 'saveHeaderImage' ), 10, 2);
		
	}
        
        public function initMetaBoxes(){
            
            add_meta_box( 'header-image', 'Set Header Image', array(&$this, 'displayOptions'), 'page', 'side', 'high');
            add_meta_box( 'header-image', 'Set Header Image', array(&$this, 'displayOptions'), 'post', 'side', 'high');
            
        }
        
        public function saveHeaderImage( $post_id = false, $post = false ){

            $image_id = get_post_meta($post_id, 'mak_page_header_image_id', true);
            
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
                return;
            }

            // Prevent quick edit from clearing custom fields
            if (defined('DOING_AJAX') && DOING_AJAX){
                return;
            }
            
            
            if(empty($image_id)){
                
                delete_post_meta($post_id, 'mak_page_header_image_id');
                delete_post_meta($post_id, 'mak_page_header_image_path');
                
            }
            
            
            if(!empty($image_id)){
                
                update_post_meta($post_id, 'mak_page_header_image_id', $_POST['attachment_id']);
                update_post_meta($post_id, 'mak_page_header_image_path', $_POST['imageurl']);
                
            }else{
                
                if(!empty($_POST['attachment_id']) && !empty($_POST['imageurl'])){
                    
                    add_post_meta($post_id, 'mak_page_header_image_id', $_POST['attachment_id']);
                    add_post_meta($post_id, 'mak_page_header_image_path', $_POST['imageurl']);                
                    
                }
            }
            
        
            
        }
        
        public static function renderFrontendOutput($post_id){
            
            $image_id = get_post_meta($post_id, 'mak_page_header_image_id', true);
            
            if(empty($image_id)){
                return false;
            }
            
            return wp_get_attachment_image($image_id, 'full', null, array('class' => 'resa-header-image img-responsive'));
            
        }
     
       
        public function displayOptions(){
            
            global $post_id;
            
            $image_id = get_post_meta($post_id, 'mak_page_header_image_id', true);
            $image_path = get_post_meta($post_id, 'mak_page_header_image_path', true);

            $loaded_image = wp_get_attachment_image( $image_id, null, null, array('style'=> 'width: 255px; height:80px;')); 
            
            include_once('forms/selection_form.php');
            
        }

}


$Mak_headerimageselection = new MakHeaderImageSelection();
$Mak_headerimageselection->run();