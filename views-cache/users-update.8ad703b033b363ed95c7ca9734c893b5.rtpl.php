<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

<center><img  height="70" whidth="100"src="<?php echo $dir_url; ?>/../res/admin/dist/img/logo1.png"></center>

<h1>Lista de Usuários </h1>
 <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Home</a></li>
    <li class="active"><a href="/admin/users"> Usuários</a></li>
     <li class="active"><a href="">Editar Usuário</a></li>

  </ol>
 
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Usuário</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->

        <form role="form" action="/admin/users/<?php echo $user["iduser"]; ?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="desperson">Nome</label>
              <input type="text" class="form-control" id="desperson" name="desperson" placeholder="Digite o nome" value="<?php echo $user["desperson"]; ?>" required>
            </div>
            
            <div class="form-group">
              <label for="nrphone">Telefone</label>
              <input type="tel" class="form-control" id="nrphone" name="nrphone" placeholder="Digite o telefone"  value="<?php echo $user["nrphone"]; ?>" required>
            </div>

             <input type="hidden" name="inadmin" value="1"> 
                       
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->