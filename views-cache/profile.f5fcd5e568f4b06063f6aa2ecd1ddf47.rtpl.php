<?php if(!class_exists('Rain\Tpl')){exit;}?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2><b>Minha Conta</b></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">                
            <div class="col-md-3">
                <?php require $this->checkTemplate("profile-menu");?>

            </div>
            <div class="col-md-9">
                <?php if( $profileMsg != '' ){ ?>

                <div class="alert alert-success">
                    <?php echo $profileMsg; ?>

                </div>
                <?php } ?>

                <?php if( $profileError != '' ){ ?>

                <div class="alert alert-danger">
                    <?php echo $profileError; ?>

                </div>
                <?php } ?>                
                <form method="post" action="/profile">
                   <div class="cart-collaterals">
                    <h2 style="color: black">Editar Dados</h2>
                </div>
                    <div class="form-group">
                    <label for="desperson">Nome </label>
                    <input type="text" class="form-control" id="desperson" name="desperson" placeholder="Digite o nome aqui" value='<?php echo getUserName(); ?>' required>
                    </div>

                    <?php if( $user["inadmin"] == 1 ){ ?>


                    <?php }else{ ?>

                    <div class="form-group">
                    <label for="desemail">E-mail</label>
                    <input type="email" class="form-control" id="desemail" name="desemail" placeholder="Digite o e-mail aqui" value='<?php echo $user["desemail"]; ?>' required>
                    </div>
                    <?php } ?>

                    <div class="form-group">
                    <label for="nrphone">Telefone</label>
                    <input type="tel" class="form-control" id="nrphone" name="nrphone" placeholder="Digite o telefone aqui" value="<?php echo $user["nrphone"]; ?>" required="">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>