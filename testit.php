<?php

include('lib/config.php');
include('lib/opendb.php');
//print_r($_POST);print"<br>";
//print_r($_photoidS);print"<br>";
echo $_FILES["file"]["type"] ;
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
)
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("uploads/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],"uploads/" . $_FILES["file"]["name"]);
	  $filename="uploads/" . $_FILES["file"]["name"];
      echo "Stored in: " . "uploads/" . $_FILES["file"]["name"];
	  echo "filename is  ".$filename;
	   $sql="insert into users(identification) values('".$filename."')";
	   $res=mysql_query($sql);
	   $insert_id=mysql_insert_id();
	   if($insert_id !=0)
	   {
	   echo "record inserted successfully!";
	   }
	   else{
	    echo "record not inserted";
	   }
      }
    }
  }
else
  {
  echo "Invalid file";
  }

?>