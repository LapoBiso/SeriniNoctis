<?php

	header('Content-Type: text/json');
	include("configuration.php");
	$action = $_POST['action'];
	$query_string = "";

	switch($action) {

		case "insert" :
			insertName();
		break;
	}

	function insertName() {
    		if (isset($_POST['text']) && isset($_POST['game'])) {
    			$player = $_POST['text'];
    			$game = $_POST['game'];
    		} else {
    			return;
    		}
    		if(isset($_POST['ishost'])){
    		    $isHost=$_POST['ishost'];
    		}
    		else{
    		    $isHost=0;
    		}


    		$mysqli = new mysqli(DB_HOST,DB_USER, DB_PASSWORD,DB_DATABASE);
    		$query_string = 'INSERT INTO  players(nickname, game , points, ishost) VALUES ("' .$player .'","'.$game.'","0", "'.$isHost.'" )';
    		$result=$mysqli->query($query_string);

            $_SESSION["idUser"]=$mysqli->insert_id;

        	$query_string = 'SELECT * FROM players WHERE id="' . $mysqli->insert_id .'"';
    		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    		$result=$mysqli->query($query_string);

    		 // cicla sul risultato
    		 $players = array();
    		 while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    	           $id = $row['id'];
                   $nickname = $row['nickname'];
                   $game = $row['game'];
                   $points = $row['points'];
                   $player_isHost = $row['ishost'];



                   $player = array('id' => $id,'nickname' => $nickname ,'game' => $game,'points' => $points, 'ishost' => $player_isHost);

                   array_push($players, $player);
             }
                    $response = array('players' => $players, 'type' => 'insert');
                    // encodo l'array in JSON
                    echo json_encode($response);

    	}

?>