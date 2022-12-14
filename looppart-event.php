<?php
/**
 * looppart-side_event.php
 *
 * @テーマ名	hublog
 * @更新日付	2012.04.05
 *
 */
?>
<article id="post-<?php the_ID(); ?>" class="post style-event row mx-auto p-0 <?php if (in_category('event-closed')) echo 'closed'; ?>">
	
	
    <?php if ( is_new( WHATSNEW_TTL ) ) : ?>
    <span class="tmb-icon new">新着</span>
    <?php endif; ?>
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="col-sm-5 p-0 mb-3 mb-sm-0 thumbnail"> <span class="attachment">
    <?php
    if ( function_exists( 'the_post_image' ) ) {
      if ( the_post_image( 'medium' ) === false ) {
        ?>
    <img src="<?php echo get_template_image('noimage');?>" alt="No Image" />
    <?php
    }
    }
    ?>
    </span>
		
	</a>
	
	
    <div class="metabox col-sm-7 align-self-stretch">
		
	<?php get_template_part('cat_icon');//カテゴリーアイコン ?>
		
		
      <p class="title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'), the_title_attribute('echo=0')); ?>">
        <?php if(post_custom('catchcopy')) :?>
        <?php echo nl2br ( post_custom('catchcopy') ); ?>
        <?php else :?>
        <?php the_title(); ?>
        <?php endif ;?>
        </a></p>
      <div class="event-meta">

        <?php if (in_category('event-date')) : ?>
		<span class="event-date"> <span>開催日：</span><?php echo post_custom('event-date'); ?> </span>
		<?php endif  ?>
        <?php if (in_category('event-hour')) : ?>
		<span class="event-hour"> <span>開催時間：</span><?php echo post_custom('event-hour'); ?> </span>
		<?php endif  ?>
        <?php if (in_category('event-at')) : ?>
		<span class="event-at"> <span>開催場所：</span><?php echo post_custom('event-at'); ?> </span>
		<?php endif  ?>
		</div>
      <!--event-nmeta--> 
      
		
<?php if (! in_category('event-closed')) : ?>
<span class="todetail col text-center text-sm-left"> <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">詳細・参加方法</a> </span>
<?php endif  ?>	
	
	</div>
    <!--metabox--> 
	<?php get_template_part('icon_status');//ステイタスアイコン ?>
  
  <?php edit_post_link(__('Edit'), ''); ?>
	<?php if (in_category('event-closed')) : ?>
	<a href="<?php the_permalink(); ?>" class="event-closed">
	<span>このイベントは終了しました。<br />
	ありがとうございました。</span>
	</a>
<?php endif;?>
</article>
