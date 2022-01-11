<?php
require_once "sql.php";

interface tohtml2{
    public function write(array $data);
}

Class Person extends ConnectSql implements tohtml2{
    protected string $tablename = "persons"; 
    protected array  $tablefields = ["Id,","FirstName,","LastName,","PostalCode,","DateOfBirth"];
    protected array $data;
    protected string $query;
    
    public function getData(int $id = null):array{
        $sqlquery = "SELECT ";
            foreach($this->tablefields as $x){
                $sqlquery .= $this->tablename.".".$x." ";
            }
        $sqlquery .= "FROM $this->tablename";
        if($id != null){
            $sqlquery .= " WHERE $this->tablename.Id = $id";
        }
        $this->data = $this->querySelect($sqlquery);
//echo $sqlquery;
        return $this->data;
    }

    public function delete(int $id = null):void{
        if($id != null){
            $sqlquery = "DELETE FROM $this->tablename WHERE $this->tablename.Id = $id";
            $this->query($sqlquery);
        }else{
            
        }
    }

    public function write(array $data):void{
        $lp = 0;
        $html = <<<TEXT
            <table class='table-list'>
                <tr>
                    <th>Lp</th>
                    <th>Imie</th>
                    <th>Nazwisko</th>
                    <th>Kod pocztowy</th>
                    <th>Data ur.</th>
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
                    <td>
                        <a href="confirm.php?type=pdelete&id=$x[0]" class="btn btn-delete">Usuń</a>
                        <a href="edit.php?type=pedit&id=$x[0]" class="btn btn-edit">Edytuj</a>
                    </td>
                </tr>
            TEXT;
        }
        $html .="</table>";
        echo $html;
    }
}