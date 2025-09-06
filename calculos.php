<?php
header('Content-Type: application/json; charset=utf-8');

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

$numero1 = isset($data['numero1']) ? floatval($data['numero1']) : null;
$numero2 = isset($data['numero2']) ? floatval($data['numero2']) : null;
$operacion = isset($data['operacion']) ? strtolower(trim($data['operacion'])) : '';

if ($numero1 === null || $numero2 === null || $operacion === '') {
  http_response_code(400);
  echo json_encode([
    "success" => false,
    "mensaje" => "Solicitud incompleta. Verifica los números y la operación."
  ]);
  exit;
}

switch ($operacion) {
  case 'sumar':
    $resultado = $numero1 + $numero2;
    break;
  case 'restar':
    $resultado = $numero1 - $numero2;
    break;
  case 'multiplicar':
    $resultado = $numero1 * $numero2;
    break;
  case 'dividir':
    if ($numero2 == 0.0) {
      http_response_code(422);
      echo json_encode([
        "success" => false,
        "mensaje" => "No se puede dividir por cero."
      ]);
      exit;
    }
    $resultado = $numero1 / $numero2;
    break;
  default:
    http_response_code(400);
    echo json_encode([
      "success" => false,
      "mensaje" => "Operación no válida."
    ]);
    exit;
}

echo json_encode([
  "success" => true,
  "operacion" => $operacion,
  "numero1" => $numero1,
  "numero2" => $numero2,
  "resultado" => $resultado,
  "mensaje" => "El resultado de $operacion es: $resultado"
], JSON_UNESCAPED_UNICODE);
exit;
?>
