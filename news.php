<?php
session_start();

include_once "sql_query.php";

// Through the function get_news(), that stores in the sql_query.php, send request to the DB
// Store the data from the DB in the variable (array) $news:
$news = get_news();
// store the array $news in the session:
$_SESSION["news"] = $news;

// If we need to check which data is now in the Session:
//Using of this code make it as a part of html content:
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Uutiset</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.2.0/css/line.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.2.0/css/solid.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Libre+Bodoni:ital,wght@0,400..700;1,400..700&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="./css/style.css" />
  <script>
        // script for printing the connection status in console:
        console.log("<?php echo $connection_status; ?>")
  </script>
</head>

<body>
  <?php include __DIR__ . '/header.php'; ?>

  <section class="section-wrapper" id="section-wrapper">
  <h1 class="section-title">Uutiset</h1>
   <!-- This section fulfill by script in the end of the body -->
  </section>
  <?php include __DIR__ . '/footer.php'; ?>

  <script>
    // Script for filling the list class="icon-lang-list" with elements:
      <?php
        if (isset($news)) {
            foreach ($news as $article) { // Make a loop for every element in array of languages
                $news_title = $article["title"];
                $news_date = $article["publication_date"];
                $news_text = $article["article_text"];
                $news_id = $article["news_id"];
                
        ?>
                // element div for news-div:
                newsWrapper = document.createElement("div");
                newsWrapper.classList.add("item-wrapper");

                newsContentWrapper = document.createElement("div");
                newsContentWrapper.classList.add("item-content");
                  // element div-wrapper to orginize image and text in one line on laptop:
                newsTextAndImageWrapper = document.createElement("div");
                newsTextAndImageWrapper.classList.add("text-and-image-content");
                // element with text colomn and button Show more... if needs
                newsArticleWrapper = document.createElement("div");
                newsArticleWrapper.classList.add("article-wrapper");
                
                // element h2 for news title:
                newsTitleElement = document.createElement("h2");
                newsTitleElement.classList.add("item-title");
                newsTitleElement.innerHTML = "<?php echo $news_title?>";

                // element div for news date:
                newsDataElement = document.createElement("div");
                newsDataElement.classList.add("item-date");
                newsDataElement.innerHTML = "<?php echo $news_date?>";

                // element p for news text:
                newsTextElement = document.createElement("p");
                newsTextElement.classList.add("item-text");
                newsText = <?php echo json_encode($news_text); ?>;
                newsTextElement.innerText = newsText;

                // element img for news image:
                newsImageElement = document.createElement("img");
                newsImageElement.classList.add("item-img");
                //create name of the file.jpg:
                newsImg = "./images/<?php echo $news_id ?>-news-image.jpg";
                newsImageElement.setAttribute("src", newsImg);
                newsImageElement.setAttribute("alt", "<?php echo $news_title?>");
                newsImageElement.setAttribute("height", "300")

                // define element section-wrapper as element where to append "children":
                sectionWrapper = document.getElementById("section-wrapper");
                newsArticleWrapper.append(newsTextElement);
                newsTextAndImageWrapper.append(newsImageElement, newsArticleWrapper);
                newsContentWrapper.append(newsTitleElement, newsDataElement, newsTextAndImageWrapper);
                newsWrapper.append(newsContentWrapper);
                sectionWrapper.append(newsWrapper);

                console.log("scrollHeight of the article is ", newsTextElement.scrollHeight);
                console.log("clientHeight of the article is ", newsTextElement.clientHeight);
                // Condition to show button Näytä lisää:
                if (newsTextElement.scrollHeight > newsTextElement.clientHeight) {
                  linkReadMoreElement = document.createElement("div");
                  linkReadMoreElement.classList.add("see-more-wrapper");
                  linkReadMoreElement.addEventListener("click", showConsoleLog);
                  linkReadMoreBtn = document.createElement("button");
                  linkReadMoreBtn.setAttribute("type", "button");
                  linkReadMoreBtn.classList.add("see-more-btn");
                  linkReadMoreBtn.innerText = "Näytä lisää";
                  linkReadMoreArrow = document.createElement("i");
                  linkReadMoreArrow.classList.add("uis");
                  linkReadMoreArrow.classList.add("uis-angle-down");
                  linkReadMoreElement.append(linkReadMoreBtn, linkReadMoreArrow);
                  newsArticleWrapper.append(linkReadMoreElement);
                }

                function showConsoleLog() {
                  console.log("Show message when click on see-more-wrapper");
                }

        <?php
            }
        }
        ?>
  </script>

</body>

</html>
