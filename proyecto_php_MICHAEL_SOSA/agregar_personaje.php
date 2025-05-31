<?php
$archivo_personajes = 'datos/personajes.json';
$archivo_obras = 'datos/obras.json';
$mensaje = '';

// Cargar obras existentes para el selector
$obras = file_exists($archivo_obras) ? json_decode(file_get_contents($archivo_obras), true) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula = $_POST['cedula'];

    $nuevo_personaje = [
        'cedula' => $cedula,
        'foto_url' => $_POST['foto_url'],
        'nombre' => $_POST['nombre'],
        'apellido' => $_POST['apellido'],
        'fecha_nacimiento' => $_POST['fecha_nacimiento'],
        'sexo' => $_POST['sexo'],
        'habilidades' => $_POST['habilidades'],
        'comida_favorita' => $_POST['comida_favorita'],
        'codigo_obra' => $_POST['codigo_obra']
    ];

    // Verificar si la cédula ya existe
    $personajes = file_exists($archivo_personajes) ? json_decode(file_get_contents($archivo_personajes), true) : [];

    foreach ($personajes as $p) {
        if ($p['cedula'] === $cedula) {
            $mensaje = '❌ Ya existe un personaje con esa cédula.';
            break;
        }
    }

    if (!$mensaje) {
        $personajes[] = $nuevo_personaje;
        file_put_contents($archivo_personajes, json_encode($personajes, JSON_PRETTY_PRINT));
        $mensaje = '✅ Personaje registrado correctamente.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Agregar Personaje</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Agregar Personaje</h1>

    <a href="index.php" class="boton-fijo-index">← Volver al Inicio</a>

    <?php if (count($obras) === 0): ?>
        <p style="color: red;">❗ Primero debes registrar al menos una obra.</p>
    <?php else: ?>
        <form method="POST">
            <label>Cédula:
                <input type="text" name="cedula" required>
            </label>
            <label>Imagen (URL o ruta local):
                <input type="text" name="foto_url" required>
            </label>
            <label>Nombre:
                <input type="text" name="nombre" required>
            </label>
            <label>Apellido:
                <input type="text" name="apellido" required>
            </label>
            <label>Fecha de Nacimiento:
                <input type="date" name="fecha_nacimiento" required>
            </label>
            <label>Sexo:
                <select name="sexo" required>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
            </label>
            <label>Habilidades (separadas por comas):
                <input type="text" name="habilidades" required>
            </label>
            <label>Comida Favorita:
                <input type="text" name="comida_favorita" required>
            </label>
            <label>Obra Asociada:
                <select name="codigo_obra" required>
                    <option value="">Selecciona una obra</option>
                    <?php foreach ($obras as $obra): ?>
                        <option value="<?= $obra['codigo'] ?>"><?= $obra['nombre'] ?> (<?= $obra['codigo'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </label>

            <button type="submit">Registrar Personaje</button>
        </form>
        <p><?= $mensaje ?></p>
    <?php endif; ?>
</body>
</html>
