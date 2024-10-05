<?php
include 'assets/act/conexion.php';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Captura de Firma Manuscrita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="signature-container">
        <canvas id="signature-pad" width="600" height="400"></canvas>
    </div>
    
    <div class="row">
        <div class="col-12" style="margin: 5px;">
            <form id="form" action="assets/act/guardarimagen.php" method="post">
                <input type="hidden" name="base64" value="" id="base64">
                <input type="text" name="numeroplanilla" class="form-control" required>
                <div class="row">
                    <div class="col-6">
                        <div class="d-grid gap-2">
                            <button id="clear" class="btn btn-info">Limpiar</button>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-grid gap-2">
                            <button id="saveandfinish" class="btn btn-primary">Guardar y Finalizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('form').addEventListener("submit",function(e){
            var ctx = document.getElementById("canvas");
            var image = ctx.toDataURL();
            document.getElementById('base64').value = image;
        },false);
    </script>

    <script src="assets/js/firma.js"></script>
</body>
</html>