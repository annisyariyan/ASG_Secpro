<?php
// Annisya Riyan Wulandini
// 2440086041

  session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                            <title>Login Page</title>
</head>
    <body style="Background: rgb(173,80,200); background: black(95deg, rgba(170,76,200,1) 12%, rgba(70,161,197,1) 45%, rgba(29,197,225,1) 100%);">

        <main class="m-3 d-block">
        <div class="container h-100 ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-15 col-xl-17">
                    <div class="card text-black" style="border-radius: 5px;">
                        <div class="card-body p-md-10">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
          
                                    <form style="width: 25rem;" method="POST" action="./LoginCheck.php">
                    
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">User Login</p>
                    
                                    <div class="form-outline flex-fill mb-1">
                                        <input type="text" name="Username" id="Username" class="form-control" />
                                            <label class="form-label" for="Username">Username</label>
                                        </div>
                    
                                    <div class="form-outline mb-5">
                                        <input type="Password" id="Password" name="Password" class="form-control form-control-lg" />
                                            <label class="form-label" for="password">Password</label>
                                            <br>
                                        <p>Doesn't have an account yet? <a href="./daftar.php" class="link-info">Sign up!</a></p>
                                    </div>

                                <?php
                                    if(!empty($_SESSION['error']))
                                    {

                                        echo'<div class="error-log">'; echo $_SESSION['error']; echo'</div>';
                                        unset($_SESSION['error']);

                                    }
                                    if(!empty($_GET['message']))
                                    {

                                        echo'<div class="error-log">'; echo $_GET['message']; echo'</div>';
                                        unset($_GET['error']);

                                    }
                                ?>
                    
                                    <div class="d-flex justify-content-center mx-2 mb-1 mb-lg-2">
                                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                    </div>

                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
    </main>
</body>
</html>
