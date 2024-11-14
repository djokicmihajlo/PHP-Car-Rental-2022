<?php
session_start();
if (isset($_SESSION["Email"])) {


    echo "<head>";
    echo "<title>Update Profile</title>";
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
                    echo '<a class="nav-link text-primary" href="../orders/orders.php">See your Orders<span class="sr-only">(current)</span></a>';
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
    require_once '../database/database.php';
    $email = $_SESSION['Email'];

    $query = "SELECT * FROM users WHERE Email='$email'";
    $result = $con->query($query);
    $user = $result->fetch_assoc();

    $id = $user["ID"];

    $name = $user["Name"];
    $lastname = $user["Lastname"];
    $email = $user["Email"];
    $password = $user["Password"];

    echo "<div class='container text-center'>";

    echo "<div class='border'>";
    echo "<h3>Change Name & Lastname</h3>";
    echo "<form method='POST'>";
    echo "Name:<br>";
    echo "<input name='name' type='text' value=$name>";
    echo "<br>Lastname:<br>";
    echo "<input name='lastname' type='text' value=$lastname>";
    echo "<br>";
    echo "<br>";
    echo "<button type='submit' name='submit_name_lastname' class='btn btn-primary'>Update</button>";
    echo "</form>";
    echo "</div>";


    echo "<div class='border'>";
    echo "<h3>Change Email adress</h3>";
    echo "<form method='POST'>";
    echo "Email:<br>";
    echo "<input name='email' type='email' value=$email>";
    echo "<br>";
    echo "<br>";
    echo "<button type='submit' name='submit_email' class='btn btn-primary'>Update</button>";
    echo "</form>";
    echo "</div>";

    echo "<div class='border'>";
    echo "<h3>Change Password</h3>";
    echo "<form method='POST'>";
    echo "Current Password:<br>";
    echo "<input name='pass_current' type='password'>";
    echo "<br>";
    echo "New Password:<br>";
    echo "<input name='pass_new' type='password'>";
    echo "<br>";
    echo "<br>";
    echo "<button type='submit' name='submit_pass' class='btn btn-primary'>Update</button>";
    echo "</form>";
    echo "</div>";


    echo "</div>";
}


if (isset($_POST['submit_name_lastname'])) {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];

    if ($name != "" && $lastname != "") {
        $query = "UPDATE users SET Name='$name',Lastname = '$lastname' WHERE ID=$id";
        if ($con->query($query)) {
            $_SESSION['Name'] = $name;
            $_SESSION['Lastname'] = $lastname;
            header("location:profile_update.php");
        }
    }
}

if (isset($_POST['submit_email'])) {
    $email = $_POST['email'];

    $query_validation = "SELECT * FROM users where Email = '" . $email . "'";
    $user_array = $con->query($query_validation);
    $user = $user_array->fetch_assoc();

    if ($user_array->num_rows > 0) {
        echo '<script type ="text/JavaScript">alert("New email adress is already being used!")</script>';
    } else {
        if ($email != "") {
            $query = "UPDATE users SET Email='$email' WHERE ID=$id";
            if ($con->query($query)) {
                $_SESSION['Email'] = $email;
                header("location:profile_update.php");
            }
        }
    }
}

if (isset($_POST['submit_pass'])) {
    $pass_current = $_POST["pass_current"];
    $pass_new = $_POST['pass_new'];


    if (strlen($pass_new) >= 4) {
        if (password_verify($pass_current, $password)) {
            if ($pass_new != "") {
                $pass_new_hash = password_hash($pass_new, PASSWORD_BCRYPT);
                $query = "UPDATE users SET Password='$pass_new_hash' WHERE ID=$id";
                $con->query($query);
            }
        } else {
            // echo 'Invalid password.';
            echo '<script type ="text/JavaScript">alert("Invalid password!")</script>';
        }
    } else {
        echo '<script type ="text/JavaScript">alert("Password needs to have at least 4 characters!")</script>';
    }
}
