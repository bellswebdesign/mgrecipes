<?php

class Database
{
    /**
     * @desc Define database connection variables
     */
    public $server = 'localhost';
    public $username = 'root';
    public $password = 'Azsxdcfvgb1';
    public $dbname = 'mgr';

    /**
     * @desc Create database connection
     */
    public function db_connect()
    {
        $mysqli = new mysqli($this->server, $this->username, $this->password, $this->dbname);
        $this->confirm_db_connect();
        return $mysqli;
    }

    /**
     * @desc Close database session
     */
    public function db_disconnect()
    {
        $mysqli = $this->db_connect();
        if (isset($mysqli)) {
            mysqli_close($mysqli);
        }
    }

    /**
     * @desc Confirm database connection
     */
    public function confirm_db_connect()
    {
        if (mysqli_connect_errno()) {
            $msg = "Database connection failed: ";
            $msg .= mysqli_connect_error();
            $msg .= " (" . mysqli_connect_errno() . ")";
            exit($msg);
        }
    }

    /**
     * @param $result_set
     * @desc If result set is unsuccessful display error
     */
    public function confirm_result_set($result_set)
    {
        if (!$result_set) {
            exit("Database query failed.");
        }
    }

    /**
     * @param $input
     * @desc Sanitize $_POST input values
     * @return string
     */
    public function sanitize_data($input)
    {
        if (is_array($input)) {
            foreach ($input as $var => $val) {
                $output[$var] = sanitize($val);
            }
        } else {
            if (get_magic_quotes_gpc()) {
                $input = stripslashes($input);
            }
            $input = cleanInput($input);
            $output = mysqli_real_escape_string($input);
        }
        return $output;
    }

}

?>