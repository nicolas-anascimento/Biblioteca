<?php 
require "server.php";

if(isset($_GET['id'])){
    $id = (int)$_GET['id'] ?? 0;
}

if($id !== 0){
    $sql = $pdo->prepare("DELETE FROM manga WHERE id = $id");
    $sql->execute();
    header("Location: index.php");
}
?>