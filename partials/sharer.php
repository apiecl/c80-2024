<div class="social-share" data-url="<?php echo c80_url($post->ID);?>" >
	<div class="twitter-share sharebutton">
		
          
          <a title="Compartir en Twitter" target="_blank" href="https://twitter.com/share?url=<?php echo get_permalink();?>&text=<?php the_title();?>&via=proyectoC80" class="sharer__twitter mobile-sharebutton"><i class="fa fa-twitter"></i></a>

	</div>

	<div class="facebook-share sharebutton" data-href="<?php echo get_permalink();?>">
          <a title="Compartir en Facebook" target="_blank" href="https://facebook.com/sharer.php?u=<?php echo urlencode( get_permalink($post->ID) );?>" class="sharer__facebook" data-count="0"><i class="fa fa-facebook"></i></a>
          
	</div>	
    
    <!-- <div class="gplus-one sharebutton">
          

          <a title="Compartir en Google+" target="_blank" href="https://plus.google.com/share?url=<?php echo get_permalink();?>" class="mobile-sharebutton sharer__gplus"><i class="fa fa-google-plus"></i></a>
     </div>

     <div class="linkedin-share sharebutton">

          <a title="Compartir en LinkedIn" target="_blank" href="http://www.linkedin.com/shareArticle?url=<?php echo get_permalink();?>&title=<?php the_title();?>" class="mobile-sharebutton sharer__linkedin"><i class="fa fa-linkedin"></i></a>
     </div> -->

     <div class="whatsapp-share sharebutton hidden-lg hidden-md">
     	<a href="whatsapp://send?text=<?php echo get_permalink();?><?php echo urlencode(' ' . get_the_title($post->ID) );?>" class="sharer__whatsapp">
     		<i class="fa fa-whatsapp"></i>
     	</a>
     </div>

      <div class="telegram-share sharebutton hidden-lg hidden-md">
     	<a href="tg://msg?text=<?php echo get_permalink();?><?php echo urlencode(' ' . get_the_title($post->ID) );?>" class="sharer__telegram">
     		<i class="fa fa-telegram"></i>
     	</a>
     </div>

     <!--<div class="embed-share sharebutton">
          <?php //get_template_part('partials/modal-c80embed');?>
     </div>	-->
</div>	