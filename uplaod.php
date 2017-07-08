<?php
//hard code url will be better then someone inject worng url as param
$url = "https://github.com/eslam-mahmoud/github-to-cpanel/archive/master.zip";
//name of the file on our disk
$zipFile = './my-zip.zip';

//Download the file
$f = file_put_contents($zipFile, fopen($url, 'r'), LOCK_EX);
//check if download was done correctly
if(FALSE === $f)
    die("Couldn't write to file.");
    
//creat zip object
$zip = new ZipArchive;
//open the downloaded file
$res = $zip->open($zipFile);
if ($res === TRUE) {
    //if opened the file then extract to
    $zip->extractTo('./');
    $zip->close();
    echo "should be extracted <br>";
    
    //where the file will be extracted repoName-branchName
    $folder = './github-to-cpanel-master/';
    //read all the extracted files and folders
    $files = scandir($folder);
    foreach($files as $file) {
        if ($file == '.' || $file == '..') {
          continue;
        }
        //move all files to to this directory
        rename($folder.$file, './'.$file);
        echo $folder.$file . ' moved to ' . './'.$file . " <br>";
    }
} else {
  echo "could not open zip file";
}
