<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="owr#6062">

    <title>🎄 - Potwierdź usunięcie</title>

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

            if(isset($_GET['type']) && isset($_GET['id'])){
            $html = "";
                if($_GET['type'] == "gedit"){
                    $gift = new Gift();
                    $data = $gift->getData($_GET['id']);
                    $person = new Person();
                    $persons = $person->getData();

                    foreach($data as $x){
                        $html .= <<<TEXT
                        <h1 style="font-size:24px;">Edytuj prezent id $x[0]</h1>
                        <br/>
                        <form method="post" action="php/edit.php?type=gedit&id=$x[0]">
                            <div class="line">
                                <label for="sender">Nadawca</label><br/>
                                <select name="sender" id="sender">
                        TEXT;
                            foreach($persons as $p){
                                if($p[0] == $x[0]){
                                    $html.= "<option name='$p[0]' value='$p[0]' selected>$p[1] $p[2]</option>";
                                }else{
                                    $html.= "<option name='$p[0]' value='$p[0]'>$p[1] $p[2]</option>";
                                }
                            }
                        $html .=<<<TEXT
                                </select>
                            </div>
                            <div class="line">
                                <label for="receiver">Odbiorca</label><br/>
                                <select name="sender" id="sender">
                        TEXT;
                            foreach($persons as $p){
                                if($p[0] == $x[0]){
                                    $html.= "<option name='$p[0]' value='$p[0]' selected>$p[1] $p[2]</option>";
                                }else{
                                    $html.= "<option name='$p[0]' value='$p[0]'>$p[1] $p[2]</option>";
                                }
                            }
                        $html.=<<<TEXT
                                </select>
                            </div>
                            <div class="line">
                                <label for="label">Nazwa</label><br/>
                                <input type="text" name="label" id="label" value="$x[3]"/>
                            </div>
                            <div class="line">
                                <label for="price">Cena</label><br/>
                                <input type="text" name="price" id="price" value="$x[4]"/>
                            </div>
                            <div class="line">
                                <label for="receiver">Odbiorca</label><br/>
                                <textarea style="resize:no-resize;width:300px;min-height:150px;border:none;">$x[5]</textarea>
                            </div>
                            <input type="submit" class="btn btn-confirm" value="Edytuj" style="width:175px;"/>
                            <br/>
                            <input type="button" class="btn btn-cancel" value="Powrót" onclick="window.location.href = 'index.php' " style="width:175px;margin:5px;"/>
                        </form>
                    TEXT;
                    }
                }
                else if($_GET['type'] == "pedit"){
                    $person = new Gift();
                    $data = $person->getData($_GET['id']);

                    foreach($data as $x){
                        $html .= <<<TEXT
                        <h1 style="font-size:24px;">Edytuj osobe id $x[0]</h1>
                        <br/>
                        <form method="post" action="php/edit.php?type=gedit&id=$x[0]">
                            <div class="line">
                                <label for="fullname">Imie i nazwisko</label><br/>
                                <input type="text" name="fullname" id="fullname" value="$x[1] $x[2]"/>
                            </div>
                            <div class="line">
                                <label for="postalcode">Kod pocztowy</label><br/>
                                <input type="text" name="postalcode" id="postalcode" value="$x[3]"/>
                            </div>
                            <div class="line">
                                <label for="dateofbirth">Data urodzenia</label><br/>
                                <input type="text" name="dateofbirth" id="dateofbirth" value="$x[4]"/>
                            </div>
                            <input type="submit" class="btn btn-confirm" value="Edytuj" style="width:175px;"/>
                            <br/>
                            <input type="button" class="btn btn-cancel" value="Powrót" onclick="window.location.href = 'index.php' " style="width:175px;margin:5px;"/>
                        </form>
                    TEXT;
                    }
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
