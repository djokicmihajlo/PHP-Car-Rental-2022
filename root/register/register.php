<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../index.php">Car Rental</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-primary" href="../login/login.php">Login<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-primary" href="register.php">Regsiter<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>


<body>
    <section class="bg-image" style="margin-top:5%">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class=" text-center mb-5">Create an account</h2>

                                <form method="POST">

                                    <div class="form-outline mb-4">
                                        <input type="text" name="name" class="form-control form-control-lg" />
                                        <label class="form-label" for="form3Example1cg">Your Name</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" name="lastname" class="form-control form-control-lg" />
                                        <label class="form-label" for="form3Example3cg">Your Lastname</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="email" name="email" class="form-control form-control-lg" />
                                        <label class="form-label" for="form3Example4cg">Email</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="pass" class="form-control form-control-lg" />
                                        <label class="form-label" for="form3Example4cg">Password</label>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="register" class="btn btn-primary text-light btn-block btn-lg gradient-custom-4">Register</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
<?php
require_once '../database/database.php';

if (isset($_POST["register"])) {
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);


    if (
        !empty($name) &&
        !empty($lastname) &&
        preg_match('/^[a-zA-Z]{4,20}$/', $name) &&
        preg_match('/^[a-zA-Z]{4,20}$/', $lastname) &&
        (empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL)) &&
        (empty($password) || (strlen($password) >= 4 && strlen($password) <= 20))
    ) {
        $query = "INSERT INTO users(Email, Name, Lastname, Password, Status) VALUES('$email', '$name', '$lastname', '$password_hash', '0');";
        $query_validation = "SELECT * FROM users where Email = '" . $email . "'";
        $user_array = $con->query($query_validation);

        if ($user_array->num_rows > 0) {
            echo '<script type ="text/JavaScript">alert("Email is already being used")</script>';
        } else {
            $con->query($query);
            header("location:../login/login.php");
        }
    } else {
        $errors = [];
        if (empty($name)) {
            $errors[] = 'Name is required';
        } elseif (!preg_match('/^[a-zA-Z]{4,20}$/', $name)) {
            $errors[] = 'Name must be 4-20 alphabetic characters without whitespace';
        }
        if (empty($lastname)) {
            $errors[] = 'Last name is required';
        } elseif (!preg_match('/^[a-zA-Z]{4,20}$/', $lastname)) {
            $errors[] = 'Last name must be 4-20 alphabetic characters without whitespace';
        }
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        }
        if (!empty($password) && (strlen($password) < 4 || strlen($password) > 20)) {
            $errors[] = 'Password length must be 4-20 characters';
        }
        // Handle errors
        if (count($errors) > 0) {
            echo '<br><div class="alert alert-danger text-center" role="alert">The following errors occurred:<br>';
            foreach ($errors as $error) {
                echo '- ' . $error . '<br>';
            }
            echo "</div>";
        }
}
}








?>