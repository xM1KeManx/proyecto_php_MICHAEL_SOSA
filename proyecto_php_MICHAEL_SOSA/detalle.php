<?php
function calcularEdad($fecha_nacimiento) {
    $nacimiento = new DateTime($fecha_nacimiento);
    $hoy = new DateTime();
    return $hoy->diff($nacimiento)->y;
}

function obtenerSignoZodiacal($fecha) {
    $dia = (int)date("d", strtotime($fecha));
    $mes = (int)date("m", strtotime($fecha));

    $signos = [
        ['capricornio', 20], ['acuario', 19], ['piscis', 20], ['aries', 20],
        ['tauro', 21], ['geminis', 21], ['cancer', 22], ['leo', 23],
        ['virgo', 23], ['libra', 23], ['escorpio', 23], ['sagitario', 22], ['capricornio', 31]
    ];
    return ($dia <= $signos[$mes - 1][1]) ? ucfirst($signos[$mes - 1][0]) : ucfirst($signos[$mes][0]);
}

$codigo = $_GET['codigo'] ?? '';
$obras = file_exists('datos/obras.json') ? json_decode(file_get_contents('datos/obras.json'), true) : [];
$personajes = file_exists('datos/personajes.json') ? json_decode(file_get_contents('datos/personajes.json'), true) : [];

$obra = null;
foreach ($obras as $o) {
    if ($o['codigo'] === $codigo) {
        $obra = $o;
        break;
    }
}

$personajes_obra = array_filter($personajes, fn($p) => $p['codigo_obra'] === $codigo);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detalle de Obra</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        .contenedor {
            background-color: white;
            padding: 20px;
            border: 2px solid #99c2ff;
            margin: 20px auto;
            max-width: 900px;
            border-radius: 8px;
        }

        .obra-info img {
            max-width: 200px;
            height: auto;
            float: right;
            margin-left: 20px;
            border-radius: 10px;
        }

        h1, h2 {
            color: #004080;
            border-bottom: 2px solid #cce0ff;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #cce0ff;
            text-align: left;
        }

        th {
            background-color: #004080;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f8ff;
        }

        @media print {
            a, button {
                display: none;
            }
        }
    </style>
</head>
<body>

<a href="index.php" class="boton-fijo-index">← Volver al Inicio</a>
<a href="ver_obras.php" class="boton-fijo-ver-obras">← Volver a Obras</a>

<div class="contenedor">
    <?php if (!$obra): ?>
        <p style="color: red;">Obra no encontrada.</p>
    <?php else: ?>
        <h1><?= htmlspecialchars($obra['nombre']) ?></h1>

        <div class="obra-info">
            <img src="<?= htmlspecialchars($obra['foto_url']) ?>" alt="Imagen de la obra">
            <p><strong>Código:</strong> <?= $obra['codigo'] ?></p>
            <p><strong>Tipo:</strong> <?= $obra['tipo'] ?></p>
            <p><strong>Descripción:</strong> <?= $obra['descripcion'] ?></p>
            <p><strong>País:</strong> <?= $obra['pais'] ?></p>
            <p><strong>Autor:</strong> <?= $obra['autor'] ?></p>
        </div>

        <div style="clear: both;"></div>

        <h2>Personajes Asociados (<?= count($personajes_obra) ?>)</h2>

        <?php if (count($personajes_obra) === 0): ?>
            <p>No hay personajes asociados.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Sexo</th>
                    <th>Edad</th>
                    <th>Signo Zodiacal</th>
                    <th>Habilidades</th>
                    <th>Comida Favorita</th>
                </tr>
                <?php foreach ($personajes_obra as $p): ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($p['foto_url']) ?>" alt="Foto" style="width:70px;height:auto;border-radius:6px;"></td>
                        <td><?= $p['nombre'] . ' ' . $p['apellido'] ?></td>
                        <td><?= $p['sexo'] ?></td>
                        <td><?= calcularEdad($p['fecha_nacimiento']) ?> años</td>
                        <td><?= obtenerSignoZodiacal($p['fecha_nacimiento']) ?></td>
                        <td><?= htmlspecialchars($p['habilidades']) ?></td>
                        <td><?= htmlspecialchars($p['comida_favorita']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    <?php endif; ?>
</div>

</body>
</html>
