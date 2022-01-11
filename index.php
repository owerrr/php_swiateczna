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
            //primary classes
            require_once "php/class/gift.php";
            require_once "php/class/person.php";
            //sql class
            require_once "php/class/sql.php";

            if(isset($_GET['list']) && $_GET['list'] == "persons"){
                echo "<a href='index.php?list=' class='h1href'><h1><i class='fas fa-exchange-alt'></i> lista użytkowników</h1></a><br/>";
            
                $persons = new Person();
                $persons->write($persons->getData());
            }else{
                echo "<a href='index.php?list=persons' class='h1href'><h1><i class='fas fa-exchange-alt'></i> lista prezentów</h1></a><br/>";
            
                $gifts = new Gift();
                $gifts->write($gifts->getData());
            }
        ?>
    </div>

    <script src="public/js/script.js"></script>
</body>
</html>