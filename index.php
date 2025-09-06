<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Calculadora • PHP + JS</title>
  <link rel="stylesheet" href="css/style.css" />
  <script src="js/script.js" defer></script>
</head>
<body>
  <div class="bg"></div>

  <main class="calculator" role="main" aria-labelledby="titulo">
    <h1 id="titulo">Calculadora básica</h1>

    <form id="calc-form" aria-describedby="ayuda">
      <div class="inputs">
        <label for="numero1">Número 1</label>
        <input type="number" id="numero1" name="numero1" placeholder="Ej: 12.5" required />

        <label for="numero2">Número 2</label>
        <input type="number" id="numero2" name="numero2" placeholder="Ej: 3" required />
      </div>

      <p id="ayuda" class="help">Elige una operación para ver el resultado al instante.</p>

      <div class="actions">
        <button type="button" data-op="sumar">Sumar</button>
        <button type="button" data-op="restar">Restar</button>
        <button type="button" data-op="multiplicar">Multiplicar</button>
        <button type="button" data-op="dividir">Dividir</button>
        <button type="reset" class="ghost" id="limpiar">Limpiar</button>
      </div>
    </form>

    <section class="result" aria-live="polite" aria-atomic="true">
      <div class="result__label">Resultado</div>
      <div class="result__value" id="resultado">—</div>
      <div class="result__detail" id="detalle"></div>
    </section>
  </main>

  <footer class="credits">
    <small>
      Fondo personalizable: cambia <code>--bg-url</code> en <code>css/style.css</code> o coloca una imagen en <code>img/</code> y actualiza la variable.
    </small>
  </footer>
</body>
</html>
