<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <center><img  height="70" whidth="100"src="<?php echo $dir_url; ?>/../res/admin/dist/img/logo1.png"></center>
  <h1>
    Perfil do Usuário<br>
   
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i>Home</a></li>
    <li class="active">Perfil</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <br>

          <?php if( $user["picture"] == 0 ){ ?>

             <img src="/../res/admin/dist/img/no_photo.png" class="img-circle" alt="User Image">
             <?php }else{ ?>

             <img src="/../res/admin/dist/ft_perfil/<?php echo $user["picture"]; ?>" style="height: 15em;width: 15em;"  class="img-circle" alt="User Image">
          <?php } ?>

          <br><br> 

          <form role="form" action="/admin/perfil/<?php echo $user["iduser"]; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="file" class="form-control-file" id="picture" name="picture" required >
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-success">Alterar foto</button>
              </div>
          </form>
            <br>

            <div class="card" style="width: 50rem">
              <div class="card-body">
                      <i class="fa fa-user"></i> <h3 class="box-title"><b>Nome:</b> <?php echo $user["desperson"]; ?></h3><br><br>
                      <i class="fa fa-sign-in"></i> <h3 class="box-title"><b>Login:</b> <?php echo $user["deslogin"]; ?></h3><br><br>
                      <i class="fa fa-envelope"></i> <h3 class="box-title"><b>E-mail:</b> <?php echo $user["desemail"]; ?></h3><br><br>
                      <i class="fa fa-phone"></i> <h3 class="box-title"><b>Telefone:</b> <?php echo $user["nrphone"]; ?></h3><br><br>
                      
              </div>
            </div>


        </div>
        <!-- /.box-header -->
        <!-- form start -->
       
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->