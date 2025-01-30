<?php
    if(!isset($_POST["Enviar"])){
        ?>
            <form action="../controladores/index.php?action=mostrarJuegos" method="post">
                <label for="">Título del juego / Plataforma</label>
                <br>
                <input type="text" name="titPlat">
                <input type="submit" value="Enviar" name="Enviar">
            </form>
        <?php
    }else{
        ?>
        <form action="index.php?action=vistaModificarJuego" method="post" class="container mt-3 mb-3 w-50 text-center mx-auto">
        <?php
            echo "<table border='1' class='table table-striped table-dark table-hover table-bordered table-sm text-center'>";
                echo "<tr><th>Imagen</th><th>Titulo</th><th>Plataforma</th><th>Fecha de Lanzamiento</th><th>Modificar</th></tr>";
                    foreach ($juegos as $key => $value) {
                        ?>
                            <?php
                                echo "<tr><td><img src='$value[1]' class='img-fluid '></td><td>$value[2]</td><td>$value[3]</td><td>$value[4]</td><td><input type='radio' name='idJuego' value='$value[0]' required></td></tr>";
                            ?>
                        <?php
                    }
                    echo "</table>";
            if(isset($msg)) echo $msg;
        ?>
    <input type="submit" value="Modificar" name="modificar">
    </form>
<?php 
}
?>
    <a href="index.php?action=volverJuegos">Atrás</a>