<?php
session_start();
echo "<head>";
echo "<title>Menage Posts</title>";
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
                    echo '<a class="nav-link text-success" href="../orders/admin_orders.php">Menage Orders<span class="sr-only">(current)</span></a>';
                    echo '</li>';
                    echo '<li class="nav-item active">';
                    echo '<a class="nav-link text-success" href="admin_posts.php">Menage Page Content<span class="sr-only">(current)</span></a>';
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
    echo "<h1>Add Post</h1>";
    echo "Title";
    echo "<br>";
    echo "<input type='text' name='title'></input>";
    echo "<br>";
    echo "Content";
    echo "<br>";
    echo "<textarea style='resize: none; height:300px; width:300px;' type='text' name='content'></textarea>";
    echo "<br>";
    echo "<br>";
    echo "<button type='submit' name='submit' class='btn btn-primary'>Add</button>";
    echo "</form'>";


    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];


        if ($title != "" && $content!="") {
            $query_add = "INSERT INTO posts(Title, Content) VALUES ('$title','$content')";
            $con->query($query_add);
            echo '<script type ="text/JavaScript">alert("Post is added!")</script>';
        }
        else{
        echo '<script type ="text/JavaScript">alert("Fill every input!")</script>';

        }
    }
}
