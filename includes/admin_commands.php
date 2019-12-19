<?php
        include_once './db_connect.php';

        $post = $_POST;
        $from = $post['from'];

        if(strcmp($from, "newProduct") == 0){
                $name = $post['name'];
                $prefix = $post['prefix'];

                $addNewProductQuery = "INSERT INTO product VALUE ('$name', '$prefix')";
                $isAdded = mysqli_query($connect, $addNewProductQuery);
                if($isAdded){
                        addedNewProduct($connect);
                } else {
                        sendError($connect);
                }
        } else if(strcmp($from, "newItem") == 0){
                $productName = $post['productName'];
                $name = $post['name'];
                $rate = $post['rate'];

                $addNewItemQuery = "INSERT INTO $productName VALUE ('$name', '$rate')";
                $isAdded = mysqli_query($connect, $addNewItemQuery);
                if($isAdded){
                        addedNewItem($connect);
                } else {
                        sendError($connect);
                }
        } else if(strcmp($from, "newTopping") == 0){
                $name = $post['name'];
                $rate = $post['rate'];

                $addNewToppingQuery = "INSERT INTO topping (topping_name, rate) VALUE ('$name', '$rate')";
                $isAdded = mysqli_query($connect, $addNewToppingQuery);
                if($isAdded){
                        addedNewTopping($connect);
                } else {
                        sendError($connect);
                }
        } else if(strcmp($from, "newCustomer") == 0){
                $name = $post['name'];
                $email = $post['email'];
                $pass = $post['password'];
                $phoneNum = $post['phone'];
                $bday = $post['bday'];

                $addNewCustomerQuery = "INSERT INTO customer (name, email, password, phone_num, birth_date) VALUE ('$name', '$email', '$password', '$phone_num', '$birth_date');";
                $isAdded = mysqli_query($connect, $addNewCustomerQuery);
                if($isAdded){
                        addedNewCustomer($connect);
                } else {
                        sendError($connect);
                }
        } else if(strcmp($from, "newDriver") == 0){
                $name = $post['name'];
                $age = $post['age'];
                $addNewDriverQuery = "INSERT INTO driver (name, age) VALUE ('$name', '$age');";
                $isAdded = mysqli_query($connect, $addNewDriverQuery);
                if($isAdded){
                        addedNewDriver($connect);
                } else {
                        sendError($connect);
                }
        } else if(strcmp($from, "newAdmin") == 0){
                $name = $post['name'];
                $email = $post['email'];
                $pass = $post['password'];
                $addNewAdminQuery = "INSERT INTO admin (name, email, password) VALUE ('$name', '$email', '$pass');";
                $isAdded = mysqli_query($connect, $addNewAdminQuery);
                if($isAdded){
                        addedNewAdmin($connect);
                } else {
                        sendError($connect);
                }
        }

        function addedNewProduct($connect){
                $response = array("result" => "success", "message" => "Successfully added new product!");
		echo json_encode($response);
		exit("");
        }

        function addedNewItem($connect){
                $response = array("result" => "success", "message" => "Successfully added new item!");
		echo json_encode($response);
		exit("");
        }

        function addedNewTopping($connect){
                $response = array("result" => "success", "message" => "Successfully added new topping!");
		echo json_encode($response);
		exit("");
        }

        function addedNewCustomer($connect){
                $response = array("result" => "success", "message" => "Successfully added new customer!");
		echo json_encode($response);
		exit("");
        }

        function addedNewDriver($connect){
                $response = array("result" => "success", "message" => "Successfully added new driver!");
		echo json_encode($response);
		exit("");
        }

        function addedNewAdmin($connect){
                $response = array("result" => "success", "message" => "Successfully added new admin!");
		echo json_encode($response);
		exit("");
        }

        function sendError($connect){
                $response = array("result" => "failure", "message" => "Some Error Occurred!");
		echo json_encode($response);
		exit("");
        }

?>