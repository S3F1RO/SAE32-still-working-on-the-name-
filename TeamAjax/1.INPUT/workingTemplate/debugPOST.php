<?php
    header("Content-Type: text/plain");

    // 1. Headers
    echo "=== HEADERS ===\n";
    if (function_exists('getallheaders')) {
        foreach (getallheaders() as $k => $v) {
            echo "$k: $v\n";
        }
    } else {
        echo "getallheaders() unavailable\n";
    }

    // 2. Raw body (important for JSON / malformed POST)
    echo "\n=== RAW BODY ===\n";
    $raw = file_get_contents("php://input");
    echo ($raw === "" ? "(empty)" : $raw);

    // 3. Parsed POST fields
    echo "\n\n=== \$_POST ===\n";
    if (!empty($_POST)) {
        print_r($_POST);
    } else {
        echo "(empty)\n";
    }

    // 4. Try to decode JSON
    echo "\n=== JSON DECODE ===\n";
    $json = json_decode($raw, true);
    if ($json !== null) {
        print_r($json);
    } else {
        echo "(invalid or no JSON)\n";
    }

    // 5. Files (if multipart/form-data)
    echo "\n=== \$_FILES ===\n";
    if (!empty($_FILES)) {
        print_r($_FILES);
    } else {
        echo "(empty)\n";
    }
?>