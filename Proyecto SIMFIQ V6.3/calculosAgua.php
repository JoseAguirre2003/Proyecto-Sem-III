<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Resultados de muestras de agua</title>
</head>
<body>

  <h1>Procesamiento de datos para muestras de agua:</h1>

  <form action="calculosagua.php" method="post">

    <div class="form-group">
      <label for="pHagua1">pH agua 1</label>
      <input type="number" name="pHagua1" id="pHagua1" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="pHagua2">pH agua 2</label>
      <input type="number" name="pHagua2" id="pHagua2" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="CeAgua1">Conductividad eléctrica agua 1</label>
      <input type="number" name="CeAgua1" id="CeAgua1" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="CeAgua2">Conductividad eléctrica agua 2</label>
      <input type="number" name="CeAgua2" id="CeAgua2" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="peso_seco">Peso seco</label>
      <input type="number" name="peso_seco" id="peso_seco" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="peso_inicial">Peso inicial</label>
      <input type="number" name="peso_inicial" id="peso_inicial" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>

</body>
</html>
