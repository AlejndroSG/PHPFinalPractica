<main>
    <?php
    if(!isset($_POST["Enviar"])){
        ?>
        <h1>Buscar Amigo</h1>
            <form action="../controladores/index.php?action=mostrarAmigos" method="post">
                <label for="">Introduce el nombre o apellido del amigo que buscas</label>
                <br>
                <input type="text" name="nomApell">
                <input type="submit" value="Enviar" name="Enviar">
            </form>
            <?php
    }else{
        ?>
        <form action="index.php?action=vistaModificarAmigo" method="post">
        <?php
            echo "<table border='1'>";
            echo "<tr><th>Nombre</th><th>Apellidos</th><th>Fecha de nacimiento</th>";
            if(isset($admin)) echo "<th>Dueño</th>";
            echo "<th>Modificar</th></tr>";
            foreach ($amigoSeleccionado as $key => $value) {
                ?>
                            <?php
                                if(!isset($admin)){
                                    echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td><input type='radio' name='idAmigo' value='$value[3]' required></td></tr>";
                                }else{
                                    echo "<tr><td>$value[1]</td><td>$value[2]</td><td>$value[3]</td><td>$value[4]</td><td><input type='radio' name='idAmigo' value='$value[0]' required></td></tr>";
                                }
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
    <a href="index.php?action=volverAmigos">Atrás</a>
</main>