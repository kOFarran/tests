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
    //pulls the text from the text area on the other page initially when the page is loaded
    initialPull();

    //Checks for changes on the other page every 5 seconds
		setInterval(function(){
		     pull();
		   },5000);

       /*
       * Event listener for setting the Query button as clicked when hitting the Enter key
       */
       $("#query").keyup(function(event) {
          if (event.keyCode === 13) {
              $("#queryButton").click();
          }
        });

        /*
        * Event listener for when the query button is clicked
        */
       $('#queryButton').on('click', function(){
         var query = $('#query').val();

         apiDB(query);
       })

		});
    /*
    * The initial pull from the other page to display the text in the box without updateing the DB
    */
    function initialPull(){
        $.get("https://iercdevsrv.tyndall.ie/training/API/tests/data.php" ,{}, function(siteData){
          var htmlSiteData = siteData;
          //converting the string format of the pulled html back to html
          convert = new DOMParser();
          raw = convert.parseFromString(htmlSiteData, "text/html");
          var text = raw.getElementsByTagName("textarea")[0].innerHTML;
          console.log(text);
          $('#ans').val(text);
        });
      }

    /*
    * function that pulls the data from the other page and updates the db if there are any changes since the last pull
    */
		function pull(){
				$.get("https://iercdevsrv.tyndall.ie/training/API/tests/data.php" ,{}, function(siteData){
					var htmlSiteData = siteData;
					//converting the string format of the pulled html back to html
					convert = new DOMParser();
					raw = convert.parseFromString(htmlSiteData, "text/html");
					var text = raw.getElementsByTagName("textarea")[0].innerHTML;
					console.log(text);
          var current = $('#ans').val();
          current = current.trim();
          var pulled = text.trim()
          //checking if there are any changes since the last pull
          if(current != pulled){
            uploadText(text);
          }else{
            console.log("No changes");
          }
					$('#ans').val(text);
				});
			}
      /*
      * Ajax call to uplad the text to the db if there are any changes detected
      */
      function uploadText(text){
        dataString = 'text='+text;
        $.ajax({
          type: "GET"
          , url: "update_pulled_text.php"
          , data: dataString
          , cache: false
          , contentType: false
          , processData: false
          , success: function(data){
            console.log("success "+data);
          }
          , error: function(data){
            console.log("error "+ data);
          }
        })
      }

      /*
      * ajax call to retrieve data from the db depending on the api call
      */
      function apiDB(api){
        api = api.trim();
        var dataString = 'call='+api;

          $.ajax({
            type: "Get"
            , url: "api_query_db.php"
            , data: dataString
            , cache: false
            , contentType: false
            , processData: false
            , dataType: 'json'
            , success: function(data){
              if(api == 'get_modified_date'){
                $("#displayResult").html('<div class="alert alert-success fade in"><button data-dismiss="alert" class="close">&times;</button><i class="fa fa-check-circle"></i><strong> Completed! </strong> Last Modified Date is: ' + data[0] + ' </div>');
              }else if(api == 'get_created_date'){
                $("#displayResult").html('<div class="alert alert-success fade in"><button data-dismiss="alert" class="close">&times;</button><i class="fa fa-check-circle"></i><strong> Completed! </strong> Created Date is: ' + data[0] + ' </div>');

              }
            }
            , error: function(data){
              $("#displayResult").html('<div class="alert alert-danger fade in"><button data-dismiss="alert" class="close">&times;</button><i class="fa fa-check-circle"></i><strong> Error! </strong> Unable to execute: ' + data + ' </div>');

            }
          })
      }


		</script>
		</head>
		<body>
      <div class="row col-sm-12">
        <div class="col-sm-2">
		<textarea type="text" name="subject" id="ans">
	  </textarea>
  </div>
  </div>
    <div class="row col-sm-12">
      <div class="col-sm-2">
        <label>Input API</label><br>
        <input class="form-group" type="text" id="query" placeholder="Query the DB?"></input>
        <div id="queryButton" class="btn btn-success">Query</div>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseInfo" aria-expanded="false" aria-controls="collapseExample">
          What to input
        </button>
        <div class="collapse" id="collapseInfo">
              <a href="#get_created_date_info" data-toggle="collapse" aria-expanded="false">get_created_date</a>
            <ul class="collapse list-unstyled" id="get_created_date_info">
              <p>Retrieves the date this input was created in the Database</p>
            </ul><br>
            <a href="#get_modified_date_info" data-toggle="collapse" aria-expanded="false">get_modified_date</a>
          <ul class="collapse list-unstyled" id="get_modified_date_info">
            <p>Retrieves the last date the input was modified</p>
          </ul>

          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12" id="displayResult"></div>
    </div>
		</body>
		</html>
