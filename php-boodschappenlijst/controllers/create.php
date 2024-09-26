<?php
$heading = 'Toevoegen';
require 'Database.php';
$config = require('config.php');
$db = new Database($config['database']);
require 'Validator.php'; 
require 'validation-rules.php'; 

$form_submission_successful = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // TODO: kies duidelijke, omschrijvende namen voor variablen, dus niet $v, maar bijv. $validator
    // TODO: validator ziet er behoorlijk ingewikkeld en uitgebreid uit, ik zou hem
    // de volgende keer zo kort mogelijk maken, dus alleen voor elk type validatie
    // (string, number, email, etc. 1 eigen functie die een boolean returned)
    $v = new Validator($_POST);    
    $rules = getValidationRules();

    
    foreach ($rules as $field => $ruleFunction) {
        $v->field($field);
        $ruleFunction($v);
    }

    
    if (!$v->validate()) {
        $errors = [];

        
        foreach ($v->errors() as $field => $fieldErrors) {
            $errors[$field] = implode(' ', $fieldErrors);
        }
    } else {
        
        $name = htmlspecialchars($_POST['name']);
        $number = intval($_POST['number']);
        $price = htmlspecialchars($_POST['price']); 

       
        $form_submission_successful = $db->query(
            'INSERT INTO groceries (name, number, price) VALUES(:name, :number, :price)', 
            [
                ':name' => $name,
                ':number' => $number,
                ':price' => $price
            ]
        );
    }

    
    if ($form_submission_successful) {
        header("Location: /");
        exit();
    }
}



require "views/create.view.php";


?>