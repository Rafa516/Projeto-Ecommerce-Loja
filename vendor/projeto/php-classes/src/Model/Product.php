<?php 

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;
use \Projeto\Mailer;

class Product extends Model {

	public static function listAll()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_products ORDER BY desproduct");

	}

	public static function checkList($list)
	{

		foreach ($list as &$row) {
			
			$p = new Product();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}

	public static function total()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_products");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['productsTotal'=>(int)$resultTotal[0]["nrtotal"]];
	}


	public function save()
	{


		$sql = new Sql();

		$results = $sql->select("CALL sp_products_save(:idproduct, :desproduct,:vlprice,  :desurl, :desdescription)", array(
			":idproduct"=>$this->getidproduct(),
			":desproduct"=>$this->getdesproduct(),
			":vlprice"=>$this->getvlprice(),
		
			":desurl"=>$this->getdesurl(),
			":desdescription"=>$this->getdesdescription(),
		));

		
		$this->setData($results[0]);

		Product::movePhotos();

	}

	public function update()
	{


		$sql = new Sql();

		$results = $sql->select("CALL sp_products_save(:idproduct, :desproduct, :vlprice,  :desurl, :desdescription)", array(
			":idproduct"=>$this->getidproduct(),
			":desproduct"=>$this->getdesproduct(),
			":vlprice"=>$this->getvlprice(),
		
			":desurl"=>$this->getdesurl(),
			":desdescription"=>$this->getdesdescription(),
		));

		$this->setData($results[0]);


	}



	public function get($idproduct)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_products WHERE idproduct = :idproduct", [
			':idproduct'=>$idproduct
		]);

		$this->setData($results[0]);

	}

	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_products WHERE idproduct = :idproduct", [
			':idproduct'=>$this->getidproduct()
		]);

		/*$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"site" . DIRECTORY_SEPARATOR . 
			"img" . DIRECTORY_SEPARATOR . 
			"products" . DIRECTORY_SEPARATOR . 
			$name;
			unlink($img);*/

	}

	
	public static function totalPhotos($idproduct)
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_productphotos  WHERE idproduct = :idproduct", [
	         ':idproduct'=>$idproduct
	     ]);
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['totalPhotos'=>(int)$resultTotal[0]["nrtotal"]];
	}

	public function checkPhoto()
	{

			$sql = new Sql();

			 $results  = $sql->select("SELECT * FROM tb_productphotos WHERE idproduct = :idproduct", [
			':idproduct'=>$this->getidproduct()
			]);

			
			 $res = ['name'=>$results[0]["namephoto"]];

			 $name = $res['name'];
			

			if (file_exists(
			$_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"site" . DIRECTORY_SEPARATOR . 
			"img" . DIRECTORY_SEPARATOR . 
			"products" . DIRECTORY_SEPARATOR .
			$name)){
				
			$url = "/res/site/img/products/".$name;	
			} else {

			$url = "/res/site/img/product.jpg";

		}
			

		return $this->setdesphoto($url);

	}



	public function getValues()
	{

		$this->checkPhoto();
		

		$values = parent::getValues();

		return $values;

	}

	public function getItens()
	{
	

		$values = parent::getValues();

		return $values;

	}


	public function movePhotos()
	{
		 				
			    $arquivo = isset($_FILES['namephoto']) ? $_FILES['namephoto'] : FALSE;
			    //loop para ler as imagens
			    for ($controle = 0; $controle < count($arquivo['name']); $controle++){ 


					$directory = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
						"res" . DIRECTORY_SEPARATOR . 
						"site" . DIRECTORY_SEPARATOR . 
						"img" . DIRECTORY_SEPARATOR . 
						"products" . DIRECTORY_SEPARATOR . 
						 $arquivo['name'][$controle];

						$namePhoto = $arquivo['name'][$controle];
			   
				    $sql = new Sql();
				    $sql->select("CALL sp_image_products_add(:idproduct, :namephoto)", array(
						":idproduct"=>$this->getidproduct(),
						":namephoto"=>$namePhoto ));
	      
				    move_uploaded_file($arquivo['tmp_name'][$controle], $directory);

			      }
		
	}

	public function showPhotos()
	{
	     $sql = new Sql();
	    
	     $resultsExistPhoto = $sql->select("SELECT * FROM tb_productphotos WHERE idproduct = :idproduct", [
	         ':idproduct'=>$this->getidproduct()
	     ]);


	     $countResultsPhoto = count($resultsExistPhoto);
	     if ($countResultsPhoto > 0)
	     {
	         foreach ($resultsExistPhoto as &$result)
	         {
	             foreach ($result as $key => $value) {
	                 if ($key === "namephoto") {
	                     $result["desphoto"] = '/res/site/img/products/'. $result['namephoto'];
	                 }
	             }
	         } 
	     
	     return $resultsExistPhoto;
	 	 }
	}

	public   function getPhotos($idphoto)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_productphotos WHERE idphoto = :idphoto", [
			':idphoto'=>$idphoto	
		]);	

	}

	public function deletePhoto($idphoto)
	{

		$sql = new Sql();

	 	 $sql->query("DELETE FROM tb_productphotos WHERE idphoto = :idphoto", [
			':idphoto'=>$idphoto
		]);

	}

	public function getFromURL($desurl)
	{

		$sql = new Sql();

		$rows = $sql->select("SELECT * FROM tb_products WHERE desurl = :desurl LIMIT 1", [
			':desurl'=>$desurl
		]);

		$this->setData($rows[0]);

	}



	public function getCategories()
	{

		$sql = new Sql();

		return $sql->select("
			SELECT * FROM tb_categories a INNER JOIN tb_productscategories b ON a.idcategory = b.idcategory WHERE b.idproduct = :idproduct
		", [

			':idproduct'=>$this->getidproduct()
		]);

	}

	public function getBrands()
	{

		$sql = new Sql();

		return $sql->select("
			SELECT * FROM tb_brands a INNER JOIN tb_productsbrands b ON a.idbrand = b.idbrand WHERE b.idproduct = :idproduct
		", [

			':idproduct'=>$this->getidproduct()
		]);

	}

	public static function getPage($page = 1, $itemsPerPage = 1)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_products 
			ORDER BY desproduct
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
			FROM tb_products 
			WHERE desproduct LIKE :search
			ORDER BY desproduct
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

	public function getProductsCarousel($related = true)
	{
		$sql = new Sql();

		if ($related === true) {

			return $sql->select("
				SELECT * FROM tb_products WHERE idproduct IN(
					SELECT a.idproduct
					FROM tb_products a
					INNER JOIN tb_productscarousel b ON a.idproduct = b.idproduct
					WHERE b.idcarousel = :idcarousel
				);
			", [
				':idcarousel'=>$this->getidcarousel()
			]);

		} else {

			return $sql->select("
				SELECT * FROM tb_products WHERE idproduct NOT IN(
					SELECT a.idproduct
					FROM tb_products a
					INNER JOIN tb_productscarousel b ON a.idproduct = b.idproduct
					WHERE b.idcarousel= :idcarousel
				);
			", [
				':idcarousel'=>$this->getidcarousel()
			]);

		}

	}


	public function getCarousel($idcarousel)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_carousel WHERE idcarousel = :idcarousel", [
			':idcarousel'=>$idcarousel
		]);

		$this->setData($results[0]);

	}

	public function addProductCarousel(Product $product)
	{

		$sql = new Sql();

		 $sql->query("INSERT INTO tb_productscarousel (idcarousel, idproduct,desurl,desproduct,vlprice) VALUES(:idcarousel, :idproduct,:desurl,:desproduct,:vlprice)", [
			':idcarousel'=>$this->getidcarousel(),
			':idproduct'=>$product->getidproduct(),
			':desurl'=>$product->getdesurl(),
			':desproduct'=>$product->getdesproduct(),
			':vlprice'=>$product->getvlprice()
		]);

	}

	public function removeProductCarousel(Product $product)
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_productscarousel WHERE idcarousel = :idcarousel AND idproduct = :idproduct", [
			':idcarousel'=>$this->getidcarousel(),
			':idproduct'=>$product->getidproduct(),
			
		]);



	}

	public static function listAllCarousel()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_productscarousel ORDER BY idproduct");

	}


}
