<!--▼▼▼リフォーム事例▼▼▼-->
<section id="home-reform" class="pt-1 pb-5">
  <div class="wrapper container home-posts">
    <header class="content_header mt-5 mb-3">
      <h2 class="ttl center">リフォーム施工事例</h2>
    </header>

    <script>
$(function(){
$('.posts .post.style-example').addClass('col-6 col-lg-4 ');
});
</script>
	  
	  
    <?php
    $args = array(
        'post_type' => 'reform', //カスタム投稿名
        //            'event_type' => array('newhouse','renovation'),
        //    'order' => 'ASC',
        'orderby' => 'order',
        'posts_per_page' => 9 //表示件数（ -1 = 全件 ）
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ):
      ?>
    <div class="posts row justify-content-start">
      <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
      <?php get_template_part('looppart', 'example'); ?>
      <?php endwhile; ?>
    </div>
    <?php endif; wp_reset_postdata(); ?>
    <div class="aboveright arrow toindex"> <a href="/reform/" title="リフォーム事例一覧ページヘのリンク">一覧を見る</a> </div>
  </div>
</section>
<!--　home-example　▲▲▲リフォーム事例▲▲▲--> 
