<?php

use \Projeto\Model\User;
use \Projeto\Model\Cart;
use \Projeto\Model\Product;
use \Projeto\Model\Category;
use \Projeto\Model\Brand;
use \Projeto\Model\Avaliaction;

	function formatPrice(float $vlprice)
	{

		return number_format($vlprice,2,",",".");
	}

	function formatMedia(float $number)
	{

		return number_format($number, 1, '.', '');
	}



	function formatDate($date)
	{

		return date('d/m/Y', strtotime($date));

	}



	function getCartNrQtd()
	{


		$cart = Cart::getFromSession();

		$totals = $cart->getProductsTotals();

		return $totals['nrqtd'];

	}

	function getCartVlSubTotal()
	{
		
		$cart = Cart::getFromSession();

		$totals = $cart->getProductsTotals();


		if($totals['vlprice'] != 0){

		return formatPrice($totals['vlprice']);
		}
		else{
			return  "0,00";
		}

	}

	

	function checkLogin($inadmin = true)
	{
		
		return User::checkLogin($inadmin);

	}

	function getUserName()
	{

		$res = User::getFromSession();

		$user =  $res->getdesperson();

		return utf8_decode($user);

	}


	function getEmail()
	{

		$user = User::getFromSession();

		return $user->getdesemail();

	}



	function average($idproduct){

		$avaliaction = new Avaliaction();

		$media = $avaliaction->getFromIdProduct($idproduct);

		$media = $avaliaction->mediaAvaliactions();

		$result = $media['avaliactions'];

		if($result == 0)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>" ;
		}
		else if($result <= 0.9)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star-half-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 1.0)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 1.9)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-half-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 2.0)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 2.9)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-half-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 3.0)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 3.9)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-half-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 4.0)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 4.9)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-half-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else 
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}

	}

	function averageRate($idbrand){

		$brand = new Brand();

		$media = $brand->get($idbrand);

		$media = $brand->mediaRates();

		$result = $media['rates'];

		if($result == 0)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>" ;
		}
		else if($result <= 0.9)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star-half-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 1.0)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 1.9)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-half-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 2.0)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 2.9)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-half-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 3.0)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 3.9)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-half-o'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 4.0)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else if($result <= 4.9)
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star-half-o'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}
		else 
		{
	    	return "<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>
			    	<i style='color:#FFD600;'class='fa fa-star'></i>	                                                         
			    	&nbsp<b>".number_format($result, 1, '.', '')."</b>" ;
		}

	}

	function totalUsers(){

		$total = User::total();

	   return  $total['usersTotal'];

	}

	function totalProducts(){

		$total = Product::total();

	   return  $total['productsTotal'];

	}

	function totalCategories()
	{

		$total = Category::total();

	   return  $total['categoriesTotal'];


	}

	function totalBrands(){

		$total = Brand::total();

	   return  $total['brandsTotal'];

	}

	function totalAvaliactions(){

		$total = Avaliaction::avaliactionsTotal();

	   return  $total['avaliactionsTotal'];

	}


?>