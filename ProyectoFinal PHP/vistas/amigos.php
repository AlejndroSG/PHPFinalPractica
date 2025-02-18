    <main>
        <?php
            echo "<a href='../controladores/index.php?action=formInsertarAmigo'>";
                if(isset($admin) && !$admin){
                    echo "Insertar Amigo";  
                }else{
                    echo"Insertar Contacto";
                }
            echo"</a>";
            echo "<a href='../controladores/index.php?action=formBuscarAmigo'>";
                if(isset($admin) && !$admin){
                    echo "Buscar Amigo";  
                }else{
                    echo"Buscar Contacto";
                }
            echo"</a>";
        ?>
        <form action="index.php?action=vistaModificarAmigo" method="post">
            <?php
                echo "<a href='../controladores/index.php?action=ordenarNombre'>Ordenar por nombre</a>";
                echo "<a href='../controladores/index.php?action=ordenarFecha'>Ordenar por fecha</a>";
                echo "<table border='1'>";
                if(isset($admin) && !$admin){
                    echo "<tr><th>Nombre</th><th>Apellidos</th><th>Fecha de nacimiento</th><th>Modificar</th><th>Nota Media</th></tr>";
                }else{
                    echo "<tr><th>Nombre</th><th>Apellidos</th><th>Fecha de nacimiento</th><th>Dueño</th><th>Modificar</th><th>Validar</th></tr>";
                }
                        foreach ($listaAmigos as $key => $value) {
                            echo "<input type='hidden' name='idAmigo' value='$value[4]'>";
                            ?>
                                <?php
                                    if($value[4] > 0){
                                        $value[4] = round($value[4], 2);
                                    }else{
                                        $value[4] = 0;
                                    };
                                    if(isset($value[5])){
                                        if($value[5] == 1){
                                            $deshabilitado="disabled";
                                        }else{
                                            $deshabilitado="";
                                        }
                                    }
                                    if(isset($admin) && !$admin){
                                        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td><input type='radio' name='idAmigo' value='$value[3]' required></td><td>$value[4]</td></tr>";
                                    }else{
                                        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td>$value[3]</td><td><input type='radio' name='idAmigo' value='$value[4]'></td><td><input type='radio' name='validar' value='$value[4]' required $deshabilitado></td></tr>";
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