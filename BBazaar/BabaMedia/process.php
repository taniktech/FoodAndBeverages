<?php
error_reporting(0);
if(isset($_POST) && isset($_POST['_token']))
{
//Include db config file
//Functions.php has db.php so no need to require
//require 'db.php';
require 'functions.php'; 


//Load Next forms after media is selcted
if($_POST['_token'] == "check_Adv_Req_Data")
{

	$mediaID = $_POST['mediaID'];
	$sql ="SELECT * FROM ts_media WHERE ts_media_id='$mediaID'";
	try
	{
	  //get db object
	  $db= new db();
	  //connection_aborted
	  $db=$db->connect();
	  $stmt=$db->query($sql);
	  if($stmt->rowCount() > 0)
	  {
	  		$results = $stmt->fetch(PDO::FETCH_ASSOC);
			$rc = "1";
			$rd = $results;
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
			echo $json_res;
	  }	
	  else
	  {
		$rc="2";
		$res['rc']=$rc;
		$json_res=json_encode($res);
		echo $json_res; 
	  }	
	  
	  }
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }


}

//Get All FM location
if($_POST['_token'] == "load_fm_location")
{

	$sql ="SELECT DISTINCT fm_location FROM ts_fm_radio_data";
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
			$rd = $results;
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
			echo $json_res;
	  }	
	  else
	  {
		$rc="2";
		$res['rc']=$rc;
		$json_res=json_encode($res);
		echo $json_res; 
	  }	
	  
	  }
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
//Load FM channels based on cities
if($_POST['_token'] == "load_fm_channels")
{
	$citiesArray = $_POST['cities'];
	if(isset($citiesArray) && !empty($citiesArray) && is_array($citiesArray))
	{

		$in  = str_repeat('?,', count($citiesArray) - 1) . '?';
		$sql ="SELECT DISTINCT channel_name FROM ts_fm_radio_data WHERE fm_location in ($in) GROUP BY channel_name";
		try
		{
		  //get db object
		  $db= new db();
		  //connection_aborted
		  $db=$db->connect();
		  $stmt=$db->prepare($sql);
		  $stmt->execute($citiesArray);
		  if($stmt->rowCount() > 0)
		  {
		  		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$rc = "1";
				$rd = $results;
				$res['rc'] = $rc;
				$res['rd'] = $results;
				$json_res = json_encode($res);
				echo $json_res;
		  }	
		  else
		  {
			$rc="2";
			$res['rc']=$rc;
			$json_res=json_encode($res);
			echo $json_res; 
		  }	
		  
		  }
		catch(PDOException $e)
		 {
		echo '{"error":{"text":'.$e->getMessage().'}}';
		 }
	}
	else
	{
		$rc="3";
		$res['rc']=$rc;
		$json_res=json_encode($res);
		echo $json_res; 
	}	

}
//Get All TV languages
if($_POST['_token'] == "load_tv_language")
{

	$sql ="SELECT DISTINCT tv_language FROM ts_tv_data";
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
			$rd = $results;
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
			echo $json_res;
	  }	
	  else
	  {
		$rc="2";
		$res['rc']=$rc;
		$json_res=json_encode($res);
		echo $json_res; 
	  }	
	  
	  }
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
//Load TV channels based on Language
if($_POST['_token'] == "load_tv_channels")
{
	$langsArray = $_POST['langs'];
	if(isset($langsArray) && !empty($langsArray) && is_array($langsArray))
	{

		$in  = str_repeat('?,', count($langsArray) - 1) . '?';
		$sql ="SELECT DISTINCT channel_name FROM ts_tv_data WHERE tv_language in ($in) GROUP BY channel_name";
		try
		{
		  //get db object
		  $db= new db();
		  //connection_aborted
		  $db=$db->connect();
		  $stmt=$db->prepare($sql);
		  $stmt->execute($langsArray);
		  if($stmt->rowCount() > 0)
		  {
		  		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$rc = "1";
				$rd = $results;
				$res['rc'] = $rc;
				$res['rd'] = $results;
				$json_res = json_encode($res);
				echo $json_res;
		  }	
		  else
		  {
			$rc="2";
			$res['rc']=$rc;
			$json_res=json_encode($res);
			echo $json_res; 
		  }	
		  
		  }
		catch(PDOException $e)
		 {
		echo '{"error":{"text":'.$e->getMessage().'}}';
		 }
	}
	else
	{
		$rc="3";
		$res['rc']=$rc;
		$json_res=json_encode($res);
		echo $json_res; 
	}	

}
//Get All Cinema location (Currenlty from Newspaper Table)
if($_POST['_token'] == "load_cinema_location")
{

	$sql ="SELECT DISTINCT newspaper_location FROM ts_newspaper_data";
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
			$rd = $results;
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
			echo $json_res;
	  }	
	  else
	  {
		$rc="2";
		$res['rc']=$rc;
		$json_res=json_encode($res);
		echo $json_res; 
	  }	
	  
	  }
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
//Get All Auto location (Currenlty from Newspaper Table)
if($_POST['_token'] == "load_np_location")
{

	$sql ="SELECT DISTINCT newspaper_location FROM ts_newspaper_data";
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
			$rd = $results;
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
			echo $json_res;
	  }	
	  else
	  {
		$rc="2";
		$res['rc']=$rc;
		$json_res=json_encode($res);
		echo $json_res; 
	  }	
	  
	  }
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
//Get All Newspaper location
if($_POST['_token'] == "load_auto_location")
{

	$sql ="SELECT DISTINCT newspaper_location FROM ts_newspaper_data";
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
			$rd = $results;
			$res['rc'] = $rc;
			$res['rd'] = $rd;
			$json_res = json_encode($res);
			echo $json_res;
	  }	
	  else
	  {
		$rc="2";
		$res['rc']=$rc;
		$json_res=json_encode($res);
		echo $json_res; 
	  }	
	  
	  }
	catch(PDOException $e)
	 {
	echo '{"error":{"text":'.$e->getMessage().'}}';
	 }
}
//Load Newspaer based on City
if($_POST['_token'] == "load_newspaper")
{
	$citiesArray = $_POST['cities'];
	if(isset($citiesArray) && !empty($citiesArray) && is_array($citiesArray))
	{

		$in  = str_repeat('?,', count($citiesArray) - 1) . '?';
		$sql ="SELECT DISTINCT newspaper FROM ts_newspaper_data WHERE newspaper_location in ($in) GROUP BY newspaper";
		try
		{
		  //get db object
		  $db= new db();
		  //connection_aborted
		  $db=$db->connect();
		  $stmt=$db->prepare($sql);
		  $stmt->execute($citiesArray);
		  if($stmt->rowCount() > 0)
		  {
		  		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$rc = "1";
				$rd = $results;
				$res['rc'] = $rc;
				$res['rd'] = $results;
				$json_res = json_encode($res);
				echo $json_res;
		  }	
		  else
		  {
			$rc="2";
			$res['rc']=$rc;
			$json_res=json_encode($res);
			echo $json_res; 
		  }	
		  
		  }
		catch(PDOException $e)
		 {
		echo '{"error":{"text":'.$e->getMessage().'}}';
		 }
	}
	else
	{
		$rc="3";
		$res['rc']=$rc;
		$json_res=json_encode($res);
		echo $json_res; 
	}	

}
//Load Newspaer categories
if($_POST['_token'] == "load_np_categories")
{

	foreach (new DirectoryIterator(__DIR__."/assets/images/Ad_Size_pics/") as $file) {
		  if ($file->isDir()) {
		      if($file->getBasename() != '.' && $file->getBasename() != '..')
		      {
		      	$data[] = array("category"=>$file->getBasename());

		      }
		      	
		  }
		}
		$rc = "1";
		$rd = $data;
		$res['rc'] = $rc;
		$res['rd'] = $rd;
		$json_res = json_encode($res);
		echo $json_res;
}
//Load Newspaer Ad sizes based on categories
if($_POST['_token'] == "load_ad_sizes")
{		
		$category = $_POST['category'];
		$data = array();
		foreach (new DirectoryIterator(__DIR__."/assets/images/Ad_Size_pics/$category/") as $file) {
		  if ($file->isFile()) {
		      if($file->getExtension() == 'jpg')
		      {
		      	$data[] = $file->getFilename();
		      }
		  }
		}
		$rc = "1";
		$rd = $data;
		$res['rc'] = $rc;
		$res['rd'] = $rd;
		$json_res = json_encode($res);
		echo $json_res;
}
//Fm Radio Data Colledtion and send to emails
if($_POST['_token'] == "fm_radio_final_data")
{
	$fm_radios = $_POST['inputName'];
	echo $fm_radios;
}
//TV Data Colledtion and send to emails
if($_POST['_token'] == "tv_final_data")
{
	$fm_radios = $_POST['inputName'];
	echo $fm_radios;
}
//Digital Data Colledtion and send to emails
if($_POST['_token'] == "digital_final_data")
{
	$fm_radios = $_POST['inputName'];
	echo $fm_radios;
}
//Auto Data Colledtion and send to emails
if($_POST['_token'] == "auto_final_data")
{
	$fm_radios = $_POST['inputName'];
	echo $fm_radios;
}
//Newspaper Data Colledtion and send to emails
if($_POST['_token'] == "np_final_data")
{
	$fm_radios = $_POST['inputName'];
	echo $fm_radios;
}
//End Of file
}
?>