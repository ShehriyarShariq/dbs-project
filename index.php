<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
      Bellaria
    </title>

    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      rel="stylesheet"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />

    <script src="scripts/jquery-3.4.1.js"></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
  </head>

  <body>
    <div id="authContainer">
      <div></div>
      <div></div>
    </div>

    <div id="page">
      <div id="header"></div>

      <div>
        <div id="loader">
          <img src="images/loader.gif" alt="loader" />
        </div>
        <div id="content"></div>
      </div>

      <div id="footer"></div>
    </div>

    <script>
      let isPageLoading = false;
      let pageIndex = 0;
      let pagesID = [
        "#home",
        "#about",
        "#order",
        "#contact",
        "#loginOrNew",
        "#loginOrNew",
      ];
      let pages = [
        "Home",
        "About",
        "Order",
        "Contact Us",
        "My Orders",
        "Settings",
      ];
      let pagesHtml = [
        "landing.html",
        "about_us.html",
        "order.php",
        "contact_us.html",
        "myorders.php",
        "settings.html",
      ];   

      function showLoginDialog() {
        $("#authContainer").show();
        $("#authContainer > div:last-child").load("login.html");
      }

      function showRegisterDialog() {
        $("#authContainer").show();
        $("#authContainer > div:last-child").load("sign-up.html");
      }

      function showPage(pageNum) {
        if (!isPageLoading) {
          if (!$(pagesID[pageNum]).hasClass("active") || pageIndex != pageNum) {
            pageIndex = pageNum;
            $("#footer").show();
            isPageLoading = true;
            $("#content").css("opacity", 0);
            $("#loader").css("display", "flex");
            setTimeout(() => {
              $("#loader").css("opacity", 1);
              $("#content").hide();
            });
            $("#content").load(pagesHtml[pageNum], () => {
              setTimeout(function () {
                $(".active").removeClass("active");
                $("#loader").css("opacity", 0).css("display", "none");
                $(pagesID[pageNum]).addClass("active");
                $("#content").show();
                $("#content").css("opacity", 1);
                isPageLoading = false;
              }, 1000);
            });
            document.title = "Bellaria | " + pages[pageNum];
          }
        }
      }

      function updateHeader() {          
        if(checkCookie("name")) {            
          $("#loginOrNew").text("Hi, " + getCookie("name"));
        } else {
          $("#loginOrNew").text("Login/Signup");
        }
      }                    

      function closeForm() {
        $("#loginForm").trigger("reset");
        $("#registerform").trigger("reset");
        $("#authContainer").hide();
      }

      function setCookie(cname, cvalue) {
        document.cookie = cname + "=" + cvalue + ";";
      }

      function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(";");
        for (var i = 0; i < ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == " ") {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
      }

      function checkCookie(cname) {
        return getCookie(cname) != "";
      }

      $(document).ready(() => {
        $("#header").load("header.html", () => {
          let navBar = document.getElementById("mainNav");
          let headerDiv = document.getElementById("header");
          let homeTab = document.getElementById("home");

          headerDiv.style.height = navBar.getBoundingClientRect().height + "px";

          updateHeader();
        });
        
        $("#footer").load("footer.html");                 

        showPage(4);

        $(document).click((e) => {
          console.log(e.target != document.getElementById("dropDownMenu") && $(e.target).parents("#dropDownMenu").length == 0 &&
            $("#loginOrNewItem").hasClass("dropdown"));
          
          if ($(e.target).parents(".auth_card").length == 0 && $("#authContainer").css("display") != "none") {
            closeForm();
          } else if (
            e.target != document.getElementById("dropDownMenu") && $(e.target).parents("#dropDownMenu").length == 0 &&
            $("#loginOrNewItem").hasClass("dropdown")
          ) {
            $("#loginOrNewItem").removeClass("dropdown");
            $("#dropDownMenu").hide();
            console.log("WTF");
          }
        });         
      });      
    </script>
  </body>
</html>
