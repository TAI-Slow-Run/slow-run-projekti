<!-- The file to store all functions with sql-requests.
 Functions can be used anywhere on the pages -->

<?php
include_once 'connection.php';

// Send request to the DB and get all records from the table news:

function get_news() {

    global $conn;

    //Send request to the DB to the table news without any parameters
    // because we need to get all the records from the table:

    $stmt = $conn->prepare("SELECT 
                                news_id, title, publication_date, article_text 
                            FROM 
                                news;");
    $stmt->execute(); // Run the request

    $news = $stmt->fetchAll(PDO::FETCH_ASSOC); // Take all the news that we just fetched and put it into an array

    return $news;
}

?>
