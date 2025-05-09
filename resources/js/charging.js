function mostrarCargando(quitar_botones = true) {
    var loadingHtml = `
        <div style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; z-index: 9999;">
        <div class="loader-container">
        <img src="../recursos/Logo-ESS1.png" alt="Imagen de carga" class="rotating-image" onerror="this.src='../../recursos/Logo-ESS1.png'">
        </div>
    
            <span class="loading-text">iSupport</span>
        </div>
        <style>
            body {
                margin: 0;
                font-family: Arial, sans-serif;
                overflow: hidden; /* Prevent scrollbar while loading */
            }
            
            .rotating-image {
                width: 62px;
                height: 62px;
                border-radius: 40%;
                animation: spin 1.3s linear infinite, colorChange 5s linear infinite;
            }
            
            .loading-text {
                font-size: 38px;
                font-weight: 900;
                animation: colorChange 5s linear infinite;
            }
            
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            
            @keyframes colorChange {
                0%, 100% { color: #05a5f0; border-top-color: #05a5f0; } /* Blue */
                33% { color: #ffea00; border-top-color: #ffea00; } /* Yellow */
                66% { color: #28a745; border-top-color: #28a745; } /* Green */
            }
        </style>
    `;
    Swal.fire({
        html: loadingHtml,
        showConfirmButton: false,
        allowOutsideClick: false,
        background: 'transparent' /* Transparent background */
    });

    if (quitar_botones) {
        $("#contenedor_botones").html('');
    }
}

