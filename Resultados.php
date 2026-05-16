<?php
// Recogemos los valores enviados por POST y sanitizamos para evitar XSS
$nombre = isset($_POST['nombre']) ? htmlspecialchars(trim($_POST['nombre'])) : '';
$edad = isset($_POST['edad']) ? htmlspecialchars(trim($_POST['edad'])) : '';
$ciudad = isset($_POST['ciudad']) ? htmlspecialchars(trim($_POST['ciudad'])) : '';
$pasatiempo = isset($_POST['pasatiempo']) ? htmlspecialchars(trim($_POST['pasatiempo'])) : '';
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>¡Resultados de los datos que ingresaste!</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <style>
    body { font-family: Arial, Helvetica, sans-serif; margin: 20px; color:#222; background: #fff; }
    h1 { color:#0b5bd7; text-align:center; }
    img { max-width: 200px; display:block; margin: 10px auto; }
    h2 { text-align:center; color:#333; }
    .btn { padding:10px 18px; background:#0b79d0; color:#fff; border:none; border-radius:4px; cursor:pointer; font-size:16px; display:block; margin: 10px auto; text-decoration:none; text-align:center; }
    .btn:hover { background:#095f9f; }
  </style>
</head>
<body>
  <h1>¡RESULTADOS!</h1>

  <!-- Imagen -->
  <img src="yes.jpg" alt="Resultado">

  <!-- Caja con los datos enviados -->
  <div style="text-align:center;">
    <div class="result-box">
      <p><strong>Nombre:</strong> <?php echo $nombre ?: 'No especificado'; ?></p>
      <p><strong>Edad:</strong> <?php echo $edad ?: 'No especificado'; ?></p>
      <p><strong>Ciudad:</strong> <?php echo $ciudad ?: 'No especificado'; ?></p>
      <p><strong>Pasatiempo:</strong> <?php echo $pasatiempo ?: 'No especificado'; ?></p>
    </div>

    <h2>¡Bien hecho, continúa así!</h2>

    <!-- Botón para abrir modal / volver a ingresar -->
    <button class="btn" onclick="Alert.render()">¡Volver a ingresar!</button>
  </div>

  <!-- Overlay y caja del modal -->
  <div id="popUpOverlay" aria-hidden="true"></div>

  <div id="popUpBox" role="dialog" aria-modal="true" aria-labelledby="popUpTitle">
    <div id="box">
      <div style="font-size:40px; color:#f0ad4e; margin-bottom:6px;">&#63;</div>
      <h1 id="popUpTitle">¿Volver a ingresar datos?</h1>
      <div id="closeModal" style="margin-top:12px;"></div>
    </div>
  </div>

  <script>
    function CustomAlert(){
      this.render = function(){
        const popUpBox = document.getElementById('popUpBox');
        const popUpOverlay = document.getElementById('popUpOverlay');
        const closeModal = document.getElementById('closeModal');

        if (popUpOverlay) popUpOverlay.style.display = "block";
        if (popUpBox) popUpBox.style.display = "block";

        if (closeModal) {
          closeModal.innerHTML =
            '<a href="index.html"><button type="button" id="yesBtn">¡Sí quiero!</button></a>' +
            '<button type="button" id="noBtn">No, cancelar</button>';

          // Si el usuario pulsa "No" cerramos el modal
          const noBtn = document.getElementById('noBtn');
          if (noBtn) noBtn.onclick = () => { this.ok(); };

          // Cerrar al clicar en el overlay (fuera del modal)
          if (popUpOverlay) popUpOverlay.onclick = (e) => {
            if (e.target === popUpOverlay) this.ok();
          };
        }
      };

      this.ok = function(){
        const popUpBox = document.getElementById('popUpBox');
        const popUpOverlay = document.getElementById('popUpOverlay');
        if (popUpBox) popUpBox.style.display = "none";
        if (popUpOverlay) popUpOverlay.style.display = "none";
      };
    }

    var Alert = new CustomAlert();
  </script>
</body>
</html>