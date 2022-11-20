<?php

$root = dirname(__DIR__, 1);
require_once  $root . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader($root . '\views');
$twig = new \Twig\Environment($loader, [
    'debug' => true,
]);

$twig->addExtension(new \Twig\Extension\DebugExtension());

if (empty($_GET['q'])) {
    $_GET['q'] = "recipe";
}
$params = explode("/", $_GET["q"]);

$method = $params[1] ?? "index";
if (!empty($_POST)) {
    $method = $params[1] . "Post";
}
$controller = $params[0] ?? "recipe";
$template = $controller . "s/" . $method ?? "recipes/index";
$class = ucfirst($controller) . "Controller";

// Check if controller exists
if (class_exists($class)) {
    // Create new object
    $activeClass = new $class();
    // Get the active method
    $activeMethod = $activeClass->$method();

    // var_dump($activeMethod);
    // Display the template
    $template = $activeMethod['template'] ?? $template;
    displayTemplate($template . ".twig", $twig, $activeMethod);
} else {
    http_response_code(404);
    displayTemplate("error.twig", $twig, array("error" => "Controller '$class' not found."));
    die();
}