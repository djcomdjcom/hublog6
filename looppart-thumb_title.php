<?php
/**
 * looppart-thumb_title.php
 */
?>
<article class="post-<?php the_ID(); ?> post clearfix style-thumb_title">
<?php if ( is_new( WHATSNEW_TTL ) ) : ?>
<span class="tmb-icon new">新着</span>
<?php endif; ?>
	<div class="metabox">
		<div class="inbox">
			<span class="date">
			<?php the_time('Y/n/j') ?>
			</span>
			
			<p class="title">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'), the_title_attribute('echo=0')); ?>">
			<?php the_title(); ?>
			</a>
			</p>
			<?php edit_post_link(__('Edit'), '', ''); ?>
		</div><!--inbox-->
	</div><!--metabox-->
	
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumbnail">
		<span class="attachment">
		<?php	$thumbnail = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
					if ( empty($thumbnail) ) :
					?><span class="noimg"></span>
					<?php
						else :
						echo $thumbnail;
					endif; ?>
	</span><!--attachment-->
</a>
</article><!-- #post -->
