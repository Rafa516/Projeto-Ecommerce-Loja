<?php 

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;
use \Projeto\Mailer;
use \Projeto\Model\User;


class Cart extends Model {

	const SESSION = "Cart";
	const SESSION_ERROR = "CartError";
	const SUCCESS = "zipcodeSucesss";



	public static function getFromSession()
	{
		
		$cart = new Cart();
		//Se o id do cart estiver na Variavel session
		if (isset($_SESSION[Cart::SESSION]) && (int)$_SESSION[Cart::SESSION]['idcart'] > 0) {
		
			//Retorna o carrinho
			$cart->get((int)$_SESSION[Cart::SESSION]['idcart']);
		} else {
			
			$cart->getFromSessionID();
	
			//Nao tem id na variavel session
			if (!(int)$cart->getidcart() > 0) {
				$data = [
					'dessessionid'=>session_id()
				];
			
				//Se o usuario estiver logado
				if (User::checkLogin(false)) {
					$user = User::getFromSession();
					
					$data['iduser'] = $user->getiduser();	
				}
				$cart->setData($data);
				$cart->save();
				$cart->setToSession();
			}
		}
		return $cart;
	}




	//Seta os dados do carrinho na variavel session
	public function setToSession(){

		$_SESSION[Cart::SESSION] = $this->getValues();
	}

	//Retorna o carrinho, atraves do  session_id()
	public function getFromSessionID(){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_carts WHERE dessessionid =:dessessionid",[
			':dessessionid'=>session_id()
		]);
		//Se a query retornou algum valor, seta os dados do carrinho na instancia
		if(count($results)>0){
			$this->setData($results[0]);
		}
	}


	//Retorna um Cart fornecendo o ID
	public function get($idcart){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_carts WHERE idcart =:idcart",[
			':idcart'=>$idcart
		]);

		//Se a query retornou algum valor, seta os dados do carrinho na instancia
		if(count($results)>0){
			$this->setData($results[0]);
		}
	}
	
	//Salva um carrinho
	public function save(){
		$sql = new Sql();

		$results = $sql->SELECT("CALL sp_carts_save(:idcart,:dessessionid,:iduser,:deszipcode,:vlfreight,:nrdays)",[
			':idcart' => $this->getidcart(),
			':dessessionid' =>$this->getdessessionid(),
			':iduser'=>$this->getiduser(),
			':deszipcode'=>$this->getdeszipcode(),
			':vlfreight'=>$this->getvlfreight(),
			':nrdays'=>$this->getnrdays()
		]);

		$this->setData($results[0]);
	}

	//Adiciona um produto ao carrinho
	public function addProduct(Product $product){

		$sql = new Sql();

		$sql->query("INSERT INTO tb_cartsproducts (idcart,idproduct) VALUES(:idcart,:idproduct)",[
			':idcart'=>$this->getidcart(),
			':idproduct'=>$product->getidproduct()
		]);

		$this->getCalculateTotal();
	}

	//Remove um produto do carrinho
	//All==false --> remove apenas o primeiro produto
	//All==true --> remove todos os produtos
	public function removeProduct(Product $product, $all=false){

		$sql = new Sql();

		if($all){
			$sql->query("UPDATE tb_cartsproducts SET dtremoved  = NOW() WHERE idcart=:idcart AND idproduct = :idproduct AND dtremoved IS NULL",[
				":idcart"=>$this->getidcart(),
				":idproduct"=>$product->getidproduct()
			]);
		}else{
			$sql->query("UPDATE tb_cartsproducts SET dtremoved  = NOW() WHERE idcart=:idcart AND idproduct = :idproduct AND dtremoved IS NULL LIMIT 1",[
				":idcart"=>$this->getidcart(),
				":idproduct"=>$product->getidproduct()
				]);
		}

		$this->getCalculateTotal();
	}

	//Retorna os produtos
	public function getProducts(){
		$sql = new Sql();

		$rows = $sql->select("
			SELECT b.idproduct, b.desproduct , b.vlprice, b.desurl, COUNT(*) AS nrqtd, SUM(b.vlprice) AS vltotal
			FROM tb_cartsproducts a 
			INNER JOIN tb_products b ON a.idproduct = b.idproduct 
			WHERE a.idcart =:idcart AND a.dtremoved IS NULL 
			GROUP BY b.idproduct,b.desproduct, b.vlprice
			ORDER BY b.desproduct",[
			':idcart'=>$this->getidcart()
		]);

		return Product::checkList($rows);
	}

	public function getProductsTotals()
	{

		$sql = new Sql();

		$results = $sql->select("
			SELECT SUM(vlprice) AS vlprice,  COUNT(*) AS nrqtd
			FROM tb_products a
			INNER JOIN tb_cartsproducts b ON a.idproduct = b.idproduct
			WHERE b.idcart = :idcart AND dtremoved IS NULL;
		", [
			':idcart'=>$this->getidcart()
		]);


		if (count($results) > 0) {
			return $results[0];
		} else {
			return [];
		}

	}

	public function setFreight($vlfreight)
	{


		return $this->setvlfreight($vlfreight);

	}

	public static function formatValueToDecimal($value):float
	{

		$value = str_replace('.', '', $value);
		return str_replace(',', '.', $value);

	}

	public static function setMsgError($msg)
	{

		$_SESSION[Cart::SESSION_ERROR] = $msg;

	}

	public static function getMsgError()
	{

		$msg = (isset($_SESSION[Cart::SESSION_ERROR])) ? $_SESSION[Cart::SESSION_ERROR] : "";

		Cart::clearMsgError();

		return $msg;

	}

	public static function clearMsgError()
	{

		$_SESSION[Cart::SESSION_ERROR] = NULL;

	}

	public function updateFreight()
	{

		if ($this->getdeszipcode() != '') {

			$this->setFreight($this->getdeszipcode());

		}

	}

	public function getValues()
	{

		$this->getCalculateTotal();



		return parent::getValues();

	}

	public function getCalculateTotal()
	{

		$this->updateFreight();

		$totals = $this->getProductsTotals();

		

		$this->setvlsubtotal($totals['vlprice']);
		$this->setvltotal($totals['vlprice'] + (float)$this->getvlfreight());

	}

	public static function removeFromSession()
	{
    	$_SESSION[Cart::SESSION] = NULL;
	}

	public static function setSuccess($msg)
	{

		$_SESSION[Cart::SUCCESS] = $msg;

	}

	public static function getSuccess()
	{

		$msg = (isset($_SESSION[Cart::SUCCESS]) && $_SESSION[Cart::SUCCESS]) ? $_SESSION[Cart::SUCCESS] : '';

		Cart::clearSuccess();

		return $msg;

	}

	public static function clearSuccess()
	{

		$_SESSION[Cart::SUCCESS] = NULL;

	}



}

 ?>