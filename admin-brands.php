<?php

use \Projeto\PageAdmin;
use \Projeto\Model\User;
use \Projeto\Model\Brand;
use \Projeto\Model\Product;


$app->get("/admin/brands", function(){

	User::verifyLogin();

	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = Brand::getPageSearch($search, $page);

	} else {

		$pagination = Brand::getPage($page);

	}

	$pages = [];

	for ($x = 0; $x < $pagination['pages']; $x++)
	{

		array_push($pages, [
			'href'=>'/admin/brands?'.http_build_query([
				'page'=>$x+1,
				'search'=>$search
			]),
			'text'=>$x+1
		]);

	}

	$page = new PageAdmin();

	$page->setTpl("brands", [
		"brands"=>$pagination['data'],
		"search"=>$search,
		"pages"=>$pages
	]);	

});

$app->get("/admin/brands/create", function(){

	User::verifyLogin();


	$brand = new Brand();

	

	$page = new PageAdmin();

	

	$page->setTpl("brands-create");


});

$app->post("/admin/brands/create", function(){

	User::verifyLogin();

	$brand = new Brand();

	$brand->setData($_POST);

	$brand->save();

	if(file_exists($_FILES['file']['tmp_name']) || is_uploaded_file($_FILES['file']['tmp_name'])) 
	{
    	$brand->setPhoto($_FILES["file"]);
 	}



	header("Location: /admin/brands");
	exit;

});


$app->get("/admin/brands/:idbrand", function($idbrand) {

	User::verifyLogin();

	$brand = new Brand();

	$brand->get((int)$idbrand);

	$page = new PageAdmin();

	$page->setTpl("brands-update", [
		"brand"=>$brand->getValues()
	]);


});

$app->post("/admin/brands/:idbrand", function($idbrand) {

	User::verifyLogin();

	$brand = new Brand();

	$brand->get((int)$idbrand);

	$page = new PageAdmin();

	$brand->setData($_POST);

	$brand->save();

	if(file_exists($_FILES['file']['tmp_name']) || is_uploaded_file($_FILES['file']['tmp_name'])) 
	{
    	$brand->setPhoto($_FILES["file"]);
 	}

	header("Location: /admin/brands");
	exit;

});

$app->get("/admin/brands/:idbrands/delete", function($idbrand) {

	User::verifyLogin();

	$brand = new Brand();

	$brand->get((int)$idbrand);

		$brand->delete();
    	
	header("Location: /admin/brands");
	exit;

});

$app->get("/admin/brands/:idbrand/products", function($idbrand) {

	User::verifyLogin();

	$brand = new Brand();

	$brand->get((int)$idbrand);

	$page = new PageAdmin();

	$page->setTpl("brands-products", [
		'brand'=>$brand->getValues(),
		"productsRelated"=>$brand->getProducts(),
		"productsNotRelated"=>$brand->getProducts(false)
	]);


});

$app->get("/admin/brands/:idbrand/products/:idproduct/add", function($idbrand, $idproduct) {

	User::verifyLogin();

	$brand = new Brand();

	$brand->get((int)$idbrand);

	$product = new Product();

	$product->get((int)$idproduct);

	$brand->addProduct($product);

	header("location: /admin/brands/".$idbrand."/products");
	exit;



});

$app->get("/admin/brands/:idbrand/products/:idproduct/remove", function($idbrand,$idproduct) {

	User::verifyLogin();

	$brand = new Brand();

	$brand->get((int)$idbrand);

	$product = new Product();

	$product->get((int)$idproduct);

	$brand->removeProduct($product);



	header("location: /admin/brands/".$idbrand."/products");
	exit;


});





?>