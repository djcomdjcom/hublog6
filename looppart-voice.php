<?php
/**
 * looppart-voice.php
 *
 * @テーマ名	hublog-c
 * @更新日付	2011.03.10
 *
 */
?>
<article id="post-<?php the_ID(); ?>"  class="style-voice post px-2 px-sm-3 py-0 pb-md-3 linkarea">
  <?php if ( is_new( WHATSNEW_TTL ) ) : ?>
  <span class="tmb-icon new">新着</span>
  <?php endif; ?>
  <figure href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'お客様の声「', 'after' => '」詳細ページへ' ) ); ?>" class="thumbnail"> <span class="attachment">
  <?php
  if ( function_exists( 'the_post_image' ) ) {
    if ( the_post_image( 'medium' ) === false ) {
      ?>
  <img src="<?php echo get_template_image('noimage');?>" width="120" height="120" alt="<?php the_title(); ?>" />
  <?php
  }
  }
  ?>
  </span> </figure>
  <div class="">
    <p class="title">
      <?php if(post_custom('catchcopy')) :?>
      <?php echo nl2br ( post_custom('catchcopy') ); ?>
      <?php else :?>
      <?php the_title(); ?>
      <?php endif ;?>
      </p>
    <?php edit_post_link(__('Edit'), ''); ?>
  </div>
      <span class="todetail"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'), the_title_attribute('echo=0')); ?>"> 詳細を見る</a></span>
  <!--matabox--> 
</article>
