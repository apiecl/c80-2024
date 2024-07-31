
<footer id="footer-sitio" class="hidden">
	<div class="container">
		<div class="footer-content">
			
			<div class="footer-column info">
				<img src="<?php bloginfo('template_url');?>/dist/img/logov_sm_blancofondo.png" alt="<?php bloginfo('name');?>">
				<p>Constitución: <br>Lo que dice, nos afecta</p>	

					<!-- Begin MailChimp Signup Form -->
<div id="mc_embed_signup">
<form action="//c80.us11.list-manage.com/subscribe/post?u=af6bd471236cf2e72a950afac&amp;id=7ecd5c202c" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
	<h2 style="line-height:1.5em;">Recibe las noticias, columnas y novedades de c80. ¡Suscríbete a nuestro boletín!</h2>
<div class="mc-field-group">
	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="deja tu e-mail">
</div>
	<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;"><input type="text" name="b_af6bd471236cf2e72a950afac_7ecd5c202c" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="Suscribirme" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
</form>
</div>

<!--End mc_embed_signup-->
			</div>

			<div class="footer-column menu">
				<ul>
					<li><a href="<?php echo get_permalink(68);?>">sobre el proyecto</a></li>
					<li><a href="<?php echo get_permalink(516);?>" target="_blank">¿cómo colaborar?</a></li>
					<li><a href="<?php echo get_permalink(70);?>">contacto</a></li>
					<li><a href="<?php bloginfo('url');?>/noticias">noticias</li>
					<li><a href="<?php echo get_post_type_archive_link( 'columnas' );?>">opinión</a></li>
					<li><a href="<?php echo get_post_type_archive_link( 'c80_cpt' );?>">constitución</a></li>
					<li class="separator">&nbsp;</li>
					<li><a href="<?php echo c80t_twitter();?>"><i class="fa fa-twitter fa-fw"></i> @<?php echo C80_TWITTER;?></a></li>
					<li>
						<a href="<?php echo C80_FACEBOOK;?>" target="_blank"><i class="fa fa-fw fa-facebook-square"></i> Facebook</a>
					</li>
					<li>
						<a href="<?php echo C80_INSTAGRAM;?>" target="_blank"><i class="fa fa-fw fa-instagram"></i> Instagram</a>
					</li>
				</ul>
			</div>

			<div class="footer-column auspicios">
				<p>Con el apoyo de:</p>
				<img src="<?php bloginfo('template_url');?>/dist/img/logo-finlandia.png" alt="Embajada de Finlandia - Santiago Chile">
			</div>

			<div class="footer-licencia">
				<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Licencia Creative Commons" style="border-width:0" src="<?php bloginfo('template_url');?>/dist/img/cc.png" /></a><br /><a xmlns:cc="http://creativecommons.org/ns#" href="http://www.c80.cl" property="cc:attributionName" rel="cc:attributionURL">C80</a> está bajo una <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Licencia Creative Commons Atribución 4.0 Internacional</a>.
			</div>

		</div>
	</div>
</footer>

<?php wp_footer();?>
</body>
</html>