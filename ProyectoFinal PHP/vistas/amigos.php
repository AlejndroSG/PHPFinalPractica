<?php
    include ("../header&footer/head.html");
?>
<body>
    <header>
        <?php include ('../header&footer/header.html'); ?>
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
    <?php
        include ("../header&footer/footer.html");
    ?>
</body>
</html>