<?php
/**
 * addcontent-reform.php
 *
 * @更新日付	2023.04.15
 *
 */
?>
<div id="addcontent-reform" class="clearfix">
	
  <?php if (post_custom('reform-gallery')) : ?>
  <section id="galleryslider" class="clearfix rel_lb">
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/js/slick/slick.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/js/slick/slick-theme.css" media="screen" />
    <script src="<?php bloginfo('stylesheet_directory'); ?>/js/slick/slick.min.js"></script> 
    <script>
//タグにclass追加
jQuery(function(){
jQuery('#galleryslider .gallery-size-large').addClass('slider_thumb slider'); 
});
jQuery(function(){
jQuery('#galleryslider .gallery-size-thumbnail').addClass('thumb'); 
});
		
//slick設定
		
jQuery(document).ready(function () {
  jQuery('.slider_thumb').slick({
      arrows:true,
	  dots: true,
      asNavFor:'.thumb',
  })

});

		
//サムネイル表示の調整	
	
var windowWidth = jQuery(window).width();
var windowSm = 768;
if (windowWidth <= windowSm) {
jQuery(function () {
let slidesToShowNum = 6; //slidesToShowに設定したい値を挿入
 /* slidesToShowより投稿が少ない場合の処理▽ */
let item = jQuery('#galleryslider .gallery-size-thumbnail dl').length; //dlの個数を取得
if (item <= slidesToShowNum) {
for ( i = 0 ; i <= slidesToShowNum + 1 - item ; i++) { //足りていない要素数分、後ろに複製
jQuery('#galleryslider .gallery-size-thumbnail dl:nth-child(' + i + ')').clone().appendTo('#galleryslider .gallery-size-thumbnail');
  }
 } /* slidesToShowより投稿が少ない場合の処理△ */

 jQuery('#galleryslider .gallery-size-thumbnail').slick({
  slidesToShow: slidesToShowNum, //slidesToShowNumに設定した値が入る
 });
});
	
} else {
//横幅768px以上（PC、タブレット）に適用させるJavaScriptを記述
jQuery(function () {
let slidesToShowNum = 12; //slidesToShowに設定したい値を挿入
 /* slidesToShowより投稿が少ない場合の処理▽ */
let item = jQuery('#galleryslider .gallery-size-thumbnail dl').length; //liの個数を取得
if (item <= slidesToShowNum) {
for ( i = 0 ; i <= slidesToShowNum + 1 - item ; i++) { //足りていない要素数分、後ろに複製
jQuery('#galleryslider .gallery-size-thumbnail dl:nth-child(' + i + ')').clone().appendTo('#galleryslider .gallery-size-thumbnail');
  }
 }
 /* slidesToShowより投稿が少ない場合の処理△ */
 jQuery('#galleryslider .gallery-size-thumbnail').slick({
  slidesToShow: slidesToShowNum, //slidesToShowNumに設定した値が入る
 });
});}	
</script>
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
    <?php echo (do_shortcode('[gallery columns="0" link="file" title="true" caption="true" description="true" size="large"  exclude='.$exclude.']')); ?> <?php echo (do_shortcode('[gallery columns="0" link="none" title="false" caption="false" description="false" size="thumbnail"  exclude='.$exclude.']')); ?> </section>
  <!--　-->
  <?php endif ?>
  <div id="reform-meta">
    <div class="inbox">
      <?php if (post_custom('feature')) : ?>
      <div class="icon-features clearfix">
        <?php get_template_part('icon-features'); ?>
      </div>
      <?php endif ?>
      <?php if (post_custom('reform-name')) : ?>
      <span class="example-area_name">[ <span class="example-area"><?php echo post_custom('reform-area'); ?></span>&nbsp;&nbsp; <span class="example-name"><?php echo post_custom('reform-name'); ?></span> ] </span>
      <?php endif ?>
      <?php if (post_custom('reform-madori')) : ?>
      <span class="example-yuka">間取：<?php echo post_custom('reform-madori'); ?></span>
      <?php endif ?>
      <?php if (post_custom('reform-yuka')) : ?>
      <span class="example-yuka">総工事床面積：<?php echo post_custom('reform-yuka'); ?></span>
      <?php endif ?>
      <?php if (post_custom('reform-kasho')) : ?>
      <span class="reform-kasho">施工箇所：<?php echo post_custom('reform-kasho'); ?></span>
      <?php endif ?>
      <?php if (post_custom('reform-kikan')) : ?>
      <span class="example-yosan">施工期間：<?php echo post_custom('reform-kikan'); ?></span>
      <?php endif ?>
      <?php if (post_custom('reform-yosan')) : ?>
      <span class="example-yosan">工事予算：<?php echo post_custom('reform-yosan'); ?>万円</span>
      <?php endif ?>
    </div>
    <!--inbox-->
    
    <?php if (post_custom('reform-youbou')) : ?>
    <dl class="reform-youbou">
      <dt class="title">お客様のご要望・お悩み</dt>
      <dd class="postcustom"> <?php echo wpautop(post_custom('reform-youbou')); ?> </dd>
    </dl>
    <?php endif ?>
    <!--reform-youbou-->
    
    <?php if (post_custom('reform-kaiketsusaku')) : ?>
    <dl class="reform-kaiketsusaku">
      <dt class="title"><?php echo get_option('profile_shop_name'); ?>からの解決策</dt>
      <dd><?php echo wpautop(post_custom('reform-kaiketsusaku')); ?> </dd>
    </dl>
    <?php endif ?>
  </div>
  <!--reform-meta--> 
  
</div>
<!--addcontent-reform--> 

<!--　beforeafter表示-->
<div id="before-after" class="rel_lb py-5">
  <?php $customfield = SCF::get('ba'); ?>
  <?php if(!empty($customfield)): ?>
  <?php
  $ba = SCF::get( 'ba' );
  foreach ( $ba as $fields ): ?>
  <?php
  if ( $fields[ 'ba_before' ] !== ""
    and $fields[ 'add_contents' ] !== "" ): __COMPILER_HALT_OFFSET__: ?>
  <?php
  $ba_before = $fields[ 'ba_before' ];
  $ba_after = $fields[ 'ba_after' ];
  ?>
  <div class="row container mx-auto p-0 ba-item py-3 mb-5 border-bottom">
    <div class="col-12 p-0">
      <?php   if ( $fields['ba_title']):?>
      <h3 class="noicon ttl"><?php echo  $fields['ba_title']; ?></h3>
      <?php endif;?>
      <?php   if ( $fields['ba_description']):?>
      <div class="description pb-4" id="description_01"> <?php echo nl2br( $fields['ba_description']); ?> </div>
      <?php endif;?>
    </div>
    <div class="col-4 px-0 before-image">
      <figure class="w100"> <span class="ttl">施工前</span> <a href="<?php echo wp_get_attachment_url($ba_before,'large'); ?>"><img src="<?php echo wp_get_attachment_url($ba_before,'thumbnail'); ?>"></a> </figure>
    </div>
    <div class="col-1 px-0 arrow text-center"> <i class="fa-solid fa-circle-right"></i> </div>
    <div class="col-7 px-0 after-image">
      <figure class="w100"> <span class="ttl">施工後</span> <a href="<?php echo wp_get_attachment_url($ba_after,'large'); ?>"><img src="<?php echo wp_get_attachment_url($ba_after,'laege'); ?>"></a> </figure>
    </div>
  </div>
  <?php endif;?>
  <?php endforeach;?>
  <?php endif; ?>
</div>
<!--beforeafterここまで-->