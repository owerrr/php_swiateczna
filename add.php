<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="owr#6062">

    <title>🎄 - Dodaj</title>

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
    
    <div id="container" style="width:660px;">
        <?php
            //primary classes
            require_once "php/class/gift.php";
            require_once "php/class/person.php";
            //sql class
            require_once "php/class/sql.php";

            if(isset($_GET['type'])){
                $persons = new Person();
                $data = $persons->getData();

            $html = "";
                if($_GET['type'] == "gift"){
                    $html .= <<<TEXT
                    <h1 style="font-size:24px;">Dodaj nowy prezent</h1>
                    <br/>
                    <form method="post" action="php/add.php?type=gadd">
                        <div class="line">
                            <label for="sender">Nadawca</label><br/>
                            <select name="sender" id="sender">
                    TEXT;
                        foreach($data as $x){
                            $html.= "<option name='$x[0]' value='$x[0]'>$x[1] $x[2]</option>";
                        }
                    $html .=<<<TEXT
                            </select>
                        </div>
                        <div class="line">
                            <label for="receiver">Odbiorca</label><br/>
                            <select name="receiver" id="receiver">
                    TEXT;
                        foreach($data as $x){
                            $html.= "<option name='$x[0]' value='$x[0]'>$x[1] $x[2]</option>";
                        }
                    $html.=<<<TEXT
                            </select>
                        </div>
                        <div class="line">
                            <label for="label">Nazwa</label><br/>
                            <input type="text" name="label" id="label"/>
                        </div>
                        <div class="line">
                            <label for="price">Cena</label><br/>
                            <input type="text" name="price" id="price"/>
                        </div>
                        <div class="line">
                            <label for="description">Opis</label><br/>
                            <textarea style="resize:no-resize;width:300px;min-height:150px;border:none;" name = "description" id = "description"></textarea>
                        </div>
                        <input type="submit" class="btn btn-confirm" value="Dodaj" style="width:175px;"/>
                        <br/>
                        <input type="button" class="btn btn-cancel" value="Powrót" onclick="window.location.href = 'index.php' " style="width:175px;margin:5px;"/>
                    </form>
                    TEXT;
                }
                else if($_GET['type'] == "person"){
                    $html .= <<<TEXT
                        <h1 style="font-size:24px;">Dodaj nową osobę</h1>
                        <br/>
                        <form method="post" action="php/add.php?type=padd">
                            <div class="line">
                                <label for="firstname">Imie</label><br/>
                                <input type="text" name="firstname" id="firstname"/>
                            </div>
                            <div class="line">
                                <label for="lastname">Nazwisko</label><br/>
                                <input type="text" name="lastname" id="lastname"/>
                            </div>
                            <div class="line">
                                <label for="postalcode">Kod pocztowy</label><br/>
                                <input type="text" name="postalcode" id="postalcode" placeholder="12-345"/>
                            </div>
                            <div class="line">
                                <label for="dateofbirth">Data urodzenia</label><br/>
                                <input type="date" name="dateofbirth" id="dateofbirth"/>
                            </div>
                            <input type="submit" class="btn btn-confirm" value="Dodaj" style="width:175px;"/>
                            <br/>
                            <input type="button" class="btn btn-cancel" value="Powrót" onclick="window.location.href = 'index.php' " style="width:175px;margin:5px;"/>
                        </form>
                    TEXT;
                }
                else{
                    $html .= <<<TEXT
                        <h1>BŁĄD</h1>
                        <br/>
                        Nie znaleziono takiej strony!
                        <br/>
                        <input type="button" class="btn btn-cancel" value="Powrót" onclick="window.location.href = 'index.php' " style="width:175px;margin:5px;"/>
                    TEXT;
                }
            echo $html;
            }

        ?>
    </div>

    <script src="public/js/script.js"></script>
</body>
</html>
