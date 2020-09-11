<?php


    include("db.php");
    $category = mysqli_real_escape_string($connection, utf8_decode($_POST['category']));
   
    $query= "SELECT * from places where category='$category';";

    $result = mysqli_query($connection, $query);

    if(!$result){
        die("Query Failed". mysqli_error($connection));
    }else {
        if(mysqli_num_rows($result) > 0){
            $json = [];
            while($row = mysqli_fetch_array($result)){
                $json[] = array(
                    'id' => $row['id'],
                    'name' => utf8_encode($row['name']),
                    'description' => utf8_encode($row['description']),
                    'rating' => $row['rating'],
                    'image' => base64_encode($row['image']),
                    'location' => utf8_encode($row['location']),
                );
            }
            $jsonString = json_encode($json);
            echo $jsonString;
        }else
        echo "No se encontró ningún sitio";
    }

?>