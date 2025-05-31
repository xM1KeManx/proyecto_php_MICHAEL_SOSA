<?php
$archivo = 'datos/obras.json';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'] ?: uniqid('obra_');
    $nueva_obra = [
        'codigo' => $codigo,
        'foto_url' => $_POST['foto_url'],
        'tipo' => $_POST['tipo'],
        'nombre' => $_POST['nombre'],
        'descripcion' => $_POST['descripcion'],
        'pais' => $_POST['pais'],
        'autor' => $_POST['autor']
    ];

    $obras = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];

    foreach ($obras as $obra) {
        if ($obra['codigo'] === $codigo) {
            $mensaje = '❌ Ya existe una obra con ese código.';
            break;
        }
    }

    if (!$mensaje) {
        $obras[] = $nueva_obra;
        file_put_contents($archivo, json_encode($obras, JSON_PRETTY_PRINT));
        $mensaje = '✅ Obra registrada correctamente.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registrar Obra</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Registrar Obra</h1>

    <a href="index.php" class="boton-fijo-index">← Volver al Inicio</a>

    <form method="POST">
        <label>Código (opcional):
            <input type="text" name="codigo">
        </label>
        <label>Imagen (URL o ruta local):
            <input type="text" name="foto_url" required>
        </label>
        <label>Tipo:
            <select name="tipo">
                <option value="Serie">Serie</option>
                <option value="Película">Película</option>
                <option value="Otro">Otro</option>
            </select>
        </label>
        <label>Nombre:
            <input type="text" name="nombre" required>
        </label>
        <label>Descripción:
            <textarea name="descripcion" required></textarea>
        </label>
        <label>País:
            <input type="text" name="pais" required>
        </label>
        <label>Autor:
            <input type="text" name="autor" required>
        </label>
        <button type="submit">Registrar</button>
    </form>

    <p><?= $mensaje ?></p>
</body>
</html>
