<?php
global $post;
$checkmod = c80_Public::c80_checkmod($post->ID);
$checknew = c80_Public::c80_checknew($post->ID);
$chaptername = c80t_parentname($post->ID, $en_capitulo);
$topname = c80t_top_parentid($post->ID, $en_capitulo);
$subt = get_post_meta($post->ID, 'c80_subtartcap', true);
$hascontent = c80_Public::c80_hascontent($post->ID)
?>

<article id="cpt-id-<?php echo $post->ID; ?>" class="articulo-constitucion <?php echo ($hascontent ? '' : 'breaksection'); ?> <?php if ($checkmod) : echo 'modarticle mod-' . $checkmod[0];
                                                                                                                                endif; ?> <?php if ($checknew) : echo 'newarticle';
                                                                                                                                            endif; ?>">

    <div class="row">

        <div class="col-md-12">
            <header class="<?php echo ($hascontent ? 'hascontent' : 'nocontent'); ?>">

                <?php if ($en_capitulo && $hascontent) { ?>

                    <h1 class="article-title">
                        <a href="<?php echo get_permalink($post->ID); ?>">
                            <span class="articlenumber">
                                <i class="fa fa-file-text-o"></i> <?php the_title(); ?><?= $subt ? ':<br/>' . $subt : ''; ?>
                            </span>
                        </a>
                    </h1>


                <?php } elseif ($en_capitulo && !$hascontent) { ?>

                    <h1 class="article-title c80-section-title">
                        <span class="articlenumber">
                            <?php the_title(); ?>
                        </span>
                    </h1>


                <?php } elseif (!$en_capitulo) { ?>

                    <h1 class="article-title">
                        <span class="chaptername">
                            <?php if ($topname !== $post->post_parent && !$en_capitulo) : ?>
                                <i class="fa fa-caret-right"></i> <?php echo get_the_title($topname); ?>: <span class="capsubt-extra"> <?php echo c80t_captitle($topname); ?> <i class="fa fa-angle-right"></i></span>
                                <?php echo $chaptername; ?>
                            <?php else : ?>
                                <i class="fa fa-caret-right"></i> <?php echo $chaptername; ?>
                            <?php endif; ?>

                        </span>
                        <span class="articlenumber">
                            <?php the_title(); ?><?= $subt ? ':<br/>' . $subt : ''; ?>
                        </span>
                    </h1>

                <?php
                }


                ?>

                <!-- <h1 class="article-title">
                            <?php if ($en_capitulo && $hascontent) : ?>
                                <a href="<?php echo get_permalink($post->ID); ?>"><i class="fa fa-file-text-o"></i> 
                                    <?php if ($chaptername) : ?>
                                        <span class="chaptername"><?php echo $chaptername; ?></span>
                                    <?php endif; ?>
                                    <span class="articlenumber"><?php the_title(); ?></span>
                                </a>
                            <?php else : ?>
                                <?php if ($chaptername) : ?>
                                    <span class="chaptername">
                                        <?php if ($topname !== $post->post_parent && !$en_capitulo) : ?>
                                        <?php echo get_the_title($topname); ?>
                                        <?php endif; ?>
                                    <i class="fa fa-caret-right"></i> <?php echo $chaptername; ?></span> 
                                <?php endif; ?>

                                <?php echo ($hascontent ? '<i class="fa fa-file-text-o"></i> ' : '<i class="fa fa-caret-right"></i> '); ?>
                                
                                <span class="articlenumber"><?php the_title(); ?></span>
                                
                                
                            <?php endif; ?>
                        </h1> -->

                <?php if ($checknew) :
                    if ($checknew && $checkmod) {
                        echo '<span class="modinfo newarticle" style="right: 222px;"><i class="fa fa-info-circle"></i> Añadido el ' . get_the_time('d/m/Y', $post->ID) . '</span>';
                    } else {
                        echo '<span class="modinfo newarticle"><i class="fa fa-info-circle"></i> Añadido el ' . get_the_time('d/m/Y', $post->ID) . '</span>';
                    }
                endif; ?>

                <?php if ($checkmod) :
                    foreach ($checkmod as $item) {
                        echo '<span class="modinfo modarticle"><i class="fa fa-info-circle"></i> Modificado el ' . get_the_time('d/m/Y', $item) . '</span>';
                    }

                endif; ?>

                <?php if (get_post_meta($post->ID, 'c80_artderogated', true)) :
                    echo '<span class="modinfo derarticle"><i class="fa fa-info-circle"></i> Derogado el ' . get_the_time('d/m/Y', $checkmod[0]) . '</span>';
                endif; ?>



                <?php if ($hascontent) : get_template_part('partials/modal-c80embed');
                endif; ?>

            </header>

        </div>

    </div>

    <?php if ($hascontent) { ?>
        <div class="row">
            <div class="col-md-9">

                <div class="main-content article-info-holder" data-chaptername="<?php echo c80t_parentname($post->ID, false); ?>" data-articlenumber="<?php the_title(); ?>">
                    <?php the_content(); ?>
                </div>

            </div>
            <div class="col-md-3">
                <?php include(TEMPLATEPATH . '/sidebar-modificaciones.php'); ?>
                <?php include(TEMPLATEPATH . '/sidebar-relacionados.php'); ?>
            </div>
        </div>
    <?php } ?>

</article>