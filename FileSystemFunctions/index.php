<?php

$path = "/dir0/dir1/myFile.php";
$file = "file1.txt";

// RETURN FILE NAME
echo basename($path)."<br>";

// RETURN FILE NAME WITHOU EXTENSION
echo basename($path, ".php")."<br>";   // Extenzija mora biti ista kao i u navedenoj putanji

// RETURN DIRECTORY PATH
echo dirname($path)."<br>";

// CHECKS IF FILE OR FOLDER EXISTS
echo file_exists($file)."<br>";  // Searches the current directory
echo file_exists("FileSystemFunctionsTest")."<br>";

// GETS THE ABSOLUTE PATH (ONLY WITHIN XAMPP WHEN USED VIA LOCAL SERVER)
echo realpath($file)."<br>";

// CHECKS TO SEE IF FILE
echo is_file($file)."<br>";

// CHECKS TO SEE IF WRITABLE
echo is_writable($file)."<br>";

// CHECKS TO SEE IF READABLE
echo is_readable($file)."<br>";

// CHECKS FILE SIZE
echo filesize($file)."<br>";

// MAKE DIRECTORY
mkdir("Testing")."<br>";

// DELETE DIRECTORY IF EMPTY
rmdir("Testing")."<br>";

// COPY FILE
echo copy("file1.txt", "file2.txt")."<br>";

// RENAME FILE
rename("file2.txt", "myFile.txt");
  
// DELETE FILE
unlink("myFile.txt");

// READ FROM FILE INTO BROWSER
echo file_get_contents($file);

// WRITE INTO FILE REPLACING THE EXISTING CONTENT, WITH THE STRING LENGTH IN THE NETBEANS CONSOLE
echo file_put_contents($file, "<br>Hi, what's going on!<br>");

// PRESERVE THE EXISTING CONTENT FROM A FILE AND THEN APPEND NEW TEXT TO TI
$current = file_get_contents($file);
$current .="Hello World!"; // ili nova varijabla: $newContent = $current."Hello World!"; 
echo file_put_contents($file, "$current")."<br>";
echo file_get_contents($file);

// OPEN FILE FOR READING
$handle = fopen($file, "r");    // "r" = read
$data = fread($handle, filesize($file));
echo $data;
fclose($handle);


// OPEN FILE FOR WRITING
$handle = fopen("file2.txt", "w");    // "r" = read
$txt = "John Doe<br>";
fwrite($handle, $txt);
$txt = "Steve Smith<br>";
fwrite($handle, $txt);
fclose($handle);
echo $data;

echo file_get_contents("file2.txt");

















