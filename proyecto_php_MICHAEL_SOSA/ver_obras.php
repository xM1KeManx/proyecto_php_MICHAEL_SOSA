<?php
$archivo_obras = 'datos/obras.json';
$archivo_personajes = 'datos/personajes.json';

$obras = file_exists($archivo_obras) ? json_decode(file_get_contents($archivo_obras), true) : [];
$personajes = file_exists($archivo_personajes) ? json_decode(file_get_contents($archivo_personajes), true) : [];

// Contar personajes por obra
$conteo_personajes = [];
foreach ($personajes as $p) {
    $codigo = $p['codigo_obra'];
    if (!isset($conteo_personajes[$codigo])) {
        $conteo_personajes[$codigo] = 0;
    }
    $conteo_personajes[$codigo]++;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Obras</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #99c2ff;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #004080;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f8ff;
        }

        .btn-detalle {
            background-color: #0066cc;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-detalle:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>

    <h1>Lista de Obras Registradas</h1>

    <a href="index.php" class="boton-fijo-index">← Volver al Inicio</a>

    <?php if (count($obras) === 0): ?>
        <p>No hay obras registradas aún.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>País</th>
                <th>Personajes</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($obras as $obra): ?>
                <tr>
                    <td><?= htmlspecialchars($obra['nombre']) ?></td>
                    <td><?= htmlspecialchars($obra['tipo']) ?></td>
                    <td><?= htmlspecialchars($obra['pais']) ?></td>
                    <td><?= $conteo_personajes[$obra['codigo']] ?? 0 ?></td>
                    <td><a class="btn-detalle" href="detalle.php?codigo=<?= urlencode($obra['codigo']) ?>">Detalle</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

</body>
</html>
