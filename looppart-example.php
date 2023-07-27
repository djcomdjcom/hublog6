<?php
/**
* looppart-example.php
*
* @テーマ名	hublog6
*
*/
?>

<article class="post-<?php the_ID(); ?> style-example post  p-2 p-sm-3 pb-md-3 linkarea">
	<?php if ( is_new( WHATSNEW_TTL ) ) : ?>
	<span class="tmb-icon new">新着</span>
	<?php endif; ?>

	<figure href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array( 'before' => '施工事例「', 'after' => '」詳細ページへ' ) ); ?>" class="thumbnail">
		<span class="attachment">
			<?php if ( function_exists('the_post_image') ) {
				if ( the_post_image(array(600, 600)) === false ){
					?><span class="noimg"></span><?php
				}
			} ?>
		</span>
	</figure>
	<?php //get_template_part('cat_icon');//カテゴリーアイコン ?>
	
	<span class="title mb-0">
		<?php the_title(); ?>
</span>
	
		<?php if(post_custom('catchcopy')) :?>
	<p class="d-none d-md-block catchcopy"><?php echo nl2br ( post_custom('catchcopy') ); ?></p>
		<?php endif ;?>
	
      <span class="todetail"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'), the_title_attribute('echo=0')); ?>"> 詳細を見る</a></span>

	<?php edit_post_link(__('Edit'), ''); ?>

</article><!--post-->


