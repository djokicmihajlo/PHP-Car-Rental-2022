<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
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
                <a class="nav-link text-primary" href="login.php">Login<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-primary" href="../register/register.php">Regsiter<span class="sr-only">(current)</span></a>
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
                                <h2 class=" text-center mb-5">User Login</h2>

                                <form method="POST">
                                    <div class="form-outline mb-4">
                                        <input type="email" name="email" class="form-control form-control-lg" />
                                        <label class="form-label" for="form3Example4cg">Email</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="pass" class="form-control form-control-lg" />
                                        <label class="form-label" for="form3Example4cg">Password</label>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="login" class="btn btn-primary text-light btn-block btn-lg gradient-custom-4">Login</button>
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
session_start();
require_once '../database/database.php';

if(isset($_POST["login"])){
    $email = $_POST["email"];
    $password = $_POST["pass"];

    
    $query ="SELECT * FROM users WHERE Email='$email';";
    $result = $con->query($query);

if($email!="" && $password!=""){
    if($result->num_rows > 0 )
    {
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['Password']))
        {
            $_SESSION["Name"] = $row["Name"];
            $_SESSION["Lastname"] = $row["Lastname"];
            $_SESSION["Email"] = $row["Email"];
            $_SESSION["Status"] = $row["Status"];
            header("location: ../index.php");

        }
        else{
            echo '<script type ="text/JavaScript">alert("Email and password dont match!")</script>';
        }
    }
    else{
        echo '<script type ="text/JavaScript">alert("Email that you are useing isnt registered yet!")</script>';
    }
    }
    if($email=="" || $password==""){
        echo '<script type ="text/JavaScript">alert("Fill every input!")</script>';
    }
}











?>