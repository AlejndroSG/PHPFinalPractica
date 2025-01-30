<main>
    <?php
        if(isset($_POST["modificar"])){
            echo "<form action='../controladores/index.php?action=modificarPrestamo' method='post' enctype='multipart/form-data'>";
                echo "<table border='1'>";
                    echo "<input type='hidden' name='idPrestamo' value='$idPrestamo'>";
                    echo "<tr>";
                        echo "<td>";
                            echo "<label>Nueva Imagen</label><br>";
                            echo "<input type='file' name='imgnew' value='$juego[1]'>";
                            echo "<img src='$juego[1]' class='img-fluid '>";
                        echo "</td>";
                        echo "<td>";
                            echo "<label>Nuevo Título</label><br>";
                            echo "<input type='text' name='titnew' value='$juego[2]'>";
                        echo "</td>";
                        echo "<td>";
                            echo "<label>Nueva Plataforma</label><br>";
                            echo "<input type='text' name='platnew' value='$juego[3]'>";
                        echo "</td>";
                        echo "<td>";
                            echo "<label>Nuevo Lanzamiento</label><br>";
                            echo "<input type='text' name='lanznew' value='$juego[4]'>";
                        echo "</td>";
                    echo "</tr>";
                echo "</table>";
                echo "<input type='submit' value='Modificar' name='modificar'>";
            echo "</form>";
        }else{
    ?>
    <form action="../controladores/index.php?action=insertarPrestamo" method="post" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal">NUEVO PRÉSTAMO</h1>
        <div class="form-floating">
            <label for="floatingInput">Amigo</label>
            <select name="amigo">
                <?php
                    foreach($amigos as $amigo){
                        echo "<option value='$amigo[3]'>$amigo[0] $amigo[1]</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-floating">
            <label for="floatingInput">Juego</label>
            <select name="juego">
                <?php
                    foreach($juegos as $juego){
                        echo "<option value='$juego[0]'>$juego[2] -- $juego[3]</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-floating">
            <label for="floatingInput">Fecha de inicio</label>
            <input type="date" class="form-control" name="fecha">
        </div>
        <div class="form-floating">
            <input type="hidden" class="form-control" name="devuelto" default="NO">
        </div>
        <button class="btn btn-primary w-100 py-2" value="Enviar" type="submit">Enviar</button>
    </form>

    <?php
        }
        if(isset($msg)) echo $msg;
        ?>
    <a href="index.php?action=volverPrestamos">Atrás</a>
</main>