<?php

class Ajax
{

    /**
     * @return string
     *
     * @desc Check if the request is an AJAX command
     */
    public function is_ajax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    /**
     * @return string
     *
     * @desc Create a new ingredient from an AJAX command
     */
    public function addIngredient()
    {
        global $database;
        $recipe_id = $_POST['recipe_id'];
        $ingredient = new Ingredient();
        $query = mysqli_query($database->db_connect(), $ingredient->addSingleIngredient($recipe_id));
        if ($query) {
            echo json_encode("Ingredient Inserted Successfully");
        } else {
            echo json_encode("Ingredient Unsuccessfully Inserted");
        }
    }

    /**
     * @return string
     *
     * @desc Create an ingredient from an AJAX command
     */
    public function deleteIngredient()
    {
        global $database;
        $recipe_id = $_POST['recipe_id'];
        $ingredient_id = $_POST['ingredient_id'];

        $ingredient = new Ingredient();

        $query = mysqli_query($database->db_connect(), $ingredient->deleteSingleIngredient($recipe_id, $ingredient_id));

        if ($query) {
            echo json_encode("Ingredient Deleted Successfully");
        } else {
            echo json_encode('Ingredient Unsuccessfully Deleted');
        }
    }

    /**
     * @return string
     *
     * @desc Create a new direction from an AJAX command
     */
    public function addDirection()
    {
        global $database;
        $recipe_id = $_POST['recipe_id'];

        $direction = new Direction();

        $query = mysqli_query($database->db_connect(), $direction->addSingleDirection($recipe_id));
        if ($query) {
            echo json_encode("Direction Inserted Successfully");
        } else {
            echo json_encode("Direction Unsuccessfully Inserted");
        }
    }

    /**
     * @return string
     *
     * @desc Deelete a direction from an AJAX command
     */
    public function deleteDirection()
    {
        global $database;
        $recipe_id = $_POST['recipe_id'];
        $direction_id = $_POST['direction_id'];

        $direction = new Direction();

        $query = mysqli_query($database->db_connect(), $direction->deleteSingleDirection($recipe_id, $direction_id));

        if ($query) {
            echo json_encode("Direction Deleted Successfully");
        } else {
            echo json_encode('Direction Unsuccessfully Deleted');
        }
    }

    /**
     * @return string
     *
     * @desc Update a recipe from an AJAX command
     */
    public function updateRecipe()
    {

        global $database;
        $editRecipe = new Edit();

        $sql = $editRecipe->updateRecipeData();
        $sql .= $editRecipe->updateIngredientData();
        $sql .= $editRecipe->updateInstructionData();

        if (!$database->db_connect()->multi_query($sql))
            echo "Multi query failed: (" . $database->db_connect()->errno . ") " . $database->db_connect()->error;
        do {
            if ($res = $database->db_connect()->store_result()) {
                var_dump($res->fetch_all(MYSQLI_ASSOC));
                $res->free();
            }
        } while ($database->db_connect()->more_results() && $database->db_connect()->next_result());

        if ($sql) {
            echo json_encode("Recipe Updated Successfully");
        } else {
            echo json_encode('Recipe Unsuccessfully Updated');
        }
    }


    /**
     * @return string
     *
     * @desc Delete a recipe from an AJAX command
     */
    public function deleteRecipe()
    {

        global $database;
        $recipe_id = $_POST['recipe_id'];

        $deleteRecipe = new Delete();

        $query = mysqli_query($database->db_connect(), $deleteRecipe->deleteSingleRecipe($recipe_id));

        if ($query) {
            echo json_encode("Recipe Deleted Successfully");
        } else {
            echo json_encode('Recipe Unsuccessfully Deleted');
        }
    }

    /**
     * @return string
     *
     * @desc Search recipes and return recipe name and ID
     */
    public function searchRecipes(){

        global $database;
        $mysqli = $database->db_connect();

        // Check connection
        if($mysqli === false){
            die("ERROR: Could not connect. " . $mysqli->connect_error);
        }

        if(isset($_REQUEST["term"])){
            // Prepare a select statement
            $sql = "SELECT * FROM recipes WHERE name LIKE ?";

            if($stmt = $mysqli->prepare($sql)){

                // Set parameters
                $param_term = $_REQUEST["term"] . '%';

                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_term);

                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    $result = $stmt->get_result();

                    // Check number of rows in the result set
                    if($result->num_rows > 0){
                        // Fetch result rows as an associative array
                        while($row = $result->fetch_array(MYSQLI_ASSOC)){
                            echo "<p id='{$row["id"]}'>" . $row["name"] . "</p>";
                        }
                    } else{
                        echo "<p>No matches found</p>";
                    }
                } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
                }
            }

            $stmt->close();
        }

        $database->db_disconnect();
    }

}

?>