<?php
require 'vendor/autoload.php';
use Ramsey\Uuid\Uuid;

Class Import {


    function createUuid()
    {
        return Uuid::uuid4()->toString();
    }

    function loadConfig($keyName)
    {
        $loadJSON   = file_get_contents('config/config.json');
        $key  = json_decode($loadJSON, true);

        return $key[$keyName];
    }

    function getUUID()
    {
        return $this->loadConfig('uuid');
    }

    function getConnection()
    {
        return $this->loadConfig('connection');
    }
    
    function getColumn()
    {
        return $this->loadConfig('column');
    }

    function getTable()
    {
        return $this->loadConfig('table');
    }

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

    function showData($post)
    {
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
        $isUuid = $this->getUUID();
        
        
        $table  = $this->getTable();
        $column = $this->getColumn();
        for($index = 0 ; $index < count($data); $index++) {

            $row = array();

            if ($isUuid == true) {
                $row['id'] = $this->createUuid();
            }

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