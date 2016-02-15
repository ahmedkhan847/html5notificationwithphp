<?php
include 'conn.php';

$con = OpenConn();
if(!empty($_POST['todo']))
{
	$values = $con->real_escape_string($_POST['todo']);
	$stmt = "INSERT INTO list(what) VALUES('$values')";
    $result = $con-> query($stmt);
    if($result)
    {
    	echo "true";
    }
    else
    {
    	echo $result->error;
    }
}
else if(!empty($_POST['ids']))
{
	$values = $_POST['ids'];
	$stmt = "DELETE FROM list WHERE id = $values";
    $result = $con-> query($stmt);
    if($result)
    {
    	echo "true";
    }
    else
    {
    	echo $result->error;
    }

}


