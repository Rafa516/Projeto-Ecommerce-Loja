<?php 

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;
use \Projeto\Mailer;

class Brand extends Model {

	const ERROR_RATE = "ErrorRate";
	const SUCCESS = "Sucesss";

	public static function listAll()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_brands ORDER BY desbrand");

	}

	public static function checkList($list)
	{

		foreach ($list as &$row) {
			
			$p = new Brand();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}

	public function save()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_brands_save(:idbrand, :desbrand)", array(
			":idbrand"=>$this->getidbrand(),
			":desbrand"=>$this->getdesbrand(),
		));

		$this->setData($results[0]);

		Brand::updateFile();

	}

	

	public function get($idbrand)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_brands WHERE idbrand = :idbrand", [
			':idbrand'=>$idbrand
		]);

		$this->setData($results[0]);

	}

	public function addRate()
	{

		$sql = new Sql();

		 $sql->select("CALL sp_add_rate(:idbrand,:iduser,:desbrand, :desperson, :desemail,:rate)", [
			':idbrand'=>$this->getidbrand(),
			':iduser'=>$this->getiduser(),
			':desbrand'=>$this->getdesbrand(),
			':desperson'=>$this->getdesperson(),
			':desemail'=>$this->getdesemail(),
			':rate'=>$this->getrate(),		
		]);	 	
	}


	public  function mediaRates()
	{

		$sql = new Sql();

		$media = $sql->select("SELECT idbrand, AVG(rate) AS media FROM tb_rate_brands WHERE idbrand= :idbrand",[

			':idbrand'=>$this->getidbrand()
		]);

	

		return ['rates'=>(double)$media[0]["media"]];

		
	}

	public static function checkRateExist($idbrand,$iduser)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_rate_brands  WHERE  idbrand = :idbrand AND iduser = :iduser", 
			[
			':idbrand'=>$idbrand,
			':iduser'=>$iduser
		
			]);

		return (count($results) > 0);
	}


	public static function setErrorRate($msg)
	{

		$_SESSION[Brand::ERROR_RATE] = $msg;

	}

	public static function getErrorRate()
	{

		$msg = (isset($_SESSION[Brand::ERROR_RATE]) && $_SESSION[Brand::ERROR_RATE]) ? $_SESSION[Brand::ERROR_RATE] : '';

		Brand::clearErrorRate();

		return $msg;

	}

	public static function clearErrorRate()
	{

		$_SESSION[Brand::ERROR_RATE] = NULL;

	}

	public static function setSuccess($msg)
	{

		$_SESSION[Brand::SUCCESS] = $msg;

	}

	public static function getSuccess()
	{

		$msg = (isset($_SESSION[Brand::SUCCESS]) && $_SESSION[Brand::SUCCESS]) ? $_SESSION[Brand::SUCCESS] : '';

		Brand::clearSuccess();

		return $msg;

	}

	public static function clearSuccess()
	{

		$_SESSION[Brand::SUCCESS] = NULL;

	}




	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_brands WHERE idbrand = :idbrand", [
			':idbrand'=>$this->getidbrand()
		]);

			Brand::updateFile();
	}

	public static function updateFile()
	{

		$brands = Brand::listAll();

		$html = [];

		foreach ($brands as $row) {
			array_push($html, '<li><a href="/brand/'.$row['idbrand'].'">'.$row['desbrand'].'</a></li>');
		}

		file_put_contents($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "brands-menu.html", implode('', $html));

	}

	public static function total()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_brands");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['brandsTotal'=>(int)$resultTotal[0]["nrtotal"]];
	}

	public function checkPhoto()
	{

		if (file_exists(
			$_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"site" . DIRECTORY_SEPARATOR . 
			"img" . DIRECTORY_SEPARATOR . 
			"brands" . DIRECTORY_SEPARATOR . 
			$this->getidbrand() . ".jpg"
			)) {

			$url = "/res/site/img/brands/" . $this->getidbrand() . ".jpg";

		} else {

			$url = "/res/site/img/brand.jpeg";

		}

		return $this->setdesphoto($url);

	}

	public function getValues()
	{

		$this->checkPhoto();

		$values = parent::getValues();

		return $values;

	}

	public function setPhoto($file)
	{

		$extension = explode('.', $file['name']);
		$extension = end($extension);

		switch ($extension) {

			case "jpg":
			case "jpeg":
			$image = imagecreatefromjpeg($file["tmp_name"]);
			break;

			case "gif":
			$image = imagecreatefromgif($file["tmp_name"]);
			break;

			case "png":
			$image = imagecreatefrompng($file["tmp_name"]);
			break;

		}

		$dist = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"site" . DIRECTORY_SEPARATOR . 
			"img" . DIRECTORY_SEPARATOR . 
			"brands" . DIRECTORY_SEPARATOR . 
			$this->getidbrand() . ".jpg";

		imagejpeg($image, $dist);

		imagedestroy($image);

		$this->checkPhoto();

	}

	public function getProducts($related = true)
	{

		$sql = new Sql();

		if ($related === true) {

			return $sql->select("
				SELECT * FROM tb_products WHERE idproduct IN(
					SELECT a.idproduct
					FROM tb_products a
					INNER JOIN tb_productsbrands b ON a.idproduct = b.idproduct
					WHERE b.idbrand = :idbrand
				);
			", [
				':idbrand'=>$this->getidbrand()
			]);

		} else {

			return $sql->select("
				SELECT * FROM tb_products WHERE idproduct NOT IN(
					SELECT a.idproduct
					FROM tb_products a
					INNER JOIN tb_productsbrands b ON a.idproduct = b.idproduct
					WHERE b.idbrand = :idbrand
				);
			", [
				':idbrand'=>$this->getidbrand()
			]);

		}

	}

	public function addProduct(Product $product)
	{

		$sql = new Sql();

		$sql->query("INSERT INTO tb_productsbrands (idbrand, idproduct) VALUES(:idbrand, :idproduct)", [
			':idbrand'=>$this->getidbrand(),
			':idproduct'=>$product->getidproduct()
		]);

	}

	public function removeProduct(Product $product)
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_productsbrands WHERE idbrand = :idbrand AND idproduct = :idproduct", [
			':idbrand'=>$this->getidbrand(),
			':idproduct'=>$product->getidproduct()
		]);

	}

	public function getProductsPage($page = 1, $itemsPerPage = 12)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_products a
			INNER JOIN tb_productsbrands b ON a.idproduct = b.idproduct
			INNER JOIN tb_brands c ON c.idbrand = b.idbrand
			WHERE c.idbrand = :idbrand
			LIMIT $start, $itemsPerPage;
		", [
			':idbrand'=>$this->getidbrand()
		]);

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>Product::checkList($results),
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	public static function getPage($page = 1, $itemsPerPage = 10)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_brands 
			ORDER BY idbrand
			LIMIT $start, $itemsPerPage;
		");

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}

	public static function getPageSearch($search, $page = 1, $itemsPerPage = 10)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_brands 
			WHERE desbrand LIKE :search  OR idbrand LIKE :search
			ORDER BY idbrand
			LIMIT $start, $itemsPerPage;
		", [
			':search'=>'%'.$search.'%'
		]);

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}
}

	

 ?>