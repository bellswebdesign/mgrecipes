<?php

class Delete extends Recipe
{

    /**
     * @param $recipe_id
     * @return string
     *
     * @desc Return sql delete query for the entire recipe and dependent tables
     */
    public function deleteSingleRecipe($recipe_id){
        $sql = "DELETE recipes, ingredients, directions FROM recipes LEFT JOIN ingredients ON ingredients.recipe_id = recipes.id LEFT JOIN directions ON directions.recipe_id = recipes.id WHERE recipes.id = '" . $recipe_id . "'";
        return $sql;
    }

    /**
     * @return array
     *
     * @desc Combine all sql update commands (string and array) into a single update command and excute
     */
    public function processDeletetRecipe()
    {
        global $database;

        $formData = $_POST["recipe"];

        $sql = $this->deleteSingleRecipe($formData['id']);

        $result = mysqli_query($database->db_connect(), $sql);
        $database->confirm_result_set($result);

        /**
         * @return bool
         *
         * @desc If sql update is successful redirect back to all recipes with status of success, otherwise failed
         */
        if ($result) {
            header("Location: all-recipes?delete_status=success");
        } else {
            header("Location: all-recipes?delete_status=failed");
            echo mysqli_error($database->db_connect());
            db_disconnect($database->db_connect());
            exit;
        }

    }

}