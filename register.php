<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
</head>
<body>
    <form action="api/loginep.php" method="post">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username"/>
        <label for="username">Adresse mail</label>
        <input type="text" name="mail"/>
        <label for="password">Mot de passe</label>
        <input type="password" name="password"/>
        <input type="submit" value="Se connecter" />
    </form>
    <p>Sinon, vous pouvez <a href="login.php">vous connecter</a></p>
    <?php if(isset($_GET["err"])) {
        if($_GET["err"] == "u") {
            echo "<p>Ce nom d'utilisateur existe déjà</p>";
        }
    }
    ?>
</body> 
</html>