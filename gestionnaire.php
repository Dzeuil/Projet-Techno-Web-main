<?php 
    include_once("api/files.php");
    session_start();
    if(!isset($_SESSION["username"])) {
        header("Location: index.php");
    }
    $user = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Fichiers</title>
</head>
<body>
<?php 
    echo "<p>Bienvenue, ".$user."</p>";
    $userfiles = getUserFiles($user);
    if(count($userfiles) == 0) {
        echo "<p>Vous n'avez créé aucun fichier</p>";
    }
    else {
        $arr = createTree($userfiles)["data"]["users"][$user];
        echo array2ul($arr);
    }
?>
</body>
</html>