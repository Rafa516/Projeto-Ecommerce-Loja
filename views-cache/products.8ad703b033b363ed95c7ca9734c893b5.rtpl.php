<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
 <center><img  height="70" whidth="100"src="<?php echo $dir_url; ?>/../res/admin/dist/img/logo1.png"></center>
  <h1>
    Lista de Produtos
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Home</a></li>
    <li class="active"><a href="/admin/products">Produtos</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
            
            <div class="box-header">
              <a href="/admin/products/create" class="btn btn-success">Cadastrar Produto</a>
               <div class="box-tools">
                <form action="/admin/products">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" class="form-control pull-right" placeholder="Pesquisar" value="<?php echo $search; ?>">
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="box-body no-padding">
              <div class="table-responsive">
             <table class="table  table-hover table-bordered">
                 <thead style="background-color: #D8D8D8" >
                  <tr>
                    <th ><center>Código</th>
                   <th ><center>Nome do Produto</th>
                    <th><center>Preço</th>
                 
                    <th ><center>Adicionar ou remover fotos</th>
                    <th ><center>Editar ou excluir</th>
                   
                   
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($products) && ( is_array($products) || $products instanceof Traversable ) && sizeof($products) ) foreach( $products as $key1 => $value1 ){ $counter1++; ?>

                  <tr>
                    <td><center><?php echo $value1["idproduct"]; ?></td>
                    <td><?php echo $value1["desproduct"]; ?></td>
                    <td><center>R$ <?php echo $value1["vlprice"]; ?></td>
               

                    <td>
                      <center><a href="/admin/photos/<?php echo $value1["idproduct"]; ?>" class="btn btn-info btn-xs"><i class="fa fa-camera"></i> Fotos</a>
                    </center>
                    </td>
                  
                    <td>
                      <center><a href="/admin/products/<?php echo $value1["idproduct"]; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                     <a href="/admin/products/<?php echo $value1["idproduct"]; ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a></center>
                    </td>
                  </tr>
                  <?php } ?>

                </tbody>
              </table>
            </div>
            </div>
            <!-- /.box-body -->
              <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>

                <li><a href="<?php echo $value1["href"]; ?>"><?php echo $value1["text"]; ?></a></li>
                <?php } ?>

              </ul>
            </div>
          </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->