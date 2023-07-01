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

    function getSeparator()
    {
        return $this->loadConfig('separator');
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

    function separatorType($word)
    {
        $acceptedSeparator = [',', ';'];
        foreach ($acceptedSeparator as $as) {
            if (strpos($word, $as) !== false) {
                return $as;
            }
        }
        return 'undefined';
    }

    function setHeader()
    {
        echo "<tr class='table-dark'>";
            echo "<td style='width:5%'>No</td>";
            
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
            
            $firstLine       = file($file)[0];
            $actualSeparator = $this->separatorType($firstLine);

            if ($actualSeparator !== $this->getSeparator()) {
                echo "<p class = 'alert alert-danger'>";
                echo "<b>Expected Separator: </b> '" . $this->getSeparator() ."' <br>";
                echo "<b>Actual Separator: </b> '" . $actualSeparator ."' <br><br>";
                echo "The CSV file separator does not match the expected separator. Please change on <b>config/config.json</b>, set <b>separator</b> with <b>Actual Separator</b> value <br>";
                echo "</p>";
            } else {

                echo "<p class = 'alert alert-info'> Total <b>".count(file($file))."</b> data ready to import</p>";

                $no = 1;
                while (($data = fgetcsv($handle, 1000, $this->getSeparator())) !== false) {
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
    }

    function setTempData($post)
    {
        if ($post['size'] > 0) {
            $file = $post['tmp_name'];
            $handle = fopen($file, "r");

            $all = [];

            $firstLine       = file($file)[0];
            $actualSeparator = $this->separatorType($firstLine);

            if ($actualSeparator !== $this->getSeparator()) {
                $_SESSION['data'] = [];
            } else {
                while (($data = fgetcsv($handle, 1000, $this->getSeparator())) !== false) {
                    array_push($all, $data);
                }
                $_SESSION['data'] = $all;
            }

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