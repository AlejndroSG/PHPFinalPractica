<main class="text-center">
    <a href="../controladores/index.php?action=formInsertarPrestamo" class="btn btn-danger btn-sm mb-3 text-center mx-auto">Insertar Préstamo</a>
    <a href="../controladores/index.php?action=formBuscarPrestamo" class="btn btn-danger btn-sm mb-3 mx-3">Buscar Préstamo</a>
    <form action="index.php?action=vistaModificarPrestamo" method="post" class="container mt-3 mb-3 w-50 text-center mx-auto">
        <?php
            echo "<table border='1' class='table table-striped table-dark table-hover table-bordered table-sm text-center'>";
                echo "<tr><th>Amigo</th><th>Juego</th><th>Fecha</th><th>Devuelto</th><th>Modificar</th></tr>";
                    foreach ($prestamos as $key => $value) {
                        ?>
                            <?php
                                echo "<tr><td><$value[1]></td><td>$value[2] <img src='$value[3]' class='img-fluid'></td><td>$value[4]</td><td>$value[5]</td><td><input type='radio' name='idPrestamo' value='$value[0]' required></td></tr>";
                            ?>
                        <?php
                    }
                    echo "</table>";
            if(isset($msg)) echo $msg;
        ?>
    <input type="submit" value="Modificar" name="modificar">
    </form>
</main>