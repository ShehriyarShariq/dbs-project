<?php 
        include_once './db_connect.php';

        $post = $_POST;
        $from = $post['from'];

        if(strcmp($from, "login") == 0){
                $email = $post['email'];
                $pass = $post['pass'];

                $checkCustCredQuery = "SELECT * FROM customer WHERE email='$email' AND password='$pass';";
                $checkCustCredQueryResult = mysqli_query($connect, $checkCustCredQuery);
                $checkCustCredQueryResultCheck = mysqli_num_rows($checkCustCredQueryResult);

                $customerQuery;
                $adminQuery;

                if($checkCustCredQueryResultCheck > 0){
                        // User is customer
                        $customerQuery = mysqli_fetch_assoc($checkCustCredQueryResult);

                        loginSuccess($connect, $customerQuery['cust_id']."~_~".$customerQuery['name']."~_~false");

                } else {
                        $checkAdminCredQuery = "SELECT * FROM admin WHERE email='$email' AND password='$pass';";
                        $checkAdminCredQueryResult = mysqli_query($connect, $checkAdminCredQuery);
                        $checkAdminCredQueryResultCheck = mysqli_num_rows($checkAdminCredQueryResult);
                
                        if($checkAdminCredQueryResultCheck > 0){
                                // User is Admin
                                $adminQuery = mysqli_fetch_assoc($checkAdminCredQueryResult);

                                loginSuccess($connect, $adminQuery['admin_id']."~_~".$adminQuery['name']."~_~true");
                        } else {
                                // User does not exist
                                invalidCredError($connect);
                        }
                }

        } else {
                $name = $post['name'];
                $email = $post['email'];
                $pass = $post['pass'];
                $phoneNum = $post['phoneNum'];
                $bday = $post['bday'];

                $checkCustCredQuery = "SELECT * FROM customer WHERE email='$email' AND password='$pass';";
                $checkCustCredQueryResult = mysqli_query($connect, $checkCustCredQuery);
                $checkCustCredQueryResultCheck = mysqli_num_rows($checkCustCredQueryResult);

                if($checkCustCredQueryResultCheck == 0){
                        $createNewCustomerQuery = "INSERT INTO customer (name, email, password, phone_num, birth_date, points) VALUES ($name, $email, $pass, $phoneNum, $bday, 0);";
                        $isCreatedCust = mysqli_query($connect, $createNewCustomerQuery);
                        if($isCreatedCust === true){
                                signUpSuccess($connect);
                        }
                } else {
                        signUpError($connect);
                }
        }

        function loginSuccess($connect, $msg){
                $response = array("result" => "success", "message" => "$msg");
		echo json_encode($response);
		exit("");
        }

        function signUpSuccess($connect){
                $response = array("result" => "success", "message" => "Customer created successfully!");
		echo json_encode($response);
		exit("");
        }

        function invalidCredError($connect){
		$response = array("result" => "failure", "message" => "User does not exist!");
		echo json_encode($response);
		exit("");
        }
        
        function signUpError($connect){
                $response = array("result" => "failure", "message" => "User already exists!");
		echo json_encode($response);
		exit("");
        }
?>