<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if all required fields are filled
    if (isset($_POST["product_name"]) && isset($_POST["customer_name"]) && isset($_FILES["file"])) {
        
        $product_name = $_POST["product_name"];
        $customer_name = $_POST["customer_name"];

        // File details
        $file_name = $_FILES["file"]["name"];
        $file_tmp = $_FILES["file"]["tmp_name"];
        $file_size = $_FILES["file"]["size"];

        // Move the uploaded file to a desired location (adjust the path accordingly)
        $upload_directory = "uploads/";
        $destination = $upload_directory . $file_name;

        if (move_uploaded_file($file_tmp, $destination)) {
            // File uploaded successfully, you can now process the order and store the file path in the database
            echo "Order placed successfully. File uploaded to: " . $destination;
        } else {
            echo "Error uploading file.";
        }

    } else {
        echo "Please fill in all the required fields.";
    }
}

?>
