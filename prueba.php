
     <?php 
     
        include('Backend/db.php');

        $name = mysqli_real_escape_string($connection, utf8_decode($_POST['name']));
       	$ubicacion = mysqli_real_escape_string($connection, utf8_decode($_POST['location']));
       	$descripcion = mysqli_real_escape_string($connection, utf8_decode($_POST['description']));
        $info = mysqli_real_escape_string($connection, urlencode($_POST['info']));
        $cat = mysqli_real_escape_string($connection, utf8_decode($_POST['cat']));
        $id = $_POST['id'];
        

    if(empty($_FILES) || $_FILES["image"]["size"] ==0){
        if (isset($_POST['actualizar']))
        {

        	mysqli_query($connection,"UPDATE places SET name = '$name', location = '$ubicacion', description = '$descripcion', 
        		info = '$info', category= '$cat' WHERE id = $id");

        	echo $id;

        	echo "<script>
                  if(confirm('Sitio actualizado correctamente')){
                      window.location.href='editSitios.php';
                  }
                  </script>";
           
        }
    }else{
        $img = $_FILES["image"];
        if($img["size"]> 1*10e6){
            echo "<script>
            alert('La imagen que ingresó es muy pesada, por favor seleccione otra');
            </script>
            ";
        }else{
            $imageData = getimagesize($img["tmp_name"]);
            if(!$imageData){
                echo "<script>
                alert('Imágen no válida');
                </script>
                ";
            }else{
                $mimeType = $img["type"];
                $allowedMimeTypes = ["image/jpg", "image/png", "image/jpeg"];
           if(!in_array($mimeType, $allowedMimeTypes)){
               echo "Solo se admiten archivos .jpg y .png (su archivo es formato $mimeType)";
           }else{
                    $imagen = addslashes(file_get_contents($img["tmp_name"]));
                $result = mysqli_query($connection, "UPDATE places SET name = '$name', location = '$ubicacion', description = '$descripcion', 
                info = '$info', category = '$cat', image='$imagen' WHERE id = $id");
                $error =mysqli_error($connection);
        if($result){
        	echo $id;
            
        	echo "<script>
                  if(confirm('Sitio actualizado correctamente.')){
                      window.location.href='editSitios.php';
                  }
                  </script>";
                }else
                echo $error;
                }
            }
        }
    }
        	
    ?>