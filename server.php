<?php

$dataJson = file_get_contents("js/data.json");
$method = $_SERVER['REQUEST_METHOD'];

$listPhp = json_decode($dataJson, true);


switch ($method) {

    case 'POST':
        if (isset($_POST['text'])) {
            $newLi = [
                "id" => $listPhp[count($listPhp) - 1]['id'] + 1,
                "text" => $_POST['text'],
                "done" => false
            ];
            $listPhp[] = $newLi;
            $dataJson = json_encode($listPhp, JSON_PRETTY_PRINT);
            file_put_contents("js/data.json", $dataJson);
        }
        break;

    case 'PUT':
        $objPhp = json_decode(file_get_contents('php://input'), true);
        $idx = $objPhp['id'] - 1;
        $listPhp[$idx]['done'] = !$listPhp[$idx]['done'];
        $dataJson = json_encode($listPhp, JSON_PRETTY_PRINT);
        file_put_contents("js/data.json", $dataJson);
        break;
}





header("Content-Type: application/json");
echo $dataJson;