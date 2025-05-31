<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inicio - Gestión Multimedia</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        .menu {
            background-color: #ffffff;
            border: 1px solid #cce0ff;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 64, 128, 0.1);
        }

        .menu h1 {
            text-align: center;
            color: #004080;
        }

        .menu ul {
            list-style: none;
            padding: 0;
        }

        .menu li {
            margin: 15px 0;
        }

        .menu a {
            display: block;
            padding: 12px;
            background-color: #e6f0ff;
            border-left: 5px solid #0066cc;
            color: #004080;
            text-decoration: none;
            border-radius: 4px;
            transition: 0.3s;
        }

        .menu a:hover {
            background-color: #cce0ff;
            border-left-color: #cc0000;
            color: #cc0000;
        }
    </style>
</head>
<body>

<div class="menu">
    <h1>🎬 Sistema de Gestión Multimedia</h1>
    <ul>
        <li><a href="registrar_obra.php">➕ Registrar Obra</a></li>
        <li><a href="agregar_personaje.php">🧍 Agregar Personaje</a></li>
        <li><a href="ver_obras.php">📋 Ver Obras</a></li>
    </ul>
</div>

</body>
</html>
