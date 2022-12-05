<?php
/**
 * looppart-home-blog.php
 * @テーマ名	hublog4
 */
?>
<article id="post-<?php the_ID(); ?>"  class="post clearfix style-inc_blog">
  <?php if ( is_new( WHATSNEW_TTL ) ) : ?>
  <span class="tmb-icon new">新着</span>
  <?php endif; ?>
  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>" class="thumbnail"> <span class="attachment">
  <?php
  if ( function_exists( 'the_post_image' ) ) {
    if ( the_post_image( array(400,400) ) === false ) {
      ?>
  <img src="<?php echo get_template_image('noimage');?>" width="120" height="120" alt="<?php the_title(); ?>" />
  <?php
  }
  }
  ?>
  </span> </a>
  <div class="metabox"> <span class="date">
    <?php the_time('Y/n/j') ?>
    </span>
    <p class="title"> <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'), the_title_attribute('echo=0')); ?>">
      <?php the_title(); ?>
      </a> </p>
    <?php if (in_category('event-closed')) : ?>
    <span class="event-closed cleartype"> このイベントは終了しました。ありがとうございました。 </span>
    <?php endif  ?>
    <div class="excerpt">
      <?php //the_excerpt(); ?>
    </div>
</div>
  <!--metabox--> 
    <?php edit_post_link(__('Edit'), ''); ?>
</article>
<!-- #post --> 

