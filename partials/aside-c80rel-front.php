<aside class="c80-rels-front">
		<header>
			<h2><i class="fa fa-book"></i>  <?php echo c80t_countrels($post->ID);?> Artículos de la constitución relacionados</h2>
		</header>
	
			<div class="textos-c80-mini">
				<?php 
						$rels = rwmb_meta('c80_artrel', 'multiple=true', $post->ID);
						$relpar = rwmb_meta('c80_parraforel', 'multiple=true', $post->ID);



						//Necesito tener los capítulos.
						$relparents = array();
						
						//Los artículos también
						$artids = array();
						$plids = array();
						$finnrel = array();
						foreach($relpar as $relp) {
							$ids = explode('-', $relp);
							$artids[] = array(
								'parrafo' => $ids[0], 
								'articulo' => $ids[1]
								);
							$plids[] = $ids[1];
						}

						$parrarr = array();

						foreach($relpar as $key=>$parrafoitem) {
							$ids = explode('-', $parrafoitem);

							$parrarr[$ids[1]][] = $ids[0];
						}
						
						foreach($rels as $rel) {
							//Pueblo capítulos el KEY es el ID del capítulo y el valor es un array de IDS de artículos
							$relarray[c80t_top_parentid($rel)][] = $rel;
 						}

 						

 						foreach($relarray as $key=>$arts) {
 							foreach($arts as $art) {
 								//Busco el párrafo en el array de párrafos
 								$pararts = isset($parrarr[$art]) ? $parrarr[$art] : '';
 								if(is_array($pararts)) {
 									asort($pararts);
		 								foreach($pararts as $parart) {
		 									$vpar = $parart + 1;
                      				$parid = $parart . '-' . $art;
                      				$parlink = c80t_plink($parid);
 					


 									echo '<h4 class="title-rel-chap"><a href="' . $parlink . '"><span>' . get_the_title($key) . '</span><span class="captitle">' . c80t_captitle($key) . '</span></a></h4>';
                      				echo '<h5><a href="' . $parlink . '"><i class="fa fa-caret-right"></i> ' . get_the_title($art) . '</a></h5>';
		 							
		 							echo c80t_pquery($parid);
		 								}
 								} else {
 									echo '<h5 class="title-rel-chap"><a href="' . get_permalink($art) . '">' . get_the_title($art) . '</a></h5>';
 								}
 								
 							}
 						}

						
						
				?>
			</div>
</aside>
