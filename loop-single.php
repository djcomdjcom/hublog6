<?php
/**
 * hublog-lt/loop-single.php
 * hublog6
 * 20230202
 */

if ( in_category( array( 'reform', 'beforeafter' ) ) ) {
  $addcontent = 'beforeafter';

} elseif ( in_category( 'voice' ) ) {
  $addcontent = 'voice';

} elseif ( is_singular( 'voice' ) ) {
  $addcontent = 'voice';


  //} elseif ( in_category( 'example' ) || post_is_in_descendant_category( get_term_by( 'slug', 'example', 'category' ))) {
  //	$addcontent = 'example';

} elseif ( in_category( array( 'example', 'newhouse', 'renovation', 'shinchiku' ) ) ) {
  $addcontent = 'example';

} elseif ( in_category( array( 'event', 'chokkin', 'event-scheduled', 'chokkinevent', 'benkyoukai', 'kengakukai' ) ) ) {
  $addcontent = 'event';


} else {
  $addcontent = '';
}

$cat_parent = 0;
$cat_bukken = 0;
$column_class = 'narrowcolumn';

$post_id_example = ( post_custom( 'voice-inc_example' ) );
$post_id_voice = ( post_custom( 'example-inc_voice' ) );

?>


<?php the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('hentry rel_lb'); ?>>
  <header class="wrapper mx-fit">
    <?php if (post_custom('voice-catch')) : ?>
    <h1 class="entry-title"><span><?php echo (post_custom('voice-catch')) ; ?></span></h1>
    <?php else :?>
    <h1 class="entry-title"><span>
      <?php the_title(); ?>
      </span></h1>
    <?php endif ;?>
  </header>
  <article class="entry-content wrapper">
    <?php get_template_part('addcontent_before', apply_filters('hublog_addcontent_before','') ); ?>
    <?php get_template_part('addcontent', $addcontent); ?>
    <?php if (post_custom('voice-catch')) : ?>
    <h2 class="entry-title">
      <?php the_title(); ?>
    </h2>
    <?php endif ;?>
    <?php the_content(); ?>
    <?php if (post_custom('inc-map') || post_custom('select-map')) : ?>
    <?php get_template_part('addcontent-inc_map'); ?>
    <?php endif ;?>
    <?php if (post_custom('example-inc_voice')) : ?>
    <section class="clearfix" id="example-inc_voice">
      <h2 class="title">施主様の声</h2>
      <?php query_posts('p=' . $post_id_voice . ''); ?>
      <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('addcontent-voice'); ?>
      <?php edit_post_link(__('お客様の声を編集'), '|', ''); ?>
      <?php endwhile; ?>
      <?php wp_reset_query(); ?>
    </section>
    <?php endif ;?>
    <?php if (post_custom('voice-inc_example')) ://施工事例インクルード ?>
    <?php query_posts('p=' . $post_id_example . ''); ?>
    <span class="todetail"><a href="/<?php echo $post_id_example ;?>.html">施工事例はこちら</a></span>
    <?php wp_reset_query(); ?>
    <?php endif ; ?>
    <?php wp_reset_query(); ?>
    <?php get_template_part('addcontent_after',  apply_filters('hublog_addcontent_after','')  ); ?>
    <?php get_template_part('addcontent_after', $addcontent); ?>
  </article>
  <!-- .entry-content -->
  
  <?php get_template_part('hublog-inquiry',''); //問い合わせフック ?>
  <footer>
    <div class="entry-utility wrapper">
      <?php edit_post_link( __( 'Edit', 'hublog' ), '<span class="edit-link">', '</span>' ); ?>
      <?php
      wp_link_pages( array(
        'before' => '<div class="page-link">' . __( 'Pages:' ),
        'after' => '</div>',
        'link_before' => '<span>',
        'link_after' => '</span>',
      ) );
      ?>
      <div class="entry-meta">
        <?php
        printf(
          $posted_in,
          get_the_category_list( ', ' ),
          $tag_list,
          get_permalink(),
          the_title_attribute( 'echo=0' )
        );
        ?>
      </div>
      <!-- .entry-meta -->
      
      <div class="entry-meta updated author"> <span class="date updated">
        <?php the_time('Y/n/j') ?>
        </span> <span class="author vcard">投稿者：<span class="fn">
        <?php the_author(); ?>
        </span></span> </div>
      <!-- .entry-meta --> 
      
    </div>
    <!-- .entry-utility --> 
    
  </footer>
</article>
<!--.hentry-->

