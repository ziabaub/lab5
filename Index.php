<?php
/**
 * Created by PhpStorm.
 * User: ziadelsarrih
 * Date: 2019-04-14
 * Time: 14:21
 */

$host = "127.0.0.1";
$user = "root";
$password = "Mays0un";
$database = "company";
$connect = mysqli_connect($host, $user, $password, $database);
$field = 'name,address,phone,email';
require 'Tools.inc';
require 'tools.php';

if (mysqli_connect_errno()) {
    die("Connection error -> [" . mysqli_connect_error() . "]");
} else {
    $data = 'Connected... ' . '<br>';
    $title = "Add Your Data";
    $tool = new Tools();
    if (isset($_POST['Submit'])) {
        $info = checkSpelling($_POST, $title);

        if ($info != null) {
            $tool->writeInto($connect, 'info', $field, $info,$_POST['rating']);
            $data = "Data has been saved success";
        }

    } else if (isset($_POST["search_button"])) {

        if ($_POST["search"] != "!!!") {
            $tool->readFrom($connect, 'info');
            $data = $tool->displayEmployeeInformationByName($_POST['search']);

        } else {
            $title = "Search Engine";
            $data = '!!!';

        }

    } else if (isset($_POST["getDatabase"])) {
        $title = "All Data";
        $tool->readFrom($connect, 'info');
        $data = $tool->displayEmployeeInformation();

    } else if (isset($_POST["deleteFromDatabase"])) {
        $tool->deleteFrom($connect, 'info', $_POST['name']);

    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Companies !</title>
    <link rel="stylesheet" href="StyleSheet.css">
</head>
<body>

<h1><?php echo $title ?> </h1>

<div class="flexBox">

    <div class="labelFields">
        <ul>
            <li>Name:</li>
            <li>Address:</li>
            <li>Phone:</li>
            <li>Email:</li>
            <li></li>
            <li><h3>Search E.</h3></li>
            <li><h4>C. Name</h4></li>
        </ul>
    </div>

    <div class="inputFields">

        <form action="Index.php?name=<?php echo $title ?>" method="post">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <ul>
                <li>
                    <input type="text" name="name" onfocus="this.value =''" value="Ziad Sarrih">
                </li>
                <li>
                    <input type="text" name="address" onfocus="this.value =''" value="Country Town Street 345">
                </li>
                <li>
                    <input type="text" name="phone" onfocus="this.value =''" value="+375444722956">
                </li>
                <li>
                    <input type="text" name="email" onfocus="this.value =''" value="zio@info.com">
                </li>
                <li>
                    <input type="submit" name="Submit">
                </li>
                <li>
                    <form action="Index.php?name=<?php echo $title ?>" method="post">
                        <input type="submit" name="deleteFromDatabase" value="Delete">
                    </form>
                </li>
                <li>
                    <form action="Index.php?name=<?php echo $title ?>" method="post">
                        <input type="submit" name="getDatabase" value="GetDataBase">
                    </form>
                </li>
                <li>
                    <form action="Index.php?name=<?php echo $title ?>" method="post">
                        <ul class="secondUl ">
                            <li>
                                <input class="search_input" type="text" name="search" onfocus="this.value =''"
                                       value="!!!">
                            </li>
                            <li>
                                <input type="submit" name="search_button" value="Search">
                            </li>
                        </ul>
                    </form>
                </li>

                <li>
                    <div>
                        <p>How did you see my lab !!</p>
                        Good
                            <input type="checkbox" class="check" name="rating" value="good" checked>
                        <br>
                        Bad!!
                            <input type="checkbox" class="check" name="rating" value="notBad">
                        <script>
                            $(document).ready(function () {
                                $('.check').click(function () {
                                    $('.check').not(this).prop('checked', false);
                                });
                            });
                        </script>
                    </div>
                </li>
            </ul>
        </form>
    </div>
    <div class="textAreaBlock">
        <div id="product_list" class="textArea" contenteditable="true"><br>
            <?php echo $data;
            ?>
        </div>
        <div><br/>
            <form action="Index.php?name=<?php echo $title ?>" method="post">
                <input type="submit" name="saveData" value="Clear"/>
            </form>
        </div>
    </div>

</div>

</body>
</html>
<?php

mysqli_close($connect);
?>
