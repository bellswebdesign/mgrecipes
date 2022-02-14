<?php

class Edit extends Recipe
{

    /**
     * @return string
     *
     * @desc Return sql update query for the recipe details
     */
    public function updateRecipeData()
    {

        if (isset($_POST['recipe'])){

            global $database;
            $recipeData = $_POST["recipe"];

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
            $sql = "UPDATE recipes SET ";
            $sql .= "name='" . $nameClean . "', ";
            $sql .= "description='" . $descriptionClean . "', ";
            $sql .= "serving_size='" . $servingSizeClean . "', ";
            $sql .= "prep_time='" . $prepTimeClean . "', ";
            $sql .= "prep_time_duration='" . $prepTimeDurationClean . "', ";
            $sql .= "cook_time='" . $cookTimeClean . "', ";
            $sql .= "cook_time_duration='" . $cookTimeDurationClean . "' ";
            $sql .= "WHERE id='" . $recipeData['id'] . "'; ";
            return $sql;
        }

    }

    /**
     * @return array
     *
     * @desc Return sql update query for the ingredient list
     */
    public function updateIngredientData()
    {
        $formData = $_POST["recipe"];
        $ingredients = new Ingredient();
        $ingredientNum = 1;

        foreach ($ingredients->getRecipeIngredients($formData['id']) as $ingredient) {

            $getMeasurementTypeId = $ingredients->getMeasurementType($formData['measurement_type_' . $ingredientNum]);

            //Create SQL script
            $sql = "UPDATE ingredients SET ";
            $sql .= "measure_amount = '" . addslashes($formData['measurement_amount_' . $ingredientNum]) . "', ";
            $sql .= "measurement_type_id = '" . $getMeasurementTypeId . "', ";
            $sql .= "ingredient_name = '" . addslashes($formData['ingredient_name_' . $ingredientNum]) . "' ";
            $sql .= "WHERE ingredients.recipe_id = '" . $formData['id'] . "' ";
            $sql .= "AND ingredients.ingredient_id = '" . $ingredient['ingredient_id'] . "'; ";

            $ingredientArray[] = $sql;
            $ingredientNum++;
        }

        //Combine all SQL commands into an array
        $ingredientArraySql = implode(" ", $ingredientArray);
        return $ingredientArraySql;

    }

    /**
     * @return array
     *
     * @desc Return sql update query for the instruction list
     */
    public function updateInstructionData()
    {
        $formData = $_POST["recipe"];
        $directions = new Direction();
        $instructionNum = 1;

        foreach ($directions->getRecipeDirections($formData['id']) as $direction) {

            //Create SQL script
            $sql = "UPDATE directions SET ";
            $sql .= "instruction = '" . addslashes($formData['instruction_' . $instructionNum]) . "' ";
            $sql .= "WHERE directions.recipe_id = '" . $formData['id'] . "' ";
            $sql .= "AND directions.id = '" . $direction['id'] . "'; ";
            $directionArray[] = $sql;
            $instructionNum++;
        }

        //Combine all SQL commands into an array
        $directionArraySql = implode(" ", $directionArray);
        return $directionArraySql;

    }

    /**
     * @return array
     *
     * @desc Combine all sql update commands (string and array) into a single update command and execute
     */
    public function processEditRecipe()
    {
        global $database;
        $formData = $_POST["recipe"];

        $sql = $this->updateRecipeData();
        $sql .= $this->updateIngredientData();
        $sql .= $this->updateInstructionData();

        if (!$database->db_connect()->multi_query($sql))
            echo "Multi query failed: (" . $database->db_connect()->errno . ") " . $database->db_connect()->error;
        do {
            if ($res = $database->db_connect()->store_result()) {
                var_dump($res->fetch_all(MYSQLI_ASSOC));
                $res->free();
            }
        } while ($database->db_connect()->more_results() && $database->db_connect()->next_result());

        /**
         * @return bool
         *
         * @desc If sql update is successful redirect back to edit page with status of success, otherwise failed
         */
        if ($sql) {
            header("Location: recipe?id=" . $formData['id'] . '&edit_status=success');
            $database->db_disconnect();
        } else {
            header("Location: edit-recipe?id=" . $formData['id'] . '&edit_status=failed');
            $database->db_disconnect();
        }

    }
}