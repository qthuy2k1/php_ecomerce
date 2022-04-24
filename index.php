<?php

require './src/Controllers/Client/BaseController.php';
require './src/Core/Database.php';
require './src/Models/BaseModel.php';
require __DIR__ . './vendor/autoload.php';

require './src/Views/Client/partials/top.php';

$controllerName = ucfirst(strtolower($_REQUEST['controller'] ?? 'Home')) . 'Controller';
$actionName = $_REQUEST['action'] ?? 'index';

// echo $controllerName;
// echo $actionName;

require './src/Controllers/Client/' . $controllerName . '.php';

$controllerObject = new $controllerName;

$controllerObject->$actionName();

require './src/Views/Client/partials/footer.php';