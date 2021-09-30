<?php

//plants. id, name, is_yearling ,quantity



include('./uniqueplants.php');



    if(isset($_POST['create'] )){
        store();
        header("location:./plants.php?plant_id=".$_POST['plant_id']);
        die;
    }

    if(isset($_POST['update'] )){
        update();
        header("location:./plants.php?plant_id=".$_POST['plant_id']);
        die;
    }
    
    if(isset($_POST['delete'] )){
        destroy($_POST['delete']);
        header("location:./plants.php?plant_id=".$_POST['plant_id']);
        die; 
    }

    $action = 'create';

    if(isset($_GET['edit'] )){
            $plant = find($_GET['edit']);
            $action = 'update';
        }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
    /*checkbox*/

    @supports (zoom:2) {
        input[type="radio"],  input[type=checkbox]{
            zoom: 2;
            }
    }
    @supports not (zoom:2) {
        input[type="radio"],  input[type=checkbox]{
            transform: scale(2);
            margin: 15px;
        }
    }

    </style>
</head>
<body>
    <div class="container">
        <div class="btn-group dropend">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                LINKS
             </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item active" href="./">HOME</a></li>
                </ul>
        </div>




    
    <form class="form" action="" method="POST">
      
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" >Age</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" name="age" value="<?= (isset($plant))? $plant['age'] : "" ?>">
            </div>
         </div>

         <div class="form-group row">
            <label class="col-sm-2 col-form-label" >Height</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" name="height" value="<?=(isset($plant))? $plant['height']:""?>">
            </div>
         </div>
         
         <div class="form-group row">
            <label class="col-sm-2 col-form-label" >Health</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" name="health" value="<?=(isset($plant))?$plant['health']:""?>">
            </div>
            
         </div>
         <input type="hidden" name="plant_id" value="<?=$_GET['plant_id']?>">
    <?php if(!isset($plant)){
            echo '<button class="btn btn-primary" name="create" type="submit">Pridėti augalą</button>';
    }else{
            echo '<button class="btn btn-info" type="submit" name="update" value="'.$plant['id'].'">Atnaujinti augalą</button>';
    } ?>
    </form>



    <table class="table">
        <tr>
        <th>Id</th> 
        <?php
        $all = all();
            if (isset($all->fetch_assoc()['name'])){
                echo "<th>Name</th>";
            }
        ?>
        <th>Age</th> 
        <th>Height</th> 
        <th>Health</th> 
        <th>edit</th> 
        <th>delete</th> 
        </tr>


        <?php $count = 0; foreach ($all as $plant) { ?>
            <tr>
            <td> <?= ++$count."/".$plant['id']  ?> </td>
                <?php
                    if(isset($plant['name'])){
                        echo "<td>".$plant['name']."</td>";
                    }
                ?>
                <td> <?= $plant['age']  ?> </td>
                <td> <?= $plant['height']  ?> </td>
                <td> <?= $plant['health']  ?> </td>
                <td>

                    <a class="btn btn-success" href="?plant_id=<?= $_GET['plant_id'] ?>&edit=<?= $plant['id']          ?>">edit</a>
                </td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="plant_id" value="<?=$_GET['plant_id']?>">
                        <button class="btn btn-danger" type="submit" name="delete" value="<?=$plant['id']?>"  >delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
    </div>
</body>
</html>