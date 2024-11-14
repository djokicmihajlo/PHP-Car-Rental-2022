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
    $query = "SELECT * FROM posts";
    $result = $con->query($query);

    echo "<div class='container text-center'>";
    echo "<h1>Menage Posts</h1>";
    echo "<br>";
    echo "<button class='btn btn-dark text-light'><a href='admin_posts_add.php'>Add new post</a></button>";


    echo "<table class='table table-striped'>";
    echo "<br>"
?>
    <tbody>
        <tr>
            <td>ID</td>
            <td>Title</td>
            <td>Content</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
    <?php



    for ($i = 0; $i < $result->num_rows; $i++) {
        $row = $result->fetch_assoc();
        echo "<tr>";
        echo "<td>";
        echo $row['ID'];
        echo "</td>";

        echo "<td>";
        echo $row['Title'];
        echo "</td>";

        echo "<td>";
        echo $row['Content'];
        echo "</td>";

        echo "<td>";
        echo '<form method="GET" action="admin_posts_edit.php">';
        echo "<button type='submit' name='edit' value='" . $row['ID'] . "'>Edit</button>";
        echo "</form>";
        echo "</td>";

        echo "<td>";
        echo '<form method="POST">';
        echo '<input type="hidden" name="delete_id" value=' . $row['ID'] . '>';
        echo "<input type='submit' name='delete' value='Delete'>";
        echo "</form>";
        echo "</td>";

        echo "</tr>";
        echo "<br>";
    }
    
    echo "</tbody>";
    echo "</table>";
}


if (isset($_POST['delete'])) {
    $query_delete = 'DELETE FROM posts WHERE ID=' . $_POST['delete_id'] . ';';
    $con->query($query_delete);
    header("location: admin_posts.php");

}


    ?>