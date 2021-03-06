<?php
session_start();

$name = $_SESSION["account_username"];
$usr_type = $_SESSION['user_type'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Quzer Airline booking</title>

    <!-- Bootstrap Core CSS -->
    <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://jquery.com/resources/demos/style.css"> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <script src="javascripts/main.js"></script>
    <script src="javascripts/slide_box.js"></script>
    <script src="javascripts/dropdown_menu.js"></script>
    <script src="javascripts/search.js"></script>
    <!--    <script src="javascripts/popup.js"></script>-->
    <script src="javascripts/order.js"></script>
    <script src="javascripts/checkLogin.js"></script>


    <!-- Custom CSS -->
    <link rel="stylesheet" href="stylesheets/main.css">
    <link rel="stylesheet" href="stylesheets/nav.css">
    <link rel="stylesheet" href="stylesheets/w3.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- Navigation -->
<?php include 'nav.php'; ?>

<div class="container" style="margin:50px 0px 10px 0px; padding-left: 0;">
    <div class="w3-sidebar w3-card-4" style="width:200px" id="mySidebar">
        <div class="w3-bar-block">
            <a class="w3-bar-item w3-button" href="profile.php" style="text-decoration: none">Profile</a>
            <a class="w3-bar-item w3-button w3-blue" href="order_list.php" style="text-decoration: none">Order</a>
            <a class="w3-bar-item w3-button" href="favorites.php" style="text-decoration: none">Favorite List</a>
            <a class="w3-bar-item w3-button" href="passenger.php" style="text-decoration: none">Passenger List</a>
        </div>
    </div>

    <div id="main" class="container" style="margin-left:210px">
<!--        <h5>Order list</h5>-->
        <p></p>
<!--        <hr>-->
        <div class="row">
            <div class="col-sm-5 col-sm-offset-7">
                <div class="input-group">
                    <input type="text" id="keywords" placeholder="Please input username to search"
                           class="input-sm form-control"> <span class="input-group-btn">
                        <button type="button" id="search" class="btn btn-sm btn-primary"> Search</button> </span>
                </div>
            </div>
        </div>
        <div class="ibox-content">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Order id</th>
                    <th>Order date</th>
                    <th>Depart</th>
                    <th>Arrival</th>
                    <th>Depart time</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody id="order_list">
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <br>
        <p class="m-0 text-center text-white">CS6314 Class Project: Airline Reservation System</p>
        <p class="m-0 text-center text-white">Copyright &copy; QUZER 2018</p>
    </div>
    <hr>

    <!-- /.container -->
</footer>

</body>


<script type="text/javascript">
    function getUserList() {
        var keywords = $('#keywords').val();
        $.ajax({
            type: 'get',
            url: 'order_fetch.php',
            data: {
                keywords: keywords
            },
            contentType: "application/json; charset=utf-8",
            dataType: 'json',

            success: function (response) {
                $("#order_list").empty();
                for (var i = 0; i < response.length; i++) {
                    $("#order_list").append("<tr><td>" + response[i].order_id + "</td>" +
                        "<td>" + response[i].order_date + "</td>" +
                        "<td>" + response[i].depart_code + "</td>" +
                        "<td>" + response[i].arrive_code + "</td>" +
                        "<td>" + response[i].flight_date + " " + response[i].depart_time + "</td>" +
                        "<td>$" + +response[i].amount + "</td></tr>");
                }
            },
            error: function () {
            }
        });
    }

    $(document).ready(function () {
        getUserList();
        $('#search').on("click", function () {
            getUserList();
        });
    });

</script>

<?php
$has = ($name != null);
if ($has) {
    $usrname = "\"$name\"";
    echo "<script type=text/javascript>hasLogin($usrname, $usr_type)</script>";
} else {
    echo "<script type=text/javascript>showLoginSignup()</script>";
}
?>
</html>





