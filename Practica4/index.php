<?php
require_once 'includes/database/conexion.php';
require_once 'backend/productos/select.php';
$productos = obtenerProductos($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Accesorios - Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="header">
        <h1 class="fw-bold"><i class="bi bi-gem"></i> Sistema CRUD de productos</h1>
        <p class="mb-0">Gestion eficiente de inventario</p>
    </div>

    <div class="container mt-4">
        <div class="list">
            <h4>Categorías</h4>
            <ul>
                <li>💍 Anillos</li>
                <li>📿 Collares</li>
                <li>💎 Pulseras</li>
                <li>✨ Aretes</li>
                <li>👑 Tiaras</li>
            </ul>
        </div>
        
        <div class="article" style="flex: 1;"> 
            <button type="button" class="btn text-white d-block mb-3 shadow-sm" style="background-color: #ec4899; border: none; font-weight: 500;" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="modalInsert">
                <i class="bi bi-plus-circle"></i> Nuevo Accesorio
            </button>
            
            <?php if (count($productos) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Accesorio</th>
                                <th>Precio</th>
                                <th>Descripción</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productos as $producto): ?>
                                <tr>
                                    <td class="fw-bold text-secondary"><?php echo $producto['claveProducto']; ?></td>
                                    <td><?php echo $producto['nombreProducto']; ?></td>
                                    <td>$<?php echo number_format($producto['precioProducto'], 2); ?></td>
                                    <td class="text-start"><?php echo $producto['descripcion']; ?></td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-sm text-white btn-edit shadow-sm" style="background-color: #f6ad55; border: none;" id="modalUpdate"
                                            data-clave="<?php echo htmlspecialchars($producto['claveProducto']); ?>"
                                            data-nombre="<?php echo htmlspecialchars($producto['nombreProducto']); ?>"
                                            data-precio="<?php echo htmlspecialchars($producto['precioProducto']); ?>"
                                            data-descripcion="<?php echo htmlspecialchars($producto['descripcion']); ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <form action="backend/productos/delete.php" method="post" style="display:inline;">
                                            <input type="hidden" name="claveProducto" value="<?php echo htmlspecialchars($producto['claveProducto']); ?>">
                                            <button type="submit" class="btn btn-sm text-white shadow-sm" style="background-color: #fc8181; border: none;" onclick="return confirm('¿Seguro que deseas eliminar este accesorio?');">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert shadow-sm" style="background-color: #fce4ec; color: #880e4f; border-left: 5px solid #ec4899;" role="alert"> 
                    <i class="bi bi-info-circle-fill"></i> Aún no hay accesorios registrados en el inventario.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer text-center mt-5 mb-3" style="color: #a0aec0; font-size: 0.9rem;">
        <p>Sweet Accesorios Tantoyuca &copy; 2026 | Proyecto de Desarrollo</p>
    </div>

    <div id="modalContainer"></div>
    <script src="assets/js/modal-insert.js"></script>
    <script src="assets/js/modal-update.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script>
    document.addEventListener('submit', function(e) {
        // Verificamos si la ruta del formulario contiene nuestras palabras clave
        const actionUrl = e.target.action || '';
        
        if (actionUrl.includes('insert.php') || 
            actionUrl.includes('update.php') || 
            actionUrl.includes('delete.php')) {
            
            e.preventDefault(); // ¡ESTO FRENA EL VIAJE A LA PÁGINA BLANCA!

            const form = e.target;
            const formData = new FormData(form);

            fetch(actionUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    if (actionUrl.includes('delete.php')) {
                        alert("🗑️ Accesorio eliminado exitosamente (AJAX).");
                        form.closest('tr').style.display = 'none'; 
                    } else {
                        alert("✅ Operación guardada exitosamente (AJAX). Actualiza la página con F5 para ver los cambios en la tabla.");
                        const modalElement = form.closest('.modal');
                        if (modalElement) {
                            const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
                            modalInstance.hide();
                        }
                        form.reset(); 
                    }
                } else {
                    alert("❌ Hubo un error al procesar la solicitud.");
                }
            })
            .catch(error => {
                console.error('Error AJAX:', error);
                alert("❌ Ocurrió un error de conexión.");
            });
        }
    });
    </script>
    </body>
</html>