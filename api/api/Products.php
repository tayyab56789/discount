<?php

/*
*  Products extends QuieriesDB
*  -----------------------
*  -> addProduct
*	-> updateProduct
*	-> selectAllProducts
*	-> selectOneProduct
*	-> selectProductsByShop
*	-> deleteProduct
*
*/
class Products extends QuieriesDB

{
	/* ------------addProduct--------------*/
	function addProduct($conn, $values)
	{
		$values["p_name"] = '\'' . $values["p_name"] . '\'';
		$values["p_description"] = '\'' . $values["p_description"] . '\'';
		$values["p_category"] = '\'' . $values["p_category"] . '\'';
		$values["p_image_id"] = '\'' . $values["p_image_id"] . '\'';
		$values["p_price"] = $values["p_price"];
		$values["p_stock"] = $values["p_stock"];
		$values["date_created"] = '\'' . $values["date_created"] . '\'';
		$values["d_id"] = $values["d_id"];
		$values["shop_id"] = '\'' . $values["shop_id"] . '\'';
		$tableName = 'products';
		return QuieriesDB::insert($conn, $tableName, $values);
	}

	/* ------------updateProduct--------------*/
	function updateProduct($conn, $values)
	{
		$tableName = 'products'; //`date_from`, `date_to`, `after_price`
		$condition = 'p_id = ' . $values["p_id"];
		$values["p_name"] = '\'' . $values["p_name"] . '\'';
		$values["p_description"] = '\'' . $values["p_description"] . '\'';
		$values["p_category"] = '\'' . $values["p_category"] . '\'';
		$values["p_image_id"] = '\'' . $values["p_image_id"] . '\'';
		$values["p_price"] = $values["p_price"];
		$values["p_stock"] = $values["p_stock"];
		$values["date_created"] = '\'' . $values["date_created"] . '\'';
		$values["d_id"] = $values["d_id"];
		$values["shop_id"] = '\'' . $values["shop_id"] . '\'';
		unset($values["p_id"]);
		return QuieriesDB::update($conn, $tableName, $values, $condition);
	}

	/* ------------selectAllProducts--------------*/
	function selectAllProducts($conn)
	{
		$tableName = 'products';
		$condition = '';
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn, $tableName, $column, $condition, $orderBy);
	}

	/* ------------selectOneProduct--------------*/
	function selectOneProduct($conn, $values)
	{
		$tableName = 'products';
		$condition = 'p_id = ' . $values["p_id"];
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn, $tableName, $column, $condition, $orderBy);
	}

	/* ------------selectProductsByShop--------------*/
	function selectProductsByShop($conn, $values)
	{
		$tableName = 'products';
		$condition = 'shop_id = ' . $values["shop_id"];
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn, $tableName, $column, $condition, $orderBy);
	}

	/* ------------deleteProduct--------------*/
	function deleteProduct($conn, $values)
	{
		$tableName = "products";
		$condition = 'p_id = ' . $values["p_id"];
		return QuieriesDB::delete($conn, $tableName, $condition);
	}
};

?>