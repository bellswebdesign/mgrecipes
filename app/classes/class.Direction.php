<?php

class Direction extends Recipe
{

    /**
     * @param $recipe_id
     * @return array
     *
     * @desc Get all recipe directions of the supplied recipe id
     */
    public function getRecipeDirections($recipe_id)
    {
        global $database;
        $sql = "SELECT * FROM recipes INNER JOIN directions ON (directions.recipe_id = recipes.id) WHERE recipes.id = " . $recipe_id . "";
        $result = mysqli_query($database->db_connect(), $sql);
        $database->confirm_result_set($result);
        return $result;
    }

    /**
     * @param $recipe_id
     * @return int
     *
     * @desc Get the number of directions as an integer of the supplied recipe id
     */
    public function getDirectionsCount($recipe_id)
    {
        global $database;
        $sql = "SELECT * FROM recipes INNER JOIN directions ON (directions.recipe_id = recipes.id) WHERE recipes.id = " . $recipe_id . "";
        $result = mysqli_query($database->db_connect(), $sql);
        $num_rows = mysqli_num_rows($result);
        $database->confirm_result_set($result);
        return $num_rows;
    }

    /**
     * @param $recipe_id
     * @return array
     *
     * @desc Add an single direction based on recipe_id and ingredient_id for ajax function
     */
    public function addSingleDirection($recipe_id){
        $sql = "INSERT INTO directions SET ";
        $sql .= "recipe_id = '" . $recipe_id . "', ";
        $sql .= "instruction = NULL, ";
        $sql .= "image = NULL";
        return $sql;
    }

    /**
     * @param $recipe_id
     * @return array
     *
     * @desc Delete an single direction based on recipe_id and ingredient_id it for ajax function
     */
    public function deleteSingleDirection($recipe_id, $direction_id){
        $sql = "DELETE FROM directions WHERE directions.recipe_id = '" . $recipe_id . "' AND directions.id = '" . $direction_id . "'";
        return $sql;
    }

}