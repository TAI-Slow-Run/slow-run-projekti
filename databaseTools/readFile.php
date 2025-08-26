<?php

/**
 * Process CSV File and Return Tokenized Data
 *
 * This script reads a CSV file, tokenizes each line into an array based on the specified display field indexes, 
 * and returns the tokenized data as a JSON response. Optionally, it can return only unique values.
 * 
 * Expected Data:
 * - filename: The name of the CSV file to read.
 * - displayFieldIndexes: An array of indexes to determine which fields to display for each line.
 * - uniqueValues: A boolean indicating whether to return only unique tokenized values.
 *
 * Error Responses:
 * - 500: If an internal error occurs during the process, such as missing file, or invalid data.
 * 
 * Success Response:
 * - Returns a JSON response with the tokenized data (and unique values if specified).
 *
 * @author Riku Theodorou <athrikardo@gmail.com>
 */

include("connection.php");

$data = getData();

try {
    if(anyNull(false, $data)) {
        http_response_code(500);
        header("Content-Type: application/json");
        echo json_encode(["error" => "Error: Received data us null"]);
        exit();
    }
    
    $filename = $data[0]; // string
    $displayFieldIndexes = $data[1]; // array 
    $uniqueValues = $data[2]; // boolean (true or false)

    $count = 0;

    $tokenizedData = [];

    $file = @fopen($filename, "r"); // using @ means that the warnings triggered by fopen will be ignored and the script will procceed forward
    if(!$file) {
        throw new Exception("File $filename not found");
    }

    $line = fgets($file); // skip headers
    while(($line = fgets($file)) != false) {
        $tokenizedData[] = tokenizeToArray(trim($line), ",", $displayFieldIndexes);
        $count += 1;
    }

    if($uniqueValues) {
        //array_merge(...$tokenizeData) -> It converts the 2D array to 1D array. D = Dimension
        //array_unique($anonymousArray) -> It returns an 1D array with only unique values
        //array_chunk($anonymousArray) -> It converts the 1D array to 2D array. Every 1D array in the 2D array has count($displayFieldIndex) elements.
        //count($displayFieldIndexes) -> It returns the size of the $displayFieldIndexes array. Another way to look at it is that how many elements it returns. Either way effevtiviley is the same. 
        $tokenizedData = array_chunk(array_unique(array_merge(...$tokenizedData)), count($displayFieldIndexes));
    }

    echo json_encode(["success" => $tokenizedData]);
    
} catch(PDOException $e) {
    http_response_code(500);
    header("Content-Type: application/json");
    echo json_encode(["error" => $e->getMessage()]);
    exit();
} catch(Exception $e) {
    http_response_code(500);
    header("Content-Type: application/json");
    echo json_encode(["error" => $e->getMessage()]);
    exit();
}

?>
