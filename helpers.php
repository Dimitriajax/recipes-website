<?php

function displayTemplate($template, $twig, $method)
{
    $twig->display($template, $method);
}

function error($errorNumber, $errorMessage)
{
    http_response_code($errorNumber);
    return array("template" => "error", "error" => $errorMessage);
    die();
}