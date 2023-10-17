<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Resultados de muestras de suelo</title>
</head>
<body>

  <h1>Procesmiento de datos para muestras de suelo:</h1>

  <form action="calculossuelo.php" method="post">

    <div class="form-group">
      <label for="pHsuelo1">Primera medida de pH</label>
      <input type="number" name="pHsuelo1" id="pHsuelo1" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="pHsuelo2">Segunda medida de pH</label>
      <input type="number" name="pHsuelo2" id="pHsuelo2" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="volumen">Volumen de sulfato de cobre II</label>
      <input type="number" name="volumen" id="volumen" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="molaridad">Molaridad de la solución de sulfato de cobre II</label>
      <input type="number" name="molaridad" id="molaridad" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="masa">Masa de la muestra de suelo</label>
      <input type="number" name="masa" id="masa" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>

</body>
</html>
