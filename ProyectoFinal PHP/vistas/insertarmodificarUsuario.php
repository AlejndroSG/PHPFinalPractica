<main>
    <?php
        if(isset($_POST["modificar"])){
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
        <h1 class="h3 mb-3 fw-normal">Insertar Usuario</h1>

        <div class="form-floating">
            <label for="floatingInput">Nombre</label>
            <input type="text" class="form-control" name="nom">
        </div>
        <div class="form-floating">
            <label for="floatingInput">Contraseña</label>
            <input type="password" class="form-control" name="pswd">
        </div>
        <button class="btn btn-primary w-100 py-2" value="Enviar" type="submit">Enviar</button>
    </form>

    <?php
        }
        ?>
    <a href="index.php?action=volverUsuarios">Atrás</a>
</main>