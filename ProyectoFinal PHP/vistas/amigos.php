    <main>
        <?php
            echo "<a href='../controladores/index.php?action=formInsertarAmigo'>";
                if(!$admin){
                    echo "Insertar Amigo";  
                }else{
                    echo"Insertar Contacto";
                }
            echo"</a>";
            echo "<a href='../controladores/index.php?action=formBuscarAmigo'>";
                if(!$admin){
                    echo "Buscar Amigo";  
                }else{
                    echo"Buscar Contacto";
                }
            echo"</a>";
        ?>
        <form action="index.php?action=vistaModificarAmigo" method="post">
            <?php
                echo "<table border='1'>";
                if(!$admin){
                    echo "<tr><th>Nombre</th><th>Apellidos</th><th>Fecha de nacimiento</th><th>Modificar</th></tr>";
                }else{
                    echo "<tr><th>Nombre</th><th>Apellidos</th><th>Fecha de nacimiento</th><th>Dueño</th><th>Modificar</th></tr>";
                }
                        foreach ($listaAmigos as $key => $value) {
                            ?>
                                <?php
                                    if(!$admin){
                                        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td><input type='radio' name='idAmigo' value='$value[3]' required></td></tr>";
                                    }else{
                                        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td>$value[3]</td><td><input type='radio' name='idAmigo' value='$value[4]' required></td></tr>";
                                    }
                                ?>
                            <?php
                        }
                        echo "</table>";
                if(isset($msg)) echo $msg;
            ?>
        <input type="submit" value="Modificar" name="modificar">
        </form>
    </main>