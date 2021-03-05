<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li ><a href="/">Home</a></li>
                        <li class="active"><a href="/products">Produtos</a></li>
                        <li ><a href="/cart">Carrinho</a></li>
                        <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" ><span class="key">Categorias</span><span > </span><b class="caret"></b></a>
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
    </div> <!-- End mainmenu area -->
 <br>


<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2><b>Produtos</b></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <?php $counter1=-1;  if( isset($products) && ( is_array($products) || $products instanceof Traversable ) && sizeof($products) ) foreach( $products as $key1 => $value1 ){ $counter1++; ?>

            <div class="col-md-3 col-sm-6">
                <div class="single-shop-product">
                    <div class="product-upper">
                        <img src="<?php echo $value1["desphoto"]; ?>" class="products"alt="">
                    </div>
                    <h2><a href="/products/<?php echo $value1["desurl"]; ?>"><?php echo $value1["desproduct"]; ?></a></h2>
                    <div class="product-carousel-price">
                        <ins>R$ <?php echo formatPrice($value1["vlprice"]); ?></ins><br>
                        <ins style="font-size: 13px;"><?php echo average($value1["idproduct"]); ?></ins> 
                    </div>  
                    
                    <div class="product-option-shop">
                        <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="/cart/<?php echo $value1["idproduct"]; ?>/add">Comprar</a>
                    </div>                       
                </div>
            </div>
            <?php } ?>

        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="product-pagination text-center">
                    <nav>
                        <ul class="pagination">
                          

                        <li>
                            <a href="" aria-label="Previous">
                            <span aria-hidden="true">«</span>
                            </a>
                       
                        </li >
                        <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>

                          <?php if( $pageName == $value1["link"] ){ ?> 
                        <li class="active"><a href="<?php echo $value1["link"]; ?>"><?php echo $value1["page"]; ?></a></li>
                        <?php }else{ ?>

                        <li ><a href="<?php echo $value1["link"]; ?>"><?php echo $value1["page"]; ?></a></li>
                          <?php } ?>

                        <?php } ?>

                        <li>
                            
                            <a href="" aria-label="Next">
                            <span aria-hidden="true">»</span>
                            </a>

                        </li>
                        
                       
                        </ul>
                    </nav>                        
                </div>
            </div>
        </div>
    </div>
</div>