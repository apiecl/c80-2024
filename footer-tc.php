
<footer id="footer-sitio" class="footer-tc">
	<div class="container">
		<div class="footer-content">
			<div class="col-md-6 left">
				<?php echo apply_filters( 'the_content', get_post_meta($post->ID, '_c80tc_contenidosfooter', true) );?>
			</div>
			<div class="col-md-6 right">
				<h3>Un proyecto de</h3>
				<img class="logofootertc" src="<?php bloginfo('template_url');?>/dist/img/logoc80tc.svg" alt="<?php bloginfo('name');?>">

				<h3>Esta webstory cuenta con el apoyo de:</h3>
				<img class="logofondarttc" src="<?php bloginfo('template_url');?>/dist/img/footerfondarttc_b.png" alt="Ministerio de las Culturas las Artes y el Patrimonio">
			</div>
		</div>
		<div class="footer-end">
			<p>Si tienes alguna duda o sugerencia escríbenos a: <a href="mailto:comunicaciones@c80.cl">comunicaciones@c80.cl</a></p>
			<p>Última actualización | <?php the_modified_date();?></p>
		</div>
	</div>
</footer>

<?php wp_footer();?>
</body>
</html>