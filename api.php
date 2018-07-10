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
		alert("0");
		setInterval(function(){
			alert("1");
		     pull();
		   },5000);

		});

		function pull(){
			alert("Working");
				$.get("https://iercdevsrv.tyndall.ie/training/API/tests/data.php" ,{}, function(siteData){
					alert("3");
					// setDataSource(srch);
					var htmlSiteData = siteData;
					//converting the string format of the pulled html back to html
					convert = new DOMParser();
					raw = convert.parseFromString(htmlSiteData, "text/html");
					// console.log(htmlSiteData);
					// var text = raw.getElementById('subject').innerHTML;
					var text = raw.getElementsByTagName("textarea")[0];
					console.log(text);
					$('#ans').val(text);


				});
			}

		</script>
		</head>
		<body>
		<textarea type="text" name="subject" id="ans">
	  </textarea>
		</body>
		</html>
