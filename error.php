<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="owr#6062">

    <title>🎄 - Lista prezentów</title>

    <link rel="stylesheet" href="public/css/main.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
    
    <div id="nav">
        <ul>
            <a href="index.php"><li>Lista</li></a>
            <a href="add.php?type=person"><li>Dodaj użytkownika</li></a>
            <a href="add.php?type=gift"><li>Dodaj prezent</li></a>
        </ul>
    </div>
    
    <div id="container">
        <?php
            require_once "php/config.php";

            foreach($errorList as $x){
                echo $x[0]."<br/>";
            }
        ?>
    </div>

    <script src="public/js/jquery-3.6.0.min.js"></script>
    <script src="public/js/script.js"></script>
</body>
</html>