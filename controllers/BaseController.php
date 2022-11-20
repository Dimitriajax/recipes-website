<?php

class BaseController
{
    public function getBeanById($typeOfBean, $queryStringKey)
    {
        if (!isset($_GET["id"])) {
            return  error(404, "No recipe ID specified.");
        }

        $table[$typeOfBean] = R::findOne($typeOfBean, 'id = ?', [$queryStringKey]);
        // $table[$typeOfBean] = R::load($typeOfBean, $queryStringKey);


        // var_dump($typeOfBean);
        // var_dump($queryStringKey);
        // var_dump($table);


        if (empty($table[$typeOfBean])) {
            return error(404, "No recipe with ID $queryStringKey found.");
        }
        return $table;
    }
}
