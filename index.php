<!DOCTYPE html>
<html>
    <head>
    <title>Formulario</title>
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link href="css/bootstrap.min.css" rel="stylesheet">

    </head>
    
    <body>
        <?php require_once 'process.php'; ?>
        <div class="container">
        <?php
        if (isset($_SESSION['message'])): ?>

        <div class="alert alert-<?=$_SESSION['msg_type']?>">

                <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);

                ?>
        </div>
        <?php endif ?>
        
        <div class="contatiner">
        <?php
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
            ?>

            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
            <?php
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>"
                                class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id']; ?>"
                                class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </table>
            </div>            

            <?php
            function pre_r( $array ) {
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
            ?>

        <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php  echo $id; ?>">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="name" class="form-control"
                value="<?php echo $name; ?>" placeholder="Digite o seu nome">
            </div>
            <div class="form-group">
                <label>Localização</label>
                <input type="text" name="location"
                 value="<?php echo $location; ?>" class="form-control" 
                 placeholder="Digite sua localização">
            </div>
            <div class="form-group">
            <?php
            if ($update == true):
            ?>
                <button type ="submit" class="btn btn-info" name="update">Update</button>
            <?php else: ?>
                <button type="submit" class="btn btn-primary" name="save">Save</button>
            <?php endif; ?>
            </div>
        </form>
        </div>
        </div>

        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="_js/script.js"></script>
    </body>
    </html>