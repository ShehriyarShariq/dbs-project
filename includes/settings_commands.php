<?php

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
                include_once './db_connect.php';

                $from = $_POST['from'];

                if(strcmp($from, "passUpdate") == 0){
                        $id = $_POST['id'];
                        $currPass = md5($_POST['currPass']);
                        $newPass = $_POST['newPass'];

                        $checkCurrPassQuery = "SELECT password FROM customer WHERE cust_id = '$id'";
                        $checkCurrPassQueryResult = mysqli_query($connect, $checkCurrPassQuery);
                        $checkCurrPassQueryResultCheck = mysqli_num_rows($checkCurrPassQueryResult);

                        if($checkCurrPassQueryResultCheck > 0){
                                $customerCurrPass = (mysqli_fetch_assoc($checkCurrPassQueryResult))['password'];
                                if(strcmp($customerCurrPass, $currPass) == 0){
                                        $updateCustomerPassQuery = "UPDATE customer SET password = '$newPass' WHERE cust_id = '$id'";
                                        $updateCustomerPassQueryResult = mysqli_query($connect, $updateCustomerPassQuery);
                                        if($updateCustomerPassQueryResult){
                                                passChangeSuccess($connect);
                                        } else {
                                                sendError($connect); 
                                        }
                                } else {
                                        sendError($connect); 
                                }                        
                        } else {
                                sendError($connect);
                        }

                } else if(strcmp($from, "addAddress") == 0){
                        $id = $_POST['id'];
                        $address = $_POST['address'];

                        $addNewAddressQuery = "INSERT INTO address (cust_id, address_detail) VALUE ('$id', '$address')";
                        $isAdded = mysqli_query($connect, $addNewAddressQuery);
                        if($isAdded){
                                addressAddOrUpdated($connect);
                        } else {
                                sendError($connect);
                        }
                } else if(strcmp($from, "updateAddress") == 0){
                        $custId = $_POST['cust_id'];
                        $addressId = $_POST['address_id'];
                        $address = $_POST['address'];

                        $addNewAddressQuery = "UPDATE address SET address_detail = '$address' WHERE cust_id = '$custId' AND address_id = '$addressId'";
                        $isUpdated = mysqli_query($connect, $addNewAddressQuery);
                        if($isUpdated){
                                addressAddOrUpdated($connect);
                        } else {
                                sendError($connect);
                        }
                } else if(strcmp($from, "loadAddresses") == 0){
                        $custId = $_POST['cust_id'];

                        $getAllAddressesQuery = "SELECT * FROM address WHERE cust_id = '$custId'";
                        $getAllAddressesQueryResult = mysqli_query($connect, $getAllAddressesQuery);

                        if($getAllAddressesQueryResult){
                                $allAddress = array();

                                while ($row = mysqli_fetch_array($getAllAddressesQueryResult)){
                                        array_push($allAddress, $row);
                                }

                                addressLoaded($connect, $allAddress);
                        } else {
                                sendError($connect);
                        }
                }

                function passChangeSuccess($connect){
                        $response = array("result" => "success", "message" => "Successfully updated password!");
                        echo json_encode($response);
                        exit("");
                }

                function addressAddOrUpdated($connect){
                        $response = array("result" => "success", "message" => "Successfully added/updated address!");
                        echo json_encode($response);
                        exit("");
                }

                function addressLoaded($connect, $allAddresss){
                        $response = array("result" => "success", "message" => $allAddresss);
                        echo json_encode($response);
                        exit("");
                }

                function sendError($connect){
                        $response = array("result" => "failure", "message" => "Some Error Occurred!");
                        echo json_encode($response);
                        exit("");
                }
        }        
?>