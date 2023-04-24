<?php 
function register($username, $password) {
    if(userExists($username)){
        return false;
    }
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $userslist = fopen("../data/files/users.csv", "a");
    fputcsv($userslist, "$username,$hash");
    fclose($userslist);
    return true;
}

function userExists($username) {
    $users = file("../data/users/users.csv");
    foreach($users as $userpw) {
        $line = explode(",", $userpw);
        $user = $line[0];
        if($username == $user) {
            return True;
        }
    }
    return False;
}

function login($username, $password) {
    $users = file("../data/users/users.csv");
    foreach($users as $userpw) {
        $line = explode(",", $userpw);
        $user = $line[0];
        $hash = $line[1];
        if($user == $username) {
            if (password_verify($password, $hash)) {
                return 1;
            } else {
                return -1;
            }
        }
    }
    return 0;
}
?>