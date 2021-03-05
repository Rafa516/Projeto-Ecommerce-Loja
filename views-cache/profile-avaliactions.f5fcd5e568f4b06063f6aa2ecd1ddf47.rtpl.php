<?php if(!class_exists('Rain\Tpl')){exit;}?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2><b>Minha Conta<b></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">                
            <div class="col-md-3">
                <?php require $this->checkTemplate("profile-menu");?>

            </div>
            <div class="col-md-9">
                <?php if( $profileMsg != '' ){ ?>

                <div class="alert alert-success">
                    <?php echo $profileMsg; ?>

                </div>
                <?php } ?>

                <?php if( $profileError != '' ){ ?>

                <div class="alert alert-danger">
                    <?php echo $profileError; ?>

                </div>
                <?php } ?> 
                  <b><h4  style="color: black;font-size: 2.5em;"class="section-title">Minhas Avaliações</h4></b>               
                <table cellspacing="0" class="shop_table cart table-hover">
                                <thead >
                                    <tr>
                                      
                                        <th >Produto</th>
                                        <th >Sua Nota</th>
                                        <th >Avaliação</th>
                                        <th >Remover </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter1=-1;  if( isset($avaliaction) && ( is_array($avaliaction) || $avaliaction instanceof Traversable ) && sizeof($avaliaction) ) foreach( $avaliaction as $key1 => $value1 ){ $counter1++; ?>

                                    
                                    <tr>
                                        <td class="product-name">
                                            
                                            <span ><a   href="/products/<?php echo $value1["desurl"]; ?>"><?php echo $value1["desproduct"]; ?></a></span><br>
                                             <span style="font-size: 15px"><?php echo average($value1["idproduct"]); ?></span>
                                        </td>

                                        <td >
                                            <span><?php echo $value1["rate"]; ?> <br>
                                            <?php if( $value1["rate"] == 1.0 ){ ?>

                                                         <i style="color:#FFD600;"class="fa fa-star"></i>
                                                         <i style="color:#FFD600;"class="fa fa-star-o"></i>
                                                         <i style="color:#FFD600;"class="fa fa-star-o"></i>
                                                         <i style="color:#FFD600;"class="fa fa-star-o"></i>
                                                         <i style="color:#FFD600;"class="fa fa-star-o"></i> 
                                                         <?php }elseif( $value1["rate"] == 2.0 ){ ?>

                                                          <i  style="color:#FFD600;"class="fa fa-star"></i>
                                                         <i style="color:#FFD600;"class="fa fa-star"></i>
                                                         <i style="color:#FFD600;"class="fa fa-star-o"></i>
                                                         <i style="color:#FFD600;"class="fa fa-star-o"></i>
                                                         <i style="color:#FFD600;"class="fa fa-star-o"></i> 
                                                         <?php }elseif( $value1["rate"] == 3.0 ){ ?>

                                                          <i  style="color:#FFD600;"class="fa fa-star"></i>
                                                         <i style="color:#FFD600;"class="fa fa-star"></i>
                                                         <i  style="color:#FFD600;"class="fa fa-star"></i>
                                                         <i  style="color:#FFD600;"class="fa fa-star-o"></i>
                                                         <i  style="color:#FFD600;"class="fa fa-star-o"></i>
                                                         <?php }elseif( $value1["rate"] == 4.0 ){ ?>

                                                          <i  style="color:#FFD600;"class="fa fa-star"></i>
                                                         <i  style="color:#FFD600;"class="fa fa-star"></i>
                                                         <i  style="color:#FFD600;"class="fa fa-star"></i>
                                                         <i  style="color:#FFD600;"class="fa fa-star"></i>
                                                         <i  style="color:#FFD600;"class="fa fa-star-o"></i> 
                                                         <?php }else{ ?>

                                                          <i  style="color:#FFD600;"class="fa fa-star"></i>
                                                         <i  style="color:#FFD600;"class="fa fa-star"></i>
                                                         <i  style="color:#FFD600;"class="fa fa-star"></i>
                                                         <i  style="color:#FFD600;"class="fa fa-star"></i>
                                                         <i  style="color:#FFD600;"class="fa fa-star"></i>
                                                         <?php } ?>

                                                     </span>
                                        </td>

                                         <td >
                                            <span class="amount"><?php echo $value1["review"]; ?></span> 
                                        </td>

                                         <td >
                                            <form method="get"  >
                                            <a style="color: red;"  title="Remover Produto" class="remove" href="/profile-avaliactions/<?php echo $value1["iduser"]; ?>/<?php echo $value1["idavaliaction"]; ?>/delete"  ><i  class="fa fa-trash-o" aria-hidden="true"></i></a> 
                                            </form>
                                        </td>                                      
                                    </tr>
                                    <?php } ?>

                                    
                                </tbody>
                            </table>
            </div>
        </div>
    </div>
</div>