let modalLoaded = false;
document.getElementById('modalInsert').addEventListener('click', function () {
    if (!modalLoaded) {
        // Cargar el modal solo la primera vez
        fetch('includes/modals/modal-insert.html')
            .then(response => {
                if (!response.ok) {
                    throw new Error('No se pudo encontrar modal.html');
                }
                return response.text();
            })
            .then(data => {
                document.getElementById('modalContainer').innerHTML = data;
                modalLoaded = true;

                // Mostrar el modal
                const modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                modal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al cargar el modal. Asegúrate de que modal.html existe en la misma carpeta.');
            });
    } else {
        // Si ya está cargado, solo mostrarlo
        const modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
        modal.show();
    }
});