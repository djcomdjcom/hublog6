


<div class="pagetab pagetab-main">
  <?php wp_nav_menu(array('theme_location'=>'renov-nav', 'fallback_cb'=>'nothing_to_do')); ?>
</div>
<?php if( post_custom('anchor_link')) :?>
<nav class="anchor_link_set">
<?php echo post_custom('anchor_link') ;?>
</nav>
<?php endif;?>
<p></p>


<header class="entry-header">

<h1 class="entry-title border-0"><span class="mincho">
ライフスタイルに合わせたリノベーション
</span></h1>
</header>


<p>現在お住まいの建物の構造体がしっかりしていれば、ライフスタイルに合わせてリノベーションするという選択肢もご用意しています。</p>

<p>建替えかリフォームかは、みなさん最初に悩まれることだと思います。</p>

<p>新築建替えありきのハウスメーカーとは違い、プロの建築家から見て、既存建物が構造的に問題なければ、リノベーションで経済的で快適な住まいを実現します。</p>

<p>耐震、耐久、省エネ、維持メンテナンスは、注文住宅と同様のコンセプトでリノベーションいたします。</p>

<p>建替えかリノベーションか迷ったら、まずは<?php echo get_option('profile_shop_name'); ?>にご相談ください。</p>
<p>
今お住まいの建物を見させていただき、適切なご提案をいたします。</p>

<figure class="w100">
<img src="<?php bloginfo('stylesheet_directory'); ?>/images/builder/renovation000.jpg" alt=""/> </figure>


<div class="pagetab pagetab-bottom">
  <?php wp_nav_menu(array('theme_location'=>'renov-nav', 'fallback_cb'=>'nothing_to_do')); ?>
</div>
</article>
<?php get_template_part('include', 'reason');//選ばれる理由 ?>
<article class="entry-content">
<p></p>