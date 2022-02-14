<?php

class Add extends Recipe
{
    /**
     * @return string
     *
     * @desc Return sql insert query for the recipe details
     */
    public function addRecipeData()
    {
        if (isset($_POST['recipe'])){

            global $database;

            //Filter and validate inputs
            $name = filter_var($_POST['recipe']['name'], FILTER_SANITIZE_STRING);
            $description = filter_var($_POST['recipe']['description'], FILTER_SANITIZE_STRING);
            $serving_size = filter_var($_POST['recipe']['serving_size'], FILTER_SANITIZE_NUMBER_INT);
            $prep_time = filter_var($_POST['recipe']['prep_time'], FILTER_SANITIZE_NUMBER_INT);
            $prep_time_duration = filter_var($_POST['recipe']['prep_time_duration'], FILTER_SANITIZE_STRING);
            $cook_time = filter_var($_POST['recipe']['cook_time'], FILTER_SANITIZE_NUMBER_INT);
            $cook_time_duration = filter_var($_POST['recipe']['cook_time_duration'], FILTER_SANITIZE_STRING);

            //Sanitize filtered data/escape data to prevent SQL injection
            $nameClean = mysqli_real_escape_string($database->db_connect(),$name);
            $descriptionClean = mysqli_real_escape_string($database->db_connect(),$description);
            $servingSizeClean = mysqli_real_escape_string($database->db_connect(),$serving_size);
            $prepTimeClean = mysqli_real_escape_string($database->db_connect(),$prep_time);
            $prepTimeDurationClean = mysqli_real_escape_string($database->db_connect(),$prep_time_duration);
            $cookTimeClean = mysqli_real_escape_string($database->db_connect(),$cook_time);
            $cookTimeDurationClean = mysqli_real_escape_string($database->db_connect(),$cook_time_duration);

            //Create SQL script
            $sql = "INSERT INTO recipes SET ";
            $sql .= "name='" . $nameClean . "', ";
            $sql .= "description='" . $descriptionClean . "', ";
            $sql .= "serving_size='" . $servingSizeClean . "', ";
            $sql .= "prep_time='" . $prepTimeClean . "', ";
            $sql .= "prep_time_duration='" . $prepTimeDurationClean . "', ";
            $sql .= "cook_time='" . $cookTimeClean . "', ";
            $sql .= "cook_time_duration='" . $cookTimeDurationClean . "'; ";
            return $sql;
        }
    }

    /**
     * @param $recipe_id of the newly created recipe
     * @return array
     *
     * @desc Return sql insert query for the ingredient list
     */
    public function addIngredientData($newRecipeId)
    {
        $ingredientClass = new Ingredient();
        $ingredients = $_POST["ingredients"];
        global $database;

        if (!empty($_POST["ingredients"])) {

            //Loop through all of the ingredients
            foreach ($ingredients as $ingredient) {

                //Take the ingredient type and find its ID
                $getMeasurementTypeId = $ingredientClass->getMeasurementType($ingredient['measurement_type']);

                //Filter and validate inputs
                $amount = filter_var($ingredient['amount'], FILTER_SANITIZE_NUMBER_INT);
                $ingredient_name = filter_var($ingredient['name'], FILTER_SANITIZE_STRING);

                //Sanitize filtered data/escape data to prevent SQL injection
                $amountClean = mysqli_real_escape_string($database->db_connect(),$amount);
                $ingredientNameClean = mysqli_real_escape_string($database->db_connect(),$ingredient_name);

                //Create SQL script
                $sql = "INSERT INTO ingredients SET ";
                $sql .= "measure_amount = '" . $amountClean . "', ";
                $sql .= "measurement_type_id = '" . $getMeasurementTypeId . "', ";
                $sql .= "ingredient_name = '" . $ingredientNameClean . "', ";
                $sql .= "recipe_id = '" . $newRecipeId . "'; ";
                $ingredientArray[] = $sql;
            }

            //Combine all SQL commands into an array
            $ingredientArraySql = implode(" ", $ingredientArray);
            return $ingredientArraySql;

        }

    }

    /**
     * @param $recipe_id of the newly created recipe
     * @return array
     *
     * @desc Return sql insert query for the instruction list
     */
    public function addInstructionData($newRecipeId)
    {
        $directions = $_POST["direction"];
        global $database;

        if (!empty($directions)) {

            //Loop through all of the directions
            foreach ($directions as $direction) {

                //Filter and validate inputs
                $directionText = filter_var($direction, FILTER_SANITIZE_STRING);

                //Sanitize filtered data/escape data to prevent SQL injection
                $directionClean = mysqli_real_escape_string($database->db_connect(),$directionText);

                //Create SQL script
                $sql = "INSERT INTO directions SET ";
                $sql .= "instruction = '" . $directionClean . "', ";
                $sql .= "recipe_id = '" . $newRecipeId . "'; ";
                $directionArray[] = $sql;
            }

            //Combine all SQL commands into an array
            $directionArraySql = implode(" ", $directionArray);
            return $directionArraySql;

        }

    }

    /**
     * @desc Combine all sql insert commands (string and array) into a single command and execute
     */
    public function processAddRecipe()
    {
        global $database;
        $mysqli = $database->db_connect();

        /**
         * @return bool
         *
         * @desc Begin sql insert command, process recipe data, and if all is successful redirect to edit page with status of success
         */
        if ($result = $mysqli->query($this->addRecipeData())) {
            $recipeID = $mysqli->insert_id;

            /**
             * @desc Process ingredient list sql command
             */
            if (!empty($this->addIngredientData($recipeID))) {
                if (!$database->db_connect()->multi_query($this->addIngredientData($recipeID))) {
                    echo "Adding ingredient data failed: (" . $database->db_connect()->errno . ") " . $database->db_connect()->error;
                }
            }

            /**
             * @desc Process instruction list sql command
             */
            if (!empty($this->addInstructionData($recipeID))) {
                if (!$database->db_connect()->multi_query($this->addInstructionData($recipeID))){
                    echo "Adding instruction data failed: (" . $database->db_connect()->errno . ") " . $database->db_connect()->error;
                }
            }

            /**
             * @desc If sql command is successful redirect back to edit page with status of success, otherwise failed
             */
            header("Location: edit-recipe?id=" . $recipeID . '&add_status=success');
            $database->db_disconnect();
        } else {
            echo "Adding recipe failed: (" . $mysqli->errno . ") " . $mysqli->error;
        }

    }


}