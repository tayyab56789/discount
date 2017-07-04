<?php

/*
*  Discount extends QuieriesDB
*  -----------------------
*  -> addDiscount
*	-> updateDiscount
*	-> ShowAllDiscounts
*	-> showOneDiscount
*	-> showDiscountByProduct
*	-> deleteDiscount
*
*/
class Discount extends QuieriesDB

{
	/* ------------addDiscount--------------*/
	function addDiscount($conn, $values)
	{
		$values["date_from"] = '\'' . $values["date_from"] . '\'';
		$values["date_to"] = '\'' . $values["date_to"] . '\'';
		$values["after_price"] = $values["after_price"];
		$values["p_id"] = '\'' . $values["p_id"] . '\'';
		$tableName = 'discount';
		return QuieriesDB::insert($conn, $tableName, $values);
	}

	/* ------------updateDiscount--------------*/
	function updateDiscount($conn, $values)
	{
		$tableName = 'discount'; //`date_from`, `date_to`, `after_price`
		$condition = 'd_id = ' . $values["d_id"];
		$values["date_from"] = '\'' . $values["date_from"] . '\'';
		$values["date_to"] = '\'' . $values["date_to"] . '\'';
		$values["after_price"] = $values["after_price"];
		$values["p_id"] = '\'' . $values["p_id"] . '\'';
		unset($values["d_id"]);
		return QuieriesDB::update($conn, $tableName, $values, $condition);
	}

	/* ------------ShowAllDiscounts--------------*/
	function ShowAllDiscounts($conn, $values)
	{
		$tableName = 'discount';
		$condition = '';
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn, $tableName, $column, $condition, $orderBy);
	}

	/* ------------showOneDiscount--------------*/
	function showOneDiscount($conn, $values)
	{
		$tableName = 'discount';
		$condition = 'd_id = ' . $values["d_id"];
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn, $tableName, $column, $condition, $orderBy);
	}

	/* ------------showDiscountByProduct--------------*/
	function showDiscountByProduct($conn, $values)
	{
		$tableName = 'discount';
		$condition = 'p_id = "' . $values["p_id"] . '"';
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn, $tableName, $column, $condition, $orderBy);
	}

	/* ------------deleteDiscount--------------*/
	function deleteDiscount($conn, $values)
	{
		$tableName = "discount";
		$condition = 'd_id = ' . $values["d_id"];
		return QuieriesDB::delete($conn, $tableName, $condition);
	}
};

?>