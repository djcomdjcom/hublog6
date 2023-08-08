<?php
$args = array(
  'post_type' => 'example', //カスタム投稿名
  //            'event_type' => array('newhouse','renovation'),
  //    'order' => 'ASC',
  'orderby' => 'order',
  'posts_per_page' => 9 //表示件数（ -1 = 全件 ）

);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ):
  ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/js/owlcarousel/assets/owl.theme.default.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/js/owlcarousel/assets/owl.carousel.min.css" media="screen" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/owlcarousel/owl.carousel.min.js"></script> 
<script>
	
	
jQuery(function($){

  $('.owl-carousel').owlCarousel({

							loop: true,
							nav: true,
							navSpeed: 800,
							dots: false,
							dotsSpeed: 800,
							lazyLoad: true,
							autoplay: true,
							autoplayHoverPause: true,
							autoplayTimeout: 3000,
							autoplaySpeed:  800,
							stagePadding: 15,
							margin:0,
							freeDrag: true,
							mouseDrag: true,
							touchDrag: true,
							slideBy: 1,
							fallbackEasing: "linear",
							responsiveClass: true,
							navText: [ "previous", "next" ],
							responsive:{
							0:{items: 2},
							576:{items: 3},
							992:{items: 4},
							1980:{items: 5}
                                
                            },
                            autoHeight: false
                        });
	
                    });
	
	

</script> 

<!--home-event-->
<section id="home-example" class="pb-4 mb-5 mx-fit scroll_up">
<header class="content_header mt-5 mb-3">

<h2 class="ttl mincho center">施工事例</h2>
</header>
<div class="owl-carousel owl-theme posts">
  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
  <div id="post-<?php the_ID(); ?>" class="clearfix style-home-example post linkarea">
    <?php if ( is_new( WHATSNEW_TTL ) ) : ?>
    <span class="tmb-icon new">新着</span>
    <?php endif; ?>
    <picture class="thumbnail w100 m-0">
    <?php
    if ( function_exists( 'the_post_image' ) ) {
      if ( the_post_image( array( 480, 480, true ) ) === false ) {
        ?>
    <span class="noimg"></span>
    <?php
    }
    }
    ?>
    </picture> <a class="btnshine example-item-inner" href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => '施工事例「', 'after' => '」詳細ページへ' ) ); ?>">
    <div class="inbox">
      <?php // get_template_part('cat_icon');//カテゴリーアイコン ?>
      <span class="ttl mincho">
      <?php the_title(); ?>
      </span>
	  <span class="date">
    <?php the_time('Y/n/j') ?>
    </span>
	  </div>
    </a>
    <?php edit_post_link(__('Edit'), ''); ?>
  </div>
  <!--post-->
  <?php endwhile; ?>
</div>
	
    <div class="arrow btn toindex mt-4"> <a href="/example/" title="施工事例一覧ページヘのリンク">一覧を見る</a> </div>
	
</section>
<!--home-event-->

<style>
</style>
<?php endif; wp_reset_postdata(); ?>
