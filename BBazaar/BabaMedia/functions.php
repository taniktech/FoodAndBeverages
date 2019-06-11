<?php
//Include db config file
require 'db.php';
class customFunctions
{

//To Get All Media availble in Index page
public function getActiveMedia()
{
	$sql ="SELECT * FROM ts_media";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	  	$rc = "1";
		$res['rc'] = $rc;
		$res['rd'] = $results;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	  else
	  {
	  	$rc = "2";
		$res['rc'] = $rc;
		$json_res = json_encode($res);
	  	return $json_res;
	  }
	}
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}

//End of file
}
?>