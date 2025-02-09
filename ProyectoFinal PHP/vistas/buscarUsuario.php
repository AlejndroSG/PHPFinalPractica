<main>
    <?php
    if(!isset($_POST["Enviar"])){
        ?>
            <form action="../controladores/index.php?action=mostrarUsuarios" method="post">
                <label for="">Introduce el nombre del usuario que buscas</label>
                <br>
                <input type="text" name="nom">
                <input type="submit" value="Enviar" name="Enviar">
            </form>
            <?php
    }else{
        ?>
        <form action="index.php?action=vistaModificarUsuario" method="post">
        <?php
            echo "<table border='1' class='table'>";
                echo "<tr><th>ID</th><th>Nombre</th><th>Contraseña</th><th>Modificar</th>";
                var_dump($usuarioSeleccionado);
                foreach ($usuarioSeleccionado as $key => $value) {
                    echo "<tr><td>$value[0]</td><td>$value[1]</td><td>";
                        for($i = 0; $i < strlen($value[2]); $i++){
                            echo "*";
                        }
                    echo "</td><td><input type='radio' name='nomUsu' value='$value[1]' required></td></tr>";
                    // echo "<input type='hidden' name='nomUsu' value='$value[1]'>";
                }
            echo "</table>";
        if(isset($msg)) echo $msg;
        ?>
            <input type="submit" value="Modificar" name="modificar"> 
        </form>
    <?php 
    }
    ?>
    <a href="index.php?action=volverUsuarios">Atrás</a>
</main>