let modalLoadedUpdate = false;
document.getElementById('modalUpdate').addEventListener('click', function (e) {
    if (e.target && (e.target.classList.contains('btn-edit') || e.target.closest('.btn-edit'))) {
        const btn = e.target.classList.contains('btn-edit') ? e.target : e.target.closest('.btn-edit');
        
        // Obtener datos del botón
        const clave = btn.getAttribute('data-clave');
        const nombre = btn.getAttribute('data-nombre');
        const precio = btn.getAttribute('data-precio');
        const desc = btn.getAttribute('data-descripcion');

        fetch('includes/modals/modal-update.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('modalContainer').innerHTML = data;
                
                // Llenar los campos del formulario en el modal
                // Nota: Asegúrate de que los IDs coincidan con modal-update.html
                document.querySelector('#modalContainer input[name="claveProducto"]').value = clave;
                document.querySelector('#modalContainer input[name="nombreProducto"]').value = nombre;
                document.querySelector('#modalContainer input[name="precioProducto"]').value = precio;
                document.querySelector('#modalContainer textarea[name="descripcion"]').value = desc;

                const modal = new bootstrap.Modal(document.getElementById('staticBackdrop2'));
                modal.show();
            });
    }
});