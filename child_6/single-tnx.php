<?php
/**
template name: 投稿タイプTNX用 

 * single-tnx.php
 *
 * @テーマ名	hublog
 * @更新日付	2012.03.15
 *
 */
get_header();
?>

		<div id="container" class="page htmlpage tnx widecolumn">

			<div id="content" role="main">
				<?php the_post(); ?>
					<article class="entry-content clearfix hentry">


                    <?php the_content(); ?>
					
					<?php //インクルードセクション
					$the_page = get_page(get_the_ID());
					$include_html_dir  = STYLESHEETPATH . '/html/';
					$include_html_file = $include_html_dir . $the_page->post_name;
					if ( file_exists($include_html_file . '.php') ){
						include $include_html_file . '.php';
					} elseif ( file_exists($include_html_file . '.html') ){
						include $include_html_file . '.html';
					}
					?>

                </article><!-- .entry-content -->



			</div><!-- #content -->
            
		</div><!-- #container -->


<?php //get_sidebar(); ?>

<?php get_footer(); ?>
