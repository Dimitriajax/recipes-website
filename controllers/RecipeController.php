<?php

class RecipeController extends BaseController
{
    protected array $recipes;

    public function __construct()
    {
        R::setup('mysql:host=localhost;dbname=mydatabase', 'bit_academy', 'bit_academy');
    }

    public function index()
    {
        $recipes["recipes"] = R::find('recipes');

        return $recipes;
    }

    public function show()
    {
        return $this->getBeanById("recipes", $_GET["id"]);
    }

    public function create()
    {
        return array("types" => array("Breakfast", "Lunch", "Dinner"), "levels" => array("Easy", "Medium", "Hard"));
    }

    public function createPost()
    {
        if (!empty($_POST)) {
            $recipe = R::dispense('recipes');
            $recipe->name = $_POST["recipe-name"];
            $recipe->type = $_POST["recipe-type"];
            $recipe->level = strtolower($_POST["recipe-level"]);
            R::store($recipe);

            $id = R::findOne('recipes', "name LIKE ?", [$_POST["recipe-name"]]);

            header("Location: /recipe/show?id=" . $id->id);
        } else {
            return error(404, "Page not found");
        }
    }

    public function edit()
    {
        $recipe = R::find('recipes', "id LIKE ?", [$_GET["id"]]);

        if (empty($recipe)) {
            $id = $_GET["id"];
            return error(404, "No recipe with ID $id found.");
        }

        return array("recipes" => $recipe, "types" => array("Breakfast", "Lunch", "Dinner"), "levels" => array("Easy", "Medium", "Hard"), "kitchens" => R::find("kitchens"));
    }

    public function editPost()
    {
        if (!empty($_POST)) {
            $recipe = R::load('recipes', $_GET["id"]);
            $recipe->kitchen_id = $_POST["recipe-kitchen"];
            $recipe->name = $_POST["recipe-name"];
            $recipe->type = $_POST["recipe-type"];
            $recipe->level = strtolower($_POST["recipe-level"]);
            R::store($recipe);

            $id = R::findOne('recipes', "name LIKE ?", [$_POST["recipe-name"]]);

            header("Location: /recipe/show?id=" . $id->id);
        } else {
            return error(404, "Page not found");
        }
    }
}