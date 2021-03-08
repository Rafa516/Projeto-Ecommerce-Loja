<?php

use \Projeto\Page;
use \Projeto\Model\Category;
use \Projeto\Model\Product;
use \Projeto\Model\User;
use \Projeto\Model\Brand;
use \Projeto\Model\Cart;
use \Projeto\Model\Avaliaction;
use \Projeto\Model\Address;
use \Projeto\Model\Order;
use \Projeto\Model\OrderStatus;


//------------------ROTA DA PÁGINA INDEX (LOJA)--------------------------------//

$app->get('/', function() {  
	
	
	$products = Product::listAll();   

	$carousel = Product::listAllcarousel(); 

	$brands = Brand::listAll(); 

	$page = new Page(); 




	$page->setTpl("index",[						  
		"products"=>Product::checkList($products), 
		"carousel"=>Product::checkList($carousel),
		"brands"=>Brand::checkList($brands)
	
	]);

});
//------------------ROTA DAS PÁGINAS DAS CATEGORIAS-----------------------------//


$app->get("/categories/:idcategory", function($idcategory){

	$numPage = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	$category = new Category();

	$category->get((int)$idcategory);

	$pagination = $category->getProductsPage($numPage);

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) { 
		array_push($pages, [
			'link'=>'/categories/'.$category->getidcategory().'?page='.$i,
			'page'=>$i
		]);
	}

	$back  = $numPage - 1;	

	$next = $numPage + 1;
	
	$page = new Page();

	$page->setTpl("category", [
		'category'=>$category->getValues(),
		'products'=>Product::checkList($category->getProducts()),
		'products'=>$pagination["data"],
		'pages'=>$pages,
		'back'=>$back,
		'next'=>$next,
		'totalPage'=>$pagination['pages'],
		"numPage"=>$numPage
	]);

});

//------------------ROTA DAS PÁGINAS DAS MARCAS-----------------------------//

$app->get("/brand/:idbrand", function($idbrand){

	$numPage = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	$brand = new Brand();

	$brand->get((int)$idbrand);

	

	$pagination = $brand->getProductsPage($numPage);

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) { 
		array_push($pages, [
			'link'=>'/brand/'.$brand->getidbrand().'?page='.$i,
			'page'=>$i
		]);
	}

	$back  = $numPage - 1;	

	$next = $numPage + 1;
	

	
	$page = new Page();

	$page->setTpl("brand", [
		'brand'=>$brand->getValues(),
		'products'=>Product::checkList($brand->getProducts()),
		'products'=>$pagination["data"],
		'errorRate'=>Brand::getErrorRate(),
		'SuccessRate'=>Brand::getSuccess(),
		'pages'=>$pages,
		'back'=>$back,
		'next'=>$next,
		'totalPage'=>$pagination['pages'],
		"numPage"=>$numPage

	]);

});

//------ROTA DO FORMULÁRIO (POST) DE NOTAS DAS MARCAS----------------//

$app->post("/brand/:idbrand/:iduser/add", function($idbrand,$iduser){

	$brand =  new Brand;

	$brand->get($idbrand);

	$user = new User();

	$user->get($iduser);


	if (Brand::checkRateExist($_POST['idbrand'],$_POST['iduser']) === true ) {

		Brand::setErrorRate("Você já registrou nota para essa marca");

		header("Location: /brand/".$idbrand);
		exit;

	}
		Brand::setSuccess("Nota registrada com sucesso");

		$brand->setData($_POST);

		$brand->addRate();

		header("location: /brand/".$idbrand);
		exit;

});

//--------------ROTA DA PÁGINAS DOS PRODUTOS----------------//

$app->get('/products', function() {  

	$numPage = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	
	$search = (isset($_GET['search'])) ? $_GET['search'] : "";

	$products = new product();

	if ($search != '') {

		$pagination = $products->getSearch($search, $numPage);

	}else{

		$pagination = Product::getProductsPage($numPage);

	}

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) { 
		array_push($pages, [
			'link'=>'/products?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}

	$back  = $numPage - 1;	

	$next = $numPage + 1;

	$page = new Page(); 

	$page->setTpl("products",[
		"search"=>$search,
		'products'=>$pagination["data"],
		'pages'=>$pages,
		'back'=>$back,
		'next'=>$next,
		'totalPage'=>$pagination['pages'],
		"numPage"=>$numPage
	]);

});
	

//--------------ROTA DAS PÁGINAS DOS DETALHES DOS PRODUTOS----------------//

$app->get("/products/:desurl", function($desurl){

	$product =  new Product();

	$product->getFromURL($desurl);
	
	$product->showPhotos();

	$avaliaction = new Avaliaction();

	$avaliaction->getFromURL($desurl);

	$page = new Page();


	$page->setTpl("product-detail",[
		'product'=>$product->getValues(),
		'categories'=>$product->getCategories(),
		'brands'=>$product->getBrands(),
		'avaliactions'=>$avaliaction->getAvaliactions(),
		'total'=>$avaliaction->totalAvaliactions(),
		'products'=>$product->showPhotos(),
		'avaliactionsSuccess'=>Avaliaction::getSuccess()
	]);

});

//------ROTA DO FORMULÁRIO (POST) DE AVALIAÇÕES DOS PRODUTOS----------------//

$app->post("/products/:desurl/", function($desurl){

	$avaliaction =  new Avaliaction();

	$avaliaction->getFromURL($desurl);

	if (isset($_POST['review']) || $_POST['review'] == true) {

		Avaliaction::setSuccess("Avaliação registrada com Sucesso!!");
		header("Location: /products/".$desurl);
	}

	$avaliaction->setData($_POST);

	$avaliaction->addAvaliactions();

	header("location: /products/".$desurl);
	exit;

});



//------------------ROTA DAS PÁGINA DO CARRINHO DE COMPRAS-----------------------------//

$app->get("/cart", function(){

	$cart = Cart::getFromSession();

	$page = new Page();

	$page->setTpl("cart",[
		'cart'=>$cart->getValues(),
		'products'=>$cart->getProducts(),
		'error'=>Cart::getMsgError(),
		'zipCodeSuccess'=>Cart::getSuccess()

	]);
	
});


//------------------ROTA PARA ADICIONAR PRODUTOS NO CARRINHO-----------------------------//

$app->get("/cart/:idproduct/add", function($idproduct){


	$product = new Product();

	$product->get((int)$idproduct);

	$cart = Cart::getFromSession();


	$qtd = (isset($_GET['qtd'])) ? (int)$_GET['qtd'] : 1;

	for ($i = 0; $i < $qtd; $i++) {
		
		$cart->addProduct($product);

	}

	header("Location: /cart");
	exit;

});

//------------------ROTA PARA RETIRAR PRODUTOS DO CARRINHO-----------------------------//

$app->get("/cart/:idproduct/minus", function($idproduct){

	$product = new Product();

	$product->get((int)$idproduct);

	$cart = Cart::getFromSession();

	$cart->removeProduct($product);

	header("Location: /cart");
	exit;

});

//------------------ROTA PARA ADICIONAR PRODUTOS DO CARRINHO-----------------------------//

$app->get("/cart/:idproduct/remove", function($idproduct){

	$product = new Product();

	$product->get((int)$idproduct);

	$cart = Cart::getFromSession();

	$cart->removeProduct($product, true);

	header("Location: /cart");
	exit;

});

$app->post("/cart/freight", function(){

	$cart = Cart::getFromSession();

	$cart->setFreight($_POST['vlfreight']);

	if (isset($_POST['vlfreight']) || $_POST['vlfreight'] == true) {

	   $cart->save();

		Cart::setSuccess("Frete calculado com Sucesso!!");
		header("Location: /cart");
	}



	header("Location: /cart");
	exit;

});

$app->get("/checkout", function(){

	User::verifyLogin(false);

	$address = new Address();
	$cart = Cart::getFromSession();

	if (!isset($_GET['zipcode'])) {

		$_GET['zipcode'] = $cart->getdeszipcode();

	}

	if (isset($_GET['zipcode'])) {

		$address->loadFromCEP($_GET['zipcode']);

		$cart->setdeszipcode($_GET['zipcode']);

		$cart->save();

		$cart->getCalculateTotal();

	}

	if (!$address->getdesaddress()) $address->setdesaddress('');
	if (!$address->getdesnumber()) $address->setdesnumber('');
	if (!$address->getdescomplement()) $address->setdescomplement('');
	if (!$address->getdesdistrict()) $address->setdesdistrict('');
	if (!$address->getdescity()) $address->setdescity('');
	if (!$address->getdesstate()) $address->setdesstate('');
	if (!$address->getdescountry()) $address->setdescountry('');
	if (!$address->getdeszipcode()) $address->setdeszipcode('');

	$page = new Page();

	$page->setTpl("checkout", [
		'cart'=>$cart->getValues(),
		'address'=>$address->getValues(),
		'products'=>$cart->getProducts(),
		'error'=>Address::getMsgError()
	]);

});

$app->post("/checkout", function(){

	User::verifyLogin(false);

	if (!isset($_POST['zipcode']) || $_POST['zipcode'] === '') {
		Address::setMsgError("Informe o CEP.");
		header('Location: /checkout');
		exit;
	}

	if (!isset($_POST['desaddress']) || $_POST['desaddress'] === '') {
		Address::setMsgError("Informe o endereço.");
		header('Location: /checkout');
		exit;
	}

	if (!isset($_POST['desdistrict']) || $_POST['desdistrict'] === '') {
		Address::setMsgError("Informe o bairro.");
		header('Location: /checkout');
		exit;
	}

	if (!isset($_POST['descity']) || $_POST['descity'] === '') {
		Address::setMsgError("Informe a cidade.");
		header('Location: /checkout');
		exit;
	}


	if (!isset($_POST['descountry']) || $_POST['descountry'] === '') {
		Address::setMsgError("Informe o país.");
		header('Location: /checkout');
		exit;
	}

	$user = User::getFromSession();

	$address = new Address();

	$_POST['deszipcode'] = $_POST['zipcode'];
	$_POST['idperson'] = $user->getidperson();

	$address->setData($_POST);

	

	$address->save();


	$cart = Cart::getFromSession();

	$cart->getCalculateTotal();

	

	$order = new Order();

	$order->setData([
		'idcart'=>$cart->getidcart(),
		'idaddress'=>$address->getidaddress(),
		'iduser'=>$user->getiduser(),
		'idstatus'=>OrderStatus::EM_ABERTO,
		'vltotal'=>$cart->getvltotal()
	]);

	$order->save();

	switch ((int)$_POST['payment-method']) {

		case 1:
		header("Location: /order/".$order->getidorder()."/mercadopago");
		break;

		case 2:
		header("Location: /order/".$order->getidorder()."/picpay");
		break;

	}

	exit;
	

});

$app->get("/order/:idorder/pagseguro", function($idorder){

	User::verifyLogin(false);

	$order = new Order();

	$order->get((int)$idorder);

	$cart = $order->getCart();

	$page = new Page([
		'header'=>false,
		'footer'=>false
	]);

	$page->setTpl("payment-pagseguro", [
		'order'=>$order->getValues(),
		'cart'=>$cart->getValues(),
		'products'=>$cart->getProducts(),
		'phone'=>[
			'areaCode'=>substr($order->getnrphone(), 0, 2),
			'number'=>substr($order->getnrphone(), 2, strlen($order->getnrphone()))
		]
	]);


});

$app->get("/order/:idorder/paypal", function($idorder){

	User::verifyLogin(false);

	$order = new Order();

	$order->get((int)$idorder);

	$cart = $order->getCart();

	$page = new Page([
		'header'=>false,
		'footer'=>false
	]);

	$page->setTpl("payment-paypal", [
		'order'=>$order->getValues(),
		'cart'=>$cart->getValues(),
		'products'=>$cart->getProducts()
	]);


});

$app->get("/login", function(){

	$page = new Page();

	$page->setTpl("login", [
		'error'=>user::getError(),
		'errorRegister'=>User::getErrorRegister(),
		'registerValues'=>(isset($_SESSION['registerValues'])) ? $_SESSION['registerValues'] : ['name'=>'', 'email'=>'', 'phone'=>'']
	]);

});

$app->post("/login", function(){

	try {

		User::login($_POST['login'], $_POST['password']);

	} catch(Exception $e) {

		User::setError($e->getMessage());

		header("Location: /login");
		exit;

	}

	header("Location: /");
	exit;

});

$app->get("/logout/", function(){
    
    User::logout();

    Cart::removeFromSession();

    session_regenerate_id();
    
    header("Location: /login");
    exit;
});

$app->post("/register", function(){

	$_SESSION['registerValues'] = $_POST;

	if (!isset($_POST['name']) || $_POST['name'] == '') {

		User::setErrorRegister("Preencha o seu nome.");
		header("Location: /login");
		exit;

	}

	if (!isset($_POST['email']) || $_POST['email'] == '') {

		User::setErrorRegister("Preencha o seu e-mail.");
		header("Location: /login");
		exit;

	}

	if (!isset($_POST['phone']) || $_POST['phone'] == '') {

		User::setErrorRegister("Preencha o seu telefone.");
		header("Location: /login");
		exit;

	}

	if (!isset($_POST['password']) || $_POST['password'] == '') {

		User::setErrorRegister("Preencha a senha.");
		header("Location: /login");
		exit;

	}

	if (User::checkEmailExist($_POST['email']) === true) {

		User::setErrorRegister("Este endereço de e-mail já está sendo usado por outro usuário.");
		header("Location: /login");
		exit;

	}

	$user = new User();

	$user->setData([
		'inadmin'=>0,
		'deslogin'=>$_POST['email'],
		'desperson'=>$_POST['name'],
		'desemail'=>$_POST['email'],
		'despassword'=>$_POST['password'],
		'nrphone'=>$_POST['phone']
	]);

	$user->save();

	User::login($_POST['email'], $_POST['password']);

	header('Location: /');
	exit;

});

$app->get("/forgot", function() {

	$page = new Page();

	$page->setTpl("forgot");	

});

$app->post("/forgot", function(){

	$user = User::getForgot($_POST["email"], false);

	header("Location: /forgot/sent");
	exit;

});

$app->get("/forgot/sent", function(){

	$page = new Page();

	$page->setTpl("forgot-sent");	

});


$app->get("/forgot/reset", function(){

	$user = User::validForgotDecrypt($_GET["code"]);

	$page = new Page();

	$page->setTpl("forgot-reset", array(
		"name"=>$user["desperson"],
		"code"=>$_GET["code"]
	));

});

$app->post("/forgot/reset", function(){

	$forgot = User::validForgotDecrypt($_POST["code"]);	

	User::setForgotUsed($forgot["idrecovery"]);

	$user = new User();

	$user->get((int)$forgot["iduser"]);

	$password = User::getPasswordHash($_POST["password"]);

	$user->setPassword($password);

	$page = new Page();

	$page->setTpl("forgot-reset-success");

});

$app->get("/profile", function(){

	User::verifyLogin(false);

	$user = User::getFromSession();

	$page = new Page();

	$page->setTpl("profile", [
		'user'=>$user->getValues(),
		'profileMsg'=>User::getSuccess(),
		'profileError'=>User::getError()
	]);

});

$app->post("/profile", function(){

	User::verifyLogin(false);

	if (!isset($_POST['desperson']) || $_POST['desperson'] === '') {
		User::setError("Preencha o seu nome.");
		header('Location: /profile');
		exit;
	}

	if (!isset($_POST['desemail']) || $_POST['desemail'] === '') {
		User::setError("Preencha o seu e-mail.");
		header('Location: /profile');
		exit;
	}

	$user = User::getFromSession();

	if ($_POST['desemail'] !== $user->getdesemail()) {

		if (User::checkLoginExist($_POST['desemail']) === true) {

			User::setError("Este endereço de e-mail já está cadastrado.");
			header('Location: /profile');
			exit;

		}

	}

	$_POST['inadmin'] = $user->getinadmin();
	$_POST['despassword'] = $user->getdespassword();
	$_POST['deslogin'] = $_POST['desemail'];

	$user->setData($_POST);

	$user->update();

	User::setSuccess("Dados alterados com sucesso!");

	header('Location: /profile');
	exit;

});

$app->get("/profile-avaliactions", function(){

	User::verifyLogin(false);

	$user = User::getFromSession();


	$page = new Page();

	$page->setTpl("profile-avaliactions", [
		'avaliaction'=>$user->getAvaliactions(),
		'profileMsg'=>User::getSuccess(),
		'profileError'=>User::getError()
	]);

});

$app->get("/profile-avaliactions/:iduser/:idavaliaction/delete", function($iduser, $idavaliaction){

	$avaliactions = new Avaliaction();

	$avaliactions->getAvaliactionsID($iduser);

	$avaliactions->getIdAvaliactions($idavaliaction);

	$avaliactions->deleteAvaliactions();

	header("Location: /profile-avaliactions/".$iduser);
	exit;

});

$app->get("/profile/orders", function(){

	User::verifyLogin(false);

	$user = User::getFromSession();

	$page = new Page();

	$page->setTpl("profile-orders", [
		'orders'=>$user->getOrders()
	]);

});

$app->get("/profile/orders/:idorder", function($idorder){

	User::verifyLogin(false);

	$order = new Order();

	$order->get((int)$idorder);

	$cart = new Cart();

	$cart->get((int)$order->getidcart());

	$cart->getCalculateTotal();

	$page = new Page();

	$page->setTpl("profile-orders-detail", [
		'order'=>$order->getValues(),
		'cart'=>$cart->getValues(),
		'products'=>$cart->getProducts()
	]);	

});

?>