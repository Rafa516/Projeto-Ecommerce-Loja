<?php if(!class_exists('Rain\Tpl')){exit;}?>  <div class="mainmenu-area">
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
                        <li class="active"><a href="/">Home</a></li>
                        <li><a href="/products">Produtos</a></li>
                        <li><a href="/cart">Carrinho</a></li>
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
                      <form action="/products" method="get" >
                        <div class="input-group" style="padding-top: 12px;">
                          <input  type="text" name="search"  class="form-control" placeholder="Pesquisar...">
                              <span  class="input-group-btn">
                                <button  style="height: 32px;"type="submit"  id="search-btn"  ><i class="fa fa-search"style="font-size:13px;" > PESQUISAR</i>
                                </button>
                              </span>
                        </div>
                      </form>
                </div> 

            </div>

        </div>

    </div> <!-- End mainmenu area -->

   
    <br>
  <div class="slider-area">
        	<!-- Slider -->      
			<div class="block-slider block-slider4"> 
            <h2 class="section-title"><b>Destaques da semana</b></h2> 
				<ul class="" id="bxslider-home4">
                    <?php $counter1=-1;  if( isset($carousel) && ( is_array($carousel) || $carousel instanceof Traversable ) && sizeof($carousel) ) foreach( $carousel as $key1 => $value1 ){ $counter1++; ?>
					<li>
                          
						<img style="margin-left: 5%;  height: 20%;width: 20%;" src="<?php echo $value1["desphoto"]; ?>" alt="Slide">

						<div class="caption-group">
							<h4 class="caption title">
								<b style="font-size: 22px;"><?php echo $value1["desproduct"]; ?></b>
							</h4>
							<h4 style="font-size: 2em;color: #688A08;"class="caption subtitle"><b>R$ <?php echo formatPrice($value1["vlprice"]); ?></b></h4>
                            <h5 style="font-size: 19px;"class="caption subtitle"><?php echo average($value1["idproduct"]); ?></h5>
							<a class="caption button-radius" href="/products/<?php echo $value1["desurl"]; ?>"><span class="icon"></span>Ver detalhes</a>
                           
						</div> 
					</li>
					<?php } ?>
				</ul>  
			</div>
			<!-- ./Slider -->        
    </div> <!-- End slider area -->  
    <div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo1">
                        <i class="fa fa-refresh"></i>
                        <p>1 ano de garantia</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo2">
                        <i class="fa fa-truck"></i>
                        <p>Frete mais barato</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo3">
                        <i class="fa fa-lock"></i>
                        <p>Pagamento seguro</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo4">
                        <i class="fa fa-gift"></i>
                        <p>Novos produtos</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End promo area -->
    
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <b><h3 class="section-title">Produtos</b></h3></b> 

                        <div class="product-carousel">
                            <?php $counter1=-1;  if( isset($products) && ( is_array($products) || $products instanceof Traversable ) && sizeof($products) ) foreach( $products as $key1 => $value1 ){ $counter1++; ?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img style="height: 18em;width: 20em;"src="<?php echo $value1["desphoto"]; ?>" class="products" >
                                    <div class="product-hover">
                                        <a href="/cart/<?php echo $value1["idproduct"]; ?>/add" class="add-to-cart-link"><i class="fa fa-cart-plus"></i>Comprar</a>
                                  
                                         <a href="/products/<?php echo $value1["desurl"]; ?>" class="view-details-link"><i class="fa fa-eye"></i>Ver detalhes</a> 
                                    </div>
                                </div> 

                                <h2><a style="text-decoration: none;" href="/products/<?php echo $value1["desurl"]; ?>"><?php echo $value1["desproduct"]; ?> </a></h2>

                                
                                    <div class="product-carousel-price">
                                        <ins style="color: #688A08;font-size: 20px;">R$ <?php echo formatPrice($value1["vlprice"]); ?></ins> 
                                    </div>

                                    <?php echo average($value1["idproduct"]); ?>
                                </div> 
                            <?php } ?> 

                        </div>
                      

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->
    
    <div class="brands-area">
        <div class="zigzag-bottom"></div>

        <div class="container">

            <div class="row">
                <b><h2 style="color: black;"class="section-title"><b>Marcas</b></h2></b>
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <div class="brand-list">
                             <?php $counter1=-1;  if( isset($brands) && ( is_array($brands) || $brands instanceof Traversable ) && sizeof($brands) ) foreach( $brands as $key1 => $value1 ){ $counter1++; ?>
                            <a style="color: black; text-decoration: none;" href="/brand/<?php echo $value1["idbrand"]; ?>"><?php echo averageRate($value1["idbrand"]); ?><br><br><img class="brands" style="height: 10em;width: 15em;"src="<?php echo $value1["desphoto"]; ?>" alt="">  </a>
                          
                            <?php } ?> 

                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->
    <br>