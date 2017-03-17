<?php
?>
<html>
	<head>
		<meta charset="utf-8"/>
		 <link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
		 <link href="./bootstrap-3.3.7-dist/js/bootstrap.min.js" rel="stylesheet">
		 <link href="./css/login.css" rel="stylesheet">
	</head>


	<body >
	 <div class="container">

      <form class="form-signin" method="post" action="./testLogin.php" >
        <h2 class="form-signin-heading" style="text-align: center;">Connection</h2>
        <label for="inputEmail" class="sr-only">Email address</label> <br/>
        	<input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>	<br/>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="pws1" required><br/>

        <button class="btn btn-lg btn-primary btn-block" id="valider" type="submit">Sign in</button><br/>
        <a class="lien" href="./register.php">Enregistrez vous</a>
      </form>

    </div> <!-- /container -->
	</body>
</html>
