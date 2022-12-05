<?php
/**
 * looppart.php
 * @テーマ名	hublog4
 */
?>



<article id="post-<?php the_ID(); ?>"  class="post row mx-auto p-0  my-5 my-md-3 linkarea">
	
  <figure href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => 'Permalink to: ', 'after' => '' ) ); ?>" class=" m-0 col-4 p-0 mb-3 mb-sm-0 thumbnail py-0 pr-sm-4"> <span class="attachment">
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
	
	
	
  <div class="metabox col-8 align-self-stretch">
	  
	    <?php if ( is_new( WHATSNEW_TTL ) ) : ?>
  <span class="tmb-icon new d-block position-relative">新着</span>
  <?php endif; ?>
	  <span class="d-block">
    <span ><?php the_time('Y/n/j') ?></span>
    </span>
    <p class="title">
      <?php the_title(); ?>
      </p>
 </div>
  <!--metabox--> 
<span class="todetail"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'), the_title_attribute('echo=0')); ?>"> 詳細を見る</a></span>

  <?php edit_post_link(__('Edit'), ''); ?>
  
</article>
<!-- #post --> 

