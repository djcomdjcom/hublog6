<?php
/**
 * hublog-lt/functions.php
 */

class Theme_Settings {
  var $r;

  function __construct( $args = '' ) {
    $defaults = array();
    $r = wp_parse_args( $args, $defaults );
    $this->r = $r;

    add_action( 'after_setup_theme', array( & $this, 'setup_theme_supports' ) );
    add_action( 'after_setup_theme', array( & $this, 'setup_nav_menu' ) );
    add_action( 'widgets_init', array( & $this, 'hublog_widgets_init_sidebar' ), 5 );
    add_action( 'widgets_init', array( & $this, 'hublog_widgets_init_footer' ), 9 );
    add_action( 'wp_enqueue_scripts', array( & $this, 'enqueue_scripts_styles' ) );
    if ( is_admin() ) {
      //			add_action('admin_head', array(&$this, 'wp_admin_favicon') );
    } else {
      add_action( 'get_header', array( & $this, 'set_template_env' ) );
      add_action( 'body_class', array( & $this, 'body_class_add_parent_term' ), 10, 2 );
    }
  }

  function set_template_env() {
    add_filter( 'looppart', array( & $this, 'get_post_is_in' ), 5 );
  }


  function get_post_is_in( $partname ) {
    global $post;
    $output = '';
    if ( post_is_in_category_slug( 'sell' ) || post_is_in_taxonomy_slug( 'sell', 'bukken' ) ) {
      $output = 'bukken';
    } elseif ( post_is_in_category_slug( 'rent' ) || post_is_in_taxonomy_slug( 'rent', 'bukken' ) ) {
      $output = 'bukken';
    } elseif ( post_is_in_category_slug( 'tatemono' ) || post_is_in_taxonomy_slug( 'tatemono', 'bukken' ) ) {
      $output = 'bukken';
    } elseif ( post_is_in_category_slug( 'example' ) ) {
      $output = 'example';
    } elseif ( post_is_in_category_slug( 'reform' ) ) {
      $output = 'reform';

    } elseif ( post_is_in_category_slug( 'event' ) ) {
      $output = 'event';


    } elseif ( post_is_in_category_slug( 'component' ) ) {
      $output = 'component';

    } elseif ( is_post_type_archive('example') || is_post_type_archive('work') ) {
      $output = 'example';
    } elseif ( is_tax( 'ex_cat' ) || is_tax( 'wcase' ) ) {
      $output = 'example';

    } elseif ( is_post_type_archive( 'reform' ) ) {
      $output = 'reform';
    } elseif ( is_tax( 'reform_cat' ) ) {
      $output = 'reform';


    } elseif ( post_is_in_category_slug( 'voice' ) ) {
      $output = 'voice';


    } elseif ( is_post_type_archive( 'voice' ) ) {
      $output = 'voice';
    } elseif ( is_tax( 'voice_cat' ) ) {
      $output = 'voice';

    } elseif ( is_post_type_archive( 'video' ) ) {
      $output = 'video';
    } elseif ( is_tax( 'video_cat' ) ) {
      $output = 'video';


    } elseif ( $post_cats = wp_get_post_categories( $post->ID ) ) {
      $c = get_category( array_shift( $post_cats ) );
      $output = $c->slug;
    }

    if ( empty( $output ) ) {
      return $partname;
    } else {
      return $output;
    }
  }

  function get_page_type() {
    if ( is_home() ) {
      $output = 'home';
    } elseif ( is_front_page() ) {
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


  function setup_theme_supports() {
    add_editor_style( 'style-editor' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-background' );
    //add_theme_support( 'post-formats' , array('post') );

    $custom_header_args = array(
      // Text color and image (empty to use none).
      'default-text-color' => '069',
      'header-text' => true,
      'default-image' => get_stylesheet_directory_uri() . '/images/sitetitle.png',

      // Set height and width, with a maximum value for the width.
      'height' => 120,
      'width' => 580,
      'max-width' => 2000,

      // Support flexible height and width.
      'flex-height' => true,
      'flex-width' => false,

      // Random image rotation off by default.
      'random-default' => false,

      // Callbacks for styling the header and the admin preview.
//      'wp-head-callback' => array( & $this, 'cb_header_style' ),
      'admin-head-callback' => '',
      'admin-preview-callback' => array( & $this, 'admin_custom_header_preview' ),
    );
    add_theme_support( 'custom-header', $custom_header_args );
  }


  function enqueue_scripts_styles() {
    global $wp_styles;

    $child_theme = wp_get_theme(); //子テーマ
    $parent_theme = wp_get_theme( get_template() ); //親テーマ

    wp_enqueue_style( 'style-common', get_template_directory_uri() . '/common.css?' . $parent_theme->get( 'Version' ) );
    wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.min.css?' . $child_theme->get( 'Version' ) );

    wp_enqueue_style( 'for-ie', get_template_directory_uri() . '/css/ie.css', array( 'hublog-style' ) );
    $wp_styles->add_data( 'for-ie', 'conditional', 'lt IE 9' );

    $print_css = '/print.css';
    if ( file_exists( get_stylesheet_directory() . $print_css ) ) {
      wp_enqueue_style( 'hublog-style-print', get_stylesheet_directory_uri() . $print_css, array( 'hublog-style' ), false, 'print' );
    }

  }

  function setup_nav_menu() {
    register_nav_menu( 'primary', __( 'Global nav' ) );
    register_nav_menu( 'contact-link', __( 'Contact-Link' ) );
    register_nav_menu( 'mobile-nav', __( 'mobile-nav' ) );
    register_nav_menu( 'about-nav', __( 'about-nav' ) );
  }

  function hublog_widgets_init_sidebar() {
    //サイドバー用
    $this->register_sidebar( array(
      'name' => __( 'Sidebar' ),
      'id' => 'sidebar-widget-area-1',
    ) );
    foreach ( ( array )apply_filters( 'additional_sidebars', '' ) as $sidebar_slug ) {
      switch ( esc_attr( $sidebar_slug ) ) {
        case 'rent':
          $this->register_sidebar( array(
            'name' => __( 'Sidebar' ) . ':' . __( '賃貸' ),
            'id' => 'sidebar-widget-area-' . $sidebar_slug,
          ) );
          break;
        case 'sell':
          $this->register_sidebar( array(
            'name' => __( 'Sidebar' ) . ':' . __( '売買' ),
            'id' => 'sidebar-widget-area-' . $sidebar_slug,
          ) );
          break;
        case 'blog':
          $this->register_sidebar( array(
            'name' => __( 'Sidebar' ) . ':' . __( 'ブログ用' ),
            'id' => 'sidebar-widget-area-' . $sidebar_slug,
          ) );
          break;
      }
    }
  }

  function hublog_widgets_init_footer() {
    //フッター部用
    $this->register_sidebar( array(
      'name' => __( 'Footer 1' ),
      'id' => 'footer-widget-area-1',
      'description' => __( 'Three columons.' ),
    ) );
    $this->register_sidebar( array(
      'name' => __( 'Footer 2' ),
      'id' => 'footer-widget-area-2',
      'description' => __( 'Bottom of page.' ),
    ) );
  }

  function register_sidebar( $args = '' ) {
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

  function body_class_add_parent_term( $classes, $class ) {
    if ( is_category() ) {
      global $cat;
      $current_cat = get_category( $cat );
      if ( $current_cat->category_parent > 0 ) {
        $p_cat = get_category( $current_cat->category_parent );
        $classes[] = 'category-parent-' . sanitize_html_class( $p_cat->slug, $p_cat->term_id );
        $classes[] = 'category-parent-' . $p_cat->term_id;
      }
    } elseif ( is_tax() ) {
      global $wp_query;
      $term = $wp_query->get_queried_object();
      if ( $term->parent > 0 ) {
        $current_term = get_term_by( 'id', $term->parent, $term->taxonomy );
        $classes[] = 'term-parent-' . sanitize_html_class( $current_term->slug, $current_term->term_id );
        $classes[] = 'term-parent-' . $current_term->term_id;
      }
    }
    return array_unique( $classes );
  }

} // end Class Theme_Settings
$hublog6 = new Theme_Settings();

/* テーマ組み込みプラグインの読み込み */
$inc_dirs = array();
if ( get_stylesheet_directory() != get_template_directory() ) {
  $inc_dirs[] = get_stylesheet_directory() . '/inc';
}
$inc_dirs[] = get_template_directory() . '/inc';
foreach ( $inc_dirs as $modules_dir ) {
  if ( is_dir( $modules_dir ) && $dh = opendir( $modules_dir ) ) {
    while ( ( $module = readdir( $dh ) ) !== false ) {
      if ( substr( $module, -4 ) == '.php' && $module[ 0 ] != '_' ) {
        include_once $modules_dir . '/' . $module;
      }
    }
  }
}

//メディア追加の際、「この投稿へのアップロード」をデフォルトに設定する
function media_uploader_default_view() {
  echo '<script type="text/javascript">jQuery(function( $ ){ ';
  echo 'wp.media.view.Modal.prototype.on( \'ready\', function( ){ $( \'select.attachment-filters\' ).find( \'[value="uploaded"]\').attr( \'selected\', true ).parent().trigger(\'change\'); });';
  echo '});</script>' . "\n";
}
add_action( 'admin_footer-post-new.php', 'media_uploader_default_view' );
add_action( 'admin_footer-post.php', 'media_uploader_default_view' );


// bodyタグにページスラッグを追加 
function pagename_class( $classes = '' ) {
  if ( is_page() ) {
    $page = get_post( get_the_ID() );
    $classes[] = 'page-' . $page->post_name;
    if ( $page->post_parent ) {
      $classes[] = 'page-' . get_page_uri( $page->post_parent ) . '-child';
    }
  }
  return $classes;
}
add_filter( 'body_class', 'pagename_class' );


// 管理画面にフィールドを出力
function create_add_css() {
  $keyname = 'custom_css';
  global $post;
  $get_value = get_post_meta( $post->ID, $keyname, true );
  wp_nonce_field( 'action_' . $keyname, 'nonce_' . $keyname );
  echo '<textarea name="' . $keyname . '" cols="100" rows="4" style="width:100%">' . $get_value . '</textarea>';
}

// カスタムフィールドの保存
add_action( 'save_post', 'save_custom_css' );

function save_custom_css( $post_id ) {
  $keyname = 'custom_css';
  if ( isset( $_POST[ 'nonce_' . $keyname ] ) ) {
    if ( check_admin_referer( 'action_' . $keyname, 'nonce_' . $keyname ) ) {
      if ( isset( $_POST[ $keyname ] ) ) {
        update_post_meta( $post_id, $keyname, $_POST[ $keyname ] );
      } else {
        delete_post_meta( $post_id, $keyname, get_post_meta( $post_id, $keyname, true ) );
      }
    }
  }
}


/* add comment..メタボックスにチェックポイントを追加
 * ---------------------------------------- */
add_action( 'add_meta_boxes', 'add_bzb_checklists' );

function add_bzb_checklists() {
  add_meta_box( 'bzb_checklists', 'オファー作成のチェックポイント', 'bzb_checklists', 'post', 'side', 'low' );
}
/*
function bzb_checklists() {
  global $post;
  $checklists = array();
  $checklists = get_post_meta($post->ID, 'bzb_checklists', true);
?>
<input type="hidden" name="bzb_checklists[]" value="">
<table class="form-table cmb_metabox">
  <tr class="cmb-type-multicheck cmb_id_bzb_checklists">
    <label style="display:none;" for="bzb_checklists">チェックリスト</label>
    <td>
      <small>（1）～（7）の順で文章を組み立ててください</small>
      <ul>
        <li><input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists1" value="check01" <?php echo ( is_array($checklists) && in_array("check01",$checklists))? "checked='checked'":"";?> /> <label for="bzb_checklists1">（1）<b>問題提起</b>　例）　□□が××で大変ではありませんか？</label></li>
        <li><input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists2" value="check02"   <?php echo ( is_array($checklists) && in_array("check02",$checklists))? "checked='checked'":"";?> /> <label for="bzb_checklists2">（2）<b>エピソード</b>　例）　××で困っているご家族がいました・・・</label></li>
        <li><input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists3" value="check03"   <?php echo ( is_array($checklists) && in_array("check03",$checklists))? "checked='checked'":"";?> /> <label for="bzb_checklists3">（3）<b>解決策を提示</b>　例）　○○で解決できるんです！</label></li>
        <li><input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists4" value="check04"   <?php echo ( is_array($checklists) && in_array("check04",$checklists))? "checked='checked'":"";?> /> <label for="bzb_checklists4">（4）<b>解決できる理由</b></label>
        	　例）　なぜなら□□だからです。</li>
        <li><input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists5" value="check05"   <?php echo ( is_array($checklists) && in_array("check05",$checklists))? "checked='checked'":"";?> /> <label for="bzb_checklists5">（5）<b>解決できる証拠</b>（実例を上げる）　例）××だったのが○○になって光熱費が・・・</label></li>
        <li><input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists6" value="check06"   <?php echo ( is_array($checklists) && in_array("check06",$checklists))? "checked='checked'":"";?> /> <label for="bzb_checklists6">（6）<b>ベネフィット</b>　例）　今、お申し込みいただけたらなら○○が無料になります！</label></li>
        <li><input class="cmb_option" type="checkbox" name="bzb_checklists[]" id="bzb_checklists7" value="check07"   <?php echo ( is_array($checklists) && in_array("check07",$checklists))? "checked='checked'":"";?> /> <label for="bzb_checklists7">（7）<b>障壁排除</b>　例）しつこい営業、訪問販売はいたしません。</label></li>
      </ul>
      <span class="cmb_metabox_description"></span>
    </td>
  </tr>
</table>

<?php
}
*/
//ADMIN CSS追加
function admin_files() {
  echo '
<link rel="stylesheet" href="' . get_bloginfo( 'template_directory' ) . '/wp-admin.css">
<link rel="stylesheet" href="' . get_bloginfo( 'stylesheet_directory' ) . '/wp-admin.css">';
}
//contactform7トラッキング
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
add_action( 'admin_head', 'admin_files' );


// QRコード出力関数
function get_qrcode_tag( $atts ) {
  extract( shortcode_atts( array(
    'url' => home_url( '/' ),
    'size' => '150',
  ), $atts ) );
  // イメージタグを返す
  return '<img src="https://chart.googleapis.com/chart?chs=' . $size . 'x' . $size . '&cht=qr&chl=' . $url . '&choe=UTF-8 " alt="QR Code"/>';
}
// 呼び出しの指定
add_shortcode( 'qrcode', 'get_qrcode_tag' );

//Analyticsリンク追加
function analytics_in_admin_bar() {
  global $wp_admin_bar;
  $wp_admin_bar->add_menu( array(
    'id' => 'dashboard_menu-hublog_setting',
    'title' => __( 'hublog_setting' ),
    'href' => home_url( '/hublog_setting/' ),
    'meta' => array(
      'target' => '_blank'
    ),
  ) );
}

function my_editor_style_setup() {
  add_theme_support( 'editor-styles' );
  add_editor_style( 'admin_editor_style.css' );
}
add_action( 'after_setup_theme', 'my_editor_style_setup' );


add_action( 'wp_before_admin_bar_render', 'analytics_in_admin_bar' );
add_theme_support( 'post-thumbnails' );
//本体ギャラリーCSS停止
add_filter( 'use_default_gallery_style', '__return_false' );

//yarppのCSSを読み込まない

add_action( 'wp_print_styles', 'lm_dequeue_header_styles' );

function lm_dequeue_header_styles() {
  wp_dequeue_style( 'yarppWidgetCss' );
}

add_action( 'get_footer', 'lm_dequeue_footer_styles' );

function lm_dequeue_footer_styles() {
  wp_dequeue_style( 'yarppRelatedCss' );
}
?>
