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
                    <li><a href="/">Home</a></li>
                    <li><a href="/products">Produtos</a></li>
                    <li><a href="/cart">Carrinho</a></li>
                    <li class="dropdown dropdown-small">
                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle"><span
                                class="key">Categorias</span><span> </span><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php if( totalCategories() != 0  ){ ?>

                            <?php require $this->checkTemplate("categories-menu");?>

                            <?php }else{ ?>

                            Nenhuma Cadastrada
                            <?php } ?>

                        </ul>
                    </li>
                    <li class="active" class="dropdown dropdown-small">
                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span
                                class="key">Marcas</span><span class="value"> </span><b class="caret"></b></a>
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


<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2><b><?php echo $brand["desbrand"]; ?></b><br><b
                            style="font-size: 20px;"><?php echo averageRate($brand["idbrand"]); ?></b></h2>

                </div>

            </div>
        </div>
    </div>
</div>
<br>
<?php if( $errorRate!= '' ){ ?>

                <div class="alert alert-danger">
                    <center><?php echo $errorRate; ?></center>
                </div>
<?php } ?>

<?php if( checkLogin(false) ){ ?>


 <?php if( $SuccessRate != '' ){ ?>

                <div class="alert alert-success">
                    <center><?php echo $SuccessRate; ?></center>
                </div>
                <?php } ?>

<center><button type="submit" data-toggle="modal" data-target="#avaliactions">
        <i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i
            class="fa fa-star-o"></i><i class="fa fa-star-o"></i> &nbsp;Dê sua nota </button></center>


<!-- Modal -->
<div class="modal fade" id="avaliactions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="exampleModalLabel"><b>
                    </b><?php echo $brand["desbrand"]; ?></h3>

                <br>
            </div>

            <div class="modal-body">

                <form role="form" action="/brand/<?php echo $brand["idbrand"]; ?>/<?php echo $user["iduser"]; ?>/add" method="post">

                    <p> <input value="<?php echo $brand["idbrand"]; ?>" name="idbrand" type="hidden"></p>
                    <p> <input value="<?php echo $user["iduser"]; ?>" name="iduser" type="hidden"></p>
                    <p> <input value="<?php echo $brand["desbrand"]; ?>" name="desbrand" type="hidden"></p>
                    <p><input value='<?php echo getUserName(); ?>' name="desperson" type="hidden" required=""></p>
                    <p><input value='<?php echo getEmail(); ?>' name="desemail" type="hidden" required=""></p>

                    <label for="rate">Nota</label>
                    <div class="rating">
                        <input type="radio" name="rate" value="5" id="5"><label for="5">☆</label>
                        <input type="radio" name="rate" value="4" id="4"><label for="4">☆</label>
                        <input type="radio" name="rate" value="3" id="3"><label for="3">☆</label>
                        <input type="radio" name="rate" value="2" id="2"><label for="2">☆</label>
                        <input type="radio" name="rate" value="1" id="1" checked><label for="1">☆</label>
                    </div>
                    <hr>
                    <p><input type="submit" value="Enviar"></p>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End  Modal -->
<?php } ?>


  
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <?php $counter1=-1;  if( isset($products) && ( is_array($products) || $products instanceof Traversable ) && sizeof($products) ) foreach( $products as $key1 => $value1 ){ $counter1++; ?>

            <div class="col-md-3 col-sm-6">
                <div class="single-shop-product">
                    <div class="product-upper">
                        <a href="/products/<?php echo $value1["desurl"]; ?>"> <img src="<?php echo $value1["desphoto"]; ?>" class="products"alt=""></a>
                    </div>
                    <h2><a style="color: #1C1C1C;text-decoration: none;" href="/products/<?php echo $value1["desurl"]; ?>"><?php echo $value1["desproduct"]; ?></a></h2>
                    <div class="product-carousel-price">
                        <ins style="color: #688A08;font-size: 20px;">R$ <?php echo formatPrice($value1["vlprice"]); ?></ins><br>

                        <ins style="font-size: 13px;"><?php echo average($value1["idproduct"]); ?></ins>
                    </div>

                    <div class="product-option-shop">
                        <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70"
                            rel="nofollow" href="/cart/<?php echo $value1["idproduct"]; ?>/add">Comprar</a>
                    </div>
                </div>
            </div>
             <?php }else{ ?>

                 <div class="alert alert-info">
                 <b>Nenhum produto nessa marca</b>
                 </div>
            <?php } ?>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="product-pagination text-center">
                   <div class="pagination">
                         <?php if( $numPage > 1 ){ ?> 
                       
                            <a href="/brand/<?php echo $brand["idbrand"]; ?>?page=<?php echo $back; ?>" aria-label="Previous">&laquo;</a>                       
                        <?php } ?>


                         <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>

                          <?php if( $pageName == $value1["link"] ){ ?> 
                        <a class="active"href="<?php echo $value1["link"]; ?>"><?php echo $value1["page"]; ?></a>
                        <?php }else{ ?>

                        <a href="<?php echo $value1["link"]; ?>"><?php echo $value1["page"]; ?></a>
                          <?php } ?>

                        <?php } ?>

                     
                      
                         <?php if( $numPage < $totalPage ){ ?> 
                       
                             <a href="/brand/<?php echo $brand["idbrand"]; ?>?page=<?php echo $next; ?>" aria-label="Previous">&raquo;</a>                      
                        <?php } ?>

                    </div>        
                </div>
            </div>
        </div>
    </div>
</div>