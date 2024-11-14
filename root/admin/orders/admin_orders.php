<?php
ob_start();
session_start();

if ($_SESSION['Status'] == 1) {
    require_once '../../database/database.php';
    $email = $_SESSION['Email'];
    $query = "SELECT * FROM orders";
    $result = $con->query($query);

    echo "<head>";
    echo "<title>Menage Orders</title>";
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
    echo "</head>";

?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../../index.php">Car Rental</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">


                <?php


                if (isset($_SESSION["Email"])) {
                    echo '<li class="nav-item active">';
                    echo '<a class="nav-link text-primary" href="../../orders/orders.php">See your Orders<span class="sr-only">(current)</span></a>';
                    echo '</li>';
                    echo '<li class="nav-item active">';
                    echo '<a class="nav-link text-primary" href="../../profile_update/profile_update.php">Update profile<span class="sr-only">(current)</span></a>';
                    echo '</li>';
                }


                if (isset($_SESSION["Status"])) {
                    if ($_SESSION["Status"] == 1) {
                        echo '<li class="nav-item active">';
                        echo '<a class="nav-link text-success" href="../cars/admin_cars.php">Menage Cars<span class="sr-only">(current)</span></a>';
                        echo '</li>';
                        echo '<li class="nav-item active">';
                        echo '<a class="nav-link text-success" href="admin_orders.php">Menage Orders<span class="sr-only">(current)</span></a>';
                        echo '</li>';
                        echo '<li class="nav-item active">';
                        echo '<a class="nav-link text-success" href="../posts/admin_posts.php">Menage Page Content<span class="sr-only">(current)</span></a>';
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
                    header("location: ../../index.php");
                }
                ?>


            </ul>
        </div>
    </nav>


<?php

    echo "<div class='container text-center'>";
    echo "<h1>Menage Orders</h1>";
    echo "<table class='table table-striped'>";
    echo '<tbody>';
    echo '<tr>';
    echo '<td>User</td>';
    echo '<td>Car</td>';
    echo '<td>Car Image</td>';
    echo '<td>Start date</td>';
    echo '<td>Return date</td>';
    echo '<td>Total price</td>';
    echo '<td>Accept</td>';
    echo '<td>Decline</td>';
    echo '<td>Current Status</td>';

    echo '</tr>';





    for ($i = 0; $i < $result->num_rows; $i++) {
        $row = $result->fetch_assoc();
        $id = $row["ID"];

        $car_id = $row["Car_ID"];
        $query_car = "SELECT * FROM cars WHERE ID=$car_id";
        $car_result = $con->query($query_car);
        $car = $car_result->fetch_assoc();

        $user_adress = $row["User_Email"];
        $query_user = "SELECT * FROM users WHERE Email='$user_adress'";
        $user_result = $con->query($query_user);
        $user = $user_result->fetch_assoc();

        echo "<tr>";

        echo "<td>";
        echo $user["Name"] . " " . $user['Lastname'] . "<br>(" . $user["Email"] . ")";
        echo "</td>";

        echo "<td>";
        echo $car["Brand"] . " " . $car['Model'];
        echo "</td>";



        echo "<td>";
        echo "<img width=150px src='" . $car["Image"] . "'>";
        echo "</td>";

        echo "<td>";
        echo $row['Start_Date'];
        echo "</td>";

        echo "<td>";
        echo $row['Return_Date'];
        echo "</td>";

        echo "<td>";
        $datediff = strtotime($row['Return_Date']) - strtotime($row['Start_Date']);;
        $days_number = round($datediff / (60 * 60 * 24)) + 1;
        $total = $days_number * $car["Price"];
        if ($days_number == 1) {
            echo "<b class='text-success'>" . $total . "</b>$ (for $days_number day)";
        } else {
            echo "<b class='text-success'>" . $total . "</b>$ (for $days_number days)";
        }
        echo "</td>";



        echo "<td>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='order_id' value=$id>";
        echo "<button  type='submit' name='accept' class='btn btn-success'>Accept</button>";
        echo "</form>";
        echo "</td>";

        echo "<td>";
        echo "<form method='POST'>";
        echo "<input type='hidden' name='order_id' value=$id>";
        echo "<button  type='submit' name='decline' class='btn btn-danger'>Decline</button>";
        echo "</form>";
        echo "</td>";

        echo "<td>";
        if ($row["Order_status"] == "waiting") {
            echo "<button class='btn btn-warning'>Waiting</button>";
        } elseif ($row["Order_status"] == "accepted") {
            echo "<button class='btn btn-success'>Accepted</button>";
        } elseif ($row["Order_status"] == "declined") {
            echo "<button class='btn btn-danger'>Declined</button>";
        }
        echo "</td>";


        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    header("location:../index.php");
}

if (isset($_POST["accept"])) {
    $order_id = $_POST['order_id'];
    $query = "UPDATE orders SET Order_status='accepted' WHERE ID=$order_id";
    $con->query($query);
    header("location:admin_orders.php");
}


if (isset($_POST["decline"])) {
    $order_id = $_POST['order_id'];
    $query = "UPDATE orders SET Order_status='declined' WHERE ID=$order_id";
    $con->query($query);
    header("location:admin_orders.php");
    ob_end_flush();
}










?>