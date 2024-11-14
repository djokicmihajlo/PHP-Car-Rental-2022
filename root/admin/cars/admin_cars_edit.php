<?php

session_start();
require_once '../../database/database.php';


echo "<head>";
echo "<title>Menage Cars</title>";
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
                    echo '<a class="nav-link text-success" href="admin_cars.php">Menage Cars<span class="sr-only">(current)</span></a>';
                    echo '</li>';
                    echo '<li class="nav-item active">';
                    echo '<a class="nav-link text-success" href="../orders/admin_orders.php">Menage Orders<span class="sr-only">(current)</span></a>';
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

if ($_SESSION["Status"] != 1) {
    header("location: ../index.php");
} else {
    $id = $_GET['edit'];
    $con = new mysqli("localhost", "root", "", "car_rental");
    $query = "SELECT * FROM cars WHERE ID=$id;";
    $result = $con->query($query);
    $car = $result->fetch_assoc();

    $brand = $car["Brand"];
    $model = $car["Model"];
    $price = $car["Price"];
    $desc = $car["Description"];
    $image = $car["Image"];


    echo "<div class='container text-center'>";
    echo "<form method='POST'>";
    echo "<h1>Edit Car</h1>";
    echo "Brand";
    echo "<br>";
    echo "<textarea style='resize:none' type='text' name='brand'>$brand</textarea>";
    echo "<br>";
    echo "Model";
    echo "<br>";
    echo "<textarea style='resize:none' type='text' name='model'>$model</textarea>";
    echo "<br>";
    echo "Price";
    echo "<br>";
    echo "<input style='resize:none' type='number' min=1 name='price' value='$price'></input>";
    echo "<br>";
    echo "Description";
    echo "<br>";
    echo "<textarea style='resize:none' type='text' name='desc' >$desc</textarea>";
    echo "<br>";
    echo "Image";
    echo "<br>";
    echo "<textarea style='resize:none' type='text' name='image' >$image</textarea>";
    echo "<br>";
    echo "<br>";
    echo "<button type='submit' name='submit' class='btn btn-primary'>Update</button>";
    echo "</form'>";



    if (isset($_POST['submit'])) {
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $price = $_POST['price'];
        $desc = $_POST['desc'];
        $image = $_POST['image'];
        $query_update = "UPDATE cars SET Brand='$brand',Model='$model',Price='$price',Description='$desc',Image='$image' WHERE ID=$id;";
        $con->query($query_update);
        // echo $query_update;
        header("location:admin_cars_edit.php?edit=$id");
    }
}

