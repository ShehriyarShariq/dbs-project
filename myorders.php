<?php 
  include_once './includes/db_connect.php';
  
  session_start();

  $userID = $_SESSION["id"];

  $allCustomerOrdersQuery = "SELECT * FROM order_table WHERE customer_id='$userID'";
  $allCustomerOrdersQueryResult = mysqli_query($connect, $allCustomerOrdersQuery);
  $allCustomerOrdersQueryResultCheck = mysqli_num_rows($allCustomerOrdersQueryResult);

  $orders = array();
  $allOrderDetails = array();

  if($allCustomerOrdersQueryResultCheck > 0){ 
    while ($row = mysqli_fetch_array($allCustomerOrdersQueryResult,MYSQLI_ASSOC)){ 
      array_push($orders, $row); 
    } 
    
    
    
    for($i = 0; $i < count($orders); $i++) { 
      $orderDetails = array();
      
      $orderID = $orders[$i]["id"]; 
      $orderDetailsQuery = "SELECT * FROM order_details WHERE order_id='$orderID'"; 
      $orderDetailsQueryResult = mysqli_query($connect, $orderDetailsQuery); 
      $orderDetailsQueryResultCheck = mysqli_num_rows($orderDetailsQueryResult); 
      if($orderDetailsQueryResultCheck > 0) { 
        while ($row = mysqli_fetch_array($orderDetailsQueryResult, MYSQLI_ASSOC)){
          array_push($orderDetails, $row);
          
          $itemID = $orderDetails[count($orderDetails) - 1]["item_id"]; 
          $itemNameQuery = "SELECT name FROM item WHERE id='$itemID'";
          $itemNameQueryResult = mysqli_query($connect, $itemNameQuery);
          $itemNameQueryResultCheck = mysqli_num_rows($itemNameQueryResult);
          if($itemNameQueryResultCheck > 0) { 
            $orderDetails[count($orderDetails) - 1]["item_name"] = mysqli_fetch_array($itemNameQueryResult, MYSQLI_ASSOC)["name"]; 
          }   
        }                     
      } 

      array_push($allOrderDetails, array($orderDetails));
    }     
  } 
  
  $allOrderDetails = json_encode(array("orderDetails" => $allOrderDetails)); 
  
?>

<link rel="stylesheet" type="text/css" href="css/myorders.css" />

<section id="order-detail-popup" class="d-none">
  <i class="fa fa-times fa-2x"></i>
  <div class="order-detail-div">
    <div>
      <h2 class="text-center uppercase bold">Order Details</h2>
      <hr />
    </div>
    <div>
      <h3>Cuisines</h3>
      <ul class="products">
        <li>2 Red Velvet</li>
      </ul>
      <hr />
    </div>
    <div>
      <h3>Topping</h3>
      <p id="toppingNameDetail">None</p>
      <hr />
    </div>
    <div>
      <h3>Order Date & Time</h3>
      <p id="order-date-time">12/09/2019 23:14:15</p>
      <hr />
    </div>
    <div>
      <h3>Delievery Address</h3>
      <p class="address-delievery">House#11 Street 35 I-9/4 Islamabad</p>
      <hr />
    </div>
    <div>
      <h3>Delievered By (Driver)</h3>
      <p id="driverNameDelievery">Ali</p>
    </div>
    <hr />
    <div>
      <h3>Total Amount</h3>
      <p id="total-amount-detail">PKR 1800</p>
    </div>
  </div>
</section>

<section id="order-rating" class="d-none">
  <i class="fa fa-times fa-2x"></i>
  <div class="rating-div">
    <div>
      <h3>
        Rating:
        <div class="rate-box">
          <span class="fa fa-star b1"></span>
          <span class="fa fa-star b2"></span>
          <span class="fa fa-star b3"></span>
          <span class="fa fa-star b4"></span>
          <span class="fa fa-star b5"></span>
        </div>
      </h3>
    </div>

    <div>
      <h3>Comment</h3>
      <textarea name="comment" id="feedback" cols="30" rows="10"></textarea>
    </div>
    <button class="btn btn-primary mt-3">Submit</button>
  </div>
</section>

<div class="container py-5">
  <h3 class="text-center mb-5">My Orders</h3>
  <ul class="cust-orders"></ul>
</div>

<script>
  $(document).ready(() => {
    let orders = <?php echo $allOrderDetails; ?>;  

    for(i in orders["orderDetails"]) {      
      let orderListItem = document.createElement("li");
      orderListItem.setAttribute("name", "order_" + i);
      
      let orderListItemSubList = document.createElement("ul");
      orderListItemSubList.style = "list-style-type: none;padding:  0;";
      orderListItemSubList.setAttribute("name", "order_" + i);

      orderListItem.appendChild(orderListItemSubList);
      document.getElementsByClassName("cust-orders")[0].appendChild(orderListItem);
            
      for(j in orders["orderDetails"][i][0]) {
        if(j == 0) {
          $("ul[name='order_" + i + "']").append("<li><span class='rate'><i class='fa fa-star'></i></span>" + orders["orderDetails"][i][0][j]["qty"] + " " + orders["orderDetails"][i][0][j]["item_name"] + "<span class='total-amount'>PKR " + orders["orderDetails"][i][0][j]["price"] + "</span></li>");
        } else {
          $("ul[name='order_" + i + "']").append("<li><span class='rate' style='opacity: 0;'><i class='fa fa-star'></i></span>" + orders["orderDetails"][i][0][j]["qty"] + " " + orders["orderDetails"][i][0][j]["item_name"] + "<span class='total-amount'>PKR " + orders["orderDetails"][i][0][j]["price"] + "</span></li>");
        }
      }
      $(".cust-orders").append("<hr>");
    }    


    $(".fa-times").click(function () {
      $("#order-rating").addClass("d-none");
      $("#order-detail-popup").addClass("d-none");
    });
    $(".cust-orders").on("click", ".rate", function (event) {
      $("#order-rating").removeClass("d-none");
      event.stopPropagation();
    });
    $(".cust-orders").on("click", "li", function () {
      $("#order-detail-popup").removeClass("d-none");
    });
  });
</script>
