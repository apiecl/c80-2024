<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php wp_head();?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
</head>
<body <?php body_class();?> >

    <header id="header-sitio">
        <!-- Navegación principal -->
        <div class="container">
            <div class="row first-header-section">
                <h1>
                    <?php if(!is_home()):?>
                    <a title="Volver a la página de inicio" href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url');?>/dist/img/logoc80tc.svg" alt="<?php bloginfo('name');?>" class="logo"></a>
                    <?php else:?>
                        <img src="<?php bloginfo('template_url');?>/dist/img/logoc80tc.svg" alt="<?php bloginfo('name');?>" class="logo">
                    <?php endif;?>
                </h1>


                <a href="#" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-movil" aria-expanded="false">
                    <span class="sr-only">Activar navegación</span>
                    <i class="fa fa-navicon"></i>
                </a>

                <div id="main-nav">
                    <div class="menu-secciones hidden-sm hidden-xs">
                        <ul>
                            <li class="link-visualizaciones">
                                <a  href="<?php echo get_bloginfo('url');?>/visualizaciones-y-recursos">Visualizaciones y recursos</a>
                            </li>
                            <li class="link-constitucion">
                                <a href="<?php echo get_post_type_archive_link('c80_cpt');?>">Constitución 1980</a>
                            </li>
                            <li class="link-noticias">
                                <a href="<?php echo get_bloginfo('url');?>/noticias">Noticias</a>
                            </li>
                            <li class="link-opinion">
                                <a href="<?php echo get_post_type_archive_link('columnas');?>">Opinión</a>
                            </li>
                            

                        </ul>
                    </div>

                    <ul class="nav navbar-nav hidden-sm hidden-xs">
                        <li class="socials">
                            <a title="Ir a Instagram" href="<?php echo C80_INSTAGRAM;?>" target="_blank"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li class="socials">
                            <a title="Ir a Twitter" href="<?php echo c80t_twitter();?>" target="_blank"><i class="fa fa-twitter"></i></a>
                        </li>
                         <li class="socials">
                            <a title="Ir a Facebook" href="<?php echo C80_FACEBOOK;?>" target="_blank"><i class="fa fa-facebook-square"></i></a>
                        </li>
                       
                        
                    </ul>
                </div>



            </div>
        </div>
       

      <!--Navegación móvil-->
      <nav id="nav-mobile">
        <div class="collapse navbar-collapse" id="menu-movil">
            <ul class="nav navbar-nav">
                <li class="link-noticias">
                    <a href="<?php echo get_bloginfo('url');?>/noticias">Noticias</a>
                </li>
                <li class="link-opinion">
                    <a href="<?php echo get_post_type_archive_link('columnas');?>">Opinión</a>
                </li>
                <li class="link-constitucion">
                    <a href="<?php echo get_post_type_archive_link('c80_cpt');?>">Constitución 1980</a>
                </li>
                <li class="link-visualizaciones">
                    <a  href="<?php echo get_bloginfo('url');?>/visualizaciones-y-recursos">Visualizaciones y recursos</a>
                </li>
                <li class="separator">
                    <span></span>
                </li>
                <li>
                    <a href="<?php echo get_permalink(68);?>">Somos</a>
                </li>
                <li>
                    <a href="<?php echo get_permalink(516);?>">¿Cómo colaborar?</a>
                </li>
                <li>
                    <a href="<?php echo get_permalink(70);?>">Contacto</a>
                </li>
                <li class="socials">
                    <a title="Ir a Instagram" href="<?php echo C80_INSTAGRAM;?>" target="_blank"><i class="fa fa-instagram"></i> En Instagram</a>
                </li>
                <li class="socials">
                    <a title="Ir a Facebook" href="<?php echo C80_FACEBOOK;?>" target="_blank"><i class="fa fa-facebook-square"></i> En Facebook</a>
                </li>
                <li class="socials">
                    <a title="Ir a Twitter" href="<?php echo c80t_twitter();?>" target="_blank"><i class="fa fa-twitter"></i> En Twitter</a>
                </li>    
            </ul>
        </div>
    </nav>
    <?php if(!is_front_page()):?>
        <?php echo c80t_breadcrumb();?>
    <?php endif;?>
</header>