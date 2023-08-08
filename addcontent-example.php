<?php if ( post_custom( 'remove-gallery' ) == 'gallery_off' ):  ?>
<?php else:?>

<div id="galleryslider" class="mx-fit sliderArea rel_lb">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/js/slick/slick.css" media="screen">
  <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/js/slick/slick-theme.css" media="screen">
  <script src="<?php bloginfo('stylesheet_directory'); ?>/js/slick/slick.min.js"></script> 
  <script>
jQuery(function($){
$('#galleryslider .gallery-size-large').addClass('slider_thumb slider'); 
$('#galleryslider .gallery-size-thumbnail').addClass('thumb'); 

$(document).ready(function () {

$('.slider_thumb').slick({
arrows:true,
dots:false,
asNavFor:'.thumb',
	
	
      centerMode: true,
      centerPadding: '0',
      slidesToShow: 1, // 画面に表示するスライドの数
	focusOnSelect: true,
});
	
	
$('.thumb').slick({
slidesToScroll: 1,
asNavFor: '.slider_thumb',
focusOnSelect: true,
slidesToShow: 12,
responsive: [
  {
	breakpoint: 768, // 576px以下のサイズに適用
	settings: {
	slidesToShow: 8,
	},
  },
  {
	breakpoint: 576, // 576px以下のサイズに適用
	settings: {
	slidesToShow: 6,
	},
  },
],
});
});
});

	  
	  
</script>
	
	
<style>
  .slick-slide {
    margin: 0 10px; /* スライド間の間隔を調整 */
  }
  .centerpadding {
    padding: 0 25%; /* 中央に余白を持たせるパーセンテージを調整 */
  }
</style>	
  <?php
  $id = $post->ID;
  if ( empty( $exclude ) ) {
    $eximages = get_children( array( 'post_parent' => $id, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => -1 ) );
    foreach ( $eximages as $eximage ) {
      $post_custom = get_post_custom( $eximage->ID );
      if ( isset( $post_custom[ 'exclude' ] ) ) {
        $excludes[] = $eximage->ID;
      }
    }
    if ( isset( $excludes ) && !empty( $excludes ) ) {
      $exclude = ( is_array( $excludes ) ) ? join( ',', $excludes ) : '';
    }
  };
  ?>
  <?php echo (do_shortcode('[gallery columns="0" link="file" title="true" caption="true" description="true" size="large"  exclude='.$exclude.']')); ?> <?php echo (do_shortcode('[gallery columns="0" link="none" title="false" caption="false" description="false" size="thumbnail"  exclude='.$exclude.']')); ?> </div>
<!--example-slider-->

<article id="example-header" class=" rel_lb">
  <?php if(post_custom('catchcopy')) :?>
  <h2 class="title"> <span class="catchcopy"> <?php echo nl2br ( post_custom('catchcopy') ); ?> </span> </h2>
  <?php endif ;?>
  <?php if (post_custom('example-name') || post_custom('example-family') || post_custom('example-area') || post_custom('example-kouhou') || post_custom('example-shikichi') || post_custom('example-yuka') || post_custom ('example-C') || post_custom ('example-Q') || post_custom ('example-UA') ) : ?>
  <div id="example-data">
    <h3 class="ttl">Data</h3>
    <table class="mt-0 ml-sm-3">
      <p class="example-area_name">
      <span>
      
      <?php if (post_custom('example-name')) :?>
      <caption>
      <?php echo post_custom('example-name'); ?>様邸
      </caption>
      <?php endif ; ?>
      <?php if (post_custom('example-family')) :?>
      <tr>
        <th>家族構成</th>
        <td><?php echo wpautop(post_custom('example-family')); ?></td>
      </tr>
      <?php endif ; ?>
      <?php if (post_custom('example-area')) :?>
      <tr>
        <th>施工エリア</th>
        <td><?php echo post_custom('example-area'); ?></td>
      </tr>
      <?php endif ; ?>
      <?php if (post_custom('example-kouhou')) :?>
      <tr>
        <th>工法・構造</th>
        <td><?php echo post_custom('example-kouhou'); ?></td>
      </tr>
      <?php endif ; ?>
      <?php if (post_custom('example-taishin')) :?>
      <tr>
        <th>耐震等級</th>
        <td><?php echo post_custom('example-taishin'); ?></td>
      </tr>
      <?php endif ; ?>
      <?php if (post_custom('example-shikichi')) :?>
      <tr>
        <th>敷地面積</th>
        <td><?php echo post_custom('example-shikichi'); ?></td>
      </tr>
      <?php endif ; ?>
      <?php if (post_custom('example-yuka')) :?>
      <tr>
        <th>床面積</th>
        <td><?php echo post_custom('example-yuka'); ?></td>
      </tr>
      <?php endif ; ?>
      <?php if (post_custom('example-madori')) :?>
      <tr>
        <th>間取</th>
        <td><?php echo post_custom('example-madori'); ?></td>
      </tr>
      <?php endif ; ?>
      <?php if (post_custom('example-C')) :?>
      <tr>
        <th>C値</th>
        <td><?php echo post_custom('example-C'); ?></td>
      </tr>
      <?php endif ;?>
      <?php if (post_custom('example-Q')) :?>
      <tr>
        <th>Q値</th>
        <td><?php echo post_custom('example-Q'); ?></td>
      </tr>
      <?php endif ;?>
      <?php if (post_custom('example-UA')) :?>
      <tr>
        <th>UA値</th>
        <td><?php echo post_custom('example-UA'); ?></td>
      </tr>
      <?php endif ;?>
    </table>
  </div>
  <!--example-data-->
  <?php endif ; ?>
</article>
<?php endif ?>