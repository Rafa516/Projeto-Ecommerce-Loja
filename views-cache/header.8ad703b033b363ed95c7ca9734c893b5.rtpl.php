<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="pt-br">
<head>
   <meta http-equiv="Cache-Control" content="no-cache" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Papelaria e Livraria J.A</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link href="<?php echo $dir_url; ?>/../res/site/img/icon-logo.png" rel="icon">
  <link rel="stylesheet" href="<?php echo $dir_url; ?>/../res/admin/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $dir_url; ?>/../res/admin/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="<?php echo $dir_url; ?>/../res/admin/dist/css/skins/_all-skins.css">
  <link rel="stylesheet" href="<?php echo $dir_url; ?>/../res/admin/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo $dir_url; ?>/../res/admin/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo $dir_url; ?>/../res/admin/bootstrap/css/styles.css">
  <link rel="stylesheet" href="../res/admin/sweetalert2/dist/sweetalert2.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="<?php echo $dir_url; ?>/../res/admin/dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>ADM</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>ADM </b>J.A</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         
            <ul class="dropdown-menu">
            
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">

                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <!-- User Image -->
                        <img src="<?php echo $dir_url; ?>/../res/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <!-- Message title and timestamp -->
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <!-- The message -->
                     
                  </li>
                  <!-- end message -->
                </ul>
                <!-- /.menu -->
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
         
          <!-- Tasks Menu -->
         
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <?php if( $user["picture"] == 0 ){ ?>
                <img src="/../res/admin/dist/img/no_photo.png" class="user-image" alt="User Image">
                <?php }else{ ?>
                <img src="/../res/admin/dist/ft_perfil/<?php echo $user["picture"]; ?>" class="user-image" alt="User Image">
              <?php } ?>
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo getUserName(); ?></span>  &nbsp;&nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
              <?php if( $user["picture"] == 0 ){ ?>
                <img src="/../res/admin/dist/img/no_photo.png" class="img-circle" alt="User Image">
                <?php }else{ ?>
                <img src="/../res/admin/dist/ft_perfil/<?php echo $user["picture"]; ?>" class="img-circle" alt="User Image">
              <?php } ?>

                <p>
                  <?php echo getUserName(); ?> - <?php echo $user["deslogin"]; ?> 
                  
                </p>
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/admin/perfil" class="btn btn-primary btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="/admin/logout" class="btn btn-danger btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <br>
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php if( $user["picture"] == 0 ){ ?>
              <img src="/../res/admin/dist/img/no_photo.png" class="img-circle" alt="User Image">
              <?php }else{ ?>
              <img src="/../res/admin/dist/ft_perfil/<?php echo $user["picture"]; ?>" class="img-circle" alt="User Image">
           <?php } ?>
        </div>
        <div class="pull-left info">
          <p><?php echo getUserName(); ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <br>

      <!-- search form (Optional) -->
    
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
       
       <li><a href="/admin"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li><a href="/" target="blank"><i class="fa fa-shopping-basket"></i> <span>Loja</span></a></li>
        <li><a href="/admin/users"><i class="fa fa-users"></i> <span>Usu??rios</span></a></li>
        <li><a href="/admin/categories"><i class="fa fa-list"></i> <span>Categorias</span></a></li>
        <li><a href="/admin/products"><i class="fa fa-shopping-cart"></i> <span>Produtos</span></a></li>
        <li><a href="/admin/brands"><i class="fa fa-copyright"></i> <span>Marcas</span></a></li>
        <li><a href="/admin/orders"><i class="fa fa-truck"></i> <span>Pedidos</span></a></li>
        <li><a href="/admin/reviews"><i class="fa fa-comments-o"></i> <span>Avalia????es</span></a></li>

        <li class="treeview">
          <a href="#"><i class="fa fa-cogs"></i> <span>Configura????es</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/carousel/1">Destaques da Semana</a></li>
            <li><a href="/admin/perfil">Seu Perfil</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>