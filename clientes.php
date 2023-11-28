<?php
include("conexion.php");

if(isset($_POST["ingresarCliente"])){
    $nombreCliente=$_POST["nombre"];
    $apellidoCliente=$_POST["apellido"];
    $direccion=$_POST["direccion"];
    $telefono=$_POST["telefono"];
    $comentarios=$_POST["comentarios"];
    $query1="INSERT INTO clientes (nombre,apellido,direccion,telefono,comentarios) VALUES ('$nombreCliente','$apellidoCliente','$direccion','$telefono','$comentarios')";
    if ($conn->query($query1) === TRUE) {
        echo "<script>alert('Datos insertados correctamente')</script>";
    } else {
        echo "<script>alert('Error al insertar datos')</script> ";
    }
}if(isset($_POST["busquedaNombre"])){
    $nombreCliente=$_POST["clienteBus"];
    // Buscar por el campo "producto" en la tabla "inventario"

    $sql2 = "SELECT * FROM clientes WHERE nombre = '$nombreCliente'";
    $result = $conn->query($sql2);
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Resultados de la búsqueda</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
            }
    
            h2 {
                color: #333;
            }
    
            table {
                width: 100%;
                border-collapse: collapse;
            }
    
            table, th, td {
                border: 1px solid #999;
            }
    
            th, td {
                padding: 8px;
                text-align: left;
            }
    
            th {
                background-color: #f2f2f2;
            }
    
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
        </style>
    </head>";



    echo "<body><h2>Resultados de la búsqueda por producto: ".$nombreCliente."

    <table border=1>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Comentarios</th>
        </tr>";
        if ($result->num_rows > 0) {
            // Mostrar datos encontrados
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["apellido"] . "</td>";
                echo "<td>" . $row["direccion"] . "</td>";
                echo "<td>" . $row["telefono"] . "</td>";
                echo "<td>" . $row["comentarios"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No se encontraron resultados</td></tr>";
        }

        echo "</table></body>";




}if(isset($_POST["busquedaTabular"])){

    $sql2 = "SELECT * FROM clientes ";
    $result = $conn->query($sql2);
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Resultados de la búsqueda</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
            }
    
            h2 {
                color: #333;
            }
    
            table {
                width: 100%;
                border-collapse: collapse;
            }
    
            table, th, td {
                border: 1px solid #999;
            }
    
            th, td {
                padding: 8px;
                text-align: left;
            }
    
            th {
                background-color: #f2f2f2;
            }
    
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
        </style>
    </head>";



    echo "<body><h2>Resultados de la búsqueda tabulada:

    <table border=1>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Comentarios</th>
        </tr>";
        if ($result->num_rows > 0) {
            // Mostrar datos encontrados
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nombre"] . "</td>";
                echo "<td>" . $row["apellido"] . "</td>";
                echo "<td>" . $row["direccion"] . "</td>";
                echo "<td>" . $row["telefono"] . "</td>";
                echo "<td>" . $row["comentarios"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No se encontraron resultados</td></tr>";
        }

        echo "</table></body>";




}





?>