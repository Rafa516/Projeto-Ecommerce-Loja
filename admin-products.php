<?php

use \Projeto\PageAdmin;
use \Projeto\Model\User;
use \Projeto\Model\Product;
use \Projeto\Model\Avaliaction;


//---------ROTA DA PÁGINA QUE LISTA OS PRODUTOS -CRUD- (READY) (ADM)---------------------------//

$app->get("/admin/products", function(){

	User::verifyLogin();

	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = Product::getPageSearch($search, $page);

	} else {

		$pagination = Product::getPage($page);

	}

	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, [
			'href'=>'/admin/products?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);

	}

	$products = Product::listAll();

	$page = new PageAdmin();

	$page->setTpl("products", [
		"products"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages
	]);

});

//-------ROTA DA PÁGINA CADASTRO DE  PRODUTOS (GET) -CRUD- (CREATE) (ADM)--------------//

$app->get("/admin/products/create", function(){

	User::verifyLogin();


	$product = new Product();

	$page = new PageAdmin();

	$page->setTpl("products-create");


});

//-------ROTA DO MÉTODO (POST) DO FORMULÁRIO DE CADASTRO -CRUD- (CREATE) (ADM)--------------//

$app->post("/admin/products/create", function(){

	User::verifyLogin();

	$product = new Product();

	$product->setData($_POST);

	$product->save();

	header("Location: /admin/products");
	exit;

});

//-------ROTA DA EXCLUSÃO DO PRODUTO -CRUD- (DELETE) (ADM)--------------//

$app->get("/admin/products/:idproduct/delete", function($idproduct) {

	User::verifyLogin();

	$product = new Product();

	$product->get((int)$idproduct);

	$product->delete();
    	
	header("Location: /admin/products");
	exit;

});

//-------ROTA DA PÁGINA PARA EDITAR PRODUTO -CRUD- (UPDATE) (ADM)--------------//

$app->get("/admin/products/:idproduct", function($idproduct) {

	User::verifyLogin();

	$product = new Product();


	$product->get((int)$idproduct);


	$page = new PageAdmin();

	$page->setTpl("products-update", [
		"product"=>$product->getValues(),
		
	]);


});

//-------ROTA DO MÉTODO (POST) DO FORMULÁRIO DE EDIÇÃO -CRUD- (UPDATE) (ADM)--------------//

$app->post("/admin/products/:idproduct", function($idproduct) {

	User::verifyLogin();

	$product = new Product();

	$product->get((int)$idproduct);

	$page = new PageAdmin();

	$product->setData($_POST);

	$product->update();

	header("Location: /admin/products");
	exit;

});

//-------ROTA DA PÁGINA PARA INSERIR OU EXCLUIR FOTOS DO PRODUTO -CRUD- (READY) (ADM)--------------//

$app->get("/admin/photos/:idproduct", function($idproduct) {

	User::verifyLogin();

	$product = new Product();

	$product->get((int)$idproduct);

	$page = new PageAdmin();

	$page->setTpl("products-photos", [
		"product"=>$product->getValues(),
		'images'=>$product->showPhotos(),
		'photos'=>Product::totalPhotos($idproduct)
	]);


});

//-------ROTA DO MÉTODO (POST) PARA INSERIR MAIS FOTOS -CRUD- (UPDATE) (ADM)--------------//

$app->post("/admin/photos/:idproduct", function($idproduct) {

	User::verifyLogin();

	$product = new Product();

	$product->get((int)$idproduct);

	$page = new PageAdmin();

	$product->setData($_POST);

	$product->save();

	header("Location: /admin/photos/".$idproduct);
	exit;

});


//-------ROTA DA EXCLUSÃO DA FOTO DO PRODUTO -CRUD- (DELETE) (ADM)--------------//

$app->get("/admin/products/:idproduct/delete/:idphoto", function($idproduct,$idphoto) {

	User::verifyLogin();

	$product = new Product();

	$product->get((int)$idproduct);

	$product->getPhotos($idphoto);

	$product->deletePhoto($idphoto);
    	
	header("Location: /admin/photos/".$idproduct);
	exit;

});


//-------ROTA DA PÁGINA DESTAQUES  DA SEMANA --------------//

$app->get("/admin/carousel/:idcarousel", function($idcarousel){

	User::verifyLogin();

	$product = new Product();

	$product->getCarousel((int)$idcarousel);

	$page = new PageAdmin;

	$page->setTpl("products-carousel",[
		"product"=>$product->getItens(),
		"productsRelated"=>$product->getProductsCarousel(),
		"productsNotRelated"=>$product->getProductsCarousel(false)

	]);

});

//-------ROTA PARA ADICIONAR PRODUTOS NA TABELA DE DESTAQUES DA SEMANA DA LOJA --------------//

$app->get("/admin/carousel/:idcarousel/products/:idproduct/add", function($idcarousel, $idproduct){

	User::verifyLogin();

	$carousel = new Product();

	$carousel->getCarousel((int)$idcarousel);

	$product = new Product();

	$product->get((int)$idproduct);

	$carousel->addProductCarousel($product);


	header("location: /admin/carousel/".$idcarousel);
	exit;

});

//-------ROTA PARA REMOVER  PRODUTOS DA  TABELA DE DESTAQUES DA SEMANA DA LOJA --------------//

$app->get("/admin/carousel/:idcarousel/products/:idproduct/remove", function($idcarousel, $idproduct){

	User::verifyLogin();
	
	$carousel = new Product();

	$carousel->getCarousel((int)$idcarousel);

	$product = new Product();

	$product->get((int)$idproduct);

	$carousel->removeProductCarousel($product);

	header("location: /admin/carousel/".$idcarousel);
	exit;

});

//-------ROTA PARA A PÁGINA DE AVALIAÇÕES --------------//

$app->get("/admin/reviews", function(){

	
	User::verifyLogin();

	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = Avaliaction::getPageSearch($search, $page);

	} else {

		$pagination = Avaliaction::getPage($page);

	}

	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, [
			'href'=>'/admin/reviews?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);

	}

	$page = new PageAdmin();

	$page->setTpl("reviews", [
		"products"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages
	]);	


});

//-------ROTA PARA EXCLUIR UMA AVALIAÇÃO SELECIONADA  --------------//

$app->get("/admin/reviews/:idavaliaction/delete", function($idavaliaction) {

	User::verifyLogin();

	$avaliaction = new Avaliaction();

	$avaliaction->getIdAvaliactions((int)$idavaliaction);

	$avaliaction->deleteAvaliactions();
    	
	header("Location: /admin/reviews");
	exit;

});


?>	 