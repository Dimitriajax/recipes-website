<?php

class KitchenController extends BaseController
{
    public array $method;

    public function __construct()
    {
        R::setup('mysql:host=localhost;dbname=mydatabase', 'bit_academy', 'bit_academy');
    }

    public function index()
    {
        $kitchens["kitchens"] = R::find('kitchens');

        return $kitchens;
    }

    public function show()
    {
        return $this->getBeanById("kitchens", $_GET["id"]);
    }
    public function create()
    {
        return array();
    }

    public function createPost()
    {
        if (!empty($_POST)) {
            $kitchen = R::dispense('kitchens');
            $kitchen->name = $_POST["kitchen-name"];
            $kitchen->description = $_POST["kitchen-description"];
            R::store($kitchen);

            $id = R::findOne('kitchens', "name LIKE ?", [$_POST["kitchen-name"]]);

            header("Location: /kitchen/show?id=" . $id->id);
        } else {
            return error(404, "Page not found");
        }
    }
    public function edit()
    {
        $kitchen = R::find('kitchens', "id = ?", [$_GET["id"]]);

        if (empty($kitchen)) {
            $id = $_GET["id"];
            return error(404, "No kitchen with ID $id found.");
        }
        return array("kitchens" => $kitchen);
    }
    public function editPost()
    {
        if (!empty($_POST)) {
            $kitchen = R::load('kitchens', $_GET["id"]);
            $kitchen->name = $_POST["kitchen-name"];
            $kitchen->description = $_POST["kitchen-description"];
            R::store($kitchen);

            $id = R::findOne('kitchens', "name LIKE ?", [$_POST["kitchen-name"]]);

            header("Location: /kitchen/show?id=" . $id->id);
        } else {
            return error(404, "Page not found");
        }
    }
}