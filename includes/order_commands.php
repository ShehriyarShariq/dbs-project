<?php 
        include_once 'db_connect.php';

        session_start();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $from = $_POST['from'];

                function generateRandomString($length = 8) {
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($i = 0; $i < $length; $i++) {
                                $randomString .= $characters[rand(0, $charactersLength - 1)];
                        }
                        return $randomString;
                }

                $userID = $_SESSION["id"];

                if(strcmp($from, "fetchAddress") == 0){
                        $getCustomerAddressesQuery = "SELECT * FROM address WHERE customer_id='$userID';";
                        $getCustomerAddressesQueryResult = mysqli_query($connect, $getCustomerAddressesQuery);
                        $getCustomerAddressesQueryResultCheck = mysqli_num_rows($getCustomerAddressesQueryResult);

                        $addresses = array();

                        if($getCustomerAddressesQueryResultCheck > 0) {                                
                                while ($row = mysqli_fetch_array($getCustomerAddressesQueryResult, MYSQLI_ASSOC)){
					array_push($addresses, $row);					
				}
                        }

                        $response = array("addresses" => $addresses);
			echo json_encode($response);
			exit("");
                } else if (strcmp($from, "placeOrder") == 0) {
                        $orderID = generateRandomString();
                        $addressID = $_POST['addressID'];
                        $placeOrderQuery = "INSERT INTO order_table (id, customer_id, address_id) VALUES ('$orderID', '$userID', '$addressID')";
                        $placeOrderQueryResult = mysqli_query($connect, $placeOrderQuery);

                        if($placeOrderQueryResult) {
                                $items = $_POST['items'];
                                for ($i = 0; $i < count($items); $i++) {                                                                         
                                        $itemDetailID = generateRandomString();
                                        $toppingID = $items[$i]["toppingID"];
                                        $qty = $items[$i]["qty"];
                                        $price = $items[$i]["price"];
                                        $itemID = $items[$i]["itemID"];

                                        $insertOrderDetailsQuery = "INSERT INTO order_details (id, order_id, item_id, topping_id, qty, price) VALUES ('$itemDetailID', '$orderID', '$itemID', '$toppingID', $qty, $price)";
                                        $insertOrderDetailsQueryResult = mysqli_query($connect, $insertOrderDetailsQuery);
                                
                                        if($i == count($items) - 1) {
                                                $response = array("result" => "success", "message" => "Order Placed!");
                                                echo json_encode($response);
                                                exit(""); 
                                        }
                                }                                                                                        
                        } else {
                                $response = array("result" => "failure", "message" => "Failed to Place Order!");
                                echo json_encode($response);
                                exit(""); 
                        }
                }
        }
?>