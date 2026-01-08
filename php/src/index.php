<?php
require __DIR__ . '/db.php';

try {
    $pdo = db();
    $items = $pdo->query("SELECT id, nombre, creado_en FROM test_items ORDER BY id DESC")->fetchAll();
} catch (Throwable $e) {
    http_response_code(500);
    echo "<h2>Error conectando a MySQL</h2>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
    exit;
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Test PHP + MySQL en Docker</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <h3 class="mb-3">✅ Test básico PHP + MySQL (Docker Compose)</h3>
  <div class="alert alert-success">
    Servidor OK. MySQL conectado y devolviendo datos.
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped mb-0">
          <thead><tr><th>ID</th><th>Nombre</th><th>Creado</th></tr></thead>
          <tbody>
          <?php foreach ($items as $it): ?>
            <tr>
              <td><?= (int)$it['id'] ?></td>
              <td><?= htmlspecialchars($it['nombre']) ?></td>
              <td><?= htmlspecialchars($it['creado_en']) ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <p class="text-muted mt-3 mb-0">
    Prueba pública esperada: <code>http://3.133.58.227</code>
  </p>
</div>
</body>
</html>
