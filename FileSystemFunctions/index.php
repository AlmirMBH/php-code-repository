<?php
echo "GET FILE AND DIRECTORY NAME<br>";

echo "RETURN FILE NAME<br>";
$dirs = scandir(__DIR__);
foreach($dirs as $dir){
    if(is_file($dir)){
        echo "'$dir' is a file";
        echo "<br>";
    }elseif(is_dir($dir)){
        echo "'$dir' is a directory<br>";
    }else{
        echo "'$dir' is a an unknown type<br>";
    }
}

$path = "/dir0/dir1/myFile.php";
$file = "file1.txt";


echo "<br>GETS THE ABSOLUTE PATH (ONLY WITHIN XAMPP WHEN USED VIA LOCAL SERVER)<br>";
echo realpath($file)."<br>";


echo "<br>RETURN FILE NAME WITHOUT EXTENSION<br>";
echo basename($path)."<br>";
echo basename($path, ".php")."<br>"; // The extension must be the actual extension


echo "<br>RETURN DIRECTORY PATH<br>";
echo dirname($path)."<br>";


echo "<br>CHECKS TO SEE IF FILE<br>";
echo is_file($file)."<br>";


echo "<br>CHECKS IF FILE OR FOLDER EXISTS<br>";
echo file_exists($file)."<br>";  // Searches the current directory
echo file_exists("FileSystemFunctionsTest")."<br>";


echo "CHECKS FILE SIZE<br>";
if(file_exists($file)){
    echo filesize($file),"<br>";
    file_put_contents($file, "Hello world");
    clearstatcache(); // if cache not cleared, the size before and after the file_pu_contents will be the same
    echo filesize($file),"<br>";
}
else{
    echo "File not found";
}


// /////////////////////////////////
// echo "<br>FILE SIZE<br>"; // move to size section
// $data = fread($handle, filesize($file));
// echo "<br>SIZE: $data<br>";
// fclose($handle);


echo "<br>CREATE AND REMOVE A DIRECTORY<br>";
if(file_exists("test-directory/test")){
    rmdir("test-directory/test"); // must be empty
    rmdir("test-directory"); // must be empty
    echo "test-directory/test already exists<br>";
}
else{
    mkdir("test-directory/test", recursive: true);
    echo "test-directory/test created<br>";
}


echo "<br><br>WRITE & READ";
echo "<br>CHECKS TO SEE IF WRITABLE<br>";
echo is_writable($file)."<br>";


echo "<br>CHECKS TO SEE IF READABLE<br>";
echo is_readable($file)."<br>";


echo "<br>READ<br>";
$handle = @fopen('non-existing-file.txt', "r"); // '@' suppresses error, not recommended
$handle = fopen($file, "r"); // "r" = read; returns data type resource, a variable that refers to en external resource

while(($line = fgets($handle)) !== false){
    echo "Printing lines: $line<br>";
}


$file3 = fopen('file3.txt', "r");
while(($line = fgetcsv($file3)) !== false){
    print_r($line);
    echo "<br>";
}
fclose($file3);


echo "<br>FILE GET CONTENTS<br>";
echo "File get contents: ", file_get_contents($file), "<br>";
echo "File get contents: ", file_get_contents($file, offset: 3, length: 5), "<br>";


echo "<br>FILE PUT CONTENTS<br>";
echo "File get contents: ", file_get_contents($file), "<br>";
file_put_contents($file, "Hi, what's going on!"); // overrides the existing content; if does not exist a new file created
file_put_contents($file, "\nHey, buddy! ", FILE_APPEND);
echo "File get appended contents: ", file_get_contents($file), "<br>";


echo "<br>MANUALLY APPEND NEW TEXT TO A FILE<br>";
$current = file_get_contents($file);
$current .="Hello World!"; // ili nova varijabla: $newContent = $current."Hello World!"; 
file_put_contents($file, "$current");
echo file_get_contents($file), "<br>";


echo "<br>OPEN FILE FOR WRITING<br>";
$handle = fopen("file2.txt", "w");    // "r" = read
$txt = "John Doe\n";
fwrite($handle, $txt);
$txt = "Steve Smith\n";
fwrite($handle, $txt);
$text = file_get_contents("file2.txt");
fclose($handle);
echo file_get_contents("file2.txt"), "<br>";



echo "<br>CREATE, DELETE, COPY, RENAME FILE";
echo "<br>DELETE FILE<br>";
if(file_exists("myFile.txt")){
    echo "myFile.txt exists<br>";
}
else{
    file_put_contents("myFile.txt", "Good morning!");
    echo "myFile.txt created<br>";
}

if(file_exists("myFile.txt")){
    unlink("myFile.txt");
    echo "myFile.txt deleted<br>";
}
else{
    echo "myFile.txt not deleted, no such file<br>";
}


echo "<br>COPY FILE<br>";
copy("file1.txt", "file2.txt")."<br>";
echo "File get copied file contents: ", file_get_contents("file2.txt"), "<br>";


echo "<br>RENAME FILE<br>";
rename("file2.txt", "file4.txt");
if(file_exists("file4.txt")){
    echo "file2.txt renamed to file4.txt<br>";
}
else{
    echo "file2.txt has not been renamed to file4.txt<br>";
}
  

