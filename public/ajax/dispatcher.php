<?php
$pdo = new PDO('mysql:host=YourHost;dbname=yourDatabaseName', 'yourDatabaseUser', 'Password');
if (!isset($_REQUEST))
    exit();
if (!isset($_REQUEST['Function']))
    exit();
switch ($_REQUEST['Function']) {
    case 'UpdateCurrencies':
        echo UpdateCurrencies();
        break;
    case 'getRates':
        echo getRates();
        break;
    case 'addCurrency':
        echo addCurrency();
        break;
    case 'DeleteCurrency':
        echo DeleteCurrency();
        break;
     case 'CheckCurrencyName':
        echo CheckCurrencyName();
        break;
    case 'CheckCurrencyShortName':
        echo CheckCurrencyShortName();
        break;
    default:
        exit();
        break;
}

function UpdateCurrencies() {
    global $pdo;
    extract($_POST);
    $qry = ('UPDATE currencies SET value = :value WHERE id = :id');
    $sth = $pdo->prepare($qry);
    $sth->execute(array(
        ':id' => $id,
        ':value' => $value
    ));
    $count = $sth->rowCount();
    return json_encode(array('status' => 'ok', 'text' => 'Table Updated', 'Query' => $qry, 'Counter' => $count));
}

function DeleteCurrency() {
    global $pdo;
    extract($_POST);
    $qry = ('DELETE FROM currencies WHERE id = :id');
    $sth = $pdo->prepare($qry);
    $sth->execute(array(
        ':id' => $id
    ));
    $count = $sth->rowCount();
    return json_encode(array('status' => 'ok', 'text' => 'Row Deleted', 'Query' => $qry, 'Counter' => $count));
}

function getRates() {
    global $pdo;
    extract($_GET);
    $qry = ('SELECT id, value FROM currencies');
    $sth = $pdo->prepare($qry);
    $sth->execute();
    return json_encode(array('status' => 'ok', 'text' => 'Table Updated', 'Query' => $qry, 'rates' => $sth->fetchAll(PDO::FETCH_ASSOC)));
}

function addCurrency() {
    global $pdo;
    extract($_POST);
    $qry = ('INSERT INTO currencies (name, value, shortname, c_symbol) VALUES (:name , :value, :shortname, :symbol)');
    $sth = $pdo->prepare($qry);
    $sth->execute(array(
        ':name' => $name,
        ':value' => $value,  
        ':shortname' => $shortname, 
        ':symbol' => $symbol  
    ));
    return json_encode(array('status' => 'ok', 'text' => 'Table Updated', 'Query' => $qry));
}

function CheckCurrencyName() {
        global $pdo;
	extract($_POST);
        $qry = ('SELECT name FROM currencies WHERE name = :name');
        $sth = $pdo->prepare($qry);
        $sth->execute(array(
        ':name' => $Name
         ));
	$count = $sth->rowCount();  
       return json_encode(array('status'=>'ok','text'=>'Name already exists!', 'Query'=>$qry, 'Counter' => $count));
}

function CheckCurrencyShortName() {
        global $pdo;
	extract($_POST);
        $qry = ('SELECT name FROM currencies WHERE shortname = :shortname');
        $sth = $pdo->prepare($qry);
        $sth->execute(array(
        ':shortname' => $ShortName
         ));
	$count = $sth->rowCount();  
       return json_encode(array('status'=>'ok','text'=>'Shortname already exists!', 'Query'=>$qry, 'Counter' => $count));
}