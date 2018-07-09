<?php

function get_price($name)
{
	$products = [
		"book"=>20,
		"pen"=>10,
		"pencil"=>5
	];

	foreach($products as $product=>$price)
	{
		if($product==$name)
		{
			return $price;
			break;
		}
	}
}

function get_text(){
  $text = $_GET['subject'];
  return $text;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Rest API Client Side Demo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#save').on('click', function(){
				$('#subject').append
			})
		})

	</script>
</head>
<body>
  <form name="form" action="" method="get">
  <textarea type="text" name="subject" id="subject">
    This is text from the input new
  </textarea>
</form>
</body>
</html>
