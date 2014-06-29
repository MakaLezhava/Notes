<?php


require_once('database.php');

if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['delete'])){

	$note_delete_ids = $_POST['delete'];

	$result = mysqli_query(db_connect(),"delete from notes where id IN ($note_delete_ids)");

	if($result) {
			header('HTTP/1.1 201 Created', TRUE, 201);
      header('Content-Type: application/json');
			print json_encode(array(
				'status' => array('message' => 'Note was successfully deleted...'),
			));
		}else{
			header('Content-Type: application/json');
      header('HTTP/1.1 400 Bad Request', TRUE, 400);

      print json_encode(array(
				'status' => array('message' => 'Unable to delete note'),
			));
		}
}