<!-- The file to store all functions with sql-requests.
 Functions can be used anywhere on the pages -->

<?php
include_once 'connection.php';

// Send request to the DB and get all records from the table news:

function get_news()
{
    global $conn;

    //Send request to the DB to the table news without any parameters
    // because we need to get all the records from the table:
    $stmt = $conn->prepare("SELECT 
                                news_id, title, publication_date, article_text 
                            FROM 
                                news;");
    $stmt->execute(); // Run the request

    // Take all the news that we just fetched and put it into an array:
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $news;
}

function generateTempFileName()
{
    //Set the unique name to the file just to store it as temporary file before uploading to the server:
    $temp_file_name = uniqid() . "-" . str_replace(" ", "-", trim(strtolower($_FILES["img-file"]["name"])));
    return $temp_file_name;
}

// Function to handle the selected image file:
function handleTempImgFile($fileName)
{
    //specify the directory to store TEMPORARY file:
    $temp_upload_dir = "images/temp-uploads/";
    //Get a temporary file with the initial name:
    $tempFile = $_FILES["img-file"]["tmp_name"];
    //Set the path to store the file (folder/temp-name.extension):
    $temp_file_path = $temp_upload_dir . $fileName;

    $uploadOk = 1;

    // Check if file already exists:
    if (file_exists($temp_file_path)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error  
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        //copy the temporary file to the server with a new name in the folder specified by $target_file:
        //Syntax: move_uploaded_file(file, dest):
        // file - filename of the uploaded file
        //dest - the new location for the file
        if (move_uploaded_file($tempFile, $temp_file_path)) {
?>
            <script>
                console.log(`The temporary file <?php echo $fileName ?>  has been uploaded to <?php echo $temp_file_path ?>.`);
            </script>
        <?php

        } else {
        ?>
            <script>
                console.log(`Sorry, there was an error uploading your file.`);
            </script>
<?php
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

?>