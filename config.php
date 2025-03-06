<?php
session_start();
$host ='localhost';
$dbname ='solirestaurant';
$username ='root';
$password ='';
try {
    
    $pdo= new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /*pdo bach ytconnecta m3a database */
    echo "Connected to database";
}
catch (PDOException $e) {
    die ("ERROR: Could not connect. " . $e->getMessage());
}

function getLastIdClient() {
global $pdo;
    $sql = "SELECT MAX(idClient) AS maxId FROM client";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result= $stmt->fetch(PDO::FETCH_ASSOC);
    if(empty($result['maxId'])) {
        $MaxId = 0;
    } else {
        $MaxId = $result['maxId'];
    }
    return $MaxId;
}

function tel_existe($tel){
    global $pdo;
    $sql = "SELECT * FROM client where telCl=:tel";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':tel', $tel);
    $stmt->execute();
    $rusult = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rusult;
}


function getdishesByType($type){
    global $pdo;
    $sql = "SELECT * FROM plat WHERE TypeCuisine=:type";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':type', $type);
    $stmt->execute();
    $rusult = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rusult;
}

function getKitchenType(){
    global $pdo;
    $sql = "SELECT distinct TypeCuisine  FROM plat ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rusult = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rusult;
}

function getFilteredDishes($type, $category) {
    global $pdo; // Supposons que $pdo soit l'objet de connexion PDO
    
    $query = "SELECT * FROM plat WHERE 1=1";
    /**1=1 selecter kulchi gaaa3 les plats */
    $params = [];
    
    if (!empty($type)) {
        $query .= " AND TypeCuisine = ?";
        /**? = valeur baqi 3ad an3tiwha */
        $params[] = $type;
        /**push dyal type */
    }
    
    if (!empty($category)) {
        $query .= " AND categoriePlat = ?";
        $params[] = $category;
    }
    
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    /**$params kit3awet f "?" */
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>