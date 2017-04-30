<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
@package Insta Type Gallery 
Plugin Name: Insta Type Gallery 
Plugin URI: http://awplife.com/
Description:  Insta type gallery plugin with lightbox preview for Wordpress
Version: 0.1.2
Author: A WP Life
Author URI: http://awplife.com/
License: GPLv2 or later
Text Domain: ITG_TXTDM
Domain Path: /languages
*/

if ( ! class_exists( 'Insta_Type_Gallery' ) ) {

	class Insta_Type_Gallery {
		
		protected $protected_plugin_api;
		protected $ajax_plugin_nonce;
		
		public function __construct() {
			$this->_constants();
			$this->_hooks();
		}		
		
		protected function _constants() {
			//Plugin Version
			define( 'ITG_PLUGIN_VER', '3.0' );
			
			//Plugin Text Domain
			define("ITG_TXTDM","ITG" );

			//Plugin Name
			define( 'ITG_PLUGIN_NAME', __( 'Insta Type Gallery', 'ITG_TXTDM' ) );

			//Plugin Slug
			define( 'ITG_PLUGIN_SLUG', 'insta_type_gallery' );

			//Plugin Directory Path
			define( 'ITG_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

			//Plugin Directory URL
			define( 'ITG_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

			/**
			 * Create a key for the .htaccess secure download link.
			 * @uses    NONCE_KEY     Defined in the WP root config.php
			 */
			define( 'ITG_SECURE_KEY', md5( NONCE_KEY ) );
			
		} // end of constructor function
		
		
		/**
		 * Setup the default filters and actions
		 */
		protected function _hooks() {
			
			//Load text domain
			add_action( 'plugins_loaded', array( $this, '_load_textdomain' ) );
			
			//add insta type gallery menu item, change menu filter for multisite
			add_action( 'admin_menu', array( $this, '_insta_menu' ), 101 );
			
			//Create Insta type Gallery Custom Post
			add_action( 'init', array( $this, '_insta_Gallery' ));
			
			//Add meta box to custom post
			add_action( 'add_meta_boxes', array( $this, '_admin_add_meta_box' ) );
			 
			//loaded during admin init 
			add_action( 'admin_init', array( $this, '_admin_add_meta_box' ) );
			
			add_action('wp_ajax_insta_gallery_js', array(&$this, '_ajax_insta_gallery'));
		
			add_action('save_post', array(&$this, '_itg_save_settings'));

			//Shortcode Compatibility in Text Widgets
			add_filter('widget_text', 'do_shortcode');

		} // end of hook function
		
		
		/**
		 * Loads the text domain.
		 */
		public function _load_textdomain() {
			load_plugin_textdomain( 'ITG_TXTDM', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}
		
		
		/**
		 * Adds the Insta type Gallery menu item
		 */
		public function _insta_menu() {
			$help_menu = add_submenu_page( 'edit.php?post_type='.ITG_PLUGIN_SLUG, __( 'Docs', 'ITG_TXTDM' ), __( 'Docs', 'ITG_TXTDM' ), 'administrator', 'sr-doc-page', array( $this, '_itg_doc_page') );
		}
		
		
		/**
		 * insta type Gallery Custom Post
		 * Create gallery post type in admin dashboard.
		 */
		public function _Insta_Gallery() {
			$labels = array(
				'name'                => _x( 'Insta Type Gallery', 'Post Type General Name', 'ITG_TXTDM' ),
				'singular_name'       => _x( 'Insta Type Gallery', 'Post Type Singular Name', 'ITG_TXTDM' ),
				'menu_name'           => __( 'Insta Type Gallery', 'ITG_TXTDM' ),
				'name_admin_bar'      => __( 'Insta Type Gallery', 'ITG_TXTDM' ),
				'parent_item_colon'   => __( 'Parent Item:', 'ITG_TXTDM' ),
				'all_items'           => __( 'All Insta Gallery', 'ITG_TXTDM' ),
				'add_new_item'        => __( 'Add New Insta Gallery', 'ITG_TXTDM' ),
				'add_new'             => __( 'Add Insta Gallery', 'ITG_TXTDM' ),
				'new_item'            => __( 'New Insta Gallery', 'ITG_TXTDM' ),
				'edit_item'           => __( 'Edit Insta Gallery', 'ITG_TXTDM' ),
				'update_item'         => __( 'Update Insta Gallery', 'ITG_TXTDM' ),
				'search_items'        => __( 'Search Insta Gallery', 'ITG_TXTDM' ),
				'not_found'           => __( 'Insta Gallery Not found', 'ITG_TXTDM' ),
				'not_found_in_trash'  => __( 'Insta Gallery Not found in Trash', 'ITG_TXTDM' ),
			);
			$args = array(
				'label'               => __( 'Insta Type GalleryInsta Type Gallery', 'ITG_TXTDM' ),
				'description'         => __( 'Custom Post Type For Insta Gallery', 'ITG_TXTDM' ),
				'labels'              => $labels,
				'supports'            => array( 'title'),
				'taxonomies'          => array(),
				'hierarchical'        => false,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => 65,
				'menu_icon'           => 'dashicons-camera',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => true,		
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'page',
			);
			register_post_type( 'Insta_gallery', $args );
			
		} // end of post type function
		
		/**
		 * Adds Meta Boxes
		 * @access    private
		 * @since     3.0
		 * @return    void
		 */
		public function _admin_add_meta_box() {
			// Syntax: add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );
			add_meta_box( '', __('Add Image', ITG_TXTDM), array(&$this, 'itg_upload_multiple_images'), 'Insta_gallery', 'normal', 'default' );
		}
		
		public function itg_upload_multiple_images($post) { 
			wp_enqueue_script('media-upload');
			wp_enqueue_script('itg-uploader.js', ITG_PLUGIN_URL . 'js/awl-itg-uploader.js', array('jquery'));
			wp_enqueue_style('itg-uploader-css', ITG_PLUGIN_URL . 'css/awl-itg-uploader.css');
			wp_enqueue_media();
			
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'itg-color-picker-js', plugins_url('js/itg-color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
			?>
			<div id="slider-gallery">
				<input type="button" id="remove-all-slides" name="remove-all-slides" class="button button-large remove-all-slides" rel="" value="<?php _e('Delete All Images', ITG_TXTDM); ?>">
				<ul id="remove-slides" class="sbox">
				<?php
				$allimagesetting = unserialize(base64_decode(get_post_meta( $post->ID, 'awl_itg_settings_'.$post->ID, true)));
				if(isset($allimagesetting['slide-ids'])) {
					$count = 0;
				foreach($allimagesetting['slide-ids'] as $id) {
					$thumbnail = wp_get_attachment_image_src($id, 'medium', true);
					$attachment = get_post( $id );
					//$image_link =  $allimagesetting['slide-link'][$count];
					?>
					<li class="slide">
						<img class="new-slide" src="<?php echo $thumbnail[0]; ?>" alt="<?php echo get_the_title($id); ?>" style="height: 150px; width: 98%; border-radius: 8px;">
						<input type="hidden" id="slide-ids[]" name="slide-ids[]" value="<?php echo $id; ?>" />
						<input type="text" name="slide-title[]" id="slide-title[]" style="width: 100%;" placeholder="Image Title" value="<?php echo get_the_title($id); ?>">
						<!--<input type="text" name="slide-link[]" id="slide-link[]" style="width: 100%;" placeholder="Image Link URL" value="<?php echo $image_link; ?>">-->
						<input type="button" name="remove-slide" id="remove-slide" class="button remove-single-slide button-danger" style="width: 100%;" value="Delete">
					</li>
				<?php $count++; } // end of foreach
				} //end of if
				?>
				</ul>
			</div>
			
			<!--Add New Image Button-->
			<div name="add-new-slider" id="add-new-slider" class="new-slider" style="height: 250px; width: 260px; border-radius: 8px;">
				<div class="menu-icon dashicons dashicons-format-image"></div>
				<div class="add-text"><?php _e('Add Image', ITG_TXTDM); ?></div>
			</div>
			<div style="clear:left;"></div>
			<br>
			<br>
			<h1>Copy Insta Type Gallery Shortcode</h1>
			<hr>
			<p class="input-text-wrap">
				<p><?php _e('Copy & Embed shotcode into any Page/ Post / Text Widget to display your Insta gallery on site.', ITG_TXTDM); ?><br></p>
				<input type="text" name="shortcode" id="shortcode" value="<?php echo "[ITG id=".$post->ID."]"; ?>" readonly style="height: 60px; text-align: center; font-size: 24px; width: 200px; border: 2px dashed;" onmouseover="return pulseOff();" onmouseout="return pulseStart();">
			</p>
			<br>
			<br>
			<h1 style="text-align:center"><?php _e('Insta TYPE GALLERY SETTINGS', ITG_TXTDM); ?></h1>
			<hr>
			<?php
			require_once('insta-setting.php');
		} // end of upload multiple image
		
		public function _itg_ajax_callback_function($id) {
			//thumb, thumbnail, medium, large, post-thumbnail
			$thumbnail = wp_get_attachment_image_src($id, 'medium', true);
			$attachment = get_post( $id ); // $id = attachment id
			?>
			<li class="slide">
				<img class="new-slide" src="<?php echo $thumbnail[0]; ?>" alt="<?php echo get_the_title($id); ?>" style="height: 150px; width: 98%; border-radius: 8px;">
				<input type="hidden" id="slide-ids[]" name="slide-ids[]" value="<?php echo $id; ?>" />
				<input type="text" name="slide-title[]" id="slide-title[]" style="width: 100%;" placeholder="Image Title" value="<?php echo get_the_title($id); ?>">
				<!--<input type="text" name="slide-link[]" id="slide-link[]" style="width: 100%;" placeholder="Image Link URL">-->
				<input type="button" name="remove-slide" id="remove-slide" style="width: 100%;" class="button" value="Delete">
			</li>
			<?php
		}
		
		public function _ajax_insta_gallery() {
			echo $this->_itg_ajax_callback_function($_POST['slideId']);
			die;
		}
		
		public function _itg_save_settings($post_id) {
			
			if ( isset( $_POST['itg-settings'] ) == "itg-save-settings" ) {
				//print_r($_POST);
				$image_ids = $_POST['slide-ids'];
				$image_titles = $_POST['slide-title'];
				$i = 0;
				foreach($image_ids as $image_id) {
					$single_image_update = array(
						'ID'           => $image_id,
						'post_title'   => $image_titles[$i],
					);
					wp_update_post( $single_image_update );
					$i++;
				}
				$awl_insta_type_gallery_shortcode_setting = "awl_itg_settings_".$post_id;
				update_post_meta($post_id, $awl_insta_type_gallery_shortcode_setting, base64_encode(serialize($_POST)));
			}
		}// end save setting
		
		/**
		 * Insta type Gallery Docs Page
		 * Create doc page to help user to setup plugin
		 * @access    private
		 * @since     3.0
		 * @return    void.
		 */
		public function _itg_doc_page() {
			require_once('docs.php');
		}
		
	} // end of class

	/**
	 * Instantiates the Class
	 * @since     3.0
	 * @global    object	$itg_gallery_object
	 */
	$itg_gallery_object = new insta_Type_Gallery();
	require_once('shortcode.php');
} // end of class exists
?>