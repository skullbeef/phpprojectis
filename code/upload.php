<?php
session_start();

if(!isset($_SESSION['user']) && !isset($_SESSION['password'])){
    header("location:index.php");
}

echo $id = $_POST['id'];
echo $username = $_POST['username'];


$target_dir = "../clients/".$username."/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$filetype = pathinfo($target_file,PATHINFO_EXTENSION);
$uploadOk = 1;

if(file_exists($target_file)){
    $uploadOk = 0;
    echo "Sorry, this file already exists!";
}


if($filetype != "pdf" && $filetype != "docx" && $filetype != "xlsx" && $filetype != "pptx" && $filetype != "csv") {
    $uploadOk = 0;
}

if(isset($_POST["submit"])) {
    if($uploadOk == 1){
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            include_once 'connection.php';
            $comment = "O Ficheiro ". $target_file. " foi carregado!";
            $sql2 = "INSERT INTO activiry (comment, id_client) VALUES ('$comment', '$id')";
            $conn->query($sql2);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }    
    }    
}

header("location:repository.php?id=".$id);

session_write_close();
?>

