<?php
/**
 * attachment.php
 */
get_header();

wp_get_attachment_image($attachment_id, $size, $icon, $attr) ;
?>



    <?php if(is_attachment()): ?>
          <?php if (wp_attachment_is_image($post->id)) : ?>
          <?php $att_image = wp_get_attachment_image_src( $post->id, "full-size"); ?>
      <p>
      <a href="<?php echo $att_image[0];?>" target="_blank"><img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>" alt="<?php $post->post_excerpt; ?>" /></a>
      </p>
        <p><?php echo esc_html($post->post_title); ?></p> <!--タイトルを表示-->
        <p><?php echo esc_html($post->post_excerpt); ?></p> <!--キャプションを表示-->
        <p><?php echo esc_html($post->post_content); ?></p> <!--説明を表示 を表示-->
          <?php else: ?>
          <?php the_content(); ?>
          <?php endif; ?>
      <?php else: ?>
          <?php the_content(); ?>
      <?php endif; ?>




<?php get_footer(); ?>