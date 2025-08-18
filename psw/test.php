<?php 
exec("/usr/bin/mysqldump -u mysql-user -h 123.145.167.189 -pmysql-pass database_name", $output);
/* $output will have sql backup, then save file with these codes */
$h=fopen("/path-to-export/file.sql", "w+");
fputs($h, $output);
fclose($h);
?> 
<?php
//Version with zipping. Requires write permissions on the folder where scripts are located.



ob_start();

$username = "root"; 
$password = ""; 
$hostname = "localhost"; 
$dbname   = "cars";

// if mysqldump is on the system path you do not need to specify the full path
// simply use "mysqldump --add-drop-table ..." in this case
$command = "C:\\xampp\\mysql\\bin\\mysqldump --add-drop-table --host=$hostname --user=$username ";
if ($password) 
        $command.= "--password=". $password ." "; 
$command.= $dbname;
system($command);

$dump = ob_get_contents(); 
ob_end_clean();

// the database dump now exists in the $dump variable
// saving it to the file
$dumpfname = $dbname . "_" . date("Y-m-d_H-i-s").".sql";
$fp = fopen($dumpfname, "w"); 
fputs($fp, $dump); 
fclose($fp);

// zip the dump file
$zipfname = $dbname . "_" . date("Y-m-d_H-i-s").".zip";
$zip = new ZipArchive();
if($zip->open($zipfname,ZIPARCHIVE::CREATE)) 
{
   $zip->addFile($dumpfname,$dumpfname);
   $zip->close();
}

// read zip file and send it to standard output
if (file_exists($zipfname)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($zipfname));
    flush();
    readfile($zipfname);
    exit;
}
?>
<?php
//Version without zipping. Write permissions are not required.



ob_start();

$username = "root"; 
$password = ""; 
$hostname = "localhost"; 
$dbname   = "cars";

// if mysqldump is on the system path you do not need to specify the full path
// simply use "mysqldump --add-drop-table ..." in this case
$command = "C:\\xampp\\mysql\\bin\\mysqldump --add-drop-table --host=$hostname --user=$username ";
if ($password) 
        $command.= "--password=". $password ." "; 
$command.= $dbname;
system($command);

$dump = ob_get_contents(); 
ob_end_clean();

// send dump file to the output
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($dbname . "_" . date("Y-m-d_H-i-s").".sql"));
ob_flush();
flush();
echo $dump;
exit();

?>