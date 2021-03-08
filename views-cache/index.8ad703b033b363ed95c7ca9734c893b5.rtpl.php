<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
	  <center><img  height="70" whidth="100"src="<?php echo $dir_url; ?>/../res/admin/dist/img/logo1.png"></center>
  <h1>
    Painel Administrativo 

  
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
  </ol>
</section>
<section class="content">
 <div class="row">
  	<div class="col-md-12">
  	 <div class="box box-success">
          <section class="content">
              <b><h4><p> Bem vindo <?php echo getUserName(); ?>, ao Painel Administrativo da loja Papelaria e Livraria J.A.</p></h4></b> <br>

              <div class="row">
                <div class="col-sm-2">
                  <div class="color"  style=" border-radius:20%;background-color: #5882FA;  max-width: 100%; height: 28rem;padding: 10px"><br>
                  <div class="card-header"><center><i  class="fa fa-users" style="font-size:  5rem; color:white;" ></i></center></div>
                    <div class="card-body">
                      <center><h2 style=" color:white;font-size:25px"> <b><?php if( totalUsers() == 0 ){ ?> Nenhum Usuário cadastrado<?php }elseif( totalUsers() == 1 ){ ?><?php echo totalUsers(); ?> Usuário cadastrado <?php }else{ ?><?php echo totalUsers(); ?> Usuários cadastrados<?php } ?></b></h2></center>
                      <hr>
                      <center><a  style=" color:white;font-size: 15px;" href="/admin/users">Ver detalhes</a></center>  
                    </div>
                  </div>
                </div>

                <div class="col-sm-2">
                  <div class="color"  style=" border-radius:20%;background-color: #FE2E2E;  max-width: 100%; height: 28rem;padding: 10px"><br>
                  <div class="card-header"><center><i  class="fa fa-list" style="font-size:  5rem; color:white;" ></i></center></div>
                    <div class="card-body">
                      <center><h2 style=" color:white;font-size:25px"> <b><?php if( totalCategories() == 0 ){ ?> Nenhuma Categoria cadastrada<?php }elseif( totalCategories() == 1 ){ ?><?php echo totalCategories(); ?> Categoria cadastrada <?php }else{ ?><?php echo totalCategories(); ?> Categorias cadastradas<?php } ?></b></h2></center>
                      <hr>
                      <center><a  style=" color:white;font-size: 15px" href="/admin/categories">Ver detalhes</a></center>  
                    </div>
                  </div>
                </div>

                <div class="col-sm-2">
                  <div class="color"  style=" border-radius:20%;background-color: #2EFE64;  max-width: 100%; height: 28rem;padding: 10px"><br>
                  <div class="card-header"><center><i  class="fa fa-shopping-cart" style="font-size:  5rem; color:white;" ></i></center></div>
                    <div class="card-body">
                      <center><h2 style=" color:white;font-size:25px"> <b><?php if( totalProducts() == 0 ){ ?> Nenhum Produto cadastrado<?php }elseif( totalProducts() == 1 ){ ?><?php echo totalProducts(); ?> Produto cadastrado <?php }else{ ?><?php echo totalProducts(); ?> Produtos cadastrados<?php } ?></b></h2></center>
                      <hr>
                      <center><a  style=" color:white;font-size: 15px" href="/admin/products">Ver detalhes</a></center>  
                    </div>
                  </div>
                </div>

                <div class="col-sm-2">
                  <div class="color"  style=" border-radius:20%;background-color: #FFBF00;  max-width: 100%; height: 28rem;padding: 10px"><br>
                  <div class="card-header"><center><i  class="fa fa-comments-o" style="font-size:  5rem; color:white;" ></i></center></div>
                    <div class="card-body">
                      <center><h2 style=" color:white;font-size:25px"> <b> <?php if( totalavAliactions() == 0 ){ ?> Nenhuma avaliação registrada<?php }elseif( totalAvaliactions() == 1 ){ ?><?php echo totalAvaliactions(); ?> avaliação registrada <?php }else{ ?><?php echo totalAvaliactions(); ?> Avaliações registradas<?php } ?></b></h2></center>
                      <hr>
                      <center><a  style=" color:white;font-size: 15px" href="/admin/reviews">Ver detalhes</a></center>  
                    </div>
                  </div>
                </div>

                <div class="col-sm-2">
                  <div class="color"  style=" border-radius:20%;background-color: #FF8000;  max-width: 100%; height: 28rem;padding: 10px"><br>
                  <div class="card-header"><center><i  class="fa fa-copyright" style="font-size:  5rem; color:white;" ></i></center></div>
                    <div class="card-body">
                      <center><h2 style=" color:white;font-size:25px"> <b> <?php if( totalbrands() == 0 ){ ?> Nenhuma marca cadastrada<?php }elseif( totalBrands() == 1 ){ ?><?php echo totalBrands(); ?> marca cadastrada   <?php }else{ ?><?php echo totalBrands(); ?> Marcas cadastradas<?php } ?></b></h2></center>
                      <hr>
                      <center><a  style=" color:white;font-size: 15px" href="/admin/brands">Ver detalhes</a></center>  
                    </div>
                  </div>
                </div>

                 <div class="col-sm-2">
                  <div class="color"  style=" border-radius:20%;background-color: #BF00FF;  max-width: 100%; height: 28rem;padding: 10px"><br>
                  <div class="card-header"><center><i  class="fa fa-truck" style="font-size:  5rem; color:white;" ></i></center></div>
                    <div class="card-body">
                      <center><h2 style=" color:white;font-size:25px"> <b> <?php if( totalOrders() == 0 ){ ?> Nenhuma pedido cadastrado<?php }elseif( totalOrders() == 1 ){ ?><?php echo totalOrders(); ?> Pedido cadastrado   <?php }else{ ?><?php echo totalOrders(); ?> Pedidos cadastrados<?php } ?></b></h2></center>
                      <hr>
                      <center><a  style=" color:white;font-size: 15px" href="/admin/orders">Ver detalhes</a></center>  
                    </div>
                  </div>
                </div>
                 

                </div>
                  
               



         
          </section>
          </div>
  	</div>
  </div>
<section class="content">

  <!-- Your Page Content Here -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->