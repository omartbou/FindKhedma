<?php
if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {

if (isset($_SESSION['role']) && $_SESSION['role'] === 'manager') {

// Check if a file path is provided as a query parameter
    if (isset($_GET['file'])) {
        $filePath = $_GET['file'];

        // Check if the file exists
        if (file_exists($filePath)) {
            // Set the appropriate headers for file download
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Content-Length: ' . filesize($filePath));

            // Read and output the file content
            readfile($filePath);

            // Terminate the script to prevent further output
            exit;
        } else {
            // File not found, you can handle this case
            echo 'File not found.';
        }
    } else {
        // File path not provided, you can handle this case
        echo 'File path not provided.';
    }
}} else{Redirect::to('home');}
?>
