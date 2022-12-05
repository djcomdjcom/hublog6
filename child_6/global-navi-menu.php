<div class="home-menu">
  <ul class="menu">
    <?php
    wp_nav_menu( array(
      'container' => '',
      'items_wrap' => '%3$s',
      'theme_location' => 'global-navi',
    ) );
    ?>
  <?php get_template_part( 'links-offer' ); ?>
  </ul>
</div>
