<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

include("conexion.php");

$sql_clientes = "SELECT nombre FROM clientes";
$result_clientes = $conn->query($sql_clientes);

$clientes = array();
if ($result_clientes->num_rows > 0) {
    while ($row = $result_clientes->fetch_assoc()) {
        $clientes[] = $row["nombre"];
    }
} else {
    echo "No se encontraron clientes en la base de datos.";
}

$sql_productos = "SELECT producto, precio FROM inventario";
$result_productos = $conn->query($sql_productos);

$productos = array();
if ($result_productos->num_rows > 0) {
    while ($row = $result_productos->fetch_assoc()) {
        $productos[$row["producto"]] = $row["precio"];
    }
} else {
    echo "No se encontraron productos en el inventario.";
}

if (isset($_POST['agregar'])) {
    $clienteElegido = $_POST['cliente'];
    $productoElegido = $_POST['producto'];
    $cantidad = (int)$_POST['cantidad'];

    $precioProducto = $productos[$productoElegido];

    $encontrado = false;

    foreach ($_SESSION['carrito'] as $key => $item) {
        if (isset($item['cliente']) && isset($item['producto']) && $item['cliente'] === $clienteElegido && $item['producto'] === $productoElegido) {
            $_SESSION['carrito'][$key]['cantidad'] += $cantidad;
            $_SESSION['carrito'][$key]['total'] = $_SESSION['carrito'][$key]['cantidad'] * $precioProducto;
            $encontrado = true;
            break;
        }
    }

    if (!$encontrado) {
        $item = array(
            'cliente' => $clienteElegido,
            'producto' => $productoElegido,
            'cantidad' => $cantidad,
            'total' => $cantidad * $precioProducto,
            'estado' => 'pendiente' // Valor por defecto
        );

        $_SESSION['carrito'][] = $item;
    }

    echo '<p>Producto agregado al carrito para el cliente: ' . $clienteElegido . ' - Producto: ' . $productoElegido . ' - Cantidad: ' . $cantidad . '</p>';
}

if (isset($_POST['limpiar'])) {
    $_SESSION['carrito'] = array();
    echo '<p>Carrito limpiado.</p>';
}

if (isset($_POST['finalizar'])) {
    $totalPedido = 0;
    $pedidoCompleto = "";
    $nombreCliente = "";
    $estadoPedido = $_POST['estado_pedido'];

    foreach ($_SESSION['carrito'] as $item) {
        $totalPedido += $item['total'];
        $pedidoCompleto .= $item['cantidad'] . ' ' . $item['producto'] . ', ';
        $nombreCliente = $item['cliente']; // Tomando el nombre del cliente del primer elemento
    }

    // Eliminando la coma y el espacio final del pedidoCompleto
    $pedidoCompleto = rtrim($pedidoCompleto, ', ');

    $queryIngresar="INSERT INTO envios (cliente,pedido,total,estado) VALUES ('$nombreCliente','$pedidoCompleto','$totalPedido','$estadoPedido')";


    if ($conn->query($queryIngresar) === TRUE) {
        echo "<script>alert('Datos insertados correctamente')</script>";
    } else {
        echo "<script>alert('Error al insertar datos')</script> ";
    }



   
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Carrito de Compras</title>
</head>
<body>
<nav id="navbar-example2" class="navbar bg-body-tertiary px-3 mb-3">
        <a class="navbar-brand" href="index.html">Sensacional Eventos</a>
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link" href="inventario.html">Inventario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="clientes.html">Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="envios.php">Envios</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Pendientes</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="pendientesFavor.html">A favor</a></li>
              <li><a class="dropdown-item" href="pendientesContra.html">En contra</a></li>
            </ul>
          </li>
        </ul>
      </nav>


      <div class="accordion" id="accordionExample">

      <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Ingresar
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
            <form method="post">
    <h2>Selecciona un cliente, un producto y cantidad:</h2>

    <center>

        <select name="cliente">
            <?php foreach ($clientes as $cliente) : ?>
                <option value="<?php echo $cliente; ?>"><?php echo $cliente; ?></option>
                <?php endforeach; ?>
            </select>
            
            <select name="producto">
                <?php foreach ($productos as $producto => $precio) : ?>
                    <option value="<?php echo $producto; ?>"><?php echo $producto; ?></option>
                    <?php endforeach; ?>
                </select>
                
                <input type="number" name="cantidad" value="1" min="1">
                
                <select name="estado_pedido">
                    <option value="pendiente">Pendiente</option>
                    <option value="pagado">Pagado</option>
                </select><br><br>
                
                <input type="submit" class="btn btn-primary" name="agregar" value="Agregar al carrito"><br><br>
                <input type="submit" class="btn btn-secondary" name="limpiar" value="Limpiar Carrito"><br><br>
                <input type="submit" class="btn btn-success" name="finalizar" value="Finalizar"><br><br>
            </center>
    </form>
              
            </div>
          </div>
        </div>



        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
              Consultar
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
            <form action="enviosProcesar.php" method="post">
                <center>

                    <input type="submit" value="tabular" class="btn btn-success">
                </center>

            
    
    </form>
              
            </div>
          </div>
        </div>







            </div>

    
    
    
</body>
</html>
