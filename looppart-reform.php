<?php
/**
 * looppart-reform.php
 * hublog6
 * 20230202
 */
?>
<article id="post-<?php the_ID(); ?>" class="post row justify-content-around style-reform linkarea">
  <?php if ( is_new( WHATSNEW_TTL ) ) : ?>
  <span class="tmb-icon new">新着</span>
  <?php endif; ?>
  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'リフォーム事例「', 'after' => '」詳細ページへ' ) ); ?>" class="col-sm-4  mb-3 mb-sm-0 thumbnail"> <span class="attachment">
  <?php
  if ( function_exists( 'the_post_image' ) ) {
    if ( the_post_image( 'thumbnail' ) === false ) {
      ?>
  <span class="noimg"></span>
  <?php
  }
  }
  ?>
  </span> </a>
  <div class="metabox col-sm-8 align-self-stretch">
    <p class="title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'), the_title_attribute('echo=0')); ?>">
      <?php the_title(); ?>
      </a></p>
    <div class="reform-nmeta">
      <dl class="reform-youbou">
        <dt class="title">お客様のご要望・お悩み</dt>
        <dd class="postcustom"> <?php echo wpautop(post_custom('reform-youbou')); ?> </dd>
      </dl>
      <!--reform-youbou--> 
      
    </div>
    <!--event-nmeta--> 
  </div>
  <!--metabox--> 
  <span class="todetail"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'), the_title_attribute('echo=0')); ?>"> 詳細を見る</a></span>
  <?php edit_post_link(__('Edit'), ''); ?>
</article>
