<?php
/**
 * looppart.php
 * hublog6
 * 20230202
 */
?>
<article id="post-<?php the_ID(); ?>"  class="post row linkarea py-2">
  <?php if ( is_new( WHATSNEW_TTL ) ) : ?>
  <span class="tmb-icon new">新着</span>
  <?php endif; ?>
  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>" class="thumbnail col-4  pr-lg-5"> <span class="attachment">
  <?php
  if ( function_exists( 'the_post_image' ) ) {
    if ( the_post_image( 'medium' ) === false ) {
      ?>
  <span class="noimg"></span>
  <?php
  }
  }
  ?>
  </span> </a>
  <div class="metabox col-8 px-0 pl-sm-3"> <span class="date">
    <?php the_time('Y/n/j') ?>
    </span>
    <p class="title"> <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'), the_title_attribute('echo=0')); ?>">
      <?php the_title(); ?>
      </a> </p>
    <?php if (in_category('event-closed')) : ?>
    <span class="event-closed cleartype"> このイベントは終了しました。ありがとうございました。 </span>
    <?php endif  ?>
    <div class="excerpt d-none d-sm-block">
      <?php the_excerpt(); ?>
    </div>
  </div>
  <!--metabox--> 
  <span class="todetail"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'), the_title_attribute('echo=0')); ?>"> 詳細を見る</a></span>
  <?php edit_post_link(__('Edit'), ''); ?>
</article>
<!-- #post --> 

