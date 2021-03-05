<?php 

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;
use \Projeto\Mailer;



class Avaliaction extends Model {

	const SUCCESS = "avaliactionSucesss";


	public function addAvaliactions()
	{

		$sql = new Sql();

		 $sql->select("CALL sp_avaliaction_add(:idproduct,:iduser,:desurl,:desproduct, :desperson, :desemail,:rate,:review)", [
			':idproduct'=>$this->getidproduct(),
			':iduser'=>$this->getiduser(),
			':desurl'=>$this->getdesurl(),
			':desproduct'=>$this->getdesproduct(),
			':desperson'=>$this->getdesperson(),
			':desemail'=>$this->getdesemail(),
			':rate'=>$this->getrate(),
			':review'=>$this->getreview()		
		]);	 	
	}

	public function getAvaliactions()
	{

		$sql = new Sql();

		return $sql->select("
			SELECT * FROM tb_avaliactions WHERE idproduct = :idproduct ORDER BY dtregister desc 
		", [

			':idproduct'=>$this->getidproduct()
		]);

	
	}

	public function getAvaliactionsID($iduser)
	{

		$sql = new Sql();

		return $sql->select("
			SELECT * FROM tb_avaliactions WHERE iduser = :iduser ORDER BY iduser desc 
		", [

			':iduser'=>$iduser
		]);

	
	}


	public function getFromIdProduct($idproduct)
	{

		$sql = new Sql();

		$rows = $sql->select("SELECT * FROM tb_products WHERE idproduct = :idproduct LIMIT 1", [
			':idproduct'=>$idproduct
		]);

		$this->setData($rows[0]);

	}

	public function getFromURL($desurl)
	{

		$sql = new Sql();

		$rows = $sql->select("SELECT * FROM tb_products WHERE desurl = :desurl LIMIT 1", [
			':desurl'=>$desurl
		]);

		$this->setData($rows[0]);

	}


	public static function avaliactionsTotal()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_avaliactions");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['avaliactionsTotal'=>(int)$resultTotal[0]["nrtotal"]];
	}

	public static function listAllAvaliactions()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_avaliactions ORDER BY dtregister desc");

	}

	public function getIdAvaliactions($idavaliaction)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_avaliactions  WHERE idavaliaction = :idavaliaction ", [
			':idavaliaction'=>$idavaliaction
		]);

		$this->setData($results[0]);

	}


	public function deleteAvaliactions()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_avaliactions WHERE idavaliaction = :idavaliaction", [
			':idavaliaction'=>$this->getidavaliaction()
		]);


	}

	public  function mediaAvaliactions()
	{

		$sql = new Sql();

		$media = $sql->select("SELECT idproduct, AVG(rate) AS media FROM tb_avaliactions WHERE idproduct = :idproduct",[

			':idproduct'=>$this->getidproduct()
		]);

	

		return ['avaliactions'=>(double)$media[0]["media"]];

		
	}


	public  function totalAvaliactions()
	{

		$sql = new Sql();

		$total = $sql->select("SELECT idproduct, count(rate) AS registros FROM tb_avaliactions WHERE idproduct = :idproduct",[

			':idproduct'=>$this->getidproduct()
		]);

		
		return ['avaliactions'=>(double)$total[0]["registros"]];
		
	}

	public static function setSuccess($msg)
	{

		$_SESSION[Avaliaction::SUCCESS] = $msg;

	}

	public static function getSuccess()
	{

		$msg = (isset($_SESSION[Avaliaction::SUCCESS]) && $_SESSION[Avaliaction::SUCCESS]) ? $_SESSION[Avaliaction::SUCCESS] : '';

		Avaliaction::clearSuccess();

		return $msg;

	}

	public static function clearSuccess()
	{

		$_SESSION[Avaliaction::SUCCESS] = NULL;

	}




}

?>