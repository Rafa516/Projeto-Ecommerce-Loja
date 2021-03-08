<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <center><img  height="70" whidth="100"src="<?php echo $dir_url; ?>/../res/admin/dist/img/logo1.png"></center>
  <h1>
    Lista de avaliações dos produtos
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Home</a></li>
    <li class="active"><a >Avaliações</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">

       <div class="box-header">
            <div class="box-tools">
                <form action="/admin/reviews">
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
              <table class="table table-hover  table-bordered">
                <thead style="background-color: #D8D8D8">
                  <tr >
                
                    <th><center>Produto</th>
                    <th><center>Nota</th>
                    <th><center>Nome</th>
                    <th><center>E-mail</th>
                    <th ><center>Avaliações</th>
                    <th ><center>Data de registro</th>
                    <th ><center>Excluir avaliação</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($products) && ( is_array($products) || $products instanceof Traversable ) && sizeof($products) ) foreach( $products as $key1 => $value1 ){ $counter1++; ?>

                  <tr>
                    
                    <td><center><?php echo $value1["desproduct"]; ?></td>
                    <td><center><?php echo $value1["rate"]; ?></td>
                    <td><center><?php echo $value1["desperson"]; ?></td>
                    <td><center>  <?php echo $value1["desemail"]; ?></td>
                    <td><center><?php echo $value1["review"]; ?></td/>
                    <td><center>  <?php echo formatDate($value1["dtregister"]); ?></td>
                     

                   
                    <td>
                      <center>
                      <a href="/admin/reviews/<?php echo $value1["idavaliaction"]; ?>/delete" onclick="return confirm('Deseja realmente excluir a avaliação ?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a></center>
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