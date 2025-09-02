<?php

/**
 * This script handles the connection to the database and provides several utility functions for database operations.
 * It includes functions for:
 * - Establishing a PDO connection to the MySQL database
 * - Retrieving data from POST or JSON payloads
 * - Checking for null values in variables or arrays
 * - Tokenizing strings into arrays
 * - Retrieving the last inserted ID from a specific table
 * - Handling errors with custom error handling function
 * 
 * The error handler also throws an exception when an error occurs and checks for SQL injection 
 * by allowing only a predefined list of tables for queries.
 * 
 * @author Riku Theodorou <athrikardo@gmail.com>
 */

foreach(parse_ini_file(__DIR__ . "/../.env") as $key => $value) {
    $_ENV[$key] = $value;
}

$servername = $_ENV["DB_HOST"];
$username = $_ENV["DB_USERNAME"];
$password = $_ENV["DB_PASSWORD"];
$databasename = $_ENV["DB_NAME"];


try {
    $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "No connection with the database: " . $e->getMessage();
}

/* --------------------Set error handler to the new project------------------------- */
/**
 * This function will be invoked when a Runtime Error is being catched
 * @param int $errno Error  code number
 * @param string $errstr Message error
 * @param string $errfile File where the error was produced
 * @param int $errline Line of the file the error was produced
 * @throws \Exception An Exception will be thrown when an Runtime Error is being produced
 * @return never
 */

function errorHandler(int $errno, string $errstr, string $errfile, int $errline) {
    $error = [
        "errno" => $errno,
        "errstr" => $errstr,
        "errfile" => $errfile,
        "errline" => $errline
    ];

    error_log(json_encode($error));
    throw new Exception(json_encode($error));
}

set_error_handler("errorHandler");


error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('log_errors', 1);
ini_set('error_log', './databaseTools/logs/error_log.txt');  // Path to log file

/* ---------------------------------------------------------------------------------------- */

//As an extra protection, whenever a table name is required as a user input we always checking for the name of the table
//This can help to counter the problem of SQL Injection.
$allowedTables = ["uses", "news", "administrators"];

/**
 * Returns the last inserted ID of a specific table
 * @param string $tableName The table's name
 * @return int The last inserted id
 */
function getLastID(string $tableName, $idFieldName) {
    global $connection;
    $sql_statement = "SELECT MAX($idFieldName) AS last_id FROM $tableName";
    $kysely = $connection->prepare($sql_statement);
    $kysely->execute();
    $results = $kysely->fetch();
    $last_id = (int)$results["last_id"] ?? 1; // If no records exist, start from 1
    return $last_id;
}

/**
 * When data is being send from javascript to php, every php script calls the `getData()` function.
 * This function retrieves data from either `<form>...</form>` or from an `array`.
 * - If the `CONTENT_TYPE` is application/json then the data received is in JSON format. Afterwards, the data is being decoded into a PHP Object
 *   and from that object we are getting the array which was the array from the javascript side.
 * - If not, the the data comes from `<form>...</form>`. Via the $_POST array we can get our data.
 * @return array | null Returns an array of data or `null` if no data is found.
 */
function getData() {

    if(!isset($_SERVER["CONTENT_TYPE"])) {
        return null;
    }

    //Sometimes CONTENT_TYPE might also include the charset type like this: "application/json charset=UTF-8"
    //We are using strpos in order to find the first occurence of "application/json" text.
    if(strpos($_SERVER["CONTENT_TYPE"], "application/json") === 0) {
        $JSONData = file_get_contents("php://input");
        $wrappedData = json_decode($JSONData, false);
        return $wrappedData->mainData;
    }  else {
        return array_values($_POST);
    }
}

/**
 * Returns an array with the field names
 * @param PDOStatement $query A PDOStatement object which was produced from:
 *                           $query = $connection->prepare($sql_statement);
 *                           $query->execute(); 
 * @return string[] An array containing the name of the fields as strings
 */
function getColumnsNames(PDOStatement $query) {
    $columns = [];
    for($i = 0; $i < $query->columnCount(); $i++) {
        $columns[$i] = $query->getColumnMeta($i)["name"];
    }
    return $columns;
}

/**
 * Checks if any number of variables is null. In case of array, it also possible to check each value of the array
 * @param bool $fullCheck If `true`, then the values of an array will also be checked.
 * @param mixed $args We can give any number of variables to the function
 * @return bool Returns `true` or `false`
 *              - `true` if any variable is null.
 *              - `false` if all variables are not null
 */
function anyNull(bool $fullCheck, ...$args) {
    foreach($args as $argument) {

        if($argument == null) {
            return true;
        }

        if($fullCheck && is_array($argument)) {
            foreach($argument as $element) {
                if($element === null) {
                    return true;
                }
            }
        }
    }
    return false;
}

/**
 * This function parses a string separated by `$separator` and returns an array holding the data that were separated.
 * Optionally, you can reorder the tokens based on the indexes provided in `$displayFieldIndexes`.
 * 
 * @param string $str The text to be tokenized
 * @param string $separator The separator defining how the text is split into tokens
 * @param array $displayFieldIndexes The order of the tokenized elements. For example:
 *                                   If `$str` is "fire,water,earth" and `$displayFieldIndexes` is `[2,0,1]`,
 *                                   the resulting array will be `["earth", "fire", "water"]`.
 *                                   Default is `["*"]`, meaning all tokens will be returned in the original order.
 * 
 * @return string[] An array containing the tokenized elements of `$str`
 */
function tokenizeToArray(string $str, string $separator, array $displayFieldIndexes = ["*"]) {
    $tokens = [];
    $i = 0;
    $indexBegin = 0;
    $size = strlen($str);

    if(count($displayFieldIndexes) == 0 || $displayFieldIndexes[0] == "*") {
        while($i != $size) {
            for(; $i < $size && $str[$i] != $separator; $i++);
            $tokens[] = substr($str, $indexBegin, $i - $indexBegin);
            if($i < $size && $str[$i] == $separator) {
                $indexBegin = ++$i;
            }
        }
    } else {
        $tmpData = [];
        while($i != $size) {
            for(; $i < $size && $str[$i] != $separator; $i++);
            $tmpData[] = substr($str, $indexBegin, $i - $indexBegin);
            if($i < $size && $str[$i] == $separator) {
                $indexBegin = ++$i;
            }
        }

        foreach($displayFieldIndexes as $index) {
            if(isset($tmpData[$index])) {
                $tokens[] = $tmpData[$index];
            }
        }
    }

    return $tokens;
}
?>
