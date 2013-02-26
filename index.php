<?php
if (isset($_FILES["file"]))
{
  if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
  }
  else
  {
	$my_path = $_FILES["file"]["tmp_name"];
	rename($my_path, $my_path.".scad");
	$my_path .= ".scad";
 $output = shell_exec("openscad -o '".$my_path.".stl' '".$my_path."'");
	$my_path .= ".stl";
	if (is_file($my_path))
{
header('Content-Type: application/x-download');
  header('Content-Disposition: attachment; filename=somefile.stl');
 
header('Content-Transfer-Encoding: binary');
 
if ($file = fopen($my_path, 'rb'))
{
  while(!feof($file) and (connection_status()==0))
  {
     print(fread($file, filesize($my_path)));
     flush();
  }
  fclose($file);
  exit();
}
}  
echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["file"]["tmp_name"]."<br>";
   echo "Output: <pre>".$output."</pre>";
  }
}
?>
<html>
<body>

<form action="index.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>

</body>
</html> 
