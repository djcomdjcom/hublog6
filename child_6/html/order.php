


<div class="pagetab pagetab-main">
  <?php wp_nav_menu(array('theme_location'=>'order-nav', 'fallback_cb'=>'nothing_to_do')); ?>
</div>


  <?php //echo (get_option('profile_shop_name')) //?>

<header class="entry-header">

<h1 class="entry-title border-0"><span class="mincho">
100年住める快適な家
</span></h1>
</header>



<p>経済性と住み心地を兼ね備えた世界に一つだけの家を実現するために、<?php echo get_option('profile_shop_name');//屋号 ?>は標準仕様に則って家づくりをしています。</p>

<p>基準があるからこそ、日々その基準を高めていく家づくりを可能にしています。</p>

<p>耐震、耐久、省エネ、維持メンテナンスなど、あなたらしい人生を見守り続ける建物標準仕様をご確認ください。</p>

<p>厳格な建物仕様があるからこそ、あなたらしく自由な発想でデザイン設計できるのです。</p>
<p>
100年住める快適な家をあなたらしいデザインで設計施工いたします。
</p>

<figure class="w100">
<img src="<?php bloginfo('stylesheet_directory'); ?>/images/builder/order000.jpg" alt=""/> </figure>

<div class="pagetab pagetab-bottom">
  <?php wp_nav_menu(array('theme_location'=>'order-nav', 'fallback_cb'=>'nothing_to_do')); ?>
</div>


</article>
<?php get_template_part('include', 'reason');//選ばれる理由 ?>
<article class="entry-content">

