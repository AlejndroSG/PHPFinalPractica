    <main class="text-center">
        <a href="../controladores/index.php?action=formInsertarAmigo" class="btn btn-danger btn-sm mb-3 text-center mx-auto">Insertar Amigos</a>
        <a href="../controladores/index.php?action=formBuscarAmigo" class="btn btn-danger btn-sm mb-3 mx-3">Buscar Amigos</a>
        <form action="index.php?action=vistaModificarAmigo" method="post" class="container mt-3 mb-3 w-50 text-center mx-auto">
            <?php
                echo "<table border='1' class='table table-striped table-dark table-hover table-bordered table-sm text-center'>";
                    echo "<tr><th>Nombre</th><th>Apellidos</th><th>Fecha de nacimiento</th><th>Modificar</th></tr>";
                        foreach ($listaAmigos as $key => $value) {
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
    </main>