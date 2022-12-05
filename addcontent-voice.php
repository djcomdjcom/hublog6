<?php
/**
 * addcontent-voice.php
 *
 * @テーマ名	gatten
 * @更新日付	2012.02.15
 *
 */
?>	
            <div id="voice-content" class="clearfix cleartype">
            
            

				<?php if (post_custom('voice-image-scanned')) : ?>
                <div class="voice-scanned voice-set rel_lb break clearfix">

                    <a href="<?php echo post_custom('voice-scanned-pdf'); ?>" target="_blank">                        
                        <img src="<?php echo post_custom('voice-image-scanned'); ?>" />    
                    </a>
    
                </div><!--voice-scanned-->
				<?php endif  ?>
                
            
				<?php if (post_custom('01voice-image')) : ?>
                <div class="voice01 voice-set clearfix">
                    <div class="voice-image rel_lb">
										<?php echo wp_get_attachment_link(post_custom('01voice-image'),array(500, 500));?>

                    </div><!--voive-image-->
                    <div class="voice">
			

                    
                    	<h2>
						<?php echo nl2br ( post_custom('01voice-title') ); ?>
						</h2>
                        <?php echo wpautop(post_custom('01voice')); ?>
						
						
						
                    </div><!--voice-->
                </div><!--voice01-->
				<?php endif //01 ?>
             
    
				<?php if (post_custom('02voice-image')) : ?>
                <div class="voice02 voice-set clearfix">
    
    
                    <div class="voice-image rel_lb">
										<?php echo wp_get_attachment_link(post_custom('02voice-image'),array(500, 500));?>

                    </div><!--voive-image-->
                    <div class="voice">
                    	<h3>
						<?php echo nl2br ( post_custom('02voice-title') ); ?>
						</h3>
                        <?php echo wpautop(post_custom('02voice')); ?>
                    </div><!--voice-->
                </div><!--voice02-->
				<?php endif //02 ?>
    

				<?php if (post_custom('03voice-image')) : ?>
                <div class="voice03 voice-set clearfix">
    
                    <div class="voice-image rel_lb">
										<?php echo wp_get_attachment_link(post_custom('03voice-image'),array(500, 500));?>


                    </div><!--voive-image-->
                    
                    <div class="voice">
                    	<h3>
						<?php echo nl2br ( post_custom('03voice-title') ); ?>
						</h3>
                        <?php echo wpautop(post_custom('03voice')); ?>
                    </div><!--voice-->
                </div><!--voice03-->
				<?php endif //03 ?>
        
    







				<?php if (post_custom('04voice-image')) : ?>
                <div class="voice04 voice-set clearfix">
    
    
                    <div class="voice-image rel_lb">
										<?php echo wp_get_attachment_link(post_custom('04voice-image'),array(500, 500));?>

                    </div><!--voive-image-->
                    <div class="voice">
                    	<h3>
						<?php echo nl2br ( post_custom('04voice-title') ); ?>
						</h3>

                        <?php echo wpautop(post_custom('04voice')); ?>
                    </div><!--voice-->
                </div><!--voice04-->
				<?php endif //04 ?>
    

				<?php if (post_custom('05voice-image')) : ?>
                <div class="voice05 voice-set clearfix">
    
                    <div class="voice-image rel_lb">
										<?php echo wp_get_attachment_link(post_custom('05voice-image'),array(500, 500));?>


                    </div><!--voive-image-->
                    
                    <div class="voice">
                    	<h3>
						<?php echo nl2br ( post_custom('05voice-title') ); ?>
						</h3>

                        <?php echo wpautop(post_custom('05voice')); ?>
                    </div><!--voice-->
                </div><!--voice05-->
				<?php endif //05 ?>    
    

    
    


			</div><!--voice-content-->
            
