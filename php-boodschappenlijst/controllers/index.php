<?php
$heading = 'Boodschappenlijst';
require 'Database.php';
$config = require('config.php');
$db = new Database($config['database']);



$tableHeaders = ["Product", "Prijs", "Aantal", "Subtotaal"];

// TODO: vraag: waarom is er een controle op id? Lijkt overbodig, kan weg?
// (overzichtspagina moet altijd alle boodschappen laten zien)
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : null;

if ($id !== null) {
    $query = "SELECT * FROM groceries WHERE id = :id";
    $db->query($query, [':id' => $id]);
    $groceries = $db->get();
   
    $groceries = !empty($groceries) ? $groceries[0] : null;
} else {
    $groceries = null;
}

$query = "SELECT name, price, number FROM groceries";
$db->query($query);
$items = $db->get();


$subTotal = [];

// TODO: onderstaande code kan korter, onderzoek hoe je dit kunt doen
foreach ($items as $item){
    $sTotal = calcSubTotal($item['price'], $item['number']);
    $subTotal[] = $sTotal;
}


$total = 0;
$total = array_reduce($subTotal, "calcTotal");

require "views/index.view.php";

?>