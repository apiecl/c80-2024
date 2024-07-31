<?php 
$fases = array('fase_1', 'fase_2', 'fase_3', 'fase_4', 'fase_5');
$timeline_options = get_option('c80_timeline_options');
$fase = get_query_var('fase');
$started = get_query_var('started');
$fasestart = parse_field_date_for_json(get_post_meta($timeline_options['hito_inicial_' . $fase], 'c80_lt_start_date', true));
$faseend = parse_field_date_for_json(get_post_meta($timeline_options['hito_final_' . $fase], 'c80_lt_start_date', true));
?>

<section class="presentacion-fase" style="background-image: url(<?php echo $timeline_options['imagen_' . $fase];?>);" data-fase="<?php echo $fase;?>" data-started="<?php echo get_query_var('started');?>">
	<div class="content-wrap">
		<div class="text-content">
			<h2><?php echo $timeline_options['titulo_' . $fase];?></h2>
			<h3><?php echo $fasestart['year'] . '-' . $faseend['year'];?></h3>
			<div class="fase-intro hidden-xs">
				<?php echo apply_filters( 'the_content', $timeline_options['intro_' . $fase] );?>
			</div>
			<?php get_template_part('partials/sharer-timeline');?>
			<div class="show-timeline-zone"><a class="toggle-timeline" data-fase="<?php echo $fase;?>"><i class="fa fa-chevron-right"></i></a></div>
		</div>
	</div>
</section>
<section class="contenedor-timeline">
	<div class="top-timeline-section">
		<div id="timeline-<?php echo $fase;?>" class="c80-timeline-insert">

		</div>
	</div>
</section>

<div class="visible-xs">
	<?php get_template_part('partials/timeline-nav');?>
</div>

<div class="container-fluid">
<div class="row navegador-fases hidden-xs">
	<?php 
	foreach($fases as $faseitem) {

		$faseitemdata[$faseitem] = array(
			'title' => $timeline_options['titulo_' . $faseitem],
			'start' => parse_field_date_for_json(get_post_meta($timeline_options['hito_inicial_' . $faseitem], 'c80_lt_start_date', true)),
			'end'	=> parse_field_date_for_json(get_post_meta($timeline_options['hito_final_' . $faseitem], 'c80_lt_start_date', true)),
		);

			$startyear = $faseitemdata[$faseitem]['start']['year'];
			$endyear = $faseitemdata[$faseitem]['end']['year'];
			$period = range($startyear, $endyear);

			if(count($period) > 6) {
				$middle = intdiv(count($period), 2);
				//var_dump($period[$middle]);
				$period = array_slice($period, $middle, 6);
				//var_dump($period);
			}
		?>

		<div class="<?php echo $faseitem;?> navegador-fase-item <?php echo ($fase == $faseitem)? 'active' : '';?>">
			<div class="yearscale">
			<a href="<?php echo add_query_arg( array('fase' => $faseitem ), get_permalink($post->ID) );?>">
				<div class="yearmarkers">
					<?php for($i = 0; $i < 14; $i++) {
						echo '<span></span>';
					}?>
				</div>
				<span class="startyear">
					<?php echo $startyear;?>
				</span>
				<div class="middleyears">
					<?php foreach($period as $year) {
						$decade = substr($year, 2);
						echo '<span class="middleyear">' . $decade . '</span>';
					}?>
				</div>
				<span class="endyear">
					<?php echo $endyear;?>
				</span>
			</div>
			<?php 
			//	for($i = $faseitemdata[$faseitem]['start']['year']; $i <= $faseitemdata[$faseitem]['end']['year']; $i++) {
			//		echo '<p>' . $i . '</p>';
			//	}
			?>

			
			<h3><?php echo $faseitemdata[$faseitem]['title'];?> | <?php echo $faseitemdata[$faseitem]['start']['year'];?> - <?php echo $faseitemdata[$faseitem]['end']['year'];?></h3>
			</a>
		</div>

		<?php

	}



	?>
</div>

</div>