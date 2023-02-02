<?php
/**
 * addcontent-event.php
 *
 * @テーマ名	hublog-c
 * @更新日付	2012.02.15
 *
 */
?>
<?php if (in_category('event-closed')) : ?>
<p class="event-closed text-center lead"> このイベントは終了しました。<br />
ありがとうございました。 </p>
<?php else  :?>
<?php if (post_custom('event-date')) :	?>
<div id="addcontent-event" class="row pb-4">
  <div class="col-md-6 mb-0 eyecatch"> <span class="w100">
	  
<?php if (has_post_thumbnail()) : ?>
  <?php the_post_thumbnail('large'); ?>
<?php else: ?>
  <span class="noimg"></span>
<?php endif; ?>
	  
	  
    </span> </div>
  <div class="event-meta col-md-6 mb-0">
    <p class="title"><strong>イベント開催情報</strong></p>
	  
	<?php get_template_part('cat_icon');//カテゴリーアイコン ?>
	  
    <?php if(post_custom('catchcopy')) :?>
    <p class="catchcopy txt-ll"> <?php echo nl2br ( post_custom('catchcopy') ); ?> </p>
    <?php endif ;?>
    <span class="event-date"> 開催日：<?php echo post_custom('event-date'); ?> </span> <span class="event-hour"> 開催時間：<?php echo post_custom('event-hour'); ?> </span> <span class="event-at"> 開催場所：<?php echo post_custom('event-at'); ?> </span> </div>
	<?php get_template_part('icon_status');//ステイタスアイコン ?>
	
</div>
<!--addcontent-event-->
<?php endif //event-date ;?>
<?php endif  ;?>
