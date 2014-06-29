<?php

require_once('database.php');

if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['note'])){
	$note = $_POST['note'];
	$time = time();

	$query = "INSERT INTO notes (note,date) VALUES('$note','$time')";
	$result = mysqli_query(db_connect(),$query);
	
	if($result){
		header('HTTP/1.1 201 Created', TRUE, 201);
		header('Content-Type: application/json');
		print json_encode(array(
			'status' => array('message' => 'Note was create successfully...'),
			));
	}else{
		header('Content-Type: application/json');
		header('HTTP/1.1 400 Bad Request', TRUE, 400);
		print json_encode(array(
			'status' => array('message' => 'Unable to create note'),
			));
	}
        }elseif($_SERVER['REQUEST_METHOD'] === 'GET') {
        	$select = mysqli_query(db_connect(),'select * from notes');
        	
        	
        	$result = array();
        	$key = 0;
        	
        	while ($note = mysqli_fetch_assoc($select)) {
        		
        		$result[] = array();
        		$result[$key]['id'] = $note['id'];
        		$result[$key]['note'] = $note['note'];
        		$result[$key]['date'] = $note['date'];
        		$key++;
    }
    
    print json_encode($result);
} else {
	header('Content-Type: application/json');
	header('HTTP/1.1 400 Bad Request', true, 400);
	print json_encode(    array(
        'status' => array(
        	'message' => 'Unable to create note...'
        )
    ));
}
?>
