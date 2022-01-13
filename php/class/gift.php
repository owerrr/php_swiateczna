<?php
require_once "person.php";
require_once "sql.php";

interface tohtml{
    public function write(array $data);
}

Class Gift extends ConnectSql implements tohtml{
    protected string $tablename = "gifts"; 
    protected array  $tablefields = ["Id,","Giver_Id,","Receiver_Id,","Label,","Price,","Description"];
    protected array $data;
    protected string $query;
    
    public function getData(int $id = null):array{
        $sqlquery = "SELECT ";
            foreach($this->tablefields as $x){
                if($x == "Giver_Id,"){
                    $sqlquery .= "CONCAT(p1.Firstname, \" \", p1.Lastname),";
                }
                else if($x == "Receiver_Id,"){
                    $sqlquery .= "CONCAT(p2.Firstname, \" \", p2.Lastname),";
                }else{
                    $sqlquery .= $this->tablename.".".$x." ";
                }
            }
        $sqlquery .= "FROM $this->tablename INNER JOIN persons p1 ON gifts.Giver_Id = p1.Id
                                            INNER JOIN persons p2 ON gifts.Receiver_Id = p2.Id";
        if($id != null){
            $sqlquery .= " WHERE $this->tablename.Id = $id";
        }
        //echo $sqlquery;
        $this->data = $this->querySelect($sqlquery);

        return $this->data;
    }

    public function delete(int $id = null):void{
        if($id != null){
            $sqlquery = "DELETE FROM $this->tablename WHERE $this->tablename.Id = $id";
            $this->query($sqlquery);
        }else{
            header("Location: ../error.php?errorid=502");
        }
    }

    public function add(?string $sender, ?string $receiver, ?string $label, ?string $price, ?string $description    ):void{
        if($sender != null && $receiver != null && $label != null && $price != null && $description != null){
            $sqlquery = "INSERT INTO $this->tablename (Giver_Id, Receiver_Id, Label, Price, gifts.Description) VALUES ($sender, $receiver, '$label', $price, '$description')";
            $this->query($sqlquery);
        }else{
            header("Location: ../error.php?errorid=201a");
        }
    }

    public function edit(?int $id, ?string $sender, ?string $receiver, ?string $label, ?string $price, ?string $description):void{
        if($id != null && $sender != null && $receiver != null && $label != null && $price != null && $description != null){
            $sqlquery = "UPDATE $this->tablename SET
                            Giver_Id = $sender,
                            Receiver_Id = $receiver,
                            Label = '$label',
                            Price = $price,
                            Description = '$description'
                            WHERE gifts.Id = $id
                        ";
                        //echo $sqlquery;
            $this->query($sqlquery);
        }else{
            header("Location: ../error.php?errorid=201a");
        }
    }

    public function write(array $data):void{
        $lp = 0;
        $html = <<<TEXT
            <table class='table-list'>
                <tr>
                    <th>Lp</th>
                    <th>Dający</th>
                    <th>Otrzymujący</th>
                    <th>Nazwa</th>
                    <th>Cena</th>
                    <th>Opis</th>
                    <th style='width:200px;'>Operacje</th>
                </tr>
        TEXT;
        foreach($data as $x){
            $lp += 1;
            //echo "$x[0], $x[1], $x[2], $x[3], $x[4], $x[5]<br/>";
            $html .= <<<TEXT
                <tr>
                    <td>$lp</td>
                    <td>$x[1]</td>
                    <td>$x[2]</td>
                    <td>$x[3]</td>
                    <td>$x[4]</td>
                    <td>$x[5]</td>
                    <td>
                        <a href="confirm.php?type=gdelete&id=$x[0]" class="btn btn-delete">Usuń</a>
                        <a href="edit.php?type=gedit&id=$x[0]" class="btn btn-edit">Edytuj</a>
                    </td>
                </tr>
            TEXT;
        }
        $html .="</table>";
        echo $html;
    }
}

/*

SQL
SELECT
    gifts.Id,
    CONCAT(p1.FirstName, " ", p1.LastName) as "nadawca",
    CONCAT(p2.FirstName, " ", p2.LastName) as "odbiorca",
    gifts.Label,
    gifts.Price,
    gifts.Description
FROM gifts
INNER JOIN persons p1
    ON gifts.Giver_Id = p1.Id
INNER JOIN persons p2
	ON gifts.Receiver_Id = p2.Id;

*/