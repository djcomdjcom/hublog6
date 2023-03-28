<?php
/**
 * looppart-side_event.php
 *
 * @テーマ名	hublog
 * @更新日付	2022.23.05
 *
 */
?>
<article id="post-<?php the_ID(); ?>" class="post style-event row linkarea py-3  <?php if (in_category('event-closed')) echo 'closed'; ?>">
  <?php if ( is_new( WHATSNEW_TTL ) ) : ?>
  <span class="tmb-icon new">新着</span>
  <?php endif; ?>
  <figure href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="col-sm-4  mb-3 mb-sm-0 thumbnail"> <span class="attachment">
  <?php
  if ( function_exists( 'the_post_image' ) ) {
    if ( the_post_image( 'medium' ) === false ) {
      ?>
  <span class="noimg"></span>
  <?php
  }
  }
  ?>
  </span> </figure>
  <div class="metabox col-sm-8 align-self-stretch">
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
    <span class="btn pill arrow text-center text-sm-left mx-auto d-block px-0"><span>詳細・参加方法</span></span>
    <?php endif  ?>
  </div>
  <!--metabox-->
	
  <span class="todetail"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s'), the_title_attribute('echo=0')); ?>">詳細・参加方法</a></span>
	<?php get_template_part('icon_status');//ステイタスアイコン ?>
  <?php edit_post_link(__('Edit'), ''); ?>
  <?php if (in_category('event-closed')) : ?>
  <a href="<?php the_permalink(); ?>" class="event-closed"> <span>このイベントは終了しました。<br />
  ありがとうございました。</span> </a>
  <?php endif;?>
</article>
