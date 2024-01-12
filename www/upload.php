<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if email and file are provided
    if (isset($_POST['email']) && isset($_FILES['file'])) {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

        if ($email === false) {
            // Invalid email format
            $status = "Invalid email address.";
        } else {
            // Valid email address, continue processing

            $file = $_FILES['file'];

            // Check if the file upload was successful
            if ($file['error'] === 0) {
                // Verify that the uploaded file is a PDF
                $allowedExtensions = ['pdf'];
                $fileInfo = pathinfo($file['name']);
                $fileExtension = strtolower($fileInfo['extension']);

                if (in_array($fileExtension, $allowedExtensions)) {
                    // Move the uploaded file to a desired location
                    $uploadDir = 'uploads/';
                    $uploadPath = $uploadDir . basename($file['name']);

                    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                        $status = "File uploaded successfully.";

                        // Send email to admin
                        $to = 'admin@example.com';
                        $subject = 'New PDF File Upload';
                        $message = "A new PDF file has been uploaded.\n\nEmail: $email\nFile: $uploadPath";
                        $headers = 'From: webmaster@example.com';

                        mail($to, $subject, $message, $headers);
                    } else {
                        $status = "Error uploading file.";
                    }
                } else {
                    $status = "Only PDF files are allowed.";
                }
            } else {
                $status = "Error: " . $file['error'];
            }
        }
    } else {
        $status = "Email and file are required.";
    }
} else {
    $status = "Invalid request method."; 

}

echo json_encode(['message' => $status]);
?>
