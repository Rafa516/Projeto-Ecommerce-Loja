<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <center><img  height="70" whidth="100"src="<?php echo $dir_url; ?>/../res/admin/dist/img/logo1.png"></center>
  <h1>
    Lista de Marcas
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Home</a></li>
    <li class="active"><a href="/admin/brands">Marcas</a></li>
    <li class="active"><a href="">Editar Marca</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Marca</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/brands/<?php echo $brand["idbrand"]; ?>" method="post"  enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="descategory">Nome da Marca</label>
              <input type="text" class="form-control" id="desbrand" name="desbrand" placeholder="Digite o nome da marca" value="<?php echo $brand["desbrand"]; ?>" required>
            </div>
            <div class="form-group">
              <label for="file">Foto</label>
              <input type="file" class="form-control" id="file" name="file" >
              <div class="box box-widget">
                <div class="box-body">
                  <img class="img-responsive" id="image-preview" src="<?php echo $brand["desphoto"]; ?>" alt="Photo">
                </div>
              </div>
            </div>

          </div>
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