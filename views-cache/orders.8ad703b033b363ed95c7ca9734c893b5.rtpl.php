<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <center><img  height="70" whidth="100"src="<?php echo $dir_url; ?>/../res/admin/dist/img/logo1.png"></center>
  <h1>
    Lista de Pedidos
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="/admin/orders">Pedidos</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">

          <div class="box-header">
            <div class="box-tools">
                <form action="/admin/orders">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="search" class="form-control pull-right" placeholder="Pesquisar" value="<?php echo $search; ?>">
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <br>
            <div class="box-body no-padding">
              <div class="table-responsive">
              <table class="table table-hover table-bordered">
                <thead style="background-color: #D8D8D8">
                  <tr>
                    <th style="width: 10px">Código</th>
                    <th><center>Cliente</th>
                    <th><center>Valor Total</th>
                    <th><center>Valor do Frete</th>
                    <th><center>Status</th>
                    <th style="width: 220px">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($orders) && ( is_array($orders) || $orders instanceof Traversable ) && sizeof($orders) ) foreach( $orders as $key1 => $value1 ){ $counter1++; ?>

                  <tr>
                    <td><center><?php echo $value1["idorder"]; ?></td>
                    <td><center><?php echo $value1["desperson"]; ?></td>
                    <td><center>R$ <?php echo $value1["vltotal"]; ?></td>
                    <td><center>R$ <?php echo $value1["vlfreight"]; ?></td>
                    <td><center><?php echo $value1["desstatus"]; ?></td>
                    <td>
                      <a href="/admin/orders/<?php echo $value1["idorder"]; ?>" class="btn btn-default btn-xs"><i class="fa fa-search"></i> Detalhes</a>
                      <a href="/admin/orders/<?php echo $value1["idorder"]; ?>/status" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Status</a>
                      <a href="/admin/orders/<?php echo $value1["idorder"]; ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
                    </td>
                  </tr>
                  <?php }else{ ?>

                  <tr>
                      <td colspan="6">Nenhum pedido foi encontrado.</td>
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