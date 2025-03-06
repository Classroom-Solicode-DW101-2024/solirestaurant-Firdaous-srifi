<?php  
require "config.php"; 
if(isset($_SESSION["client"])){      
    echo "le nom de client ".$_SESSION["client"]["nomCl"];      
    $typeCuisine = getKitchenType();  
} else {     
    header("Location:login.php"); 
}  

if(isset($_GET["logout"])){     
    session_destroy();     
    header("Location:login.php"); 
}

$filteredDishes = []; 
$filtering = false;
if(isset($_POST['search'])){     
    $selectedType = $_POST['type_s'];     
    $selectedCategory = $_POST['categorie_s'];          
    $filteredDishes = getFilteredDishes($selectedType, $selectedCategory);
    $filtering = true; 
}       
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head>     
    <meta charset="UTF-8">     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">     
    <title>solirestaurant</title>     
    <link rel="stylesheet" href="css/home.css?v=1">
    <!--v=1 update la page-->       
</head> 
<body>     
    <header>         
        <h1>solirestaurant</h1>                   
        <form method="POST">             
            <select name="type_s" id="type_s">                 
                <option value="">Tous les types</option>                 
                <option value="Marocaine" <?php echo (isset($_POST['type_s']) && $_POST['type_s'] == 'Marocaine') ? 'selected' : ''; ?>>Marocaine</option>                 
                <option value="Italienne" <?php echo (isset($_POST['type_s']) && $_POST['type_s'] == 'Italienne') ? 'selected' : ''; ?>>Italienne</option>                 
                <option value="Chinoise" <?php echo (isset($_POST['type_s']) && $_POST['type_s'] == 'Chinoise') ? 'selected' : ''; ?>>Chinoise</option>                 
                <option value="Espagnole" <?php echo (isset($_POST['type_s']) && $_POST['type_s'] == 'Espagnole') ? 'selected' : ''; ?>>Espagnole</option>                 
                <option value="Francaise" <?php echo (isset($_POST['type_s']) && $_POST['type_s'] == 'Francaise') ? 'selected' : ''; ?>>Francaise</option>             
            </select>             
            <select name="categorie_s" id="categorie_s">                 
                <option value="">Tous les categories</option>                 
                <option value="plat principal" <?php echo (isset($_POST['categorie_s']) && $_POST['categorie_s'] == 'plat principal') ? 'selected' : ''; ?>>plat principal</option>                 
                <option value="dessert" <?php echo (isset($_POST['categorie_s']) && $_POST['categorie_s'] == 'dessert') ? 'selected' : ''; ?>>dessert</option>                 
                <option value="entrée" <?php echo (isset($_POST['categorie_s']) && $_POST['categorie_s'] == 'entrée') ? 'selected' : ''; ?>>entrée</option>            
            </select>            
            <button name="search">search</button>         
        </form>
        <div>
        <a href="home.php?logout=1"><button>logout</button></a>    
        <span><?php 
        echo($_SESSION["client"]["nomCl"]);
        ?></span>
        </div>          
                  
    </header>     
    <div class="content">
        <?php if($filtering): ?>
            <div class="typeCuisineSection">
                <h2>Résultats de recherche</h2>
                <div class="Cards">
                    <?php foreach($filteredDishes as $dish): ?>
                        <div class='card'>
                            <img src="<?= $dish['image'] ?>">
                            <h3><?= $dish['nomPlat'] ?></h3>
                            <h4><?= $dish['categoriePlat'] ?></h4>
                            <span><?= $dish['prix'] ?>DH</span>
                            <a href=""><button>Add to cart</button></a>
                        </div>
                    <?php endforeach; ?>
                    <?php if(empty($filteredDishes)): ?>
                        <p>Aucun plat trouvé avec ces critères.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <?php foreach($typeCuisine as $type): ?>
                <div class="typeCuisineSection">
                    <h2><?= $type['TypeCuisine'] ?></h2>
                    <div class="Cards">
                        <?php
                        $Dishes = getdishesByType($type['TypeCuisine']);
                        foreach($Dishes as $dish): ?>
                            <div class='card'>
                                <img src="<?= $dish['image'] ?>">
                                <h3><?= $dish['nomPlat'] ?></h3>
                                <h4><?= $dish['categoriePlat'] ?></h4>
                                <span><?= $dish['prix'] ?>DH</span>
                                <a href=""><button>Add to cart</button></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div> 
</body> 
</html>