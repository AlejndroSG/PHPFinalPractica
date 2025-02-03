    <main class="text-center">
        <?php
            if(!$admin){
                echo "<a href='../controladores/index.php?action=formInsertarAmigo' class='btn btn-danger'>Insertar Amigos</a>";
                echo "<a href='../controladores/index.php?action=formBuscarAmigo' class='btn btn-danger'>Buscar Amigos</a>";
            }else{
                 echo "<a href='../controladores/index.php?action=formInsertarContactos' class='btn btn-danger'>Insertar Contactos</a>";
                 echo "<a href='../controladores/index.php?action=formBuscarContactos' class='btn btn-danger'>Buscar Contactos</a>";
            }
        ?>
        <form action="index.php?action=vistaModificarAmigo" method="post" class="container mt-3 mb-3 w-50 text-center mx-auto">
            <?php
                echo "<table border='1' class='table table-striped table-dark table-hover table-bordered table-sm text-center'>";
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