<?php

class Ingredient extends Recipe {

    /**
     * @param $recipe_id
     * @return array
     *
     * @desc Return array of all recipes ingredients by a recipe id
     */
    public function getRecipeIngredients($recipe_id){
        global $database;
        $sql = "SELECT * FROM ingredients WHERE ingredients.recipe_id = " . $recipe_id . "";
        $result = mysqli_query($database->db_connect(), $sql);
        $database->confirm_result_set($result);
        return $result;
    }

    /**
     * @param $recipe_id
     * @param $ingredient_name
     * @return int
     *
     * @desc Return id of an ingredient from an ingredient name and recipe id
     */
    public function getIngredientId($ingredient_name, $recipe_id){
        global $database;
        $sql = "SELECT id FROM ingredients WHERE ingredient_name = '" . $ingredient_name . "' AND recipe_id= '" . $recipe_id . "' ";
        $result = mysqli_query($database->db_connect(), $sql);
        $database->confirm_result_set($result);
        while ($row = $result->fetch_assoc()) {
            return $row['id'];
        }
    }

    /**
     * @return array
     *
     * @desc Return array of all measurement types
     */
    public function getMeasurementTypes(){
        global $database;
        $sql = "SELECT * FROM measurement_types";
        $result = mysqli_query($database->db_connect(), $sql);
        $database->confirm_result_set($result);
        return $result;
    }

    /**
     * @param $measurementSlug
     * @return int
     *
     * @desc Return id of a measurement type being supplied its slug
     */
    public function getMeasurementType($measurementSlug){
        global $database;
        $sql = "SELECT id FROM measurement_types WHERE measurement_type = '" . $measurementSlug . "'";
        $result = mysqli_query($database->db_connect(), $sql);
        $database->confirm_result_set($result);
        while ($row = $result->fetch_assoc()) {
            return $row['id'];
        }
    }

    /**
     * @param $measurementId
     * @return string
     *
     * @desc Return type of a measurement type being supplied its id
     */
    public function getMeasurementTypeById($measurementId){
        global $database;
        $sql = "SELECT measurement_type FROM measurement_types WHERE id = '" . $measurementId . "'";
        $result = mysqli_query($database->db_connect(), $sql);
        $database->confirm_result_set($result);
        while ($row = $result->fetch_assoc()) {
            return $row['measurement_type'];
        }
    }

    /**
     * @param $recipe_id
     * @return bool
     *
     * @desc Add an single ingredient based on recipe_id and ingredient_id for ajax function
     */
    public function addSingleIngredient($recipe_id){
        $sql = "INSERT INTO ingredients SET ";
        $sql .= "recipe_id = '" . $recipe_id . "', ";
        $sql .= "measure_amount = NULL, ";
        $sql .= "measurement_type_id = NULL, ";
        $sql .= "ingredient_name = NULL; ";
        return $sql;
    }

    /**
     * @param $recipe_id
     * @return bool
     *
     * @desc Delete an single ingredient based on recipe_id and ingredient_id for ajax function
     */
    public function deleteSingleIngredient($recipe_id, $ingredientId){
        $sql = "DELETE FROM ingredients WHERE ingredients.recipe_id = '" . $recipe_id . "' AND ingredients.ingredient_id = '" . $ingredientId . "'";
        return $sql;
    }

    /**
     * @return bool
     *
     * @desc Combine all sql update commands (string and array) into a single update command and execute
     */
    public function processAddIngredient()
    {
        global $database;

        $formData = $_POST["recipe"];

        $sql = $this->addSingleIngredient($formData['id']);

        $result = mysqli_query($database->db_connect(), $sql);
        $database->confirm_result_set($result);

        /**
         * @return bool
         *
         * @desc If sql update is successful redirect back to all recipes with status of success, otherwise failed
         */
        if ($result) {
            header("Location: edit-recipe?id=" . $formData['id'] . '&add_status=success');
        } else {
            header("Location: edit-recipe?id=" . $formData['id'] . '&add_status=failed');
            echo mysqli_error($database->db_connect());
            db_disconnect($database->db_connect());
            exit;
        }

    }

}