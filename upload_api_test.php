<?php
    include 'config_db.php';



    // Get POST data
		$text = (!empty($_GET['text']) ? $_GET['text'] : '');
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
    date_default_timezone_set('Europe/Dublin');
    $createdDate = date("Y-m-d H:i:s", time());
    $input = 3;

             // Array for our insert
		try{
			             $query=array(':txt' => $text, ':input'=> $input, ':modifiedDate' => $createdDate);

			 					echo "1";
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

						$stmt = $db->prepare("UPDATE api_test2
    															SET update_text = COALESCE(:txt, update_text),
  																			modified_date = COALESCE(:modifiedDate, modified_date)
    															WHERE input_id = :input;");
																echo "here4";
            // Execute Query
            $stmt->execute($query);
						echo "here2";
            if($stmt) {
							//echo $stmt;
                 echo $projectId = $db->lastInsertId();
            } else {
                echo "No!";
            }
    }
    catch(PDOException $e)
    {
       $e->getMessage();
    }

?>
