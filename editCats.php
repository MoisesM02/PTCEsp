<?php

session_start();
if(!isset($_SESSION["usuario"]) || $_SESSION["rolid"] != "1"){
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trips SV</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="LoginPTC/images/logoicono.png">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand">Editar categorías</a>

        <ul class="navbar-nav ml-auto">
            <form class="form-inline my-2 my-lg-0">
                <input type="search"  id="search" class="form-control mr-md-2" placeholder="Buscar categorías">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </ul>
    </nav>

    <div class="container p-4">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <form id="task-form">
                            <input type="hidden" id="taskID">
                            <div class="form-group">
                                <input type="text" id="name" placeholder="Nombre de la categoría" class="form-control">
                            </div>
                            <div class="form-group">
                                <textarea id="description" cols="30" rows="10" class="form-control" placeholder="Descripción"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block text-center">Guardar categoría</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card my-4" id="task-result">
                    <div class="card-body" >
                        <ul id="container"></ul>
                    </div>
                </div>
                <table class="table table-borderless table-hover table-responsive table-striped table-xl">
                    <thead class="thead-dark">
                        <tr>
                            <td>ID</td>
                            <td>Nombre</td>
                            <td>Descripción</td>
                            <td>Eliminar</td>
                        </tr>
                    </thead>
                    <tbody id="tasks">

                    </tbody>
                </table>
            </div>
        </div>
    </div>


<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/editCats.js"></script>
</body>
</html>