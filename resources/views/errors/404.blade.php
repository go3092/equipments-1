<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>404 NOT FOUND PAGE</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">

	<!-- ICON -->
	<link rel="shortcut icon" type="image/x-icon" href="{{env('ADMINLTE')}}dist/img/rak_RGv_icon.ico" />
	<link rel="stylesheet" href="{{env('ADMINLTE')}}bower_components/bootstrap/dist/css/bootstrap.min.css">


</head>

<body>
	<div class="container">
		<div class="col-md-5 col-md-offset-4">
			<br><br><br><br>
			<h1>Oops!</h1>
			<h2>404 - The Page can't be found</h2>
			<a href="{{url('/home')}}" class="btn btn-danger">Go To Homepage</a>

		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>

<script type="text/JavaScript">
	redirectURL = "{{url('/home')}}";
	setTimeout("location.href = redirectURL;", 5000);
</script>
