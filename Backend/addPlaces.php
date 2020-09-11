<?php

    function uploadPlace(){  
        if(isset($_POST['enviar'])){
            if(count($_FILES) > 0 && isset($_FILES)){
                include('db.php');
        $img = $_FILES["image"];
        if($img["size"]> 1*10e6){
            echo '<div class="error alert-error">La imagen es muy pesada</div>';
        }
            else{
                $imgdata = getimagesize($img["tmp_name"]);
            if(!$imgdata){
                echo '<div class="error alert-error">Imagen no soportada</div>';
            }else{
                $mimeType = $img["type"];
                $allowedMimeTypes = ["image/jpg", "image/png", "image/jpeg"];
           if(!in_array($mimeType, $allowedMimeTypes)){
               echo  '<div class="error alert-error">El formato de su imagen no es soportada, utlice formato .jpg o .png</div>';
           }else{
        $imgData = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
        $imageProperties = getimageSize($_FILES['image']['tmp_name']);
        $name = mysqli_real_escape_string($connection, utf8_decode(htmlspecialchars($_POST['name'])));
        $description = mysqli_real_escape_string($connection, utf8_decode($_POST['description']));
        $location = mysqli_real_escape_string($connection, htmlspecialchars($_POST['location']));
        $category = mysqli_real_escape_string($connection, htmlspecialchars($_POST['category']));
        $category = strtolower($category);
        $info = mysqli_real_escape_string($connection, utf8_decode($_POST["info"]));
        $query = "Insert into places (name, description, image, rating, location, category, info) VALUES ('$name', '$description', '$imgData', 5.0, '$location', '$category', '$info');";
        $result = mysqli_query($connection, $query);
            if($result){
                echo '<div class="alert alert-success">Agregado Satisfactoriamente</div>';
            }else
                die("Query failed". mysqli_error($connection)); 
        
        
        //-------------------------------
                    }
                }
            }
            }else{
                echo "image not found";
            }
         
        }
         
    }
?>