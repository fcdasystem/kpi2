<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Webpixels">
    <title>OnlineLibrary</title>
    <!-- Preloader -->
    <style>
        @keyframes hidePreloader {
            0% {
                width: 100%;
                height: 100%;
            }

            100% {
                width: 0;
                height: 0;
            }
        }

        body>div.preloader {
            position: fixed;
            background: white;
            width: 100%;
            height: 100%;
            z-index: 1071;
            opacity: 0;
            transition: opacity .5s ease;
            overflow: hidden;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body:not(.loaded)>div.preloader {
            opacity: 1;
        }

        body:not(.loaded) {
            overflow: hidden;
        }

        body.loaded>div.preloader {
            animation: hidePreloader .5s linear .5s forwards;
        }
    </style>
    <script>
        window.addEventListener("load", function() {
            setTimeout(function() {
                document.querySelector('body').classList.add('loaded');
            }, 300);
        });
    </script>
    <!-- Favicon -->
    <link rel="icon" href="assets/img/brand/favicon.png" type="image/png"><!-- Font Awesome -->
    <link rel="stylesheet" href="assets/libs/@fortawesome/fontawesome-free/css/all.min.css">
    <!-- Quick CSS -->
    <link rel="stylesheet" href="assets/css/quick-website.css" id="stylesheet">
</head>

<body>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-cookies" data-backdrop="false" aria-labelledby="modal-cookies" aria-hidden="true">
        <div class="modal-dialog modal-dialog-aside left-4 right-4 bottom-4">
            <div class="modal-content bg-dark-dark">
                <div class="modal-body">
                    <!-- Text -->
                    <p class="text-sm text-white mb-3">
                        We use cookies so that our themes work for you. By using our website, you agree to our use of cookies.
                    </p>
                    <!-- Buttons -->
                    <a href="pages/utility/terms.html" class="btn btn-sm btn-white" target="_blank">Learn more</a>
                    <button type="button" class="btn btn-sm btn-primary mr-2" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section>
        <div class="container d-flex flex-column">
            <div class="row align-items-center justify-content-center min-vh-100">
                <div class="col-md-6 col-lg-5 col-xl-5 py-6 py-md-0">
                    <div class="card shadow zindex-100 mb-0">
                        <div class="card-body px-md-5 py-5">
                            <div class="mb-5">
                                <h6 class="h3">Вхід</h6>
                                <p class="text-muted mb-0">Введіть логін та пароль</p>
                            </div>
                            <span class="clearfix"></span>

                            <form name="form1" method="post" action="">
<div class="form-group">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i data-feather="user"></i></span>
</div>
<input name="adusername" type="text" id="adusername" class="form-control" placeholder="Логін"/>
</div>
</div>
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text"><i data-feather="key"></i></span>
</div>
<input name="adpassword" type="password" id="adpassword" class="form-control" placeholder="Пароль"/>
</div>

</div>
<div class="mt-4">
<button type="submit" name="submit" value="Login" class="btn btn-block btn-primary">Вхід</button></div>
</div>
</form>


<?php
if(isset($_POST["submit"])){

if(!empty($_POST['adusername']) && !empty($_POST['adpassword'])) {
	$user=$_POST['adusername'];
	$pass=$_POST['adpassword'];

	include 'conn.php';
	$sql = sprintf("SELECT * FROM admin WHERE Email='%s' AND Password='%s'",
		$mysqli->real_escape_string($user),
		$mysqli->real_escape_string($pass));
	
	$result=$mysqli->query($sql);
	
	
	/* if there are some errors with the sql */
	if(!$result){
		$message = 'Invalid query:'.$mysqli->error."<br>";
		$message .= 'Whole query:'.$sql;
		die($message);
	}

	//$numrows=mysql_num_rows($query);
	$numrows = $result->num_rows;
	
		
	if($numrows!=0)
	{
		while($row=$result->fetch_assoc())
		{

			$dbusername=$row['Email'];
			$dbpassword=$row['Password'];
			$Name=$row['Name'];
		}


		if($user == $dbusername && $pass == $dbpassword)
		{

			session_start();
			$_SESSION['sess_user']=$Name;

			/* Redirect browser */
			header("Location: admin.php");
		}
	}
	else{
		echo "Некоректний логін або пароль";
	}
	$result->free();
	$mysqli->close();

} 
else {
	echo "All fields are required!";
}

}
?>

   
    <!-- Core JS  -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/svg-injector/dist/svg-injector.min.js"></script>
    <script src="assets/libs/feather-icons/dist/feather.min.js"></script>
    <!-- Quick JS -->
    <script src="assets/js/quick-website.js"></script>
    <!-- Feather Icons -->
    <script>
        feather.replace({
            'width': '1em',
            'height': '1em'
        })
    </script>
</body>

</html>