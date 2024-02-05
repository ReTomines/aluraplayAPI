<?php
// Executar no terminal: php -S localhost:8080 -t public/


use Alura\Mvc\Controller\{
    Controller,
    DeleteVideoController,
    EditVideoController,
    Error404Controller,
    JsonVideoListController,
    LoginFormController,
    LoginController,
    NewVideoController,
    VideoFormController,
    VideoListController,
};
use Alura\Mvc\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

// Conexão com MySQL
require_once __DIR__ . '/../conexao/conexao.php';
//require_once __DIR__ . '/../conexao/criar-banco.php';

//Conexão com SQLite
//$dbPath = __DIR__ . '/../banco.sqlite';
//$pdo = new PDO("sqlite:$dbPath");


$videoRepository = new VideoRepository($pdo);

$routes = require_once __DIR__ . '/../config/routes.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

session_start();
session_regenerate_id();  // Função evita ataques maliciosos da sessão. A cada nova sessão o id é regerado.
$isLoginRoute = $pathInfo === '/login';
if(!array_key_exists('logado', $_SESSION) && !$isLoginRoute){
    header('Location: /login');
    return;
}  

$key = "$httpMethod|$pathInfo";
if (array_key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod|$pathInfo"];

    $controller = new $controllerClass($videoRepository);
} else {
    $controller = new Error404Controller();
}
/** @var Controller $controller */
$controller->processaRequisicao();
