<?php 
function updateFileContents($filename, $content) {
    file_put_contents($filename, $content);
}

$data = json_decode(html_entity_decode(stripslashes(file_get_contents('php://input'))));
$fileid = $data->filename;
$newcontent = $data->newcontent;
if(strlen($fileid) > 0) {
    updateFileContents("../".$fileid, $newcontent);
}
?>