<?php
/**
 * hublog-lt/functions.php
 */

require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
 'http://demobuilder.hublog.info/wp-content/themes/hublog6/hublog_update.json',
 __FILE__,
 'hublog5' //γγΌγε
);


if ( !function_exists('nothing_to_do') ) :
function nothing_to_do(){
	return;
}
endif;

class Theme_Settings{
	var $r;

	function __construct($args=''){
		$defaults = array(
		);
		$r = wp_parse_args($args,$defaults);
		$this->r = $r;

		add_action( 'after_setup_theme',  array(&$this, 'setup_theme_supports') );
		add_action( 'after_setup_theme',  array(&$this, 'setup_nav_menu') );
		add_action( 'widgets_init',		  array(&$this, 'hublog_widgets_init_sidebar'), 5 );
		add_action( 'widgets_init',		  array(&$this, 'hublog_widgets_init_footer'),  9 );
		add_action( 'wp_enqueue_scripts', array(&$this, 'enqueue_scripts_styles') );
		if ( is_admin() ){
//			add_action('admin_head', array(&$this, 'wp_admin_favicon') );
		} else {
			add_action('get_header', array(&$this, 'set_template_env') );
			add_action('body_class', array(&$this, 'body_class_add_parent_term'), 10, 2 );
		}
	}

	function set_template_env(){
		add_filter('looppart', array(&$this, 'get_post_is_in'), 5 );
	}
	

	function setup_theme_supports() {
		add_editor_style ( 'style-editor' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-background' );
		//add_theme_support( 'post-formats' , array('post') );

		$custom_header_args = array(
			// Text color and image (empty to use none).
			'default-text-color'     => '069',
			'header-text'			 => true,
			'default-image'          => get_stylesheet_directory_uri() . '/images/sitetitle.png',

			// Set height and width, with a maximum value for the width.
			'height'		=> 120,
			'width'			=> 580,
			'max-width'		=> 2000,

			// Support flexible height and width.
			'flex-height'            => true,
			'flex-width'             => false,

			// Random image rotation off by default.
			'random-default'         => false,

			// Callbacks for styling the header and the admin preview.
			'wp-head-callback'       => array(&$this,'cb_header_style'),
			'admin-head-callback'    => '',
			'admin-preview-callback' => array(&$this,'admin_custom_header_preview'),
		);
		add_theme_support( 'custom-header', $custom_header_args );
	}

	function admin_custom_header_preview(){
		?>
		<div class="custom_header_preview" style="border:2px #ddd solid;padding:10px;">
			<p>&nbsp;</p>
			<div id="global-header" class="clearfix wrapper">
				<h1 class="description" style="font-size:12px;font-weight:normal;margin-top:0;"><?php bloginfo('description'); ?></h1>
				<?php $header_image = get_header_image(); ?>
				<a class="sitetitle" href="javascript:void(0);" onclick="return false;" title="<?php bloginfo('name'); ?>" style="font-size:24px;font-weight:bold;">
					<?php if ( ! empty( $header_image ) ) : ?>
						<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php //echo get_custom_header()->width; ?>" height="<?php //echo get_custom_header()->height; ?>" alt="" />
					<?php else : ?>
						<?php bloginfo('name'); ?>
					<?php endif; ?>
				</a>
			</div>
		</div>
	<?php }

	function cb_header_style() {
		$text_color = get_header_textcolor();
		// If no custom options for text are set, let's bail
		if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
			return;

		// If we get this far, we have custom styles.
		?>
		<style type="text/css">
		<?php
			// Has the text been hidden?
			if ( ! display_header_text() ) :
		?>
			.blogname {
				position: absolute !important;
				clip: rect(1px 1px 1px 1px); /* IE7 */
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text, use that.
			else :
		?>
			.blogname {
				color: #<?php echo $text_color; ?> !important;
			}
		<?php endif; ?>
		</style>
		<?php
	}

	function get_html5js_url(){
		global $wp_scripts;
		// Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions.
		$html5js = 'http://html5shim.googlecode.com/svn/trunk/html5.js';
		$response = wp_remote_head($html5js,1);
		if( !(!is_wp_error( $response ) && $response["response"]["code"] === 200) ) {
			$html5js = get_template_directory_uri() . '/js/html5.js';
		}
		return $html5js;
		//wp_enqueue_script( 'html5js', $html5js );
		//$wp_scripts->add_data( 'html5js', 'conditional', 'lt IE 9' );
	}

	function enqueue_scripts_styles(){
		global $wp_styles;

$child_theme = wp_get_theme();//ε­γγΌγ
$parent_theme = wp_get_theme(get_template());//θ¦ͺγγΌγ
		
		wp_enqueue_style( 'style-common', get_template_directory_uri() . '/common.css?'. $parent_theme->get( 'Version' ) );
		wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.min.css?'. $child_theme->get( 'Version' ) );

		wp_enqueue_style(     'for-ie', get_template_directory_uri() . '/css/ie.css', array('hublog-style') );
		$wp_styles->add_data( 'for-ie', 'conditional', 'lt IE 9' );

		$print_css = '/print.css';
		if ( file_exists(get_stylesheet_directory() . $print_css) ){
			wp_enqueue_style( 'hublog-style-print', get_stylesheet_directory_uri() . $print_css, array('hublog-style'), false, 'print' );
		}

	}

	function setup_nav_menu(){
		register_nav_menu( 'primary' , __('Global nav') );
		register_nav_menu( 'contact-link' , __('Contact-Link') );
		register_nav_menu( 'mobile-nav' , __('mobile-nav') );
		register_nav_menu( 'about-nav' , __('about-nav') );
	}

	function hublog_widgets_init_sidebar(){
		//γ΅γ€γγγΌη¨
		$this->register_sidebar( array(
			'name' => __( 'Sidebar' ),
			'id' => 'sidebar-widget-area-1',
		) );
		foreach ( (array)apply_filters('additional_sidebars','') as $sidebar_slug ) {
			switch ( esc_attr($sidebar_slug) ) {
				case 'rent' :
			 		$this->register_sidebar(array(
						'name' => __('Sidebar') . ':' . __('θ³θ²Έ'),
						'id' => 'sidebar-widget-area-' . $sidebar_slug,
					));
					break;
				case 'sell' :
			 		$this->register_sidebar(array(
						'name' => __('Sidebar') . ':' . __('ε£²θ²·'),
						'id' => 'sidebar-widget-area-' . $sidebar_slug,
					));
					break;
				case 'blog' :
			 		$this->register_sidebar(array(
						'name' => __('Sidebar') . ':' . __('γγ­γ°η¨'),
						'id' => 'sidebar-widget-area-' . $sidebar_slug,
					));
					break;
			 }
		}
	}
	
	function hublog_widgets_init_footer(){
		//γγγΏγΌι¨η¨
		$this->register_sidebar( array(
			'name' => __( 'Footer 1'),
			'id' => 'footer-widget-area-1',
			'description' => __( 'Three columons.' ),
		) );
		$this->register_sidebar( array(
			'name' => __( 'Footer 2'),
			'id' => 'footer-widget-area-2',
			'description' => __( 'Bottom of page.' ),
		) );
	}

	function register_sidebar($args=''){
		$defaults = array(
			'id' => '',
			'name' => '',
			'description' => '',
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<span class="widget-title">',
			'after_title' => '</span>',
		);
		$r = wp_parse_args( $args, $defaults );
		register_sidebar( $r );
	}
/*
	function wp_admin_favicon(){
		if ( file_exists(get_stylesheet_directory() . '/favicon.ico' ) ) :
			$favicon_url = get_stylesheet_directory() . '/favicon.ico';
			echo '<link rel="shortcut icon" href="' . $favicon_url . '" type="image/gif" />';
			echo '<link rel="icon" href="' . $favicon_url . '" type="image/gif" />';
		endif; //favicon.ico
	}
*/
	function get_post_is_in($partname){
		global $post;
		$output = '';
		if ( post_is_in_category_slug('sell') || post_is_in_taxonomy_slug('sell','bukken') ) {
			$output = 'bukken';
		} elseif ( post_is_in_category_slug('rent') || post_is_in_taxonomy_slug('rent','bukken') ) {
			$output = 'bukken';
		} elseif ( post_is_in_category_slug('tatemono') || post_is_in_taxonomy_slug('tatemono','bukken') ) {
			$output = 'bukken';
		} elseif ( post_is_in_category_slug('example') ) {
			$output = 'example';
		} elseif ( post_is_in_category_slug('reform') ) {
			$output = 'reform';

		} elseif ( post_is_in_category_slug('event') ) {
			$output = 'event';
			
			
		} elseif ( post_is_in_category_slug('component') ) {
			$output = 'component';

		} elseif ( is_post_type_archive('example')) {
			$output = 'example';
		} elseif ( is_tax('ex_cat')) {
			$output = 'example';

		} elseif ( is_post_type_archive('reform')) {
			$output = 'reform';
		} elseif ( is_tax('reform_cat')) {
			$output = 'reform';


		} elseif ( post_is_in_category_slug('voice') ) {
			$output = 'voice';
			
			
		} elseif ( is_post_type_archive('voice')) {
			$output = 'voice';
		} elseif ( is_tax('voice_cat')) {
			$output = 'voice';
			
		} elseif ( is_post_type_archive('video')) {
			$output = 'video';
		} elseif ( is_tax('video_cat')) {
			$output = 'video';
			
			
		} elseif ( $post_cats = wp_get_post_categories($post->ID) ) {
			$c = get_category( array_shift($post_cats) );
			$output = $c->slug;
		}

		if ( empty($output) ){
			return $partname;
		} else {
			return $output;
		}
	}

	function get_page_type(){
		if ( is_home() ){
			$output = 'home';
		} elseif ( is_front_page() ){
			$output = 'home';
		} elseif ( is_category() ) {
			$output = 'category';
		} elseif ( is_tag() ) {
			$output = 'tag';
		} elseif ( is_archive() ) {
			$output = 'archive';
		} else {
			$output = get_post_type();
		}
		return $output;
	}

	function body_class_add_parent_term($classes, $class){
		if ( is_category() ){
			global $cat;
			$current_cat = get_category( $cat );
			if ( $current_cat->category_parent > 0 ){
				$p_cat = get_category( $current_cat->category_parent );
				$classes[] = 'category-parent-' . sanitize_html_class( $p_cat->slug, $p_cat->term_id );
				$classes[] = 'category-parent-' . $p_cat->term_id;
			}
		} elseif ( is_tax() ) {
			global $wp_query;
			$term = $wp_query->get_queried_object();
			if ( $term->parent > 0 ){
				$current_term = get_term_by( 'id', $term->parent, $term->taxonomy );
				$classes[] = 'term-parent-' . sanitize_html_class( $current_term->slug, $current_term->term_id );
				$classes[] = 'term-parent-' . $current_term->term_id;
			}
		}
		return array_unique($classes);
	}

} // end Class Theme_Settings
$hublog3 = new Theme_Settings();

/* γγΌγη΅γΏθΎΌγΏγγ©γ°γ€γ³γ?θͺ­γΏθΎΌγΏ */
$inc_dirs = array();
if ( get_stylesheet_directory() != get_template_directory() ) {
	$inc_dirs[] = get_stylesheet_directory() . '/inc';
}
$inc_dirs[] = get_template_directory() . '/inc';
foreach ( $inc_dirs as $modules_dir ) {
	if ( is_dir($modules_dir) && $dh = opendir($modules_dir) ) {
		while ( ( $module = readdir( $dh ) ) !== false ) {
			if ( substr($module, -4) == '.php' && $module[0] != '_' ) {
				include_once $modules_dir . '/' . $module;
			}
		}
	}
}

//γ‘γγ£γ’θΏ½ε γ?ιγγγγ?ζη¨ΏγΈγ?γ’γγγ­γΌγγγγγγ©γ«γγ«θ¨­ε?γγ
function media_uploader_default_view() {
echo '<script type="text/javascript">jQuery(function( $ ){ ';
echo 'wp.media.view.Modal.prototype.on( \'ready\', function( ){ $( \'select.attachment-filters\' ).find( \'[value="uploaded"]\').attr( \'selected\', true ).parent().trigger(\'change\'); });';
echo '});</script>'."\n";
}
add_action( 'admin_footer-post-new.php', 'media_uploader_default_view' );
add_action( 'admin_footer-post.php', 'media_uploader_default_view' );


// bodyγΏγ°γ«γγΌγΈγΉγ©γγ°γθΏ½ε  
function pagename_class($classes = '') { 
	if (is_page()) { $page = get_post(get_the_ID()); $classes[] = 'page-' . $page->post_name; 
					if ($page->post_parent) { $classes[] = 'page-' . get_page_uri($page->post_parent) . '-child'; } 
				   } 
	return $classes; } 
add_filter('body_class', 'pagename_class')
;

  
// η?‘ηη»ι’γ«γγ£γΌγ«γγεΊε
function create_add_css() {
    $keyname = 'custom_css';
    global $post;
    $get_value = get_post_meta( $post->ID, $keyname, true );
    wp_nonce_field( 'action_' . $keyname, 'nonce_' . $keyname );
    echo '<textarea name="' . $keyname . '" cols="100" rows="4" style="width:100%">' . $get_value . '</textarea>';
}
  
// γ«γΉγΏγ γγ£γΌγ«γγ?δΏε­
add_action( 'save_post', 'save_custom_css' );
function save_custom_css( $post_id ) {
    $keyname = 'custom_css';
    if ( isset( $_POST['nonce_' . $keyname] )) {
        if( check_admin_referer( 'action_' . $keyname, 'nonce_' . $keyname ) ) {
            if( isset( $_POST[$keyname] )) {
                update_post_meta( $post_id, $keyname, $_POST[$keyname] );
            } else {
                delete_post_meta( $post_id, $keyname, get_post_meta( $post_id, $keyname, true ) );
            }
        }
    }
}



/* add comment..γ‘γΏγγγ―γΉγ«γγ§γγ―γγ€γ³γγθΏ½ε 
* ---------------------------------------- */
add_action('add_meta_boxes', 'add_bzb_checklists');
function add_bzb_checklists() {
  add_meta_box('bzb_checklists', 'γͺγγ‘γΌδ½ζγ?γγ§γγ―γγ€γ³γ', 'bzb_checklists', 'post', 'side', 'low');
}

function bzb_checklists() {
  global $post;
  $checklists = array();
  $checklists = get_post_meta($post->ID, 'bzb_checklists', true);
?>
<input type="hidden" name="bzb_checklists[]" value="">
<table class="form-table cmb_metabox">
  <tr class="cmb-type-multicheck cmb_id_bzb_checklists">
    <label style="display:none;" for="bzb_checklists">γγ§γγ―γͺγΉγ</label>
    <td>
      <small>οΌ1οΌο½οΌ7οΌγ?ι γ§ζη« γη΅γΏη«γ¦γ¦γγ γγ</small>
      <ul>
        <li><input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists1" value="check01" <?php echo ( is_array($checklists) && in_array("check01",$checklists))? "checked='checked'":"";?> /> <label for="bzb_checklists1">οΌ1οΌ<b>ει‘ζθ΅·</b>γδΎοΌγβ‘β‘γΓΓγ§ε€§ε€γ§γ―γγγΎγγγοΌ</label></li>
        <li><input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists2" value="check02"   <?php echo ( is_array($checklists) && in_array("check02",$checklists))? "checked='checked'":"";?> /> <label for="bzb_checklists2">οΌ2οΌ<b>γ¨γγ½γΌγ</b>γδΎοΌγΓΓγ§ε°γ£γ¦γγγε?ΆζγγγΎγγγ»γ»γ»</label></li>
        <li><input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists3" value="check03"   <?php echo ( is_array($checklists) && in_array("check03",$checklists))? "checked='checked'":"";?> /> <label for="bzb_checklists3">οΌ3οΌ<b>θ§£ζ±Ίη­γζη€Ί</b>γδΎοΌγββγ§θ§£ζ±Ίγ§γγγγ§γοΌ</label></li>
        <li><input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists4" value="check04"   <?php echo ( is_array($checklists) && in_array("check04",$checklists))? "checked='checked'":"";?> /> <label for="bzb_checklists4">οΌ4οΌ<b>θ§£ζ±Ίγ§γγηη±</b></label>
        	γδΎοΌγγͺγγͺγβ‘β‘γ γγγ§γγ</li>
        <li><input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists5" value="check05"   <?php echo ( is_array($checklists) && in_array("check05",$checklists))? "checked='checked'":"";?> /> <label for="bzb_checklists5">οΌ5οΌ<b>θ§£ζ±Ίγ§γγθ¨Όζ </b>οΌε?δΎγδΈγγοΌγδΎοΌΓΓγ γ£γγ?γββγ«γͺγ£γ¦εη±θ²»γγ»γ»γ»</label></li>
        <li><input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists6" value="check06"   <?php echo ( is_array($checklists) && in_array("check06",$checklists))? "checked='checked'":"";?> /> <label for="bzb_checklists6">οΌ6οΌ<b>γγγγ£γγ</b>γδΎοΌγδ»γγη³γθΎΌγΏγγγ γγγγͺγββγη‘ζγ«γͺγγΎγοΌ</label></li>
        <li><input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists7" value="check07"   <?php echo ( is_array($checklists) && in_array("check07",$checklists))? "checked='checked'":"";?> /> <label for="bzb_checklists7">οΌ7οΌ<b>ιε£ζι€</b>γδΎοΌγγ€γγεΆζ₯­γθ¨ͺεθ²©ε£²γ―γγγγΎγγγ</label></li>
      </ul>
      <span class="cmb_metabox_description"></span>
    </td>
  </tr>
</table>

<?php
}
//ADMIN CSSθΏ½ε 
function admin_files() {
    echo '
<link rel="stylesheet" href="'.get_bloginfo('template_directory'). '/wp-admin.css">
<link rel="stylesheet" href="'.get_bloginfo('stylesheet_directory'). '/wp-admin.css">';
}
//contactform7γγ©γγ­γ³γ°
add_action( 'wp_footer', 'mycustom_wp_footer' );

function mycustom_wp_footer() {
?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
    ga( 'send', 'event', 'Contact Form', 'submit' );
}, false );
</script>
<?php
}
add_action('admin_head', 'admin_files');


// QRγ³γΌγεΊει’ζ°
function get_qrcode_tag($atts) {
	extract(shortcode_atts(array(
		'url' => home_url('/'),
		'size' => '150',
	), $atts));
	// γ€γ‘γΌγΈγΏγ°γθΏγ
	return '<img src="https://chart.googleapis.com/chart?chs=' . $size . 'x' . $size . '&cht=qr&chl=' . $url . '&choe=UTF-8 " alt="QR Code"/>';
}
// εΌγ³εΊγγ?ζε?
add_shortcode('qrcode', 'get_qrcode_tag');

 //Analyticsγͺγ³γ―θΏ½ε 
function analytics_in_admin_bar() {
global $wp_admin_bar;
$wp_admin_bar->add_menu(array(
'id' => 'dashboard_menu-hublog_setting',
'title' => __('hublog_setting'),
'href' => home_url('/hublog_setting/') ,
'meta'   => array(
'target' => '_blank'
),
));
}

function my_editor_style_setup() {
    add_theme_support( 'editor-styles' );
    add_editor_style( 'admin_editor_style.css' );
}
add_action( 'after_setup_theme', 'my_editor_style_setup' );



add_action('wp_before_admin_bar_render', 'analytics_in_admin_bar');
add_theme_support( 'post-thumbnails' );	
//ζ¬δ½γ?γ£γ©γͺγΌCSSεζ­’
add_filter( 'use_default_gallery_style', '__return_false' );
?>