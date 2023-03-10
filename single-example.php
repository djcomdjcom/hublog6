<?php
/**
 * single-example.php
 * hublog6
 * 20230202
 */

get_header();

?>
<script>	
$(function(){
  $('.rel_lb a[href$=".jpg"],.rel_lb a[href$=".jpeg"],.rel_lb a[href$=".JPG"],.rel_lb a[href$=".JPEG"],.rel_lb a[href$=".png"],.rel_lb a[href$=".PNG"],.rel_lb a[href$=".gif"],.rel_lb a[href$=".GIF"]').attr('rel' ,'lightbox');
});  
</script>

    <?php the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('hentry'); ?>>

  <header class="wrapper mx-fit">
        <h1 class="entry-title"><span>
          <?php the_title(); ?>
          </span></h1>
      </header>
      <div class="entry-content wrapper">
        <?php //get_template_part('addcontent_before', apply_filters('hublog_addcontent_before','') ); ?>
        <?php get_template_part('addcontent', 'example'); ?>
        <?php the_content(); ?>
		  
		  
        <?php wp_reset_query(); ?>
        <?php get_template_part('addcontent_after',  apply_filters('hublog_addcontent_after','')  ); ?>
        <?php get_template_part('addcontent_after', $addcontent); ?>
      </div>
      <!-- .entry-content -->
      
      <?php get_template_part('include', 'example');//選ばれる理由 ?>
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
            <?php

            $terms = get_the_terms( $post->ID, 'ex_cat' );
            print( '<p>Posted in：' );

            if ( empty( $terms ) ) {
              echo '<a href=/example">施工事例一覧</a>';
            } else {
              foreach ( $terms as $term ) {
                echo '<a href="' . get_term_link( $term->slug, 'ex_cat' ) . '">' . $term->name . '</a>';
              }

            };
            print( '</p>' );
            ?>
          </div>
          <!-- .entry-meta -->
          <?php related_posts(); ?>
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
    <!-- #post-## --> 
    
<?php
/**
 */

get_footer();

?>
