<?php
        include_once './db_connect.php';

        $post = $_POST;
        $from = $post['from'];
        $isLoad = array_key_exists('isLoad', $post);
        $isDelete = array_key_exists('isDelete', $post);
        $isUpdate = array_key_exists('isUpdate', $post);

        if($isLoad){
                if(strcmp($from, "loadProducts") == 0){
                        $isReturnAll = $post['allData'];
                        $getAllProductsQuery = "SELECT product_name FROM product";
                        $getAllProductsQueryResult = mysqli_query($connect, $getAllProductsQuery);

                        $allProducts = array();

                        while ($row = mysqli_fetch_array($getAllProductsQueryResult)){
                                array_push($allProducts, strcmp($isReturnAll, "true") == 0 ? $row : $row[0]);
                        }

                        loadResult($connect, $allProducts);
                } else if(strcmp($from, "loadItems") == 0){
                        $tableName = $post['tableName'];
                        $getAllItemsQuery = "SELECT * FROM $tableName";
                        $getAllItemsQueryResult = mysqli_query($connect, $getAllItemsQuery);

                        $allItems = array();

                        while ($row = mysqli_fetch_array($getAllItemsQueryResult)){
                                array_push($allItems, $row);
                        }

                        loadResult($connect, $allItems);
                } else if(strcmp($from, "loadToppings") == 0){
                        $getAllToppingsQuery = "SELECT * FROM topping";
                        $getAllToppingsQueryResult = mysqli_query($connect, $getAllToppingsQuery);

                        $allToppings = array();

                        while ($row = mysqli_fetch_array($getAllToppingsQueryResult)){
                                array_push($allToppings, $row);
                        }

                        loadResult($connect, $allToppings);
                } else if(strcmp($from, "loadCustomers") == 0){
                        $getAllCustomersQuery = "SELECT * FROM customer";
                        $getAllCustomersQueryResult = mysqli_query($connect, $getAllCustomersQuery);

                        $allCustomers = array();

                        while ($row = mysqli_fetch_array($getAllCustomersQueryResult)){
                                array_push($allCustomers, $row);
                        }

                        loadResult($connect, $allCustomers);
                } else if(strcmp($from, "loadDrivers") == 0){
                        $getAllDriversQuery = "SELECT * FROM driver";
                        $getAllDriversQueryResult = mysqli_query($connect, $getAllDriversQuery);

                        $allDrivers = array();

                        while ($row = mysqli_fetch_array($getAllDriversQueryResult)){
                                array_push($allDrivers, $row);
                        }

                        loadResult($connect, $allDrivers);
                } else if(strcmp($from, "loadAdmins") == 0){
                        $getAllAdminsQuery = "SELECT * FROM admin";
                        $getAllAdminsQueryResult = mysqli_query($connect, $getAllAdminsQuery);

                        $allAdmins = array();

                        while ($row = mysqli_fetch_array($getAllAdminsQueryResult)){
                                array_push($allAdmins, $row);
                        }

                        loadResult($connect, $allAdmins);
                }
        } else if($isDelete){
                if(strcmp($from, "delProduct") == 0){                        
                        $prefix = $post['prefix'];
        
                        $delProductQuery = "DELETE FROM product WHERE product_prefix = '$prefix'";
                        $isDeleted = mysqli_query($connect, $delProductQuery);
                        if($isDeleted){
                                deleteResult($connect, "product");
                        } else {
                                sendError($connect);
                        }
                } else if(strcmp($from, "delItem") == 0){
                        $tableName = $post['tableName'];
                        $id = $post['id'];
        
                        $deletedItemQuery = "DELETE FROM $tableName where product_id = '$id'";
                        $isDeleted = mysqli_query($connect, $deletedItemQuery);
                        if($isDeleted){
                                deleteResult($connect, "item");
                        } else {
                                sendError($connect);
                        }
                } else if(strcmp($from, "delTopping") == 0){                        
                        $id = $post['id'];
        
                        $deleteToppingQuery = "DELETE FROM topping WHERE topping_id = '$id'";
                        $isDeleted = mysqli_query($connect, $deleteToppingQuery);
                        if($isDeleted){
                                deleteResult($connect, "topping");
                        } else {
                                sendError($connect);
                        }
                } else if(strcmp($from, "delCustomer") == 0){
                        $id = $post['id'];
        
                        $deleteCustomerQuery = "DELETE FROM customer WHERE cust_id = '$id'";
                        $isDeleted = mysqli_query($connect, $deleteCustomerQuery);
                        if($isDeleted){
                                deleteResult($connect, "customer");
                        } else {
                                sendError($connect);
                        }
                } else if(strcmp($from, "delDriver") == 0){
                        $id = $post['id'];

                        $deleteDriverQuery = "DELETE FROM driver WHERE driver_id = '$id'";
                        $isDeleted = mysqli_query($connect, $deleteDriverQuery);
                        if($isDeleted){
                                deleteResult($connect, "driver");
                        } else {
                                sendError($connect);
                        }
                } else if(strcmp($from, "delAdmin") == 0){
                        $id = $post['id'];
                        
                        $deleteAdminQuery = "DELETE FROM admin WHERE admin_id = '$id'";
                        $isDeleted = mysqli_query($connect, $deleteAdminQuery);
                        if($isDeleted){
                                deleteResult($connect, "admin");
                        } else {
                                sendError($connect);
                        }
                }
        } else if($isUpdate){
                
        } else {
                if(strcmp($from, "newProduct") == 0){
                        $name = $post['name'];
                        $prefix = $post['prefix'];
        
                        $addNewProductQuery = "INSERT INTO product VALUE ('$name', '$prefix')";
                        $isAdded = mysqli_query($connect, $addNewProductQuery);
                        if($isAdded){
                                addedNewResult($connect, "product");
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
                                addedNewResult($connect, "item");
                        } else {
                                sendError($connect);
                        }
                } else if(strcmp($from, "newTopping") == 0){
                        $name = $post['name'];
                        $rate = $post['rate'];
        
                        $addNewToppingQuery = "INSERT INTO topping (topping_name, rate) VALUE ('$name', '$rate')";
                        $isAdded = mysqli_query($connect, $addNewToppingQuery);
                        if($isAdded){
                                addedNewResult($connect, "topping");
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
                                addedNewResult($connect, "customer");
                        } else {
                                sendError($connect);
                        }
                } else if(strcmp($from, "newDriver") == 0){
                        $name = $post['name'];
                        $age = $post['age'];
                        $addNewDriverQuery = "INSERT INTO driver (name, age) VALUE ('$name', '$age');";
                        $isAdded = mysqli_query($connect, $addNewDriverQuery);
                        if($isAdded){
                                addedNewResult($connect, "driver");
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
                                addedNewResult($connect, "admin");
                        } else {
                                sendError($connect);
                        }
                }
        }

        function addedNewResult($connect, $type){
                $response = array("result" => "success", "message" => "Successfully added new $type!");
		echo json_encode($response);
		exit("");
        }
        
        function deleteResult($connect, $type){
                $response = array("result" => "success", "message" => "Successfully removed $type!");
		echo json_encode($response);
		exit("");
        }

        function loadResult($connect, $products){
                $response = array("result" => "success", "message" => $products);
		echo json_encode($response);
		exit("");
        }

        function sendError($connect){
                $response = array("result" => "failure", "message" => "Some Error Occurred!");
		echo json_encode($response);
		exit("");
        }

?>