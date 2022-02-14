<?php

class Recipe {

    /**
     * @return array
     *
     * @desc Return array of all recipes
     */
    public static function getAllRecipes(){
        global $database;
        $sql = "SELECT * FROM recipes ";
        $result = mysqli_query($database->db_connect(), $sql);
        $database->confirm_result_set($result);
        return $result;
    }

    /**
     * @param $id
     * @return array
     *
     * @desc Return array of all data from a recipe by id
     */
    public static function getRecipeId($id){
        global $database;
        $sql = "SELECT * FROM recipes ";
        $sql .= "WHERE id='" . $id . "'";
        $result = mysqli_query($database->db_connect(), $sql);
        $database->confirm_result_set($result);
        $recipe = mysqli_fetch_assoc($result);
        return $recipe;
    }

    /**
     * @return array
     *
     * @desc Return array of all duration types
     */
    public function getDurationTypes(){
        global $database;
        $sql = "SELECT * FROM duration_types";
        $result = mysqli_query($database->db_connect(), $sql);
        $database->confirm_result_set($result);
        return $result;
    }

    /**
     * @param $durationslug
     * @return int
     *
     * @desc Return id of a duration type from a duration type slug
     */
    public function getDurationType($durationslug){
        global $database;
        $sql = "SELECT id FROM duration_types WHERE duration = '" . $durationslug . "'";
        $result = mysqli_query($database->db_connect(), $sql);
        $database->confirm_result_set($result);
        while ($row = $result->fetch_assoc()) {
            return $row['id'];
        }
    }

    /**
     * @param $durationId
     * @return int
     *
     * @desc Return id of a duration type from a duration type slug
     */
    public function getDurationTypeById($durationId){
        global $database;
        $sql = "SELECT duration FROM duration_types WHERE id = '" . $durationId . "'";
        $result = mysqli_query($database->db_connect(), $sql);
        $database->confirm_result_set($result);
        while ($row = $result->fetch_assoc()) {
            return $row['duration'];
        }
    }

}