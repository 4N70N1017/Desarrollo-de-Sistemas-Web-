<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Captura de datos</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="dive">
    <h1>Captura de datos personales</h1>
    <h2>Ingresar los datos que se le piden</h2>
    <p>Mi primera encuesta</p>
    <hr>

    <form action="resultados.php" method="POST">
      <label for="nombre">Nombre</label>
      <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required />
      <hr>

      <label for="edad">Edad</label>
      <input type="number" id="edad" name="edad" placeholder="Ingresa tu edad" required />
      <hr>

      <label for="ciudad">Ciudad</label>
      <input type="text" id="ciudad" name="ciudad" placeholder="Ingresa la ciudad donde vives" required />
      <hr>

      <label for="pasatiempo">Pasatiempo</label>
      <input type="text" id="pasatiempo" name="pasatiempo" placeholder="Ingresa tu pasatiempo favorito" required />
      <hr>

      <input type="submit" value="¡Ingresamos Datos!" class="btn" />
    </form>
  </div>
</body>
</html>