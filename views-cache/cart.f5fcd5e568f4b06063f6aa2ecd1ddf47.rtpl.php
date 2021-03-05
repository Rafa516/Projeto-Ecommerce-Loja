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
                        <li><a href="/products">Produtos</a></li>
                        <li class="active"><a href="/cart">Carrinho</a></li>
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
                    <h2><b>Carrinho de Compras</b></h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                <div class="product-content-right">
                    <div class="woocommerce">

                        <form action="/checkout">
                            
                            <?php if( $error != '' ){ ?>

                            <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>

                            </div>
                            <?php } ?>


                             <?php if( $zipCodeSuccess == true && $cart["vlsubtotal"] != 0 ){ ?>

                                <div class="alert alert-success">
                                <center><?php echo $zipCodeSuccess; ?></center>
                                </div>
                            <?php } ?>


                            <table cellspacing="0" class="shop_table cart table-hover">
                                <thead >
                                    <tr>
                                        <th class="product-remove">Remover </th>
                                        <th class="product-thumbnail">foto</th>
                                        <th class="product-name">Produto</th>
                                        <th class="product-price">Preço</th>
                                        <th class="product-quantity">Quantidade</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter1=-1;  if( isset($products) && ( is_array($products) || $products instanceof Traversable ) && sizeof($products) ) foreach( $products as $key1 => $value1 ){ $counter1++; ?>

                                    
                                    <tr class="cart_item">
                                        <td class="product-remove">
                                            <form method="get"  >
                                            <a style="color: red;"  title="Remover Produto" class="remove" href="/cart/<?php echo $value1["idproduct"]; ?>/remove"  ><i  class="fa fa-trash-o" aria-hidden="true"></i></a> 
                                            </form>
                                        </td>

                                        <td class="product-thumbnail">
                                            <a href="/products/<?php echo $value1["desurl"]; ?>"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="<?php echo $value1["desphoto"]; ?>"></a>
                                        </td>

                                        <td class="product-name">
                                            <a href="/products/<?php echo $value1["desurl"]; ?>"><?php echo $value1["desproduct"]; ?></a><br>
                                            <span style="font-size: 15px"><?php echo average($value1["idproduct"]); ?></span>
                                        </td>

                                        <td class="product-price">
                                            <span class="amount">R$ <?php echo formatPrice($value1["vlprice"]); ?></span> 
                                        </td>

                                        <td class="product-quantity">
                                            <div class="quantity buttons_added">
                                                <input type="button" class="minus" value="-" onclick="window.location.href='/cart/<?php echo $value1["idproduct"]; ?>/minus'">
                                                <input style="text-align: center;height: 30px;"type="text" size="2" class="input-text qty text" title="Qty" value="<?php echo $value1["nrqtd"]; ?>">
                                                <input  type="button" class="plus" value="+" onclick="window.location.href='/cart/<?php echo $value1["idproduct"]; ?>/add'">
                                            </div>
                                        </td>

                                        <td class="product-subtotal">
                                            <span class="amount"><?php echo formatPrice($value1["vltotal"]); ?></span> 
                                        </td>
                                    </tr>
                                    <?php } ?>

                                    
                                </tbody>
                            </table>

                            <div class="cart-collaterals">

                                <div class="cross-sells">

                                    <h2 style="color: #2E2E2E;">Taxa do Frete</h2>
                                    
                                    <div class="coupon">
                                        
                                        <?php if( $cart["vlsubtotal"] == 0 ){ ?>

                                      
                                        <?php }else{ ?>

                                        <select style="height: 35px;width: 200px;" name="vlfreight" id="vlfreight">
                                            <option value="5">Distrito Federal</option>
                                              <option value="8">Goías</option>
                                          

                                        </select>
                                       
                                        <?php } ?>

                                        <!-- sem botão -->
                                        <?php if( $cart["vlsubtotal"] == 0 ){ ?>


                                        <?php }else{ ?>

                                        <input  type="submit" formmethod="post" formaction="/cart/freight" value="CALCULAR" class="button">
                                        <?php } ?>

                                    </div>

                                </div>

                                <div class="cart_totals ">

                                    <h2 style="color: #2E2E2E;">Resumo da Compra</h2>

                                    <table cellspacing="0">
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <th>Subtotal</th>
                                                <?php if( $cart["vlsubtotal"] == 0 ){ ?>

                                                 <td><span class="amount">R$ 0,00</span></td>
                                                 <?php }else{ ?>

                                                <td><span class="amount">R$ <?php echo formatPrice($cart["vlsubtotal"]); ?></span></td>
                                                <?php } ?>

                                            </tr>

                                            <tr class="shipping">
                                                <th>Frete</th>
                                                <?php if( $cart["vlsubtotal"] == 0 ){ ?>

                                                <td>R$ 0,00 <small>prazo de 0 dia(s)</small></td>
                                                <?php }elseif( $cart["vlfreight"] == 0 ){ ?>

                                                <td>R$ 0,00 <small>prazo de 0 dia(s)</small></td>
                                                <?php }else{ ?>

                                                <td>R$ <?php echo formatPrice($cart["vlfreight"]); ?> <?php if( $cart["nrdays"] > 0 ){ ?><small>prazo de <?php echo $cart["nrdays"]; ?> dia(s)</small><?php } ?></td>
                                                <?php } ?>

                                            </tr>

                                            <tr class="order-total">
                                                <th>Total</th>
                                                 <?php if( $cart["vlsubtotal"] == 0 ){ ?>

                                                 <td><strong><span class="amount">R$ 0,00</span></strong> </td>
                                                 <?php }else{ ?>

                                                <td><strong><span class="amount">R$ <?php echo formatPrice($cart["vltotal"]); ?></span></strong> </td>
                                                <?php } ?>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="pull-right">
                                 <?php if( $cart["vlsubtotal"] == 0   ){ ?>

                                 <!-- sem botão -->
                              

                                 <!-- sem botão -->
                                 <?php }else{ ?>

                                  <input type="submit" value="Finalizar Compra" name="proceed" class="checkout-button button alt wc-forward">
                                  <?php } ?>




                            </div>

                        </form>

                    </div>                        
                </div>                    
            </div>
        </div>
    </div>
</div>