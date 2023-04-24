<?php 
    include_once("api/files.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editeur</title>
    <style>#codeZone {white-space: pre-wrap;}</style>
    <script src="js/editor.js"></script>
</head>
<body>
    <?php 
        if(!isset($_GET["file"])) {
            echo "<p>Aucun fichier renseigné</p>";
        }
        else {
            $file = $_GET["file"];
            $user = $_SESSION["username"];
            
            if(codeFileExists($file)) {
                if(isFileOwner($user, $file)) {
                    echo '<h1>'.getFileNameFromDir($file, $user).'</h1>';
                    echo '<textarea name="codeZone" id="codeZone" cols="30" rows="10">'.file_get_contents($file).'</textarea>';
                }
                else {
                    echo "<p>Vous n'avez pas la permission d'accéder à ce fichier</p>";
                }
            }
            else {
                echo "<p>Fichier non trouvé</p>";
            }
        }
    ?>
</body>
</html>