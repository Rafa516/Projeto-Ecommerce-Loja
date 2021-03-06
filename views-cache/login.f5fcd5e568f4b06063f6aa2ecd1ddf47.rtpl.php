<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2><b>Autenticação</b></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <?php if( $error != '' ){ ?>

                <div class="alert alert-danger">
                    <?php echo $error; ?>

                </div>
                <?php } ?>


                <form action="/login" id="login-form-wrap" class="login" method="post">
                    <h2>Acessar</h2>
                    <p class="form-row form-row-first">
                        <label for="login">E-mail <span class="required">*</span>
                        </label>
                        <input style="width: 20em;" type="email" id="login" name="login" class="input-text" required>
                    </p>
                    <p class="form-row form-row-last">
                        <label for="senha">Senha <span class="required">*</span>
                        </label>
                        <input style="width: 20em;" type="password" id="senha" name="password" class="input-text"
                            required>
                    </p>
                    <div class="clear"></div>
                    <p class="form-row">
                        <input type="submit" value="Login" class="button">
                        <label class="inline" for="rememberme"><input type="checkbox" value="forever" id="rememberme"
                                name="rememberme"> Manter conectado </label>
                    </p>
                    <p class="lost_password">
                        <a href="/forgot">Esqueceu a senha?</a>
                    </p>

                    <div class="clear"></div>
                </form>
            </div>
            <div class="col-md-4">

                <?php if( $errorRegister != '' ){ ?>

                <div class="alert alert-danger">
                    <?php echo $errorRegister; ?>

                </div>
                <?php } ?>


                <form style="padding-left: 15%" id="register-form-wrap" action="/register" class="register"
                    method="post">
                    <h2>Criar conta</h2>
                    <p class="form-row form-row-first">
                        <label for="nome">Nome <span class="required">*</span>
                        </label>
                        <input type="text" id="nome" name="name" class="input-text" value="<?php echo $registerValues["name"]; ?>"
                            required>
                    </p>
                    <p class="form-row form-row-first">
                        <label for="email">E-mail <span class="required">*</span>
                        </label>
                        <input type="email" id="email" name="email" class="input-text" value="<?php echo $registerValues["email"]; ?>"
                            required>
                    </p>
                    <p class="form-row form-row-first">
                        <label for="phone">Telefone <span class="required">*</span>
                        </label>
                        <input type="text" id="phone" name="phone" class="input-text" value="<?php echo $registerValues["phone"]; ?>"
                            required>
                    </p>
                    <p class="form-row form-row-last">
                        <label for="senha">Senha <span class="required">*</span>
                        </label>
                        <input type="password" id="senha" name="password" class="input-text" required>
                    </p>
                    <div class="clear"></div>

                    <p class="form-row">
                        <input type="submit" value="Criar Conta" name="login" class="button">
                    </p>

                    <div class="clear"></div>
                </form>
            </div>
        </div>
    </div>
</div>