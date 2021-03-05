<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <center><img  height="70" whidth="100"src="<?php echo $dir_url; ?>/../res/admin/dist/img/logo1.png"></center>
  <h1>
    Lista de Usuários
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-home"></i> Home</a></li>
    <li class="active"><a href="/admin/users">Usuários</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
            
            <div class="box-header">
              <a href="/admin/users/create" class="btn btn-success">Cadastrar Usuário</a>
               <div class="box-tools">
                <form action="/admin/users">
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
              <table class="table table-hover  table-bordered">
                <thead style="background-color: #D8D8D8">
                  <tr >
                
                    <th><center>Nome</th>
                    <th><center>E-mail</th>
                    <th><center>Login</th>
                    <th style="width: 60px"><center>Administrador</th>
                    <th ><center>Editar ou excluir</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($users) && ( is_array($users) || $users instanceof Traversable ) && sizeof($users) ) foreach( $users as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                    
                    <td><center><?php echo $value1["desperson"]; ?></td>
                    <td><center>  <?php echo $value1["desemail"]; ?></td>
                    <td><center><?php echo $value1["deslogin"]; ?></td/>
                    <td><center><?php if( $value1["inadmin"] == 1 ){ ?>Sim<?php }else{ ?>Não<?php } ?></td>
                    <td>
                      <center>
                      
                      <?php if( $value1["iduser"] == $user["iduser"] ){ ?>
                      <a href="/admin/users/<?php echo $value1["iduser"]; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
                      <?php }else{ ?>
                      <a href="/admin/users/<?php echo $value1["iduser"]; ?>/delete" onclick="return confirm('Deseja realmente excluir o usuário <?php echo $value1["desperson"]; ?>?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a></center>
                      <?php } ?>

                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
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