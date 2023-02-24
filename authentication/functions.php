<?php

function connectDb()
{
    try {
        $conn = new PDO("mysql:host=127.0.0.1:3306;dbname=learningsecurity", 'root', 'root');
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}

function logUser($email, $password)
{
    $connexion = connectDb();
    $sql = 'SELECT * FROM users WHERE email = "' . $email .'"';
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_OBJ);
    $user = $users[0];

    if (password_verify($password,$user->password)){
        return $user;
    }

    return null;
}

function getUser($id) {
    $connexion = connectDb();
    $sql = 'SELECT * FROM users WHERE id = ' . $id;
    $stmt = $connexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function saveUser($email, $username, $password) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $connexion = connectDb();
    $sql = 'INSERT INTO users(username,email,password) VALUES("'.$email.'","'.$username.'","'.$password.'")';
    $stmt = $connexion->prepare($sql);

    return $stmt->execute();
}