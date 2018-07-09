<?php
include 'config_db.php';

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
				upload();
			})
		})

		function upload(){
			var text = $('#subject').val();

			var dataString = "text="+text

			$.ajax({
				type: "GET"
				, url: "upload_api_test.php"
				, data: dataString
				, cache: false
				, contentType: false
				, processData: false
				, success: function(data){
					alert('success '+ data);
				}
				, error: function(data){
					alert('Error '+data);
				}
			})

		}
		function addText(txt){
			$('#subject').val(txt);
		}
	</script>
</head>
<body>
  <form name="form" action="" method="get">
  <textarea type="text" name="subject" id="subject">
  </textarea>
	<div id="save" class="btn btn-success">Save</div>

</form>
<?php try{

	$QueryIndexDetails = "SELECT MAX(update_text) FROM api_test2 WHERE deleted_date IS NULL;";

	$ResultIndexDetails = $db->prepare($QueryIndexDetails);

	$ExecIndexDetails = $ResultIndexDetails->execute();

	foreach ($ResultIndexDetails as $RowIndexDetails) {
	//	echo '<script type="text/javascript"> alert("foreachA"); </script>';
		$databaseText = $RowIndexDetails['MAX(update_text)'];

		//$databaseColor = ltrim($databaseColor, '#');

		echo '<script type="text/javascript">addText("'.$databaseText.'");</script>';
	}


	}
	catch(PDOException $e) {
	echo $e->getMessage();
	}
	 ?>
</body>
</html>
