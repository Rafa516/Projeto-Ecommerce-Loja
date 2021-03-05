<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<!--
    Hcode Store by hcode.com.br
-->
<html lang="pt-br">
  <head>
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Papelaria e LIvraria J.A</title>
    
    <!-- Google Fonts -->
    <link href="/res/site/img/icon-logo.png" rel="icon">
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/res/site/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/res/site/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/res/site/css/owl.carousel.css">
    <link rel="stylesheet" href="/res/site/css/style.css">
    <link rel="stylesheet" href="/res/site/css/responsive.css">

    <link rel="stylesheet" href="res/site/sweetalert2/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="/res/site/css/magnific-popup.css">
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <li ><a href="/"><i style="color: #1C1C1C" class="fa fa-home"></i> Home</a></li>
                             <?php if( getCartNrQtd() == 0  ){ ?>
                            <li><a href="/cart"><i style="color: #1C1C1C"  class="fa fa-shopping-cart"></i> Meu Carrinho</a></li>
                            <?php }else{ ?>
                             <li><a href="/cart"><i style="color: #FF0000"  class="fa fa-shopping-cart"></i> Meu Carrinho</a></li>
                             <?php } ?>

                            <?php if( checkLogin(false) ){ ?>
                             <li><a href="/profile"><i style="color: #1C1C1C" class="fa fa-user"></i> Minha Conta</a></li>
                             <li><i style="color: #00FF40" class="fa fa-circle"></i> <?php echo getUserName(); ?></li>
                             <li><a href="/logout"><i style="color: #FE2E2E" class="fa fa-close"></i>Sair</a></li>
                            <?php }else{ ?>
                            <li><a href="/login"><i style="color: #D7DF01" class="fa fa-lock"></i> Login</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="header-right">
                        <ul class="list-unstyled list-inline">
                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">Categorias</span><span > </span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <?php if( totalCategories() != 0  ){ ?>
                                    <?php require $this->checkTemplate("categories-menu");?>
                                    <?php }else{ ?>
                                    Nenhuma Cadastrada
                                    <?php } ?>
                                    
                                </ul>
                            </li>

                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">Marcas</span><span class="value"> </span><b class="caret"></b></a>
                                <ul class="dropdown-menu">                                 
                                    <?php if( totalBrands() != 0  ){ ?>
                                    <?php require $this->checkTemplate("brands-menu");?>
                                    <?php }else{ ?>
                                    Nenhuma Cadastrada
                                    <?php } ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End header area -->


    
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="#"><img src="/res/site/img/logo1.png"></a></h1>
                    </div>
                </div>

               
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="/cart">Carrinho  <span class="cart-amunt">R$ <?php echo getCartVlSubTotal(); ?></span> <i class="fa fa-shopping-cart"></i> 
                       
                            <?php if( getCartNrQtd() == 0  ){ ?>
                            <span style=" background: none repeat scroll 0 0 #688A08;
                                            border-radius: 50%;
                                            color: #fff;
                                            display: inline-block;
                                            font-size: 12px;
                                            height: 20px;
                                            padding-top: 2px;
                                            position: absolute;
                                            right: -10px;
                                            text-align: center;
                                            top: -10px;
                                            width: 20px;" 
                                            ><?php echo getCartNrQtd(); ?></span></a>
                            <?php }else{ ?>
                             <span style=" background: none repeat scroll 0 0 #FF0000;
                                            border-radius: 50%;
                                            color: #fff;
                                            display: inline-block
                                            font-weight: bold;
                                            font-size: 12px;
                                            height: 20px;
                                            padding-top: 2px;
                                            position: absolute;
                                            right: -10px;
                                            text-align: center;
                                            top: -10px;
                                            width: 20px;" 
                                            ><?php echo getCartNrQtd(); ?></span></a>
                            <?php } ?>
                    </div>
                </div>
          
            </div>
        </div>
    </div> <!-- End site branding area -->
    
   
		