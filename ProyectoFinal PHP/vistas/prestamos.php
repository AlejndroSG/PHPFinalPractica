<main>
    <a href="../controladores/index.php?action=formInsertarPrestamo">Insertar Préstamo</a>
    <a href="../controladores/index.php?action=formBuscarPrestamo">Buscar Préstamo</a>
    <form action="index.php?action=devolverPrestamo" method="post">
    <?php
        echo "<table border='1'>";
        echo "<tr><th>Amigo</th><th>Juego</th><th></th><th>Fecha</th><th>Devuelto</th><th>Devolver</th></tr>";
        foreach ($prestamos as $key => $value) {
            $disabled = ($value[5] == "Si") ? " disabled" : "";
            echo "<tr><td>$value[1]</td><td>$value[2]</td><td><img src='$value[3]'></td><td>$value[4]</td><td>$value[5]</td>
            <td><input type='radio' name='idPrestamo' value='$value[0]' $disabled></td>";
                if(strlen($disabled) != 0){
                    echo "<td>";
                        ?>
                            <label for="">Introduce una nota al préstamo</label><br>
                            <input type="number" step="0.01" max="5" min="0" name="nota">
                            <input type="hidden" name="idPrestamo" value="<?php$value[0]?>">
                        <?php
                        if(isset($nota)){
                            echo "Nota: $nota";
                        }
                    echo "</td></tr>";
                }else{
                    echo "</tr>";
                };
        }
        echo "</table>";
        if(isset($msg)) echo $msg;
    ?>
    <input type="submit" value="Modificar" name="modificar">
    </form>
    <a href="index.php?action=volverPrestamos">Atrás</a>
</main>