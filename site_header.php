<?php
/**
 * site_header.php
 * 
 * (extend for header.php)
 */
?>
<header id="header">
  <div class="wrapper description pl-5 pl-md-0 d-none d-sm-block"> <em class="px-3 px-xl-0">
    <?php bloginfo( 'description' ); ?>
    </em> </div>
  <section id="globalheader">
    <div class="row wrapper mx-auto">
      <div class="sitetitle text-center text-md-left order-2 order-md-1 col-6 col-sm-8 col-md-5 mx-0 mx-sm-auto align-self-center pl-5 pl-sm-0"> <a class="w100 maxw-360 mx-auto mx-md-0" href="/" >
        <?php if (is_home() ): ?>
        <h1 class="m-0 p-0"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sitetitle@2x.png" alt="<?php echo get_option('profile_corporate_name'); ?>"></h1>
        <?php else:?>
        <span class=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sitetitle@2x.png" alt="<?php echo get_option('profile_corporate_name'); ?>"></span>
        <?php endif;?>
        </a> </div>
      <div class="sitelogo d-none d-md-block order-1 order-md-2 col-3 col-sm-3 col-md-2 mx-0 max-md-auto mb-0 "><a class="w100" href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon@2x.png" alt="アイコン「<?php echo get_option('profile_corporate_name'); ?>」"></a></div>
      <div id="header-sub" class="order-3 col-sm-5 col-12 text-center text-md-right d-none d-md-block">
        <?php if ( has_nav_menu( 'contact-link' ) ) :?>
        <div class="menu-header_link-container">
          <?php wp_nav_menu( array('theme_location'=>'contact-link', 'fallback_cb'=>'nothing_to_do') ); ?>
        </div>
        <!--menu-header_link-container-->
        
        <?php endif; ?>
        <div class="contact-tel"> <span class="profile_inquiry_tel">
          <?php
          $profile_inquiry_tel = ( get_option( 'profile_inquiry_tel' ) ) ? get_option( 'profile_inquiry_tel' ) : get_option( 'profile_main_tel' );
          if ( !empty( $profile_inquiry_tel ) ): ?>
          &nbsp;<span class="telnum"><?php echo $profile_inquiry_tel; ?>&nbsp;</span>
          <?php
          endif;
          ?>
          </span> </div>
        <!--contact-tel-->
        <?php if ( get_option('profile_holiday') || get_option('profile_opening_hours')) : ?>
        <div class="opning-hour-day">
          <?php if ( get_option('profile_opening_hours')) : ?>
          <span class="profile_opening_hours"> <span class="title">営業時間：</span><?php echo (get_option('profile_opening_hours')) ?></span>
          <?php endif; ?>
          <?php if ( get_option('profile_holiday') ) : ?>
          <span class="profile_holiday"> <span class="title">定休日：</span><?php echo (get_option('profile_holiday')) ?> </span>
          <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
  <div id="top-contact" class="position-fixed top-contact">
    <div class="inbox"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/top-contact@2x.png" class="tc-img" alt="問合せはこちら"> <a class="to_offer" href="/offer?title=<?php if ( is_home() || is_front_page() ) {  echo ('トップページ');} else {echo get_the_title();}?>">資料請求</a> <a class="to_inquiry" href="/inquiry?title=<?php if ( is_home() || is_front_page() ) {  echo ('トップページ');} else {echo get_the_title();}?>">お問い合わせ</a> </div>
  </div>
</header>
<?php if (! is_home() ): ?>
<nav id="headnav">
  <?php get_template_part( 'global-navi-menu' ); ?>
</nav>
<?php endif; ?>
