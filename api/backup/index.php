<?php 
	session_start();
	include('classes.php');

	/*-------- global variables ---------*/
	$servername = "localhost"; 
	$username = "root";
	$password = "";
	$dbname = "shopdb";

	$connectDB = new ConnectDB();
	/*------ connection variable ------*/
	$conn = $connectDB::connectionWithDB($servername,$username,$password,$dbname);

	$shopOwner = new ShopOwner();
	$shop = new Shop();
	$products = new Products();
	$discount = new Discount();
if(isset($_POST["action"])){
	$value=$_POST;
	unset($value["action"]);
	$action = $_POST["action"];
	switch ($action) {
		case "signup":
			echo $shopOwner::signup($conn,$value);
			break;
		case "signin":
			echo $shopOwner::signin($conn,$value);
			break;
		case "showAllUsers":
			echo $shopOwner::showAllUsers($conn);
			break;
		case "updateUser":
			echo $shopOwner::updateUser($conn,$value);
			break;
		case "registerShop":
			echo $shop::registerShop($conn,$value);
			break;
		case "updateShop":
			echo $shop::updateShop($conn,$value);
			break;
		case "selectAllShop":
			echo $shop::selectAllShop($conn);
			break;
		case "selectOneShop":
			echo $shop::selectOneShop($conn,$value);
			break;
		case "selectShopByShopowner":
			echo $shop::selectShopByShopowner($conn,$value);
			break;
		case "deleteShop":
			echo $shop::deleteShop($conn,$value);
			break;
		case "addProduct":
			echo $products::addProduct($conn,$value);
			break;
		case "updateProduct":
			echo $products::updateProduct($conn,$value);
			break;
		case "selectAllProducts":
			echo $products::selectAllProducts($conn);
			break;
		case "selectOneProduct":
			echo $products::selectOneProduct($conn,$value);
			break;
		case "selectProductsByShop":
			echo $products::selectProductsByShop($conn,$value);
			break;
		case "deleteProduct":
			echo $products::deleteProduct($conn,$value);
			break;
		case "addDiscount":
			echo $discount::addDiscount($conn,$value);
			break;
		case "updateDiscount":
			echo $discount::updateDiscount($conn,$value);
			break;
		case "ShowAllDiscounts":
			echo $discount::ShowAllDiscounts($conn);
			break;
		case "showOneDiscount":
			echo $discount::showOneDiscount($conn,$value);
			break;
		case "showDiscountByProduct":
			echo $discount::showDiscountByProduct($conn,$value);
			break;
		case "deleteDiscount":
			echo $discount::deleteDiscount($conn,$value);
			break;
	    default:
	       $result= array("message" => "error",	"code" => "405");
			echo json_encode($result);
	}
}
else{
	$result= array("message" => "error","code" => "406");
	echo json_encode($result);
}
?>