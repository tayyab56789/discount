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
		//$values["p_stock"] = $values["p_stock"];
		//$values["date_created"] = '\'' . $values["date_created"] . '\'';
		//$values["d_id"] = $values["d_id"];
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
		//$values["p_stock"] = $values["p_stock"];
		//$values["date_created"] = '\'' . $values["date_created"] . '\'';
		//$values["d_id"] = $values["d_id"];
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
	function showAllProductName($conn) 
	{
		$tableName = 'products';
		$condition = '';
		$orderBy = '';
		$column = 'p_name';
		return QuieriesDB::select($conn, $tableName, $column, $condition, $orderBy);
	}
	function selectProductsByCategory($conn, $values)
	{
		$tableName = 'products';
		$condition = 'p_category = "' . $values["p_category"] . '"';
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn, $tableName, $column, $condition, $orderBy);
	}

	function selectProductsByCategoryCustomSelect($conn, $values){
		$query ='SELECT products.p_id, products.p_name, products.p_description, products.p_category, products.p_image_id, products.p_price, products.p_stock, products.shop_id, discount.d_id, discount.date_from, discount.date_to,shop.shop_id, shop.shop_name, shop.shop_icon, discount.after_price FROM products, discount, shop where CAST(discount.p_id AS UNSIGNED) = products.p_id AND products.shop_id = shop.shop_id AND products.p_category = "'.$values['p_category'].'" AND discount.date_to > now()  ORDER BY discount.date_to ASC';
		return QuieriesDB::custom($conn,$query);
	}
	function selectProductsByCategoryCustomSelectByid($conn, $values){
		$query ='SELECT products.p_id, products.p_name, products.p_description, products.p_category, products.p_image_id, products.p_price, products.p_stock, products.shop_id, discount.d_id, discount.date_from, discount.date_to,shop.shop_id, shop.shop_name, shop.shop_icon, discount.after_price FROM products, discount, shop where CAST(discount.p_id AS UNSIGNED) = products.p_id AND products.shop_id = shop.shop_id AND products.p_id = "'.$values['p_id'].'" ORDER BY discount.date_to DESC';
		return QuieriesDB::custom($conn,$query);
	}
	function selectAllProductsCustomSelect($conn){
		$query ='SELECT products.p_id, products.p_name, products.p_description, products.p_category, products.p_image_id, products.p_price, products.p_stock, products.shop_id, discount.d_id, discount.date_from, discount.date_to,shop.shop_id, shop.shop_name, shop.shop_icon, discount.after_price FROM products, discount, shop where CAST(discount.p_id AS UNSIGNED) = products.p_id AND products.shop_id = shop.shop_id AND discount.date_to > now() ORDER BY discount.date_to DESC';
		return QuieriesDB::custom($conn,$query);
	}
	function selectProductsBySearch($conn, $values){
		$query ='SELECT products.p_id, products.p_name, products.p_description, products.p_category, products.p_image_id, products.p_price, products.p_stock, products.shop_id, discount.d_id, discount.date_from, discount.date_to,shop.shop_id, shop.shop_name, shop.shop_icon, discount.after_price FROM products, discount, shop where CAST(discount.p_id AS UNSIGNED) = products.p_id AND products.shop_id = shop.shop_id AND products.p_name LIKE "%'.$values['search'].'%" AND discount.date_to > now() ORDER BY discount.date_to DESC';
		return QuieriesDB::custom($conn,$query);
	}
};

?>