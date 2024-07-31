<?php 
     $fase = get_query_var('fase');
     $link = add_query_arg( array('fase' => $fase ), get_permalink($post->ID));
?>

<div class="sharer-timeline" data-url="<?php echo c80_url($post->ID);?>" >
	<div class="twitter-share sharebutton">
		
          
          <a title="Compartir en Twitter" target="_blank" href="https://twitter.com/share?url=<?php echo $link;?>&text=<?php the_title();?>&via=proyectoC80" class="sharer__twitter mobile-sharebutton"><i class="fa fa-twitter"></i></a>

	</div>

	<div class="facebook-share sharebutton" data-href="<?php echo $link;?>">
          <a title="Compartir en Facebook" target="_blank" href="https://facebook.com/sharer.php?u=<?php echo urlencode( $link );?>" class="sharer__facebook" data-count="0"><i class="fa fa-facebook"></i></a>
          
	</div>	
    
    <!-- <div class="gplus-one sharebutton">
          

          <a title="Compartir en Google+" target="_blank" href="https://plus.google.com/share?url=<?php echo $link;?>" class="mobile-sharebutton sharer__gplus"><i class="fa fa-google-plus"></i></a>
     </div>

     <div class="linkedin-share sharebutton">

          <a title="Compartir en LinkedIn" target="_blank" href="http://www.linkedin.com/shareArticle?url=<?php echo $link;?>&title=<?php the_title();?>" class="mobile-sharebutton sharer__linkedin"><i class="fa fa-linkedin"></i></a>
     </div> -->

     <div class="whatsapp-share sharebutton hidden-lg hidden-md">
     	<a href="whatsapp://send?text=<?php echo $link;?><?php echo urlencode(' ' . get_the_title($post->ID) );?>" target="_blank" class="sharer__whatsapp">
     		<i class="fa fa-whatsapp"></i>
     	</a>
     </div>

      <div class="telegram-share sharebutton hidden-lg hidden-md">
     	<a href="https://telegram.me/share/url?url=<URL>&text=<?php echo $link;?><?php echo urlencode(' ' . get_the_title($post->ID) );?>" target="_blank" class="sharer__telegram">
     		<i class="fa fa-telegram"></i>
     	</a>
     </div>

     <!--<div class="embed-share sharebutton">
          <?php //get_template_part('partials/modal-c80embed');?>
     </div>	-->
</div>	

<div class="sharer-info">Comparte esta fase</div>