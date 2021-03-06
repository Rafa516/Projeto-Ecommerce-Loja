<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <center><img  height="70" whidth="100"src="<?php echo $dir_url; ?>/../res/admin/dist/img/logo1.png"></center>
  <h1>
    Lista de fotos do Produto
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="/admin/products">Produtos</a></li>
    <li class="active"><a href="">Adicionar ou remover fotos</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Adicionar ou remover fotos do produto </b></h3>
        </div><br>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/photos/<?php echo $product["idproduct"]; ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <div class="box-body">
             
              <input type="file" class="form-control-file" id="namephoto" name="namephoto[]"  multiple="multiple" required ><br>
              <div class="box box-widget">
                <div  id="myWorkContent">
                  <br>

                  <?php if( $photos["totalPhotos"] == 1 ){ ?>

                   <?php $counter1=-1;  if( isset($images) && ( is_array($images) || $images instanceof Traversable ) && sizeof($images) ) foreach( $images as $key1 => $value1 ){ $counter1++; ?>

                   <a href="#" title="EXCLUIR IMAGEM" onclick="return alert('Não é possível excluir, produto deve ter uma imagem!!')"> <img style="height: 15em;width: 15em" class="photo"id="image-preview" src="<?php echo $value1["desphoto"]; ?>" ></a>
                  <?php } ?>

                  <?php }else{ ?>

                  <?php $counter1=-1;  if( isset($images) && ( is_array($images) || $images instanceof Traversable ) && sizeof($images) ) foreach( $images as $key1 => $value1 ){ $counter1++; ?>

                   <a href="/admin/products/<?php echo $value1["idproduct"]; ?>/delete/<?php echo $value1["idphoto"]; ?>" title="EXCLUIR IMAGEM" onclick="return confirm('Deseja realmente excluir esta imagem?')"> <img style="height: 15em;width: 15em" class="photo"id="image-preview" src="<?php echo $value1["desphoto"]; ?>" ></a>
                  <?php } ?>

                  <?php } ?>

               
                </div>
              </div>
            </div>
         
          <!-- /.box-body -->
            <div class="box-footer">
            <button type="submit" class="btn btn-primary">Adicionar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>


</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
document.querySelector('#file').addEventListener('change', function(){
  
  var file = new FileReader();

  file.onload = function() {
    
    document.querySelector('#image-preview').src = file.result;

  }

  file.readAsDataURL(this.files[0]);

});
</script>