<?php 
/*
 *  QuieriesDB universal queiries class
 *  -----------------------------------
 *	-> insert
 *	-> select
 *	-> delete
 *	-> update 
 *	
 */

class QuieriesDB

{
	/*------------  insert function  -------------------*/
	public 

	function insert($conn,$tableName,$values)
	{
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
	public 

	function select($conn,$tableName,$column, $condition,$orderBy)
	{
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

				if($tableName =='shopowner'){
					$results["shopowner"][] = array(
				      'id' => $row['id'],
				      'e_mail' => $row['e_mail'],
				      'phone' => $row['phone'],
				      'address' => $row['address']
				   );
				}
				else{
					$results[$tableName][]=$row;
				}			   
			}
			return json_encode($results);
		} else {
		    $result= array(
					"error" => "No entry found",
					"code" => "404"
				);
				return json_encode($result);
		}
	}

	/*------------  delete function  -------------------*/
	public 

	function delete($conn,$tableName,$condition)
	{
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
	public 

	function update($conn,$tableName,$values,$condition)
	{
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

?>