
<footer id="footer-sitio">
	<div class="container">
		<div class="footer-row row">
			
			<div class="col-md-2 info">
				<img src="<?php bloginfo('template_url');?>/dist/img/logoc80_2022.svg" alt="<?php bloginfo('name');?>">
			</div>

			<div class="col-md-2 menu">
				<h3>Secciones</h3>
				<ul class="items-footer">
					
					<li><a href="<?php echo get_bloginfo('url');?>/visualizaciones-y-recursos">Visualizaciones</a></li>
					<li><a href="<?php bloginfo('url');?>/noticias">Noticias</a></li>
					<li><a href="<?php echo get_post_type_archive_link( 'columnas' );?>">Opinión</a></li>
					<li><a href="<?php echo get_post_type_archive_link( 'c80_cpt' );?>">Constitución 1980</a></li>
					
				</ul>
				
			</div>

			<div class="col-md-2 menu">
				<h3>Información</h3>
				<ul class="items-footer">
					<li><a href="<?php echo get_permalink(68);?>">Somos</a></li>
					<li><a href="<?php echo get_permalink(516);?>" target="_blank">¿Cómo colaborar?</a></li>
					<li><a href="<?php echo get_permalink(70);?>">Contacto</a></li>
				</ul>
			</div>

			<div class="col-md-3 redes">
				<h3>Redes sociales</h3>
				<ul class="socials items-footer">
					<li>
						<a href="<?php echo C80_INSTAGRAM;?>" target="_blank"><i class="fa fa-fw fa-instagram"></i> Instagram</a>
					</li>
					<li><a href="<?php echo c80t_twitter();?>"><i class="fa fa-twitter fa-fw"></i> Twitter</a></li>
					<li>
						<a href="<?php echo C80_FACEBOOK;?>" target="_blank"><i class="fa fa-fw fa-facebook-square"></i> Facebook</a>
					</li>
				</ul>
			</div>

			

			<div class="footer-licencia col-md-3">
				<h3>Licencia de uso</h3>
				<img alt="Licencia Creative Commons" style="border-width:0" src="<?php bloginfo('template_url');?>/dist/img/licencia_c80.svg" /><br />C80 está bajo una licencia Creative Commons. El material puede ser distribuido, copiado y exhibido, pero obliga a citar las fuentes de esos contenidos. El autor debe figurar en los créditos.
			</div>

		</div>
	</div>
</footer>
<a href="#" class="goback" title="Subir">
		<img src="<?php bloginfo('template_url');?>/dist/img/arrowup.svg" alt="Volver arriba" />
	</a>
<?php wp_footer();?>
</body>
</html>