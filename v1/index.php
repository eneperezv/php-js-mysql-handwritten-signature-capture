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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="assets/js/firma.js"></script>
    <style>
        #canvas {
            width: 640px;
            height: 420px;
            border: 1px black solid;
        }
    </style>
</head>
<body>
    
    <div class="row">
        <div class="col-12" style="margin: 5px;">
            <h1>Firma aquí:</h1>
            <div id="signature-pad" class="signature-pad">
                <div class="signature-pad--body">
                    <canvas id="canvas"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12" style="margin: 5px;">
            <form id="form" action="assets/act/guardarimagen.php" method="post">
                <input type="hidden" name="base64" value="" id="base64">
                <input type="text" name="numeroplanilla" class="form-control" required>
                <br>
                <div class="d-grid gap-2">
                    <button id="saveandfinish" class="btn btn-primary">Guardar y Finalizar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h1>Firmas registradas</h1>
            <table class="table-responsive">
                <thead>
                    <tr>
                        <th style="width:15%">ID</th>
                        <th style="width:15%">NumPlanilla</th>
                        <th style="width:70%">Imagen Firma</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqlBusca = "SELECT ID,NUMPLANILLA,URLFIRMA FROM pruebas";
                    $resBusca = mysqli_query($linknv,$sqlBusca);
                    while(list($valID,$valNUMPLANILLA,$valURLFIRMA) = mysqli_fetch_array($resBusca)){
                        $urlFirma = str_replace('..','assets',$valURLFIRMA);
                        ?>
                        <tr>
                            <td><?php print $valID; ?></td>
                            <td><?php print $valNUMPLANILLA; ?></td>
                            <td><a href="<?php print $urlFirma; ?>" target="_blank"><?php print $urlFirma; ?></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            
        </div>
    </div>

    <script type="text/javascript">
        var wrapper = document.getElementById("signature-pad");
        var canvas = wrapper.querySelector("canvas");
        var signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)'
        });
        function resizeCanvas() {
            var ratio =  Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
            signaturePad.clear();
        }
        window.onresize = resizeCanvas;
        resizeCanvas();
    </script>

    <script>
        document.getElementById('form').addEventListener("submit",function(e){
            var ctx = document.getElementById("canvas");
            var image = ctx.toDataURL();
            document.getElementById('base64').value = image;
        },false);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>