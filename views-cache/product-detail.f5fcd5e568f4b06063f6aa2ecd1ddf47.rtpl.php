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
                    <li class="active"><a href="/products">Produtos</a></li>
                    <li><a href="/cart">Carrinho</a></li>
                    <li class="dropdown dropdown-small">
                        <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle"><span
                                class="key">Categorias</span><span> </span><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php if( totalBrands() != 0  ){ ?>

                            <?php require $this->checkTemplate("brands-menu");?>

                            <?php }else{ ?>

                            Nenhuma Cadastrada
                            <?php } ?>

                        </ul>
                    </li>
                    <li class="dropdown dropdown-small">
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


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="product-content-right">


                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <img style="height: 30em;width: 30em;" src="<?php echo $product["desphoto"]; ?>"><br>

                                    <div id="myWorkContent">

                                        <?php $counter1=-1;  if( isset($products) && ( is_array($products) || $products instanceof Traversable ) && sizeof($products) ) foreach( $products as $key1 => $value1 ){ $counter1++; ?>

                                        <a class="image-link" href="<?php echo $value1["desphoto"]; ?>"><img
                                                style="height: 6em;width: 6em;" class="photo"
                                                src="<?php echo $value1["desphoto"]; ?>"></a>
                                        <?php } ?>


                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name"><?php echo $product["desproduct"]; ?></h2>
                                <div class="product-inner-price">
                                    <h3><b style="color: #688A08;">R$ <?php echo formatPrice($product["vlprice"]); ?></b></h3>
                                </div>

                                <form action="/cart/<?php echo $product["idproduct"]; ?>/add" class="cart">

                                    <button value="Comprar" type="submit"><i class="fa fa-cart-plus"
                                            aria-hidden="true"></i>&nbsp;&nbsp;Adicionar no carrinho</button>
                                </form>
                                <?php if( $total["avaliactions"] == 0 ){ ?>

                                <b style="font-size: 16px"><?php echo average($product["idproduct"]); ?></b>
                                &nbsp;<b style="font-size: 15px"> Produto não avaliado</b>
                                <?php }else{ ?>

                                <b style="font-size: 16px"><?php echo average($product["idproduct"]); ?></b>
                                &nbsp;&nbsp;&nbsp;<b style="font-size: 16px">   <i class="fa fa-comments-o"></i>
                                    <?php echo $total["avaliactions"]; ?></b>
                                <?php } ?>

                                <div class="product-inner-category">
                                    <br>
                                    <b>
                                        <p>Marca:
                                    </b> <?php $counter1=-1;  if( isset($brands) && ( is_array($brands) || $brands instanceof Traversable ) && sizeof($brands) ) foreach( $brands as $key1 => $value1 ){ $counter1++; ?> <a href="/brand/<?php echo $value1["idbrand"]; ?>"><?php echo $value1["desbrand"]; ?></a><?php } ?>

                                    <b>
                                        <p>Categorias:
                                    </b> <?php $counter1=-1;  if( isset($categories) && ( is_array($categories) || $categories instanceof Traversable ) && sizeof($categories) ) foreach( $categories as $key1 => $value1 ){ $counter1++; ?> <a
                                        href="/categories/<?php echo $value1["idcategory"]; ?>"><?php echo $value1["descategory"]; ?></a><?php } ?>

                                </div>

                                <?php if( $avaliactionsSuccess == true ){ ?>

                                <div class="alert alert-success">
                                    <center><?php echo $avaliactionsSuccess; ?></center>
                                </div>
                                <?php } ?>


                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home"
                                                role="tab" data-toggle="tab">Descrição</a></li>
                                        <?php if( checkLogin(false) ){ ?>

                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab"
                                                data-toggle="tab">Avaliar Produto</a></li>
                                        <?php }else{ ?>

                                        <li role="presentation"><a href="#profile" data-toggle="modal"
                                                data-target="#registerAvaliaction">Avaliar Produto</a></li>
                                        <?php } ?>

                                    </ul>

                                    <!-- Modal -->
                                    <div class="modal fade" id="registerAvaliaction" tabindex="-1" role="dialog"
                                        aria-labelledby="registerAvaliaction" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h5 class="modal-title" id="exampleModalLabel"><b>
                                                            Avaliar Produto</b></h5>

                                                    <br>
                                                </div>

                                                <div class="modal-body">
                                                    <h4 style="font-size: 16px">Para avaliar o produto é necessário
                                                        realizar <b>login</b> ou <b>cadastro.</b> </h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <form role="form" action="/login">
                                                        <input type="submit" value="logar ou cadastrar">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End  Modal -->

                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2><b>Descrição do Produto</b>
                                                <h2>
                                                    <p style="font-size: 16px;text-align: justify;">
                                                        <?php echo $product["desdescription"]; ?></p>

                                        </div>
                                        <?php if( checkLogin(false) ){ ?>

                                        <div role="tabpanel" class="tab-pane fade" id="profile">
                                            <h2>Sua Avaliação</h2>
                                            <div class="submit-review">
                                                <form role="form" action="/products/<?php echo $product["desurl"]; ?>/" method="post">
                                                    <p> <input value="<?php echo $product["idproduct"]; ?>" name="idproduct"
                                                            type="hidden"></p>
                                                    <input value="<?php echo $product["desurl"]; ?>" name="desurl" type="hidden"></p>
                                                    <p> <input value="<?php echo $user["iduser"]; ?>" name="iduser" type="hidden"></p>
                                                    <p> <input value="<?php echo $product["desproduct"]; ?>" name="desproduct"
                                                            type="hidden"></p>
                                                    <p><input value='<?php echo getUserName(); ?>' name="desperson"
                                                            type="hidden" required=""></p>
                                                    <p><input value='<?php echo getEmail(); ?>' name="desemail"
                                                            type="hidden" required=""></p>

                                                    <label for="rate">Nota</label>
                                                    <div class="rating">
                                                        <input type="radio" name="rate" value="5" id="5"><label
                                                            for="5">☆</label>
                                                        <input type="radio" name="rate" value="4" id="4"><label
                                                            for="4">☆</label>
                                                        <input type="radio" name="rate" value="3" id="3"><label
                                                            for="3">☆</label>
                                                        <input type="radio" name="rate" value="2" id="2"><label
                                                            for="2">☆</label>
                                                        <input type="radio" name="rate" value="1" id="1" checked><label
                                                            for="1">☆</label>

                                                    </div><br>


                                                    <p><label for="review">Comentar</label> <textarea name="review"
                                                            id="" cols="30" rows="10" required></textarea></p>

                                                    <p><input type="submit" value="Enviar"></p>

                                                </form>

                                            </div>

                                        </div>
                                        <?php } ?>

                                    </div>
                                </div>
                                <hr>

                                <center><button type="submit" data-toggle="modal" data-target="#avaliactions">
                                        <i class="fa fa-comments-o"></i> &nbsp;Avaliações</button></center>

                                <!-- Modal -->
                                <div class="modal fade" id="avaliactions" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h5 class="modal-title" id="exampleModalLabel"><b>
                                                        <?php if( $total["avaliactions"] == 0 ){ ?>Produto não avaliado
                                                        <?php }elseif( $total["avaliactions"] == 0 ){ ?><?php echo $total["avaliactions"]; ?>

                                                        Avaliação
                                                        <?php }else{ ?><?php echo $total["avaliactions"]; ?> Avaliações<?php } ?></b></h5>

                                                <br>
                                            </div>


                                            <div class="modal-body">
                                                <?php $counter1=-1;  if( isset($avaliactions) && ( is_array($avaliactions) || $avaliactions instanceof Traversable ) && sizeof($avaliactions) ) foreach( $avaliactions as $key1 => $value1 ){ $counter1++; ?>


                                                <?php if( $value1["rate"] == 1.0 ){ ?>

                                                <i style="color:#FFD600;" class="fa fa-star"></i>
                                                <i style="color:#FFD600;" class="fa fa-star-o"></i>
                                                <i style="color:#FFD600;" class="fa fa-star-o"></i>
                                                <i style="color:#FFD600;" class="fa fa-star-o"></i>
                                                <i style="color:#FFD600;" class="fa fa-star-o"></i>
                                                <?php }elseif( $value1["rate"] == 2.0 ){ ?>

                                                <i style="color:#FFD600;" class="fa fa-star"></i>
                                                <i style="color:#FFD600;" class="fa fa-star"></i>
                                                <i style="color:#FFD600;" class="fa fa-star-o"></i>
                                                <i style="color:#FFD600;" class="fa fa-star-o"></i>
                                                <i style="color:#FFD600;" class="fa fa-star-o"></i>
                                                <?php }elseif( $value1["rate"] == 3.0 ){ ?>

                                                <i style="color:#FFD600;" class="fa fa-star"></i>
                                                <i style="color:#FFD600;" class="fa fa-star"></i>
                                                <i style="color:#FFD600;" class="fa fa-star"></i>
                                                <i style="color:#FFD600;" class="fa fa-star-o"></i>
                                                <i style="color:#FFD600;" class="fa fa-star-o"></i>
                                                <?php }elseif( $value1["rate"] == 4.0 ){ ?>

                                                <i style="color:#FFD600;" class="fa fa-star"></i>
                                                <i style="color:#FFD600;" class="fa fa-star"></i>
                                                <i style="color:#FFD600;" class="fa fa-star"></i>
                                                <i style="color:#FFD600;" class="fa fa-star"></i>
                                                <i style="color:#FFD600;" class="fa fa-star-o"></i>
                                                <?php }else{ ?>

                                                <i style="color:#FFD600;" class="fa fa-star"></i>
                                                <i style="color:#FFD600;" class="fa fa-star"></i>
                                                <i style="color:#FFD600;" class="fa fa-star"></i>
                                                <i style="color:#FFD600;" class="fa fa-star"></i>
                                                <i style="color:#FFD600;" class="fa fa-star"></i>
                                                <?php } ?>

                                                &nbsp;<?php echo $value1["rate"]; ?>&nbsp;&nbsp;<i style="margin-left: 25em"
                                                    class="fa fa-calendar"></i>&nbsp;<?php echo formatDate($value1["dtregister"]); ?>

                                                <br>
                                                <img style="height: 30px;width: 30px;"
                                                    src="/res/site/img/user_coment.png">
                                                <b><?php echo $value1["desperson"]; ?></b><br><br>
                                                <i class="fa fa-commenting-o"> &nbsp;</i><?php echo $value1["review"]; ?>

                                                <hr>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>