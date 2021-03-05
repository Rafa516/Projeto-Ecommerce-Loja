<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="list-group" id="menu">
    <a href="/profile" class="list-group-item list-group-item-action">Editar Dados</a>
    <a href="#" class="list-group-item list-group-item-action">Alterar Senha</a>
    <a href="#" class="list-group-item list-group-item-action">Meus Pedidos</a>
    <a href="/profile-avaliactions/<?php echo $user["iduser"]; ?>" class="list-group-item list-group-item-action">Minhas Avaliações</a>
    <a href="/logout" class="list-group-item list-group-item-action">Sair</a>
</div>