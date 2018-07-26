<?php
    session_start();
    include '../model/dbfunctions.php';
    
    $blogtitle = $_POST['blogtitle'];
    $blog = $_POST['blogentry'];
    $authorID = $_POST['authorID'];

    $add = "INSERT INTO blog (blogTitle, blog, authorID) VALUES(:blogtitle, :blog, :id);";
    include '../model/connect.php';
    $stmt = $conn->prepare($add);
    $stmt->bindParam(':blogtitle', $blogtitle, PDO::PARAM_STR);
    $stmt->bindParam(':blog', $blog, PDO::PARAM_STR);
    $stmt->bindParam(':id', $authorID, PDO::PARAM_INT);
    $stmt->execute();
    header('location: ../view/php/blogs.php');
?>