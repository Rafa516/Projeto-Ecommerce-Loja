<?php

use \Projeto\PageAdmin;
use \Projeto\Model\User;
use \Projeto\Model\Category;
use \Projeto\Model\Product;

//---------ROTA DA PÁGINA INDEX DA ÁREA ADMINISTRATIVA ----------------------//

$app->get('/admin', function() {
    
	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("index");


});

//---------ROTA DA PÁGINA PERFIL DA ÁREA ADMINISTRATIVA----------------------//

$app->get('/admin/perfil', function() {
    
	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("perfil");

});

//---------ROTA DA PÁGINA DE LOGIN DA ÁREA ADMINISTRATIVA (GET)----------------------//

$app->get('/admin/login', function() {

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login",[
		'error'=>user::getError(),

	]);

});

//---------ROTA DA PÁGINA PERFIL DA ÁREA ADMINISTRATIVA ENVIO DO FORMULÁRIO (POST)----------------------//

$app->post('/admin/login', function() {

	try {

		User::login($_POST['login'], $_POST['password']);

	} catch(Exception $e) {

		User::setError($e->getMessage());

		header("Location: /admin/login");
		exit;

	}

	header("Location: /admin");
	exit;

});

//---------ROTA DA PÁGINA PERFIL DA ÁREA ADMINISTRATIVA----------------------//

$app->get('/admin/logout', function() {

	User::logout();

	header("Location: /admin/login");
	exit;

});

//---------ROTA DA PÁGINA RECUPERAR SENHA DA ÁREA ADMINISTRATIVA----------------------//

$app->get("/admin/forgot", function() {

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot");	

});


//---------ROTA DA PÁGINA RECUPERAR SENHA DA ÁREA ADMINISTRATIVA ENVIO DO FORMULÁRIO (POST)----------------------//

$app->post("/admin/forgot", function(){

	$user = User::getForgot($_POST["email"]);

	header("Location: /admin/forgot/sent");
	exit;

});

//---------ROTA DA PÁGINA RECUPERAR SENHA DA ÁREA ADMINISTRATIVA----------------------//

$app->get("/admin/forgot/sent", function(){

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-sent");	

});


$app->get("/admin/forgot/reset", function(){

	$user = User::validForgotDecrypt($_GET["code"]);

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-reset", array(
		"name"=>$user["desperson"],
		"code"=>$_GET["code"]
	));

});

$app->post("/admin/forgot/reset", function(){

	$forgot = User::validForgotDecrypt($_POST["code"]);	

	User::setForgotUsed($forgot["idrecovery"]);

	$user = new User();

	$user->get((int)$forgot["iduser"]);

	$password = User::getPasswordHash($_POST["password"]);

	$user->setPassword($password);

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-reset-success");

});





?>