<?php

/*
 * ConnectDB connect to database 
 *	-> connectionWithDB
 *
 * QuieriesDB universal queiries class
 *	-> insert
 *	-> select
 *	-> delete
 *	-> update 
 *
 * ShopOwner extends QuieriesDB
 *  -> signup
 *	-> signin
 *	-> showAllUsers
 *	-> updateUser
 *	
 * Shop extends QuieriesDB
 *	-> registerShop
 *	-> updateShop
 *	->
 *	->
 */

class ConnectDB{
	public function connectionWithDB($servername,$username,$password,$dbname){
        $conn = mysqli_connect($servername, $username, $password, $dbname);
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		else{
			return $conn;
		}
    }
};

class QuieriesDB{
	/*------------  insert function  -------------------*/
	public function insert($conn,$tableName,$values){
		//$result = array();
		if(!empty($values)){
			$tableColumns = implode(',',array_keys($values));
			$tableValues = implode(',',array_values($values));
			$sql = "INSERT INTO $tableName ($tableColumns)
			VALUES ($tableValues)";
			if (mysqli_query($conn, $sql)) {
				$last_id = mysqli_insert_id($conn);
				unset($values["password"]);
				$result= array(
					"message" => "success",
					"code" => "304",
					"id" => $last_id,
					"values" => array(
						$values
					)
				);
				return json_encode($result);
			   
			} else {
			    $result= array(
					"error" => mysqli_error($conn),
					"code" => "404"
				);
				return json_encode($result);
			}
		}	
	}

	/*------------  Select function  -------------------*/
	public function select($conn,$tableName,$column, $condition,$orderBy){
		if(count($column) > 1){
			$tableColumns = implode(',',$column);
		}else{
			$tableColumns= '*';
		}
		$sql = "SELECT $tableColumns FROM $tableName";
		if(!empty($condition) || trim($condition) != ''){
			$sql .= " WHERE $condition";
		}
		if(!empty($orderBy) || trim($orderBy) != ''){
			$sql .= " ORDER BY $orderBy";
		}
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
		    $results = array();
			while($row = mysqli_fetch_assoc($result))
			{
				if($tableName =='discount'){
					$results["discount"][] = array(
				      'd_id' => $row['d_id'],
				      'date_from' => $row['date_from'],
				      'date_to' => $row['date_to'],
				      'after_price' => $row['after_price']
				   );
				}else if($tableName =='shopowner'){
					$results["shopowner"][] = array(
				      'id' => $row['id'],
				      'e_mail' => $row['e_mail'],
				      'phone' => $row['phone'],
				      'address' => $row['address']
				   );
				}else if($tableName =='shop'){
					$results["shop"][] = array(
				      'shop_id' => $row['shop_id'],
				      'shop_name' => $row['shop_name'],
				      'shop_icon' => $row['shop_icon'],
				      'shopowner_id' => $row['shopowner_id']
				   );
				}
				else{
					$results[$tableName][]=$row;
				}			   
			}
			return json_encode($results);
		} else {
		    $result= array(
					"error" => mysqli_error($conn),
					"code" => "404"
				);
				return json_encode($result);
		}
	}

	/*------------  delete function  -------------------*/
	public function delete($conn,$tableName,$condition){
		$sql = "DELETE FROM $tableName WHERE $condition";
		if (mysqli_query($conn, $sql)) {
		    $result= array(
				"message" => "success",
				"code" => "304"
			);
			return json_encode($result);
		} else {
		    $result= array(
				"error" => mysqli_error($conn),
				"code" => "404"
			);
			return json_encode($result);
		}
	}

	/*------------  update function  -------------------*/
	public function update($conn,$tableName,$values,$condition){
		//$result = array();
		if(!empty($values)){
			$tableColumns = array_keys($values);
			$tableValues = array_values($values);
			$tableUpdatedValue = array();
			$counter = count($tableColumns);
			for($i=0; $i<$counter; $i++){
				$tableUpdatedValue[$i] = $tableColumns[$i]."=".$tableValues[$i];
			}
			$tableUpdatedValues= implode(',',$tableUpdatedValue);
			$sql = "UPDATE $tableName SET $tableUpdatedValues WHERE $condition";
			if (mysqli_query($conn, $sql)) {
				
				$result= array(
					"message" => "success",
					"code" => "304",
					"values" => array(
						$values
					)
				);
				return json_encode($result);
			} else {
			    $result= array(
					"error" => mysqli_error($conn),
					"code" => "404"
				);
				return json_encode($result);
			}
		}	
	}
};


/*------------------shopowner class --------------------*/
class ShopOwner extends QuieriesDB{
	/* ------------signup--------------*/
	function signup($conn,$values){
		$values["e_mail"] = '\''.$values["e_mail"].'\'';
		$values["password"]= '\''.md5($values["password"]).'\'';
		$values["phone"]= '\''.$values["phone"].'\'';
		$values["address"]= '\''.$values["address"].'\'';
		$tableName = 'shopowner';
		return QuieriesDB::insert($conn,$tableName,$values);
	}
	/* ------------signin--------------*/
	function signin($conn,$values){
		$values["e_mail"] = '\''.$values["e_mail"].'\'';
		$values["password"]= '\''.md5($values["password"]).'\'';
		$tableName = 'shopowner';
		$condition = 'e_mail = '.$values["e_mail"].' AND password ='.$values["password"];
		$orderBy = '';
		$column = '*';
		$results = QuieriesDB::select($conn,$tableName,$column, $condition,$orderBy);
		$resultArray = json_decode($results);
		$_SESSION["user_id"] = $resultArray->shopowner[0]->id;
		return $results;
	}
	/* ------------showAllUsers--------------*/
	function showAllUsers($conn){
		$tableName = 'shopowner';
		$condition = '';
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn,$tableName,$column, $condition,$orderBy);
	}
	/* ------------updateUser--------------*/
	function updateUser($conn,$values){
		$tableName = 'shopowner';//`date_from`, `date_to`, `after_price`
		$condition= 'id = '.$values["id"];
		$values["e_mail"] = '\''.$values["e_mail"].'\'';
		$values["password"]= '\''.md5($values["password"]).'\'';
		$values["phone"]= '\''.$values["phone"].'\'';
		$values["address"]= '\''.$values["address"].'\'';
		unset($values["id"]);
		return QuieriesDB::update($conn,$tableName,$values,$condition);
	}
};

class Shop extends QuieriesDB{
	/* ------------registerShop--------------*/
	function registerShop($conn,$values){
		$values["shop_name"] = '\''.$values["shop_name"].'\'';
		$values["shop_icon"]= '\''.$values["shop_icon"].'\'';
		$values["shopowner_id"]= '\''.$values["shopowner_id"].'\'';
		$tableName = 'shop';
		return QuieriesDB::insert($conn,$tableName,$values);
	}
	/* ------------updateShop--------------*/
	function updateShop($conn,$values){
		$tableName = 'shop';//`date_from`, `date_to`, `after_price`
		$condition= 'shop_id = '.$values["shop_id"];
		$values["shop_name"] = '\''.$values["shop_name"].'\'';
		$values["shop_icon"]= '\''.$values["shop_icon"].'\'';
		unset($values["shop_id"]);
		return QuieriesDB::update($conn,$tableName,$values,$condition);
	}
	/* ------------selectAllShop--------------*/
	function selectAllShop($conn){
		$tableName = 'shop';
		$condition = '';
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn,$tableName,$column, $condition,$orderBy);
	}
	/* ------------selectOneShop--------------*/
	function selectOneShop($conn,$values){
		$tableName = 'shop';
		$condition= 'shop_id = '.$values["shop_id"];
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn,$tableName,$column, $condition,$orderBy);
	}
	/* ------------selectShopByShopowner--------------*/
	function selectShopByShopowner($conn,$values){
		$tableName = 'shop';
		$condition= 'shopowner_id = '.$values["shopowner_id"];
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn,$tableName,$column, $condition,$orderBy);
	}
	function deleteShop($conn,$values){
		$tableName="shop";
		$condition = 'shop_id = '.$values["shop_id"];
		return QuieriesDB::delete($conn,$tableName,$condition);
	}
}

class Products extends QuieriesDB{
	/* ------------addProduct--------------*/
	function addProduct($conn,$values){
		$values["p_name"] = '\''.$values["p_name"].'\'';
		$values["p_description"] = '\''.$values["p_description"].'\'';
		$values["p_category"] = '\''.$values["p_category"].'\'';
		$values["p_image_id"] = '\''.$values["p_image_id"].'\'';
		$values["p_price"] = $values["p_price"];
		$values["p_stock"] = $values["p_stock"];
		$values["date_created"] = '\''.$values["date_created"].'\'';
		$values["d_id"] = $values["d_id"];
		$values["shop_id"] = '\''.$values["shop_id"].'\'';
		$tableName = 'products';
		return QuieriesDB::insert($conn,$tableName,$values);
	}
	/* ------------updateProduct--------------*/
	function updateProduct($conn,$values){
		$tableName = 'products';//`date_from`, `date_to`, `after_price`
		$condition= 'p_id = '.$values["p_id"];
		$values["p_name"] = '\''.$values["p_name"].'\'';
		$values["p_description"] = '\''.$values["p_description"].'\'';
		$values["p_category"] = '\''.$values["p_category"].'\'';
		$values["p_image_id"] = '\''.$values["p_image_id"].'\'';
		$values["p_price"] = $values["p_price"];
		$values["p_stock"] = $values["p_stock"];
		$values["date_created"] = '\''.$values["date_created"].'\'';
		$values["d_id"] = $values["d_id"];
		$values["shop_id"] = '\''.$values["shop_id"].'\'';
		unset($values["p_id"]);
		return QuieriesDB::update($conn,$tableName,$values,$condition);
	}
	/* ------------selectAllProducts--------------*/
	function selectAllProducts($conn){
		$tableName = 'products';
		$condition = '';
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn,$tableName,$column, $condition,$orderBy);
	}
	/* ------------selectOneProduct--------------*/
	function selectOneProduct($conn,$values){
		$tableName = 'products';
		$condition= 'p_id = '.$values["p_id"];
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn,$tableName,$column, $condition,$orderBy);
	}
	/* ------------selectProductsByShop--------------*/
	function selectProductsByShop($conn,$values){
		$tableName = 'products';
		$condition= 'shop_id = '.$values["shop_id"];
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn,$tableName,$column, $condition,$orderBy);
	}
	/* ------------deleteProduct--------------*/
	function deleteProduct($conn,$values){
		$tableName="products";
		$condition = 'p_id = '.$values["p_id"];
		return QuieriesDB::delete($conn,$tableName,$condition);
	}
}

class Discount extends QuieriesDB{
	/* ------------addDiscount--------------*/
	function addDiscount($conn,$values){
		$values["date_from"] = '\''.$values["date_from"].'\'';
		$values["date_to"] = '\''.$values["date_to"].'\'';
		$values["after_price"] = .$values["after_price"];
		$values["p_id"] = '\''.$values["p_id"].'\'';
		$tableName = 'discount';
		return QuieriesDB::insert($conn,$tableName,$values);
	}
	/* ------------updateDiscount--------------*/
	function updateDiscount($conn,$values){
		$tableName = 'discount';//`date_from`, `date_to`, `after_price`
		$condition= 'd_id = '.$values["d_id"];
		$values["date_from"] = '\''.$values["date_from"].'\'';
		$values["date_to"] = '\''.$values["date_to"].'\'';
		$values["after_price"] = .$values["after_price"];
		$values["p_id"] = '\''.$values["p_id"].'\'';
		unset($values["d_id"]);
		return QuieriesDB::update($conn,$tableName,$values,$condition);
	}
	/* ------------ShowAllDiscounts--------------*/
	function ShowAllDiscounts($conn,$values){
		$tableName = 'discount';
		$condition = '';
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn,$tableName,$column, $condition,$orderBy);
	}
	/* ------------showOneDiscount--------------*/
	function showOneDiscount($conn,$values){
		$tableName = 'discount';
		$condition= 'd_id = '.$values["d_id"];
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn,$tableName,$column, $condition,$orderBy);
	}
	/* ------------showDiscountByProduct--------------*/
	function showDiscountByProduct($conn,$values){
		$tableName = 'discount';
		$condition= 'p_id = "'.$values["p_id"].'"';
		$orderBy = '';
		$column = '*';
		return QuieriesDB::select($conn,$tableName,$column, $condition,$orderBy);
	}
	/* ------------deleteDiscount--------------*/
	function deleteDiscount($conn,$values){
		$tableName="discount";
		$condition = 'd_id = '.$values["d_id"];
		return QuieriesDB::delete($conn,$tableName,$condition);
	}
}

?>