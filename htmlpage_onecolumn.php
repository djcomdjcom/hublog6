<?php
/**
template name: ★htmlインクルード用 1カラム
 */
get_header();
?>
<div id="container" class="page widecolumn htmlpage">
  <div id="content" role="main">
    <?php the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('hentry'); ?>>
      <header class="entry-header">
        <?php
        if ( has_post_thumbnail() ):
          $args = array(
            'alt' => get_the_title(),
            'title' => get_the_title(),
          );
        $image = get_the_post_thumbnail( $page->ID, 'header-title', $args );
        ?>
        <h1 class="entry-title-image"><?php echo $image; ?></h1>
        <?php else: ?>
        <h1 class="entry-title"><span>
          <?php the_title(); ?>
          </span></h1>
        <?php endif; ?>
		  
		  
      </header>
		
		
      <article class="entry-content">
        <?php the_content(); ?>
        <?php if ( current_user_can( 'administrator' ) ) :?>
        <p class="edit_theme"><a target="_blank" href="/wp-admin/theme-editor.php?file=html%2F<?php echo $slug_name = $post->post_name; ?>.php&theme=<?php echo get_stylesheet('name'); ?>" title="/wp-admin/theme-editor.php?file=html%2F<?php echo $slug_name = $post->post_name; ?>.php&theme=<?php echo get_stylesheet('name'); ?>"> このincludeテーマを編集 </a></p>
        <?php endif;?>
        <?php //インクルードセクション
        $the_page = get_page( get_the_ID() );
        $include_html_dir = STYLESHEETPATH . '/html/';
        $include_html_file = $include_html_dir . $the_page->post_name;
        if ( file_exists( $include_html_file . '.php' ) ) {
          include $include_html_file . '.php';
        } elseif ( file_exists( $include_html_file . '.html' ) ) {
          include $include_html_file . '.html';
        }
        ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
      </article>
      <!-- .entry-content -->
      
      <?php /** ページタブリンク **/ ?>
      <?php $parent_page_id = (int)post_custom('parent_page_id'); ?>
      <?php if ( $parent_page_id > 0 ) : ?>
      <ul id="pagetab-<?php echo $parent_page_id; ?>" class="pagetab clearfix cleartype">
        <?php wp_list_pages('depth=1&hide_empty=0&title_li=&include='  . $parent_page_id); ?>
        <?php wp_list_pages('depth=1&hide_empty=0&title_li=&child_of=' . $parent_page_id); ?>
      </ul>
      <?php endif; ?>
		
      <?php get_template_part('releated-posts');// posts_in_page ?>
      
      <!--商品ページ共通-->
      <?php
      $gettemplate01 = ( post_custom( 'gettempale01' ) );
      ?>
      <?php get_template_part($gettemplate01); ?>
      <?php get_template_part('hublog-inquiry',''); //問い合わせフック ?>
      <footer class="entry-utility page wrapper">
        <div class="entry-meta updated author"> <span class="date updated">
          <?php the_time('Y/n/j') ?>
          </span> <span class="author vcard">投稿者：<span class="fn">
          <?php the_author(); ?>
          </span></span> </div>
        <!--entry-meta-->
        <?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
      </footer>
      <!-- .entry-utility --> 
    </article>
    <!--.hentry--> 
  </div>
  <!-- #content --> 
  
</div>
<!-- #container -->

<?php get_footer(); ?>
