<?php 

?>

<!DOCTYPE html>
<html>

<head>
        <meta charset="UTF-8" />
        <title>
                Bellaria
        </title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
                crossorigin="anonymous" />
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
                crossorigin="anonymous"></script>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
                integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
                crossorigin="anonymous" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <script src="scripts/jquery-3.4.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>

        <script src="scripts/jquery-3.4.1.js"></script>

</head>

<body id="page-top">
        <!--Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-shrink" id="mainNav">
                <div class="container">
                        <a class="navbar-brand js-scroll-trigger" href="#page-top">BELLARIA</a>
                        <button class="navbar-toggler navbar-toggler-right collapsed" type="button"
                                data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                                aria-expanded="false" aria-label="Toggle navigation">
                                Menu
                                <i class="fas fa-bars"></i>
                        </button>
                        <div class="navbar-collapse collapse" id="navbarResponsive">
                                <ul class="nav navbar-nav ml-auto">
                                        <li class="nav-item">
                                                <a id="logout" class="nav-link js-scroll-trigger" href="#">LogOut</a>
                                        </li>
                                </ul>
                        </div>
                </div>
        </nav>

        <script>
                let logoutBtn = document.getElementById("logout");

                logoutBtn.addEventListener("click", event => {
                        event.preventDefault();

                        window.localStorage.setItem("email", "");
                        window.localStorage.setItem("pass", "");
                        window.localStorage.setItem("id", "")
                        window.localStorage.setItem("name", "");
                        window.localStorage.setItem("isAdmin", "");

                        window.location.replace("index.html");
                });


        </script>

</body>

</html>