<?php

use \Projeto\PageAdmin;
use \Projeto\Model\User;



$app->get("/admin/users", function() {

	User::verifyLogin();

	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = User::getPageSearch($search, $page);

	} else {

		$pagination = User::getPage($page);

	}

	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, [
			'href'=>'/admin/users?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);

	}

	$page = new PageAdmin();

	$page->setTpl("users", array(
		"users"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages
	));

});


$app->get("/admin/users/create", function() {

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("users-create",[
		'errorRegister'=>User::getErrorRegister()	
	]);


});

$app->get("/admin/users/:iduser/delete",function($iduser){

	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$user->delete();

	header("Location: /admin/users");
 	exit;




});


$app->get('/admin/users/:iduser', function($iduser){
 
   User::verifyLogin();
 
   $user = new User();
 
   $user->get((int)$iduser);
 
   $page = new PageAdmin();
 
   $page ->setTpl("users-update", array(
        "user"=>$user->getValues()    
    ));
 
});

$app->post("/admin/users/create", function () {

 	User::verifyLogin();

	$user = new User();

 	$_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;



 	if (User::checkLoginExist($_POST['deslogin']) === true) {

		User::setErrorRegister("Este login já está sendo usado por outro usuário.");

		header("Location: /admin/users/create");
		exit;

	}

	if (User::checkEmailExist($_POST['desemail']) === true) {

		User::setErrorRegister("Este e-mail já está sendo usado por outro usuário.");

		header("Location: /admin/users/create");
		exit;

	}
	
 
	 	$user->setData($_POST);

		$user->save();

		header("Location: /admin/users");
	 	exit;
 	

});

$app->post("/admin/users/:iduser",function($iduser){

	User::verifyLogin();

	$user = new User();

	$_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;

	$user->get((int)$iduser);
 
  	$user->setData($_POST);

  	$user->update();

  	header("Location: /admin/users");
  	exit;


});

$app->post("/admin/perfil/:iduser", function ($iduser) {

 	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);
 
 	$user->setData($_POST);


	$user->updateImage();

	header("Location: /admin/perfil");
 	exit;

});





?>