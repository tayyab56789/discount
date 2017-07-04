<?php 
/*
 *  ShopOwner extends QuieriesDB
 *  -----------------------------
 *  -> signup
 *	-> signin
 *	-> showAllUsers
 *	-> updateUser
 */
class ShopOwner extends QuieriesDB

{
	/* ------------signup--------------*/
	function signup($conn,$values)
	{
		$values["e_mail"] = '\''.$values["e_mail"].'\'';
		$values["password"]= '\''.md5($values["password"]).'\'';
		$values["phone"]= '\''.$values["phone"].'\'';
		$values["address"]= '\''.$values["address"].'\'';
		$tableName = 'shopowner';
		return QuieriesDB::insert($conn,$tableName,$values);
	}

	/* ------------signin--------------*/
	function signin($conn,$values)
	{
		$values["e_mail"] = '\''.$values["e_mail"].'\'';
		$values["password"]= '\''.md5($values["password"]).'\'';
		$tableName = 'shopowner';
		$condition = 'e_mail = '.$values["e_mail"].' AND password ='.$values["password"];
		$orderBy = '';
		$column = '*';
		$results = QuieriesDB::select($conn,$tableName,$column, $condition,$orderBy);
		$resultArray = json_decode($results);
		if(isset($resultArray->shopowner[0]->id)) {
			$_SESSION["user_id"] = $resultArray->shopowner[0]->id;
		}
		return $results;
	}

	/* ------------showAllUsers--------------*/
	function showAllUsers($conn)
	{
		$tableName = 'shopowner';
		$condition = '';
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn,$tableName,$column, $condition,$orderBy);
	}

	/* ------------updateUser--------------*/
	function updateUser($conn,$values)
	{
		$tableName = 'shopowner';//`date_from`, `date_to`, `after_price`
		$condition= 'id = '.$values["id"];
		$values["e_mail"] = '\''.$values["e_mail"].'\'';
		$values["password"]= '\''.md5($values["password"]).'\'';
		$values["phone"]= '\''.$values["phone"].'\'';
		$values["address"]= '\''.$values["address"].'\'';
		unset($values["id"]);
		return QuieriesDB::update($conn,$tableName,$values,$condition);
	}
	/* ------------deleteUser--------------*/
	function deleteUser($conn,$values)
	{
		$tableName="shopowner";
		$condition = 'id = '.$values["id"];
		return QuieriesDB::delete($conn,$tableName,$condition);
	}
	function checkUserLogin($conn){
		$login= false;
		if(isset($_SESSION["user_id"])){
			$login= true;
		}
		else{
			$login= false;
		}
		$result= array(
					"user_login" => $login,
				);
				return json_encode($result);
	}
};

?>