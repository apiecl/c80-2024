<?php 
  if(get_post_type($post->ID) == 'c80_cpt'):
    $height = 320;
  else:
    $height = 640;
  endif;
?>


<a href="#" class="loadembedhtml" title="Compartir este contenido en tu sitio web" data-title="<?php the_title();?>" data-target="#c80_article_link-subarticle-<?php echo $post->ID;?>" data-id="<?php echo $post->ID;?>"><i class="fa fa-share-alt"></i></a>

<div class="modal fade modal-c80" tabindex="-1" role="dialog" aria-labelledby="c80_article_link-subarticle-<?php echo $post->ID;?>" id="c80_article_link-subarticle-<?php echo $post->ID;?>">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> <?php if(get_post_type($post->ID) == 'c80_cpt'):?>
          <?php echo c80t_parentname($post->ID, false);?>: 
        <?php endif;?>

        <?php echo get_the_title($post->ID);?></span></h4>
      </div>
      <div class="modal-body">
        <h4>Compartir en redes sociales</h4>

        <?php get_template_part('partials/sharer');?>

        <h4>Insertar este contenido en tu sitio</h4>

        <div class="alert alert-warning">
         <p>Copia el código de abajo e insértalo en tu sitio web para compartir este contenido.</p> 
        </div>
        <p class="htmlplaceholder"><textarea name="c80embed" class="c80_embedcodetextarea" id="c80_embedcodetextarea-<?php echo $post->ID;?>" cols="30" rows="10"><?php echo get_post_embed_html(600, $height, $post->ID);?></textarea></p>
      </div>
    
    </div>
  </div>
</div>