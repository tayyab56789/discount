<?php 
/*
 *  Shop extends QuieriesDB
 *  -----------------------
 *  -> registerShop
 *	-> updateShop
 *	-> selectAllShop
 *	-> selectOneShop
 *	-> selectShopByShopowner
 *	-> deleteShop
 *
 */
class Shop extends QuieriesDB

{
	/* ------------registerShop--------------*/
	function registerShop($conn,$values)
	{
		$values["shop_name"] = '\''.$values["shop_name"].'\'';
		$values["shop_icon"]= '\''.$values["shop_icon"].'\'';
		$values["shopowner_id"]= '\''.$values["shopowner_id"].'\'';
		$tableName = 'shop';
		return QuieriesDB::insert($conn,$tableName,$values);
	}

	/* ------------updateShop--------------*/
	function updateShop($conn,$values)
	{
		$tableName = 'shop';//`date_from`, `date_to`, `after_price`
		$condition= 'shop_id = '.$values["shop_id"];
		$values["shop_name"] = '\''.$values["shop_name"].'\'';
		$values["shop_icon"]= '\''.$values["shop_icon"].'\'';
		unset($values["shop_id"]);
		return QuieriesDB::update($conn,$tableName,$values,$condition);
	}

	/* ------------selectAllShop--------------*/
	function selectAllShop($conn)
	{
		$tableName = 'shop';
		$condition = '';
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn,$tableName,$column, $condition,$orderBy);
	}

	/* ------------selectOneShop--------------*/
	function selectOneShop($conn,$values)
	{
		$tableName = 'shop';
		$condition= 'shop_id = '.$values["shop_id"];
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn,$tableName,$column, $condition,$orderBy);
	}

	/* ------------selectShopByShopowner--------------*/
	function selectShopByShopowner($conn,$values)
	{
		$tableName = 'shop';
		$condition= 'shopowner_id = '.$values["shopowner_id"];
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn,$tableName,$column, $condition,$orderBy);
	}

	/* ------------deleteShop--------------*/
	function deleteShop($conn,$values)
	{
		$tableName="shop";
		$condition = 'shop_id = '.$values["shop_id"];
		return QuieriesDB::delete($conn,$tableName,$condition);
	}
};

?>