<!DOCTYPE html>
<html>
<head>
	<?php wp_head();?>
</head>
<body <?php body_class();?> >

<header id="header-sitio" class="header-mini">
    <!-- Navegación principal -->
    <div class="container">
        <div class="row first-header-section">
            <h1>
                <a href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_url');?>/dist/img/logoc80_2017_sm.svg" alt="<?php bloginfo('name');?>" class="logo"></a>
            </h1>
            <h2 class="description"><?php bloginfo('description');?></h2>
            
            
             <div id="main-nav">
                <ul class="nav navbar-nav hidden-sm hidden-xs">
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
</header>