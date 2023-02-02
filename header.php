<?php
/**
 * hublog-lt/header.php
 * hublog6
 * 20230202
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]--><head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<title><?php
	if ( is_home() || is_front_page() ) {
		bloginfo( 'name' ); 
	} else {
		wp_title(' | ',true,'right');
		bloginfo('name');
	}
?></title>

<link rel="profile" href="https://gmpg.org/xfn/11" />

<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<?php if ( file_exists(get_stylesheet_directory() . '/favicon.ico') ) : ?>
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" type="image/gif" />
<link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" type="image/gif" />
<?php endif; //favicon.ico ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<?php $print_css = (file_exists(get_stylesheet_directory() . '/print.css')) ? get_stylesheet_directory_uri() . '/print.css' : get_template_directory_uri() . '/print.css';?>
<link rel="stylesheet" href="<?php echo $print_css; ?>" type="text/css" media="print" />
	
	
<!-- css -->
<!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
</head>
<?php if (is_singular(array('lp','tnx') )): ?>
<?php get_template_part('code', 'fbpixel'); ?>
<?php endif;?>

<?php
$pagename = '';
$page_class = '';
if ( is_home() || is_front_page() ){
	$pagename = 'home';
} elseif ( is_page() ) {
	$pageObj = get_page(get_the_ID());
	if ($pageObj) {
		$page_name = $pageObj->post_name; //post_name is slug
		if ( $page_name ) {
			$page_class = 'page-' . $page_name;
		}
	}
	$pagename = $page_name;
}
?>


<body <?php body_class(); ?>>

<?php get_template_part( 'site_header' ); ?>
	
<div id="breadcrumb" class="breadcrumbs" vocab="https://schema.org/" typeof="BreadcrumbList">
  <div class="inbox px-2">
    <?php
    if ( function_exists( 'bcn_display' ) ) {
      bcn_display();
    }
    ?>
  </div>
</div>
<?php get_template_part('topinfo', $topinfo_template); ?>

<main role="main" id="main" <?php body_class( 'clearfix' ); ?> ontouchstart="">