<?php get_header(); ?>
<div id="home-slider" class="mx-fit">
  <?php get_template_part('nivoslides'); ?>
</div>
<div id="home-carousel" class="mb-3">
  <div id="calousel_ttl" class="wrapper container text-center"> <span class="ttl">Special Contents</span> </div>
  <?php get_template_part('inc', 'event_bnrs'); ?>
</div>

<!--▼▼▼コンセプト▼▼▼-->
<section id="home-concept" class="py-5 px-3 px-xl-0 mx-fit">
  <div class="inbox wrapper text-center pb-5 ">
  <header id="home-concept-header" class="content_header">
    <h2 class="ttl mincho center mb-4"><?php echo get_option('profile_shop_name');//屋号 ?>の<br class="d-sm-none">
      家づくりとは</h2>
  </header>
  <div class="text-center px-4 px-md-0">
    <p style="color: #BBB;" class="ttl noicon ">Concept</p>
    <p class="txt-ll mb-5"> リフォーム工事から<br class="d-sm-none">
      新築注文住宅まで<br>
      高性能住宅を重視し、省エネや快適性を追求した<br>
      「住んで健康になれる」家づくりを提供しています。</p>
    <p class=" "> 自社職人と自社施工を基盤として、<br>
      ひとつ一つの家づくりにこだわって施工しています。<br>
      大小に関わらずリフォーム工事には事前調査を細かくに行い、<br>
      お客さまに最適なプランをご提案させていただいております。</p>
  </div>
  <section id="concept_choice" class="">
    <ul class="row justify-content-between py-3 pt-md-5 pb-md-4">
      <li class="choice01 col-6 col-md-3 mb-4 linkarea">
        <figure class="w100"> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/cpt_choice-01@2x.jpg" alt="住んで健康になれる健康志向の家"/> </figure>
        <div class="txtcell">
          <h3 class="ttl ">住んで健康になれる<br>
            健康志向の家</h3>
        </div>
        <span class="todetail"><a href="/concept#page_concept01" title="コンセプト「住んで健康になれる」"></a></span> </li>
      <li class="choice02 col-6 col-md-3 mb-4 linkarea">
        <figure class="w100"> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/cpt_choice-02@2x.jpg" alt="自社職人と自社施工"/> </figure>
        <div class="txtcell">
          <h3 class="ttl ">自社職人と自社施工</h3>
        </div>
        <span class="todetail"><a href="/concept#page_concept02" title="コンセプト「自社職人と自社施工」"></a></span> </li>
      <li class="choice03 col-6 col-md-3 mb-4 linkarea">
        <figure class="w100"> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/cpt_choice-03@2x.jpg" alt="耐震性・耐久性断熱効果の高い家"/> </figure>
        <div class="txtcell">
          <h3 class="ttl ">耐震性・耐久性<br>
            断熱効果の高い家</h3>
        </div>
        <span class="todetail"><a href="/concept#page_concept03" title="コンセプト「耐震性・耐久性断熱効果の高い家」"></a></span> </li>
      <li class="choice04 col-6 col-md-3 mb-4 linkarea">
        <figure class="w100"> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/cpt_choice-04@2x.jpg" alt="ゼロエネルギースタイル"/> </figure>
        <div class="txtcell">
          <h3 class="ttl ">ゼロエネルギースタイル</h3>
        </div>
        <span class="todetail"><a href="/concept#page_concept04" title="コンセプト「ゼロエネルギースタイル」"></a></span> </li>
    </ul>
    </div>
    <p class="btn pill"> <a class="bg_key01 mx-auto" href="/concept">コンセプトページはこちら</a> </p>
  </section>
</section>
<!--　home-concept　▲▲▲コンセプト▲▲▲--> 

<!--▼▼▼施工事例▼▼▼-->
<?php get_template_part('include', 'example');//施工事例 ?>
<!--　home-example　▲▲▲施工事例▲▲▲--> 
<!--▼▼▼施工事例▼▼▼-->
<?php get_template_part('include', 'reform');//リフォーム事例 ?>
<!--　home-example　▲▲▲施工事例▲▲▲--> 

<!--▼▼▼インフォエリア▼▼▼-->
<div id="home-infoarea" class="row justify-content-between wrapper container mx-auto px-0 mb-5 ">
<script>
jQuery(function(){
jQuery('.posts .post.style-event').addClass('my-5 my-md-3 '); 
jQuery('.posts .post.style-event .thumbnail').addClass('py-0 '); 
jQuery('.posts .post.style-inc_news .thumbnail').addClass('py-0 '); 
});		
</script>
<section id="home-news" class="home-content  px-0 px-md-3 col-md-6 mb-5">
  <header class="content_header text-center py-3 py-lg-4">
    <h2 class="ttl mincho">ニュース<span class="txt-s">＆</span>トピックス</h2>
  </header>
  <?php
  $args = array(
    'post_type' => 'post',
    'category_name' => 'news',
    'posts_per_page' => 3,
  );
  $the_query = new WP_Query( $args );
  if ( $the_query->have_posts() ):
    ?>
  <div class="posts px-0 px-md-3 mx-auto">
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <?php //get_template_part('looppart', 'headline'); ?>
    <?php get_template_part('looppart', 'inc_news'); ?>
    <?php endwhile; ?>
  </div>
  <?php endif; wp_reset_postdata(); ?>
  <p class="arrow btn mb-0"><a href="/category/news" title="ニュース＆トピックス一覧ページヘのリンク">もっと見る</a></p>
</section>
<!--home-news-->
<section id="home-event" class="home-content col-md-6 mb-5 ">
  <header class="content_header text-center py-3 py-lg-4">
    <h2 class="ttl mincho">近日イベントのご案内</h2>
  </header>
  <?php
  $args = array(
    'post_type' => 'post',
    'category_name' => 'event',
    'posts_per_page' => 3,
  );
  $the_query = new WP_Query( $args );
  if ( $the_query->have_posts() ):
    ?>
  <div class="posts px-0 px-md-3 mx-auto">
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <?php get_template_part('looppart', 'event'); ?>
    <?php endwhile; ?>
  </div>
  <?php endif; wp_reset_postdata(); ?>
  <p class="arrow btn mb-0"><a href="/category/event" title="イベント情報">もっと見る</a></p>
</section>
<!--home-event--> 
	</div>

<!--▼▼▼選ばれる理由▼▼▼-->

<?php get_template_part('include', 'reason');//選ばれる理由 ?>

<!--　home-infoarea　▲▲▲インフォエリア▲▲▲--> 

<!--▼▼▼代表あいさつとスタッフ紹介▼▼▼-->
<section id="home-greeting" class="pb-4 mb-5">
  <div class="wrapper"> 
    
    <!--▼▼▼代表あいさつ▼▼▼-->
    <section id="president"> <a href="/message" class="w100"> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/hm-bnr-president@2x.webp" alt="代表あいさつ"/> </a> </section>
    
    <!--　home-greeting　▲▲▲代表あいさつ▲▲▲--> 
    <!--▼▼▼スタッフ紹介▼▼▼-->
    
    <section id="home-staff" class="mt-5 home-content">
      <header class="content_header mb-5">
        <h2 class="mincho center">スタッフ紹介</h2>
      </header>
      <div class="flexbox">
        <?php get_template_part('loop-authors'); ?>
        <div class="staff-list d-none"> <a class="w100" href="/recruit"><img class="pt-2 photo" alt="" src="<?php echo get_stylesheet_directory_uri(); ?>/images/staff-topage.png"></a> </div>
      </div>
      <p class="arrow btn center"> <a href="/staff">スタッフ紹介一覧はこちら</a> </p>
    </section>
    <!--　home-staff　▲▲▲スタッフ紹介▲▲▲--> 
    
  </div>
</section>
<!--　home-greeting　▲▲▲代表あいさつとスタッフ紹介▲▲▲-->

<section id="home-blog" class="pt-5 pb-5 mb-5 mx-fit"> 
  <script>
jQuery(function(){
jQuery('#home-blog .posts .post').addClass('p-3 col-md-3 col-sm-6 col-12'); 
});		
</script>
  <div class="wrapper container ">
    <header class="content_header text-center">
      <h2 class="ttl mincho">ブログ</h2>
    </header>
    <?php query_posts('category_name=blog&posts_per_page=3'); ?>
    <div class="posts row justify-content-start">
      <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('looppart', 'home_blog'); ?>
      <?php endwhile; ?>
    </div>
    <div class=" arrow btn center"> <a href="/category/blog">一覧へ</a></div>
    <?php wp_reset_query(); ?>
  </div>
</section>
<section id="hajimetenavi" class="navi text-center mt-5 mb-5">
  <header class="content_header wrapper container mb-4">
    <h2 class="ttl mincho">お客様の状況に応じて <span class="text-nowrap">アクションをお選びください</span></h2>
  </header>
  <div class="wrapper container">
    <ul class="row justify-content-between px-0">
      <li class="col-6 col-md-3" ><a class="w100" href="/online_sumai"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hajimete_bnr-soudankai@2x.webp" alt="住まいの無料相談会"><span>住まいの無料相談会</span></a></li>
      <li class="col-6 col-md-3" ><a class="w100" href="/online_meeting"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hajimete_bnr-ol_meet@2x.webp" alt="オンライン打ち合わせ"><span>オンライン打ち合わせ</span></a></li>
      <li class="col-6 col-md-3" ><a class="w100" href="/kenngakukai"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hajimete_bnr-kengakukai@2x.webp" alt="構造完成見学会"><span>構造完成見学会</span></a></li>
      <li class="col-6 col-md-3" ><a class="w100" href="/offer?title=<?php if ( is_home() || is_front_page() ) {  echo ('トップページ');} else {echo get_the_title();}?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hajimete_bnr-shiryou@2x.webp" alt="資料請求"><span>資料請求</span></a></li>
    </ul>
  </div>
</section>
<?php get_template_part('include', 'contact'); ?>
<?php get_template_part('include', 'zeh'); ?>
<?php get_footer(); ?>
