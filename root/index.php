<?php
session_start();
require_once 'database/database.php';
$query = "SELECT * FROM cars";
$result_cars = $con->query($query);
$query = "SELECT * FROM posts";
$result_posts = $con->query($query);


echo "<head>";
echo "<title>Car Rental</title>";
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
echo "</head>";

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Car Rental</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">


            <?php


            if (isset($_SESSION["Email"])) {
                echo '<li class="nav-item active">';
                echo '<a class="nav-link text-primary" href="orders/orders.php">See your Orders<span class="sr-only">(current)</span></a>';
                echo '</li>';
                echo '<li class="nav-item active">';
                echo '<a class="nav-link text-primary" href="profile_update/profile_update.php">Update profile<span class="sr-only">(current)</span></a>';
                echo '</li>';
            }


            if (isset($_SESSION["Status"])) {
                if ($_SESSION["Status"] == 1) {
                    echo '<li class="nav-item active">';
                    echo '<a class="nav-link text-success" href="admin/cars/admin_cars.php">Menage Cars<span class="sr-only">(current)</span></a>';
                    echo '</li>';
                    echo '<li class="nav-item active">';
                    echo '<a class="nav-link text-success" href="admin/orders/admin_orders.php">Menage Orders<span class="sr-only">(current)</span></a>';
                    echo '</li>';
                    echo '<li class="nav-item active">';
                    echo '<a class="nav-link text-success" href="admin/posts/admin_posts.php">Menage Page Content<span class="sr-only">(current)</span></a>';
                    echo '</li>';
                }
            }


            if (!isset($_SESSION["Email"])) {
                echo '<li class="nav-item active">';
                echo '<a class="nav-link text-primary" href="login/login.php">Login<span class="sr-only">(current)</span></a>';
                echo '</li>';
                echo '<li class="nav-item active">';
                echo '<a class="nav-link text-primary" href="register/register.php">Regsiter<span class="sr-only">(current)</span></a>';
                echo '</li>';
            } else {
                '<li class="nav-item active">';
                echo "<form method='POST'>";
                echo "<button name='logout' class='btn btn-danger' type='submit'>Logout</button>";
                echo "</form>";
                '</li>';
            }

            if (isset($_POST["logout"])) {
                session_destroy();
                header("location: index.php");
            }
            ?>


        </ul>
    </div>
</nav>


<?php
echo "<div class='container'>";
for ($i = 0; $i < $result_posts->num_rows; $i++) {
    $row = $result_posts->fetch_assoc();

    echo "<div class='row border' style='margin-top: 10px;margin-bottom: 10px;'>";
    echo "<div class='col' style='margin-top: 10px;margin-bottom: 10px;' >";
    echo "<div class='container'>";
    echo "<div class='row '>";
    echo "<h1>" . $row["Title"] . "</h1>";
    echo "</div>";
    echo "<div class='row'>";
    echo "<span>" . $row["Content"] . "</span>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
echo "</div>";







echo "<div class='container'>";
for ($i = 0; $i < $result_cars->num_rows; $i++) {
    $row = $result_cars->fetch_assoc();
    echo "<div class='row border' style='margin-top: 10px;
    margin-bottom: 10px;'>";
    echo "<div class='col' >";
    echo "<h1>" . $row['Brand'] . " " . $row['Model'] . "</h1>";
    echo "<h5>" . $row['Description'] . "</h5>";
    echo "</br>";
    echo "<h2>$" . $row['Price'] . "/day</h2>";
    echo "<form method='POST'>";
    echo "<b>Book this car:</b>";
    echo "<br>";
    echo "Start date:";
    echo "<input name='start_date' type='date'>"; //start
    echo "<br>";
    echo "Return date:";
    echo "<input name='return_date' type='date'>"; //return
    echo "<input type='hidden' name='car_id' value=" . $row["ID"] . ">";
    echo "<br>";
    echo "<br>";
    echo "<button name='book' class='btn btn-primary'>Book</button>";


    echo "</form>";
    echo "</br>";
    echo "</div>";
    echo "<div class='col'>";
    echo "<img width='600px'src=" . $row["Image"] . ">";
    echo "</div>";
    echo "</div>";
}
echo "</div>";


if (isset($_POST["book"])) {
    if (isset($_SESSION["Email"])) {
        $start = $_POST["start_date"];
        $return = $_POST["return_date"];
        $car_id = $_POST["car_id"];

        if ($start != "" && $return != "") {
            if ($start <= $return) {
                $query = "INSERT INTO orders(User_Email, Car_ID, Start_Date, Return_Date, Order_status) VALUES ('" . $_SESSION['Email'] . "','$car_id','$start','$return','waiting')";
                $con->query($query);

            } else {
                echo '<script type ="text/JavaScript">alert("Return date must be after the starting date!")</script>';
            }
        } else {
            echo '<script type ="text/JavaScript">alert("Set starting and return date!")</script>';
        }
    } else {
        echo '<script type ="text/JavaScript">alert("Only registered users can rent cars!")</script>';
    }
}
?>
