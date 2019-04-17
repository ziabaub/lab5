<?php


/**
 * @param $arr
 * @param string
 * @return  InfoCo
 * this function check the spelling of each inputs
 */
function checkSpelling($arr,&$result)
{
    $check = true;
    $result = "Success ! ";
    if (!preg_match('/(?=^.{0,40}$)^[a-zA-Z-]+\s[a-zA-Z-]+$/', $arr['name'], $array_name)) {
        $result = "Check Name";
        $check = false;
    } else if (!preg_match('/(?=^.{0,60}$)^[a-zA-Z-]+\s[a-zA-Z-]+\s[a-zA-Z-]+\s+\d{0,10}+$/', $arr['address'])) {
        $check = false;
        $result = "Check Address";
    } else if (!preg_match('/^\+[3]{1}[7]{1}[5]{1}+[4298]{2}+\d{7}$/', $arr['phone'])) {
        $check = false;
        $result = "Check Phone";
    } else if (!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/', $arr['email'], $array_email)) {
        $check = false;
        $result = "Check Email";
    }


    if ($check == "Success ! ") {
        require_once('InfoCo.inc');
        return new InfoCo(ucwords($arr['name']), $arr['address'], $arr['phone'], $arr['email']);
    } else {
        return null;
    }

}





