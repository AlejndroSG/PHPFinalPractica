<main>
    <?php
        if(isset($_POST["modificar"])){
            echo "<h1>Modificar Usuario</h1>";
            echo "<form action='../controladores/index.php?action=modificarUsuario' method='post'>";
                echo "<table border='1'>";
                    echo "<tr>";
                        echo "<td>";
                            echo "<label>Nuevo Nombre</label><br>";
                            echo "<input type='text' name='nombreModif' value='".$usuario[0][1]."'>";
                        echo "</td>";
                        echo "<td>";
                            echo "<label>Nueva Contraseña</label><br>";
                            echo "<input type='text' name='pswdModif' value='".$usuario[0][2]."'>";
                        echo "</td>";
                    echo "</tr>";
                echo "</table>";
                echo "<input type='hidden' name='idUsu' value='".$usuario[0][0]."'>";
                echo "<input type='submit' value='Modificar' name='modificar'>";
            echo "</form>";
        }else{
    ?>
    <form action="../controladores/index.php?action=insertarUsuario" method="post">
        <h1>Insertar Usuario</h1>

        <div>
            <label for="floatingInput">Nombre</label>
            <br>
            <input type="text" name="nom">
        </div>
        <div>
            <label for="floatingInput">Contraseña</label>
            <br>
            <input type="password" name="pswd">
        </div>
        <button value="Enviar" type="submit">Enviar</button>
    </form>

    <?php
        }
        ?>
    <a href="index.php?action=volverUsuarios">Atrás</a>
</main>