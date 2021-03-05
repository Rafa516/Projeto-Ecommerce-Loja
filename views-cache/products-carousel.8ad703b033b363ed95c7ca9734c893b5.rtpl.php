<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Adicionar produtos na área de Destaques da semana da loja
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Home</a></li>
    <li class="active"><a href="#">  Adicionar produtos nos Destaques da semana</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Todos os Produtos</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <table class="table table-hover table-bordered">
                       <thead style="background-color: #D8D8D8">
                            <tr>
                            <th style="width: 10px">#</th>
                            <th><center>Nome do Produto</center></th>
                            <th ><center>Adicionar produto</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter1=-1;  if( isset($productsNotRelated) && ( is_array($productsNotRelated) || $productsNotRelated instanceof Traversable ) && sizeof($productsNotRelated) ) foreach( $productsNotRelated as $key1 => $value1 ){ $counter1++; ?>

                            <tr>
                            <td><?php echo $value1["idproduct"]; ?></td>
                            <td><?php echo $value1["desproduct"]; ?></td>
                            <td>
                                <center><a href="/admin/carousel/<?php echo $product["idcarousel"]; ?>/products/<?php echo $value1["idproduct"]; ?>/add" class="btn btn-info btn-xs "><i class="fa fa-arrow-right"></i> Adicionar</a></center>
                            </td>
                            </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                <h3 class="box-title">Produtos no Destaques da semana </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                     <table class="table table-hover table-bordered">
                       <thead style="background-color: #D8D8D8">
                            <tr>
                            <th style="width: 10px">#</th>
                            <th><center>Nome do Produto</center></th>
                            <th ><center>Remover Produto</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter1=-1;  if( isset($productsRelated) && ( is_array($productsRelated) || $productsRelated instanceof Traversable ) && sizeof($productsRelated) ) foreach( $productsRelated as $key1 => $value1 ){ $counter1++; ?>

                            <tr>
                            <td><?php echo $value1["idproduct"]; ?></td>
                            <td><?php echo $value1["desproduct"]; ?></td>
                            <td>
                                <center><a href="/admin/carousel/<?php echo $product["idcarousel"]; ?>/products/<?php echo $value1["idproduct"]; ?>/remove" class="btn btn-danger btn-xs "><i class="fa fa-arrow-left"></i> Remover</a></center>
                            </td>
                            </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>        
    </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->