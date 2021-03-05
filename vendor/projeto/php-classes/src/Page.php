<?php 

namespace Projeto;

use \Rain\Tpl;
use \Projeto\Model\User;
use \Projeto\Model\Cart;

class Page {

	private $tpl;
	private $options = [];
	private $defaults = [
		"header"=>true,
		"footer"=>true,
		"data"=>["dir_url" => "http://www.ecommerce.com.br"  // variável
		]

	];

	public function __construct($opts = array(),$tpl_dir = "/views/")
	{

		$this->options = array_merge($this->defaults, $opts);

		$config = array(
		    "base_url"      => null,
		    "tpl_dir"       => $_SERVER['DOCUMENT_ROOT'].$tpl_dir,
		    "cache_dir"     => $_SERVER['DOCUMENT_ROOT']."/views-cache/",
		    "auto_escape"   => false,
		    "debug"         => true
		);

		Tpl::configure( $config );

		$this->tpl = new Tpl();

		if (isset($_SESSION[User::SESSION])) $this->tpl->assign("user", $_SESSION[User::SESSION]);

		

		//atribuindo os valores das váriaveis do Usuario na sessão.
		
		$pageName = explode("/categories/:idcategory", $_SERVER['REQUEST_URI']);
		$pageName = end($pageName);

		$this->tpl->assign("pageName", $pageName);

		if ($this->options['data']) $this->setData($this->options['data']);

		if ($this->options['header'] === true) $this->tpl->draw("header", false);

	}

	public function __destruct()
	{

		if ($this->options['footer'] === true) $this->tpl->draw("footer", false);

	}

	private function setData($data = array())
	{

		foreach($data as $key => $val)
		{

			$this->tpl->assign($key, $val);

		}

	}

	public function setTpl($tplname, $data = array(), $returnHTML = false)
	{

		$this->setData($data);

		return $this->tpl->draw($tplname, $returnHTML);

	}

}

 ?>