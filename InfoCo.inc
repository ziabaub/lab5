<?php
/**
 * Created by PhpStorm.
 * User: ziadelsarrih
 * Date: 2019-04-14
 * Time: 14:28
 */

class InfoCo{

    private $name;
    private $address;
    private $phone;
    private $email;
    private $rating;


    function __construct($name,$address,$phone,$email)
    {
        $this->name=$name;
        $this->address=$address;
        $this->phone=$phone;
        $this->email=$email;
    }



    function __set($name, $value)
    {
        switch ($name){
            case 'name':
                $this->name=$value;
                break;
            case 'address':
                $this->address=$value;
                break;
            case 'phone':
                $this->phone=$value;
                break;
            case 'email':
                $this->email=$value;
                break;

        }
    }

    function __get($name)
    {
        switch ($name){
            case 'name':
                return $this->name;
            case 'address':
                return $this->address;
            case 'phone':
                return $this->phone;
            case 'email':
                return  $this->email;

        }
    }


}