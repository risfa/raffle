<?php
session_start();
$date=date('Ymd');
if($_SESSION["input"]!=$date){
		$_SESSION["input"] = $date;
		$filename = 'data/'.$date.'.json';
		$name=$_GET['name'];
		if (file_exists($filename)) {
		    $data=file_get_contents($filename);
		    $data=json_decode($data);
		    if(isset($data->$name)){
			$data->$name+=1;
		    }else{
			$data->$name=1;
		    }	
		    $json=json_encode($data);
		    file_put_contents($filename, $json);	
		} else {
		   $newfile = fopen($filename, "w") or die("Unable to open file!");
		   $data=array();
		   $data[$name]=1;
		   $json=json_encode($data);
		   fwrite($newfile, $json);
		   fclose($newfile);
		}
}
