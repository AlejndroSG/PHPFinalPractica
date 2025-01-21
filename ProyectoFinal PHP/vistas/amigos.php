<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/morph/bootstrap.min.css">
</head>
<body>
    <header>
        <?php include '../header&footer/header.html'; ?>
    </header>
    <main>
        <?php
            echo "<table border='1'>";
                echo "<tr><th>Nombre</th><th>Apellidos</th><th>Fecha de nacimiento</th></tr>";
                    foreach ($listaAmigos as $key => $value) {
                        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td></tr>";
                    }
            echo "</table>";
        ?>
    </main>
</body>
</html>