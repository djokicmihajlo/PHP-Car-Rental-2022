<?php
session_start();
if(isset($_SESSION["Email"])){
    require_once '../database/database.php';
    $email = $_SESSION['Email'];
    $query = "SELECT * FROM orders WHERE User_Email='$email'";
    $result = $con->query($query);


    echo "<head>";
    echo "<title>Orders</title>";
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
    echo "</head>";

    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php">Car Rental</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
    
    
                <?php
    
    
                if (isset($_SESSION["Email"])) {
                    echo '<li class="nav-item active">';
                    echo '<a class="nav-link text-primary" href="orders.php">See your Orders<span class="sr-only">(current)</span></a>';
                    echo '</li>';
                    echo '<li class="nav-item active">';
                    echo '<a class="nav-link text-primary" href="../profile_update/profile_update.php">Update profile<span class="sr-only">(current)</span></a>';
                    echo '</li>';
                }
    
    
                if (isset($_SESSION["Status"])) {
                    if ($_SESSION["Status"] == 1) {
                        echo '<li class="nav-item active">';
                        echo '<a class="nav-link text-success" href="../admin/cars/admin_cars.php">Menage Cars<span class="sr-only">(current)</span></a>';
                        echo '</li>';
                        echo '<li class="nav-item active">';
                        echo '<a class="nav-link text-success" href="../admin/orders/admin_orders.php">Menage Orders<span class="sr-only">(current)</span></a>';
                        echo '</li>';
                        echo '<li class="nav-item active">';
                        echo '<a class="nav-link text-success" href="../admin/posts/admin_posts.php">Menage Page Content<span class="sr-only">(current)</span></a>';
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
                    header("location: ../index.php");
                }
                ?>
    
    
            </ul>
        </div>
    </nav>
    
    
    <?php


    echo "<div class='container text-center'>";

    echo "<h1>Your orders</h1>";
    echo "<table class='table table-striped'>";  
    echo '<tbody>';
    echo '<tr>';
    echo '<td>Car</td>';
    echo '<td>Image</td>';
    echo '<td>Start date</td>';
    echo '<td>Return date</td>';
    echo '<td>Total price</td>';
    echo '<td>Cancle order</td>';
    echo '<td>Order status</td>';
    echo '</tr>';





    for ($i = 0; $i < $result->num_rows; $i++) {
        $row = $result->fetch_assoc();
        $car_id = $row["Car_ID"];
        $query_car = "SELECT * FROM cars WHERE ID=$car_id";
        $car_result = $con->query($query_car);
        $car = $car_result->fetch_assoc();


        echo "<tr>";
        echo "<td>";
        echo $car["Brand"]." ".$car['Model'];
        echo "</td>";

        echo "<td>";
        echo "<img width=150px src='".$car["Image"]."'>";
        echo "</td>";

        echo "<td>";
        echo $row['Start_Date'];
        echo "</td>";
        
        echo "<td>";
        echo $row['Return_Date'];
        echo "</td>";

        echo "<td>";
        $datediff = strtotime($row['Return_Date']) -strtotime($row['Start_Date']);;
        $days_number = round($datediff / (60 * 60 * 24))+1;
        $total = $days_number * $car["Price"];
        if($days_number==1){
        echo "<b class='text-success'>".$total."</b>$ (for $days_number day)";

        }else{
        echo "<b class='text-success'>".$total."</b>$ (for $days_number days)";
        }
        echo "</td>";

        echo "<td>";
        echo '<form method="POST">';
        echo '<input type="hidden" name="delete_id" value=' . $row['ID'] . '>';
        echo "<button type='submit' class='btn btn-danger' name='delete'>Cancle</button>";
        echo "</form>";
        echo "</td>";

        echo "<td>";
        if($row["Order_status"]=="waiting"){
            echo "<button class='btn btn-warning'>Waiting</button>";
        }
        elseif($row["Order_status"]=="accepted"){
            echo "<button class='btn btn-success'>Accepted</button>";

        }
        elseif($row["Order_status"]=="declined"){
            echo "<button class='btn btn-danger'>Declined</button>";

        }
        echo "</td>";

        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";

}else{
    header("location:../index.php");
}


if (isset($_POST['delete'])) {
    $query_delete = 'DELETE FROM orders WHERE ID=' . $_POST['delete_id'] . ';';
    header("location:orders.php");
    $con->query($query_delete);
}


?>