<?php
include("conexion.php");

if(isset($_POST["ingresarInventario"])){
    $producto=$_POST["producto"];
    $marca=$_POST["marca"];
    $valor=$_POST["valor"];
    $precio=$_POST["precio"];
    $cantidad=$_POST["cantidad"];
    $query1="INSERT INTO inventario (producto,marca,valor,precio,cantidad) VALUES ('$producto','$marca','$valor','$precio','$cantidad')";
    if ($conn->query($query1) === TRUE) {
        echo "<script>alert('Datos insertados correctamente')</script>";
    } else {
        echo "<script>alert('Error al insertar datos')</script> ";
    }
}if(isset($_POST["busquedaNombre"])){
    $nombreProducto=$_POST["productoBus"];
    // Buscar por el campo "producto" en la tabla "inventario"

    $sql2 = "SELECT * FROM inventario WHERE producto = '$nombreProducto'";
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



    echo "<body><h2>Resultados de la búsqueda por producto: ".$nombreProducto."

    <table border=1>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Marca</th>
            <th>Valor</th>
            <th>Precio</th>
            <th>Cantidad</th>
        </tr>";
        if ($result->num_rows > 0) {
            // Mostrar datos encontrados
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["producto"] . "</td>";
                echo "<td>" . $row["marca"] . "</td>";
                echo "<td>" . $row["valor"] . "</td>";
                echo "<td>" . $row["precio"] . "</td>";
                echo "<td>" . $row["cantidad"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No se encontraron resultados</td></tr>";
        }

        echo "</table></body>";




}if(isset($_POST["busquedaTabular"])){

    $sql2 = "SELECT * FROM inventario ";
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
            <th>Producto</th>
            <th>Marca</th>
            <th>Valor</th>
            <th>Precio</th>
            <th>Cantidad</th>
        </tr>";
        if ($result->num_rows > 0) {
            // Mostrar datos encontrados
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["producto"] . "</td>";
                echo "<td>" . $row["marca"] . "</td>";
                echo "<td>" . $row["valor"] . "</td>";
                echo "<td>" . $row["precio"] . "</td>";
                echo "<td>" . $row["cantidad"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No se encontraron resultados</td></tr>";
        }

        echo "</table></body>";




}





?>