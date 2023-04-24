<?php 
function codeFileExists($filename) {
    return file_exists($filename);
}

function glob_recursive($pattern, $flags = 0)
   {
     $files = glob($pattern, $flags);
     foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir)
     {
       $files = array_merge($files, glob_recursive($dir.'/'.basename($pattern), $flags));
     }
     return $files;
   }


function getUserFiles($user) {
    $filelist = glob_recursive("data/users/$user/*.*");
    return $filelist;
}

function createTree($a) {
    $result = array();
    $links = array();
    foreach($a as $item){
        $itemparts = explode("/", $item);

        $last = &$result;

        for($i=0; $i < count($itemparts); $i++){
            $part = $itemparts[$i];
            if($i+1 < count($itemparts))
                $last = &$last[$part];
            else 
                $last[$part] = array("".$item);
        }
    }
    return $result;
}

function array2ul($arr) {
    $out = "<ul>";
    $array = $arr;
    foreach($array as $key => $elem){
        if(!is_array($elem)){
                $out .= "<p><a href=editor.php?file=".$elem.">Editer ce fichier</a></p><p><a href=share.php?file=".$elem.">Partager ce fichier</a></p>";
                $addul = false;
        }
        else $out .= "<li><span>$key</span>".array2ul($elem)."</li>";
    }
    $out .= "</ul>";
    return $out; 
}

function getFileNameFromDir($fulldir, $user) {
    $explode = explode("/", $fulldir);
    $pos = array_search($user, $explode);
    $file = array_slice($explode, $pos+1);
    $filename = implode("/",$file);
    return $filename;
}

function isFileOwner($user, $filename) {
    // $filelist = file("data/files/filelist.csv");
    
    // foreach($filelist as $file) {
    //     $line = explode(",", $file);
    //     if($line[0] == $filename) {
    //         $ownerslist = array_slice($line, 2);
    //         foreach($ownerslist as $owner) {
    //             if(rtrim($owner) == $user) {
    //                 return true;
    //             }
    //         }
    //     }   
    // }
    // return false;
    return true;
}

function createFile($name, $owner) {
    $file = "";
    do {
        $file = substr(base64_encode(md5( mt_rand() )), 0, 15);
    } while (codeFileExists($file));
    $filelist = fopen("data/files/filelist.csv", "a");
    fputcsv($filelist, array($file,$name,$owner));
    fclose($filelist);
    $newfile = fopen("data/files/$file", "w");
    fclose($newfile);
}
?>
