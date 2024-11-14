<?php
session_start();
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
    require_once '../../database/database.php';

    echo "<div class='container text-center'>";
    echo "<form method='POST'>";
    echo "<h1>Add new Car</h1>";
    echo "Brand";
    echo "<br>";
    echo "<input type='text' name='brand'></input>";
    echo "<br>";
    echo "Model";
    echo "<br>";
    echo "<input type='text' name='model'></input>";
    echo "<br>";
    echo "Price";
    echo "<br>";
    echo "<input type='number' min=1 name='price'></input>";
    echo "<br>";
    echo "Description";
    echo "<br>";
    echo "<textarea type='text' name='desc'></textarea>";
    echo "<br>";
    echo "Image";
    echo "<br>";
    echo "<input type='text' name='image'></input>";
    echo "<br>";
    echo "<br>";
    echo "<button type='submit' name='submit' class='btn btn-primary'>Add</button>";
    echo "</form'>";


    if (isset($_POST['submit'])) {
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $price = $_POST['price'];
        $desc = $_POST['desc'];
        $image = $_POST['image'];
    
    
        if (
            !empty($brand) &&
            !empty($model) &&
            !empty($price) &&
            !empty($desc) &&
            !empty($image) &&
            ctype_alpha(str_replace(' ', '', $brand)) &&
            strlen($brand) >= 2 &&
            strlen($brand) <= 20 &&
            strlen($model) >= 2 &&
            strlen($model) <= 20 &&
            is_numeric($price) &&
            strlen($price) >= 1 &&
            strlen($price) <= 20 &&
            strlen($desc) >= 4 &&
            strlen($desc) <= 100
        ) {
            $query_add = "INSERT INTO cars(Brand, Model, Price, Description, Image) VALUES ('$brand','$model','$price','$desc','$image')";
            $con->query($query_add);
            echo '<script type ="text/JavaScript">alert("Car is added!")</script>';
        } else {
            $errors = [];
            if (empty($brand)) {
                $errors[] = 'Brand name is required';
            } elseif (!ctype_alpha(str_replace(' ', '', $brand)) || strlen($brand) < 2 || strlen($brand) > 20) {
                $errors[] = 'Brand name must be 2-20 alphabetic characters long';
            }
            if (empty($model)) {
                $errors[] = 'Model name is required';
            } elseif (strlen($model) < 2 || strlen($model) > 20) {
                $errors[] = 'Model name must be 2-20 characters long';
            }
            if (empty($price)) {
                $errors[] = 'Price is required';
            } elseif (!is_numeric($price)) {
                $errors[] = 'Price must only contain numeric characters';
            } elseif ($price < 1 || strlen($price) > 20) {
                $errors[] = 'Price must be a number between 1 and 20 digits long';
            }
            if (empty($desc)) {
                $errors[] = 'Description is required';
            } elseif (strlen($desc) < 4 || strlen($desc) > 100) {
                $errors[] = 'Description length must be between 4 and 100 characters';
            }
            if (empty($image)) {
                $errors[] = 'Image is required';
            }
            if (count($errors) > 0) {
                echo '<br><div class="alert alert-danger text-center" role="alert">The following errors occurred:<br>';
                foreach ($errors as $error) {
                    echo '- ' . $error . '<br>';
                }
                echo "<div/>";
            }
        }
}
}
?>