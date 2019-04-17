<?php
/*/**
 * Created by PhpStorm.
 * User: ziadelsarrih
 * Date: 2019-04-14
 * Time: 17:11
 */

require 'InfoCo.inc';

class Tools
{

    private $info;

    function __construct()
    {
        $this->info = array();
    }

    /**
     * @param $connection
     * @param $tableName
     * this function is to write into specific table into databases
     */
    public function readFrom($connection, $tableName)
    {
        $query = 'select* from ' . $tableName;
        $result = mysqli_query($connection, $query);

        if (!$result) {

            echo "Error Request or table name doesn't exist ";
            $query2 = 'show tables';
            $result2 = mysqli_query($connection, $query2);
            if (!$result2) {
                die("..");
            } else {
                echo "Available Table is  : \n ";
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    die("[ " . $row2['Tables_in_company'] . " ] ,");
                }
                mysqli_free_result($result2);
            }
        } else {

            while ($row = mysqli_fetch_assoc($result)) {
                array_push($this->info, new InfoCo($row['name'], $row['address'], $row['phone'], $row['email']));

            }
            mysqli_free_result($result);

        }
    }

    /**
     * @param $connection
     * @param $tableName
     * @param $fields
     * @param $values InfoCo
     */
    public function writeInto($connection, $tableName, $fields, $values)
    {
        $data = "'" . $values->__get('name')
            . "','" . $values->__get('address')
            . "','" . $values->__get('phone')
            . "','" . $values->__get('email') . "'";

        $query = 'insert into' . ' ' . $tableName . ' (' . $fields . ') values (' . $data . ')';
        $result = mysqli_query($connection, $query);

        if (!$result) {

            echo "Error Request or table name doesn't exist ";
            $query2 = 'show tables';
            $result2 = mysqli_query($connection, $query2);
            if (!$result2) {
                die("..");
            } else {
                echo "Available Table is  : \n ";
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    die("[ " . $row2['Tables_in_company'] . " ] ,");
                }
                mysqli_free_result($result2);
            }
        }
    }

    /**
     * @param $connection
     * @param $tableName
     * @param $values string
     */
    public function deleteFrom($connection, $tableName, $values)
    {

        $query = 'delete from' . ' ' . $tableName . ' ' . 'where name = '."'".$values."'";
        $result = mysqli_query($connection, $query);

        if (!$result) {

            echo "Error Request or table name doesn't exist ";
            $query2 = 'show tables';
            $result2 = mysqli_query($connection, $query2);
            if (!$result2) {
                die("..");
            } else {
                echo "Available Table is  : \n ";
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    die("[ " . $row2['Tables_in_company'] . " ] ,");
                }
                mysqli_free_result($result2);
            }
        }
    }


    /**
     * @return array
     */
    public function getInfo(): array
    {
        return $this->info;
    }

    /**
     * @return string
     */
    public function displayEmployeeInformation()
    {
        $res = "";
        $count = 1;
        foreach ($this->info as $e) {
            $res .= '<h3>Company Number : ' . '[' . $count . ']</h3>' .
                '* Name : ' . $e->__get('name') .
                '<br>' . '* Address :  ' . $e->__get('address') .
                '<br>' . '* Phone :  ' . $e->__get('phone') .
                '<br>' . '* E-mail :  ' . $e->__get('email');
            $count++;
        }
        return $res;
    }

    /**
     * @param $in string
     * @return string
     */
    public function displayEmployeeInformationByName($in)
    {

        $res = "";
        $count = 1;
        $name = ucwords(trim($in));
        echo $name;
        foreach ($this->info as $e) {
            $current = trim($e->__get('name'));
            if (($current == $name) && (strlen($current) == strlen($name))) {
                $res .= '<h3>Company Number : ' . '[' . $count . ']</h3>' .
                    '* Name : ' . $e->__get('name') .
                    '<br>' . '* Address :  ' . $e->__get('address') .
                    '<br>' . '* Phone :  ' . $e->__get('phone') .
                    '<br>' . '* E-mail :  ' . $e->__get('email');
            }
            $count++;

        }
        return $res;
    }


}
