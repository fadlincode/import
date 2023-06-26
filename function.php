<?php
require 'vendor/autoload.php';
use Ramsey\Uuid\Uuid;

Class import {


    public function createUuid()
    {
        return Uuid::uuid4()->toString();
    }
    
    /**
     * Get Column from json
     */
    function getColumn()
    {
        $loadJSON   = file_get_contents('config/db.json');
        $columnKey  = json_decode($loadJSON, true);

        return $columnKey['column'];
    }

    function getTable()
    {
        $loadJSON   = file_get_contents('config/db.json');
        $columnKey  = json_decode($loadJSON, true);

        return $columnKey['table'];
    }


    /**
     * Show data from csv
     */
    function showData($post)
    {
        // show header
        $this->setHeader();
        
        if ($post['size'] > 0) {
            $file   = $post['tmp_name'];
            $handle = fopen($file, "r");
            
            $no = 1;
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                echo "<tr>";
                    echo "<td>".$no."</td>";
                    for($i = 0; $i < count($this->getColumn()); $i++)
                    {
                        echo "<td>".$data[$i]."</td>";
                    }
                echo "</tr>";

                $no++;
            }

            fclose($handle);
        }
    }

    /**
     * Set Column Header
     */
    function setHeader()
    {
        echo "<tr>";
            echo "<td>No</td>";
            
            $column = $this->getColumn();
            for($i=0; $i < count($column); $i++){
                echo "<td>" .$column[$i]. "</td>";
            }
            
        echo"</tr>";
    }


    function setTempData($post)
    {
        if ($post['size'] > 0) {
            $file = $post['tmp_name'];
            $handle = fopen($file, "r");

            $all = [];
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                array_push($all, $data);
            }

            $_SESSION['data'] = $all;
        } else {
            $_SESSION['data'] = [];
        }
    }

    function storeData($data)
    {
        include 'config/connection.php';
        
        $table  = $this->getTable();
        $column = $this->getColumn();
        for($index = 0 ; $index < count($data); $index++) {

            $row = array();
            $row['id'] = $this->createUuid();
            for($i=0; $i < count($column); $i++){
                $row[$column[$i]] = mysqli_real_escape_string($connection, $data[$index][$i]);
            }

            $sql = "INSERT INTO $table (" . implode(",", array_keys($row)) . ") VALUES ('" . implode("','", array_values($row)) . "')";
            $connection->query($sql);
        }

        $connection->close();
    }
}
    
?>