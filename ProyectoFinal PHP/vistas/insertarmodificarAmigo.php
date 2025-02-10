<main>
    <?php
        if(isset($_POST["modificar"])){
            echo "<h1>Modificando amigo</h1>";
            echo "<form action='../controladores/index.php?action=modificarAmigo' method='post'>";
                echo "<table border='1'>";
                    echo "<input type='hidden' name='idAmigo' value='$idAmigo'>";
                    echo "<tr>";
                        echo "<td>";
                            echo "<label>Nuevo Nombre</label><br>";
                            echo "<input type='text' name='nombreModif' value='$amigo[0]'>";
                        echo "</td>";
                        echo "<td>";
                            echo "<label>Nuevo Apellido</label><br>";
                            echo "<input type='text' name='apellModif' value='$amigo[1]'>";
                        echo "</td>";
                        echo "<td>";
                            echo "<label>Nueva Fecha</label><br>";
                            echo "<input type='date' name='fechaModif' value='$amigo[2]'>";
                        echo "</td>";
                        if($admin){
                            echo "<td>";
                                echo "<label>Nuevo Dueño</label><br>";
                                echo "<select name='idUsuario'>";
                                echo "<option selected value='$amigo[4]'>$amigo[3]</option>";
                                foreach($usuarios as $usuario){
                                    if(!strcmp($usuario[1], $amigo[3]) == 0){
                                        echo "<option value='$usuario[0]'>$usuario[1]</option>";
                                    }
                                }
                                echo "</select>";
                            echo "</td>";
                        }
                    echo "</tr>";
                echo "</table>";
                echo "<input type='submit' value='Modificar' name='modificar'>";
            echo "</form>";
        }else{
    ?>
    <form action="../controladores/index.php?action=insertarAmigo" method="post">
        <h1>
            <?php
                if(!$admin){
                    echo "Insertar amigo";
                }else{
                    echo "Insertar contacto";
                }
            ?>
        </h1>

        <div>
            <label for="floatingInput">Nombre</label>
            <br>
            <input type="text" name="nom">
        </div>
        <div>
            <label for="floatingInput">Apellidos</label>
            <br>
            <input type="text" name="apell">
        </div>
        <div>
            <label for="floatingInput">Fecha de Nacimiento</label>
            <br>
            <input type="date" name="fecha">
        </div>
        <?php
            if(isset($usuarios)){
                echo "<label>Selecciona un dueño</label>";
                echo "<select name='idUsuario'>";
                foreach($usuarios as $usuario){
                    echo "<option value='$usuario[0]'>$usuario[1]</option>";
                }
                echo "</select>";
            };
        ?>
        <br>
        <button value="Enviar" type="submit">Enviar</button>
    </form>

    <?php
        }
        ?>
    <a href="index.php?action=volverAmigos">Atrás</a>
</main>