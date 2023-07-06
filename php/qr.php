<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCANEANDO</title>
    <script src="https://unpkg.com/html5-qrcode"></script>
  </head>
  <body>

    <div style="display: flex;justify-content: center;">
      <div id="my-qr-reader" style="width:500px;"></div>
    </div>

    <script>
      //CHECK IF DOM IS READY
      function domReady(fn) {
        if (document.readyState === "complete" || document.readyState === "interactive") {
          setTimeout(fn, 1);
        } else {
          document.addEventListener("DOMContentLoaded", fn);
        }
      }

      domReady(function() {
        var myqr = document.getElementById("you-qr-result");
        var lastResult, countResults = 0;

        // IF FOUND YOUR CODE
        function onScanSuccess(decodeText, decodeResult) {
          if (decodeText !== lastResult) {
            lastResult = decodeText;

            // Alerta del código QR aquí
            alert("SERIE ESCANEADA");
            // Y añade el resultado del QR al campo de búsqueda en la página anterior
            window.opener.document.getElementById("buscar").value = decodeText;
            myqr.innerHTML = `ESCANEASTE: ${decodeText}`;

            // Cerrar la ventana del escáner después de aceptar la alerta
            setTimeout(function() {
              window.close();
            }, 2000);
          }
        }

        // Renderizar el lector de QR de la cámara
        var htmlscanner = new Html5QrcodeScanner("my-qr-reader", { fps: 10, qrbox: 250 });
        htmlscanner.render(onScanSuccess);
      });
    </script>
  </body>
</html>
