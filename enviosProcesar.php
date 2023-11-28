<?php
include("conexion.php");
$sql2 = "SELECT * FROM envios ";
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
            <th>Cliente</th>
            <th>Pedido</th>
            <th>Total</th>
            <th>Estado</th>
        </tr>";
        if ($result->num_rows > 0) {
            // Mostrar datos encontrados
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["cliente"] . "</td>";
                echo "<td>" . $row["pedido"] . "</td>";
                echo "<td>" . $row["total"] . "</td>";
                echo "<td>" . $row["estado"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No se encontraron resultados</td></tr>";
        }

        echo "</table></body>";

?>