<main>
    <?php
        if(!isset($_POST["Enviar"])){
            ?>
            <h1>Buscar Prestamo</h1>
                <form action="../controladores/index.php?action=mostrarPrestamos" method="post">
                    <label for="">Nombre del amigo / Titulo del juego</label>
                    <br>
                    <input type="text" name="nomTit">
                    <input type="submit" value="Enviar" name="Enviar">
                </form>
            <?php
        }else{
            ?>
            <form action="index.php?action=vistaModificarAmigo" method="post">
            <?php
                echo "<table border='1'>";
                    echo "<tr><th>Nombre</th><th>Apellidos</th><th>Fecha de nacimiento</th></tr>";
                        foreach ($amigoSeleccionado as $key => $value) {
                            ?>
                                <?php
                                    echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td><input type='radio' name='idAmigo' value='$value[3]' required></td></tr>";
                                ?>
                            <?php
                        }
                        echo "</table>";
                if(isset($msg)) echo $msg;
            ?>
        <input type="submit" value="Modificar" name="modificar"> 
        </form>
        <?php 
        }
    ?>
    <a href="index.php?action=volverPrestamos">Atrás</a>
</main>