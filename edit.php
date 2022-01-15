<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="owr#6062">

    <title>🎄 - Edytuj</title>
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
                        //echo $x[1];
                        $html .= <<<TEXT
                        <h1 style="font-size:24px;">Edytuj prezent id $x[0]</h1>
                        <br/>
                        <form method="post" action="php/edit.php?type=gedit&id=$x[0]">
                            <div class="line">
                                <label for="sender">Nadawca</label><br/>
                                <select name="sender" id="sender">
                        TEXT;
                            foreach($persons as $p){
                                $fn = $p[1]." ".$p[2];
                                if($fn == $x[1]){
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
                                <select name="receiver" id="receiver">
                        TEXT;
                            foreach($persons as $p){
                                $fn = $p[1]." ".$p[2];
                                if($fn == $x[2]){
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
                                <label for="description">Odbiorca</label><br/>
                                <textarea name = "description" id = "description" style="resize:no-resize;width:300px;min-height:150px;border:none;">$x[5]</textarea>
                            </div>
                            <input type="submit" class="btn btn-confirm" value="Edytuj" style="width:175px;"/>
                            <br/>
                            <input type="button" class="btn btn-cancel" value="Powrót" onclick="window.location.href = 'index.php' " style="width:175px;margin:5px;"/>
                        </form>
                    TEXT;
                    }
                }
                else if($_GET['type'] == "pedit"){
                    $person = new Person();
                    $data = $person->getData($_GET['id']);

                    foreach($data as $x){
                        $html .= <<<TEXT
                            <h1 style="font-size:24px;">Edytuj osobę z id $x[0]</h1>
                            <br/>
                            <form method="post" action="php/edit.php?type=pedit&id=$x[0]">
                                <div class="line">
                                    <label for="firstname">Imie</label><br/>
                                    <input type="text" name="firstname" id="firstname" value = "$x[1]"/>
                                </div>
                                <div class="line">
                                    <label for="lastname">Nazwisko</label><br/>
                                    <input type="text" name="lastname" id="lastname" value = "$x[2]"/>
                                </div>
                                <div class="line">
                                    <label for="postalcode">Kod pocztowy</label><br/>
                                    <input type="text" name="postalcode" id="postalcode" placeholder="12-345" value="$x[3]"/>
                                </div>
                                <div class="line">
                                    <label for="dateofbirth">Data urodzenia</label><br/>
                                    <input type="date" name="dateofbirth" id="dateofbirth" value="$x[4]"/>
                                </div>
                                <input type="submit" class="btn btn-confirm" value="Dodaj" style="width:175px;"/>
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

    <script src="public/js/jquery-3.6.0.min.js"></script>
    <script src="public/js/script.js"></script>
</body>
</html>
