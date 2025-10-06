<?php

date_default_timezone_set('Europe/Helsinki'); // or your desired timezone

function create_session(PDO $connection, int $admin_id) {
    $selector = bin2hex(random_bytes(9)); // 18 chars
    $validator = bin2hex(random_bytes(32)); // secret

    //Hash both with a server secret
    $selector_hash = hash_hmac("sha256", $selector, $_ENV["APP_SECRET"]);
    $validator_hash = hash_hmac("sha256", $validator, $_ENV["APP_SECRET"]);

    $expires_at = (new DateTime("+1 hour"))->format("Y-m-d H:i:s");

    $sql_statement = "INSERT INTO admin_sessions(admin_id, selector, validator, expires_at)
    VALUES (:admin_id, :selector, :validator, :expires_at)";

    $query = $connection->prepare($sql_statement);
    $query->execute([
        ":admin_id" => $admin_id,
        ":selector" => $selector_hash,
        ":validator" => $validator_hash,
        ":expires_at" => $expires_at
    ]);

    //send raw selector + validator to client as cookie
    $cookie_value = $selector . ":" . $validator;
    setcookie("auth_token", $cookie_value, [
        "expires" => 0, // session cookie (deleted when browser closes)
        "path" => "/", // cookie is sent for the whole website, not just a folder
        "secure" => true, // cookie is only sent over HTTPS
        "httponly" => true, // cookie cannot be read or modified by JavaScript
        "samesite" => "Lax" // reduces CSRF by limiting cross-site cookie sending.
        /* CSRF = Cross-Site Request Forgery.
        It’s an attack where a hacker tricks a logged-in user’s browser
        into making a request to your server without the user knowing. */
    ]);

    return true;
}

function validate_session(PDO $connection) {
    if(empty($_COOKIE["auth_token"])) {
        return null;
    }

    $parts = explode(":", $_COOKIE["auth_token"]);
    if(count($parts) !== 2) {
        return null;
    }

    /*
     * The line below is PHP syntax sugar for quickly assigning array values to variables.
     * Example:
     * If we have the array $parts = ['abc123', 'def456'] then
     * the below line is the same as writing:
     * $selector = $parts[0];
     * $validator = $parts[1]; 
     */
    list($selector, $validator) = $parts;

    $selector_hash = hash_hmac("sha256", $selector, $_ENV["APP_SECRET"]);
    $validator_hash = hash_hmac("sha256", $validator, $_ENV["APP_SECRET"]);

    // error_log("APP_SECRET: " . $_ENV['APP_SECRET']);
    // error_log("Selector hash: $selector_hash");
    // error_log("DB selector: " . print_r($session['selector'] ?? 'not found', true));


    $sql_statement = "SELECT * FROM admin_sessions
    WHERE selector = :selector AND expires_at > NOW()
    LIMIT 1";

    $query = $connection->prepare($sql_statement);
    $query->execute([
        ":selector" => $selector_hash
    ]);
    $session = $query->fetch(PDO::FETCH_ASSOC);

    //var_dump($session);

    if(!$session) {
        return null;
    }

    //compare hashed validator
    if(!hash_equals($session["validator"], $validator_hash)) {
        return null;
    }

    //Recheck this line later
    return (int)$session["admin_id"]; // converts string to int. ONLY IN PHP. In java, this is an error.
}

function logout_session(PDO $connection) {
    if(!empty($_COOKIE["auth_token"])) {
        $parts = explode(":", $_COOKIE["auth_token"]);
        if(count($parts) === 2) {
            list($selector, $validator) = $parts;
            $selector_hash = hash_hmac("sha256", $selector, $_ENV["APP_SECRET"]);

            $sql_statement = "DELETE FROM admin_sessions
            WHERE selector = :selector";
            
            $query = $connection->prepare($sql_statement);
            $query->execute([
                ":selector" => $selector_hash
            ]);
        }

        //Delete cookie
        setcookie("auth_token", "", [
            "expires" => time() - 3600, // session cookie (deleted when browser closes)
            "path" => "/", // cookie is sent for the whole website, not just a folder
            "secure" => true, // cookie is only sent over HTTPS
            "httponly" => true, // cookie cannot be read or modified by JavaScript
            "samesite" => "Lax" // reduces CSRF by limiting cross-site cookie sending.
            /* CSRF = Cross-Site Request Forgery.
            It’s an attack where a hacker tricks a logged-in user’s browser
            into making a request to your server without the user knowing. */
        ]);

        //Optional but it's a good practise to do.
        unset($_COOKIE["auth_token"]);
    }
}
?>