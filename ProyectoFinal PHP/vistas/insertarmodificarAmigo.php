<main>
    <?php
        if(isset($_POST["modificar"])){
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
                        echo "<td>";
                            echo "<label>Nuevo Dueño</label><br>";
                            echo "<select name='idUsuario'>";
                            echo "<option selected value='$amigo[4]'>$amigo[3]</option>";
                            foreach($usuarios as $usuario){
                                if(strcmp($usuario[1], $amigo[0]) == 1){
                                    echo "<option value='$usuario[0]'>$usuario[1]</option>";
                                }
                            }
                            echo "</select>";
                        echo "</td>";
                    echo "</tr>";
                echo "</table>";
                echo "<input type='submit' value='Modificar' name='modificar'>";
            echo "</form>";
        }else{
    ?>
    <form action="../controladores/index.php?action=insertarAmigo" method="post">
        <h1 class="h3 mb-3 fw-normal">
            <?php
                if(!$admin){
                    echo "Insertar amigo";
                }else{
                    echo "Insertar contacto";
                }
            ?>
        </h1>

        <div class="form-floating">
            <label for="floatingInput">Nombre</label>
            <input type="text" class="form-control" name="nom">
        </div>
        <div class="form-floating">
            <label for="floatingInput">Apellidos</label>
            <input type="text" class="form-control" name="apell">
        </div>
        <div>
            <input type="date" class="form-control" name="fecha">
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
        <button class="btn btn-primary w-100 py-2" value="Enviar" type="submit">Enviar</button>
    </form>

    <?php
        }
        ?>
    <a href="index.php?action=volverAmigos">Atrás</a>
</main>