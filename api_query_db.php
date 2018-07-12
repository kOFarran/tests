<?php
    include 'config_db.php';


 $arr = array();
    // Get POST data
		 $call = (!empty($_GET['call']) ? $_GET['call'] : '');
	//


		// //Testing Purposes
		// echo  ' type :' . $type .' - ';
		// //echo  ' projID :' . $projID .' - ';
		// echo  ' Id: ' . $Id .' - ';
		// echo  ' Title: ' . $Title .' - ';
		// echo  ' Start: ' . $Start .' - ';
		// echo  ' End: ' . $End .' - ';
		// echo  ' Description: ' . $Description .' - ';
		// echo  ' Colour: ' . $Colour .' - ';
		// echo $loggedInUser;
		//
		//
		// echo "here";
		//
		// echo 'IDS - '. $Colour .' - ' . $pId .' - '. $tId .' - ' . $wpId .' - '. $aId .' - ';

		/* DATETIME for date_created in MySQL */
    // date_default_timezone_set('Europe/Dublin');
    // $createdDate = date("Y-m-d H:i:s", time());
    // $input = 3;

             // Array for our insert
		try{
			             // $query=array(':txt' => $text, ':input'=> $input, ':modifiedDate' => $createdDate);

			 					// echo "1";
            // Prepare Statement
            // $stmt = $db->prepare("INSERT INTO api_test2
						// 										(update_text, created_date)
						// 										VALUES (:txt, :createdDate)");

            /*
            /*IF NOT EXISTS (SELECT MAX(update_text) FROM api_test2
                   WHERE deleted_date IS NULL AND MAX(update_text) = "Second")
   BEGIN
      INSERT INTO api_test2
        (update_text, created_date)
        VALUES ("Second", 2018/07/09)
   END*/

/*INSERT INTO api_test2
	SELECT MAX(update_text) FROM api_test2
    WHERE NOT EXISTS(SELECT MAX(update_text) FROM api_test2 WHERE deleted_date IS NULL AND MAX(update_text) = "Second");

    INSERT INTO api_test2(update_text)
	VALUES ("Second")
    WHERE NOT EXISTS(SELECT update_text FROM api_test2 WHERE deleted_date IS NULL AND update_text = "Second");

            */
            if($call == "get_modified_date"){
						$stmt = $db->prepare("SELECT MAX(modified_date)
                                  FROM api_test1;");
																// echo "here4";
            }else if($call == "get_created_date"){
              $stmt = $db->prepare("SELECT MAX(created_date)
                                    FROM api_test1;");
            }
            // Execute Query
            $stmt->execute();
						// echo "here2";
            // if($stmt) {
						// 	//echo $stmt;
            //       echo $projectId = $db->lastInsertId();
            // } else {
            //      echo "No!";
            // }
            foreach($stmt as $result){
              // $arr1[0] = '123';
              // $arr1[1] =  '456';
              // echo $result[0];
              // echo $result[1];




              $arr1[0] = $result[0];

          //     //ob_end_clean();
          //     echo json_encode($arr1);
          //   //	echo $row1;
          //   //	echo $row2;
             }
             echo json_encode($arr1);
    }
    catch(PDOException $e)
    {
       $e->getMessage();
    }

?>
