error_reporting(E_ERROR);
 
$fullstring = explode('/', $_SERVER['REQUEST_URI']);
$server = addslashes($fullstring[1]);
 
// load the icon into $in_file_name
if ($fin = fopen("http://$server/favicon.ico", "r"))
{
  $in_file_name = tempnam(".", "ico_");
 
  $fout = fopen($in_file_name, "wb");
 
  while(!feof($fin)) {
    $buffer = fread($fin, 2048);
    fwrite($fout, $buffer);
  }
 
  fclose($fin);
  fclose($fout);
 
  // convert the file
 
  $file_name = "../$server";
 
  if (`python ConvertIcon.py '$in_file_name' '$file_name'` != 0)
    $file_name = "../default.png";
}
else
  $file_name = "../default.png";
 
// serve up the output file
 
header("Content-type: image/png");
 
$fin = fopen($file_name, "r");
while(!feof($fin)) {
  $buffer = fread($fin, 2048);
  echo $buffer;
}
