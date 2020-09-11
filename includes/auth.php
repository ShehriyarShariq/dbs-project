<?php         
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
                include_once 'db_connect.php';

                session_start();
      
                function generateRandomString($length = 8) {
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($i = 0; $i < $length; $i++) {
                                $randomString .= $characters[rand(0, $charactersLength - 1)];
                        }
                        return $randomString;
                }

                function success($connect, $msg){
                        $response = array("result" => "success", "message" => "$msg");
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

                $from = $_POST['from'];

                if(strcmp($from, "login") == 0){
                        $email = $_POST['email'];
                        $pass = md5($_POST['pass']);

                        $checkCustCredQuery = "SELECT * FROM customer WHERE email='$email' AND password='$pass';";
                        $checkCustCredQueryResult = mysqli_query($connect, $checkCustCredQuery);
                        $checkCustCredQueryResultCheck = mysqli_num_rows($checkCustCredQueryResult);

                        $customerQuery;
                        $adminQuery;

                        if($checkCustCredQueryResultCheck > 0){
                                // User is customer
                                $customerQuery = mysqli_fetch_assoc($checkCustCredQueryResult);


                                $_SESSION["id"] = $customerQuery['cust_id'];
                                $_SESSION["name"] = $customerQuery['name'];
                                $_SESSION["email"] = $email;
                                success($connect, $customerQuery['cust_id']."~_~".$customerQuery['name']."~_~false");

                        } else {
                                $checkAdminCredQuery = "SELECT * FROM admin WHERE email='$email' AND password='$pass';";
                                $checkAdminCredQueryResult = mysqli_query($connect, $checkAdminCredQuery);
                                $checkAdminCredQueryResultCheck = mysqli_num_rows($checkAdminCredQueryResult);
                        
                                if($checkAdminCredQueryResultCheck > 0){
                                        // User is Admin
                                        $adminQuery = mysqli_fetch_assoc($checkAdminCredQueryResult);

                                        success($connect, $adminQuery['admin_id']."~_~".$adminQuery['name']."~_~true");
                                } else {
                                        // User does not exist
                                        invalidCredError($connect);
                                }
                        }

                } else if(strcmp($from, "register") == 0) {
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $pass = md5($_POST['pass']);
                        $phoneNum = $_POST['phoneNum'];
                        $bday = $_POST['bday'];

                        $checkCustCredQuery = "SELECT * FROM customer WHERE email='$email' AND password='$pass';";
                        $checkCustCredQueryResult = mysqli_query($connect, $checkCustCredQuery);
                        $checkCustCredQueryResultCheck = mysqli_num_rows($checkCustCredQueryResult);

                        $newCustID = generateRandomString();
                        if($checkCustCredQueryResultCheck == 0){
                                $createNewCustomerQuery = "INSERT INTO customer (cust_id, name, email, password, phone_num, birth_date) VALUES ('$newCustID', '$name', '$email', '$pass', '$phoneNum', '$bday');";
                                $isCreatedCust = mysqli_query($connect, $createNewCustomerQuery);
                                if($isCreatedCust){                        
                                        $_SESSION["id"] = $newCustID;
                                        $_SESSION["name"] = $name;
                                        $_SESSION["email"] = $email;
                                        success($connect, $newCustID."~_~".$name."~_~false");                                
                                }
                        } else {
                                signUpError($connect);
                        }
                } else if (strcmp($from, "logout") == 0){
                        if(session_status() == PHP_SESSION_ACTIVE) {
                                session_unset(); 
                                session_destroy(); 
                        }

                        success($connect, "Logout Succesful!");
                }                            
        }                
?>