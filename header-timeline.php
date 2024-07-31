<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">
<head>
	<?php wp_head();?>
</head>
<body <?php body_class();?> data-spy="scroll" data-target="#timeline-nav" data-offset="0">

<header id="header-sitio" class="hidden">
    <!-- Navegación principal -->
    <div class="container">
        <div class="row first-header-section">
            <h1>
                <a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url');?>/dist/img/logoc80_2017_sm.svg" alt="<?php bloginfo('name');?>" class="logo"></a>
            </h1>
            <h2 class="description"><?php bloginfo('description');?></h2>
            
            <a href="#" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-movil" aria-expanded="false">
                <span class="sr-only">Activar navegación</span>
                <i class="fa fa-navicon"></i>
            </a>

            <div id="main-nav">
                <ul class="nav navbar-nav hidden-sm hidden-xs">
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
                        <a href="<?php echo c80t_twitter();?>" target="_blank"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li class="socials">
                        <a href="<?php echo C80_FACEBOOK;?>" target="_blank"><i class="fa fa-facebook-square"></i></a>
                    </li>
                    <li class="socials">
                        <a href="<?php echo C80_INSTAGRAM;?>" target="_blank"><i class="fa fa-instagram"></i></a>
                    </li>
                </ul>
            </div>

            

        </div>
    </div>
     <nav class="navegacion-principal hidden-sm hidden-xs">
      <div class="container">

        <div class="menu-secciones">
            <ul>
                <li class="link-constitucion">
                    <a href="<?php echo get_post_type_archive_link('c80_cpt');?>"><i class="fa fa-book"></i> Constitución 1980</a>
                </li>
                <li class="link-opinion">
                    <a href="<?php echo get_post_type_archive_link('columnas');?>">Opinión</a>
                </li>
                <li class="link-noticias">
                    <a href="<?php echo get_bloginfo('url');?>/noticias">Noticias</a>
                </li>

            </ul>
        </div>
        
      </div>
        
    </nav>

    <!--Navegación móvil-->
    <nav id="nav-mobile">
        <div class="collapse navbar-collapse" id="menu-movil">
            <ul class="nav navbar-nav">
                <li class="link-noticias">
                    <a href="<?php echo get_bloginfo('url');?>/noticias"> <i class="fa fa-newspaper-o fa-fw"></i> Noticias</a>
                </li>
                <li class="link-opinion">
                    <a href="<?php echo get_post_type_archive_link('columnas');?>"><i class="fa fa-commenting-o fa-fw"></i> Opinión</a>
                </li>
                 <li class="link-constitucion">
                    <a href="<?php echo get_post_type_archive_link('c80_cpt');?>"><i class="fa fa-book fa-fw"></i> Constitución 1980</a>
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
                        <a href="<?php echo c80t_twitter();?>" target="_blank"><i class="fa fa-twitter"></i> En Twitter</a>
                    </li>
                    <li class="socials">
                        <a href="<?php echo C80_FACEBOOK;?>" target="_blank"><i class="fa fa-facebook-square"></i> En Facebook</a>
                    </li>
                    <li class="socials">
                        <a href="<?php echo C80_INSTAGRAM;?>" target="_blank"><i class="fa fa-instagram"></i> En Instagram</a>
                    </li>
            </ul>
        </div>
    </nav>
    <?php if(!is_front_page()):?>
        <?php echo c80t_breadcrumb();?>
    <?php else:?>
        <?php echo c80t_temas();?>
    <?php endif;?>
</header>