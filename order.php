<link rel="stylesheet" type="text/css" href="css/order.css" />

<section class="d-none checkout-popup py-5">
  <div>
    <i class="fa fa-times fa-2x"></i>
    <div class="confirm-order text-center py-5">
      <h2 class="text-center text-uppercase bold">Confirm Order</h2>
      <hr class="line" />
      <div>
        <h4>Items</h4>
        <ul id="itemsList" class="item-list">
          <li class="d-flex justify-content-around">
            <span>2 Red Velvet</span>|
            <span id="toppingOnItem">Topping: None</span>|<span>PKR 800</span>
          </li>
        </ul>
        <hr />
      </div>
      <div>
        <h4>Choose Address</h4>
        <select id="chooseAddress">
          <option name="">None</option>
        </select>
        <hr />
      </div>
      <div>
        <h4>Cash on Delivery</h4>
        <hr />
      </div>
      <div>
        <h4>Total Amount</h4>
        <h5 id="checkoutTotal">PKR 1800</h5>
        <hr />
      </div>
      <button id="placeOrderBtn" style="width: 80%" class="btn btn-primary mt-3">
        Place Order
      </button>
    </div>
  </div>
</section>

<section class="pop-up-plus d-none">
  <div>
    <i class="fa fa-times fa-2x"></i>
    <div class="container text-center pop-up-details pt-5">
      <h3 class="d-flex">
        <span id="product-name">Chocolate Mousse</span
        ><span id="product-price">PKR 990</span>
      </h3>
      <br />
      <hr class="line" />
      <h5 class="text-left mb-4">Choose toppings (only one if any)</h5>
      <ul class="toppings">
        <form id="toppingsForm">
          <li><input name="topping" type="radio" checked value="" /> None</li>
        </form>
      </ul>
      <hr />
      <h5 class="text-left">Special Instructions (if any)</h5>
      <textarea
        id="instructions"
        class="mt-2 mb-5 p-3"
        rows="4"
        cols="68"
        placeholder="E.g No butter"
      ></textarea>
      <br />
      <div class="row">
        <div class="col-3 d-flex">
          <i class="fa fa-minus" id="qty-d"></i>
          <span id="qty">1</span>
          <i class="fa fa-plus" id="qty-i"></i>
        </div>
        <div class="col-9">
          <button id="addToCartBtn" class="btn btn-primary">Add To Cart</button>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="order-body">
  <div class="row" style="height: 100%; margin: 0">
    <div
      class="col-8"
      style="
        padding: 0;
        height: 100%;
        display: grid;
        grid-template-rows: 1fr auto;
        grid-template-columns: 1fr;
      "
    >
      <div style="width: 90%; margin: 0 auto">
        <ul id="tabs" class="upper-header d-flex justify-content-around">
          <li name="cake" class="category category-active">Cake</li>
          <li name="cupcake" class="category">Cupcake</li>
          <li name="cookie" class="category">Cookie</li>
          <li name="donut" class="category">Donut</li>
        </ul>

        <h4 class="head text-center">
          <i class="fa fa-circle" aria-hidden="true"></i
          ><i class="fa fa-circle" aria-hidden="true"></i>Choose your cuisine<i
            class="fa fa-circle"
            aria-hidden="true"
          ></i
          ><i class="fa fa-circle" aria-hidden="true"></i>
        </h4>
        <hr class="line" />
        <ul class="product-list"></ul>
      </div>

      <div id="orderFooter"></div>
    </div>
    <div class="col-4 cart pt-3">
      <h4 class="text-center">Your Order - Bellaria</h4>
      <br />
      <p class="text-justify text-center">
        You haven't added anything to your cart yet! Start adding to your cart
      </p>
      <br />
      <hr />
      <br />
      <div class="row">
        <div class="col-6">Subtotal</div>
        <div class="col-6 d-flex flex-row-reverse">
          <span>PKR <span id="subTotal">0.00</span></span>
        </div>
      </div>
      <div class="row">
        <div class="col-6">Delievery Fee</div>
        <div class="col-6 d-flex flex-row-reverse">
          <span>PKR <span id="deliveryFee">0.00</span></span>
        </div>
      </div>
      <div class="row">
        <div class="col-6">Total</div>
        <div class="col-6 d-flex flex-row-reverse">
          <span>PKR <span id="total">0.00</span></span>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <button id="checkoutBtn" class="btn btn-primary checkout">
            checkout
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  $(document).ready(() => {
    let deliveryFee = 50;

    let address;

    let orderMap = {
      total: 0,
      items: [],
      addressID: "",
      from: "placeOrder"
    };

    let currItemMap = {};

    let categories = {
      cake: {
        AAAA: {
          name: "Chocolate Mousse",
          price: 990,
        },
        AAAB: {
          name: "Chocolate Fudge",
          price: 880,
        },
        AAAC: {
          name: "Oreo Cake",
          price: 890,
        },
        AAAD: {
          name: "Chocolate Mousse",
          price: 990,
        },
      },
      cupcake: {
        AAAE: {
          name: "Chocolate Mousse",
          price: 990,
        },
        AAAF: {
          name: "Chocolate Fudge",
          price: 880,
        },
      },
      cookie: {
        AAAG: {
          name: "Chocolate Fudge",
          price: 880,
        },
        AAAH: {
          name: "Oreo Cookie",
          price: 890,
        },
      },
      donut: {
        AAAI: {
          name: "Chocolate Fudge",
          price: 880,
        },
      },
    };

    let toppings = {
      AAAA: {
        name: "Sprinkles",
        price: 10,
      },
      AAAB: {
        name: "Choco Chips",
        price: 15,
      },
      AAAC: {
        name: "Choco Syrup",
        price: 20,
      },
      AAAD: {
        name: "Peanuts",
        price: 25,
      },
    };

    function getEventTarget(e) {
      e = e || window.event;
      return e.target || e.srcElement;
    }

    function populateProductsList(id) {
      $(".product-list").html("");
      const itemIds = Object.keys(categories[id]);
      Object.values(categories[id]).forEach((item, i) => {
        $(".product-list").append(
          "<li name=" +
            id +
            "_" +
            itemIds[i] +
            ">" +
            item.name +
            "<span>from PKR " +
            item.price +
            '<i class="fa fa-plus"></i></span></li><hr>'
        );
      });
    }

    function getCustomerAddresses(){
      $.ajax({
        type: "POST",
        url: "./includes/order_commands.php",
        data: {
          from: "fetchAddress"
        },
        dataType: "JSON",
        success: function (response) {        
          console.log(response.addresses);

          address = response.addresses;

          for(i in address) {
            $("#chooseAddress").append("<option name='" + address[i].id + "'>" + address[i].address + "</option>");
          }

          $("#itemsList").html("");
          for (i in orderMap.items) {
            const item = orderMap.items[i];
            $("#itemsList").append(
              '<li class="d-flex justify-content-around"><span>' +
                item.qty +
                " " +
                categories[item.categoryID][item.itemID].name +
                "</span>(Topping: " +
                (item.toppingID != ""
                  ? toppings[item.toppingID].name
                  : "No toppings") +
                ")<span>PKR " +
                (categories[item.categoryID][item.itemID].price +
                  (item.toppingID != "" ? toppings[item.toppingID].price : 0)) *
                  item.qty +
                "</span></li>"
            );
          } 

          $("#checkoutTotal").text("PKR " + $("#total").text());

          $(".checkout-popup").removeClass("d-none");
        },
        error: function (jqXhr) {
          console.log(jqXhr.responseText);
          alert("Error Fetching Address!");
        },
      });
    }

    (function () {
      Object.keys(toppings).forEach((toppingID) => {
        $("#toppingsForm").append(
          '<li><input name="topping" type="radio" value="' +
            toppingID +
            '" /> ' +
            toppings[toppingID].name +
            "<span>+ PRK " +
            toppings[toppingID].price +
            "</span></li>"
        );
      });

      $("input[name='topping']").on("change", (e) => {
        if ($(e.target).val() != "") {
          const price = toppings[$(e.target).val()].price;
          const qty = parseInt($("#qty").text());

          const itemPrice =
            categories[currItemMap.categoryID][currItemMap.itemID].price +
            price;

          if (qty > 0) {
            $("#qty").text(qty);
            $("#product-price").text("PKR " + itemPrice * qty);
          }

          currItemMap.toppingID = $(e.target).val();
        } else {
          const qty = parseInt($("#qty").text());

          const itemPrice =
            categories[currItemMap.categoryID][currItemMap.itemID].price;

          if (qty > 0) {
            $("#qty").text(qty);
            $("#product-price").text("PKR " + itemPrice * qty);
          }

          currItemMap.toppingID = "";
        }
      });
    })();

    function updateFinalCheckout() {
      $("#subTotal").text(orderMap.total);
      $("#deliveryFee").text(deliveryFee);
      $("#total").text(orderMap.total + deliveryFee);
    }

    populateProductsList(Object.keys(categories)[0]);

    $("#footer").hide();
    $("#orderFooter").load("footer.html", () => {
      $("#orderFooter .contact_us_row").hide();
      $("#orderFooter .contact-section-div")
        .removeClass("pb-5")
        .addClass("p-3");
      $("#orderFooter .contact-section").css("padding", 0);
      $("#orderFooter .contact-section .social").css("margin-top", 0);
    });

    $(".product-list").on("click", "li", function () {
      $(".pop-up-plus").removeClass("d-none");
      var ids = $(this).attr("name").split("_");
      $(".pop-up-details").attr("name", $(this).attr("name"));
      $("#product-name").text(categories[ids[0]][ids[1]].name);
      $("#product-price").text(categories[ids[0]][ids[1]].price);

      currItemMap = {
        categoryID: ids[0],
        itemID: ids[1],
        toppingID: "none",
        qty: 1,
        message: "none",
        price: 0
      };
    });

    $("#qty-d").click(function () {
      let newQty = parseInt($("#qty").html()) - 1;
      const itemIds = $(".pop-up-details").attr("name").split("_");
      let itemPrice = categories[itemIds[0]][itemIds[1]].price;

      if ($("input[name='topping']:checked").val() != "") {
        itemPrice += toppings[$("input[name='topping']:checked").val()].price;
      }

      if (newQty > 0) {
        $("#qty").text(newQty);
        $("#product-price").text("PKR " + itemPrice * newQty);

        currItemMap.qty -= 1;
      }
    });

    $("#qty-i").click(function () {
      let newQty = parseInt($("#qty").html()) + 1;
      const itemIds = $(".pop-up-details").attr("name").split("_");
      let itemPrice = categories[itemIds[0]][itemIds[1]].price;

      if ($("input[name='topping']:checked").val() !== "") {
        console.log($("input[name='topping']:checked").val());
        console.log(toppings[$("input[name='topping']:checked").val()]);
        itemPrice += toppings[$("input[name='topping']:checked").val()].price;
      }

      $("#qty").text(newQty);
      $("#product-price").text("PKR " + itemPrice * newQty);

      currItemMap.qty += 1;
    });

    $("#addToCartBtn").click(function () {
      const itemPrice = parseInt(
        $("#product-price").text().replace("PKR ", "")
      );
      orderMap.total += itemPrice;

      if ($("#instructions").text() != "") {
        currItemMap.message = $("#instructions").text();
      }

      currItemMap.price = itemPrice;

      orderMap.items.push(currItemMap);

      currItemMap = {};

      $("input[name='topping']")[0].checked = true;
      $("#instructions").val("");

      $(".pop-up-plus").addClass("d-none");

      updateFinalCheckout();
    });

    $("#checkoutBtn").click(function () {
      if (checkCookie("id")) {
        if (orderMap.items.length > 0) {
          if(address == null) {
            getCustomerAddresses();
          } else {
            $("#checkoutTotal").text("PKR " + $("#total").text());

          $(".checkout-popup").removeClass("d-none");
          }
        }
      } else {
        alert("You need to login to continue");
      }
    });

    $(".fa-times").click(function () {
      $(".pop-up-plus").addClass("d-none");
      $(".checkout-popup").addClass("d-none");
    });
    $("#new-address-add").click(function () {
      console.log("add new address");
      // take him to settings to add new address and save the state of his orders
    });

    $(".category").click((e) => {
      $(".category-active").removeClass("category-active");
      $(e.target).addClass("category-active");
      populateProductsList($(e.target).attr("name"));
    });

    $("#placeOrderBtn").click(e => {
      orderMap.addressID = $("#chooseAddress > option:selected").attr("name");

      $.ajax({
        type: "POST",
        url: "./includes/order_commands.php",
        data: orderMap,
        dataType: "JSON",
        success: function (response) {        
          if(response.result == "success") {
            showPage(4);
          } else {
            alert("Error in Placing Order! Please try again.");
          }
        },
        error: function (jqXhr) {
          console.log(jqXhr.responseText);
          alert("Error in Placing Order! Please try again!");
        },
      });
    });
  });
</script>
