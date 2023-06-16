<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the text from the form submission
    $text = $_POST['text'];

    // Validate and sanitize the input as needed

    // Handle the image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'img/'; // Directory to store uploaded images
        $uploadedFile = $uploadDir . basename($_FILES['image']['name']);

        // Move the uploaded image to the designated directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFile)) {
            // Execute the cURL command
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, 'https://api.openai.com/v1/images/edits');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Authorization:Bearer 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'
            ));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, array(
                'image' => new CURLFile($uploadedFile),
                'prompt' => $text,
                'n' => 1,
                'size' => '1024x1024'
            ));

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                $error = curl_error($curl);
                // Handle the error appropriately
            }

            curl_close($curl);

            // Process the response and display it in another HTML element on the same page
            echo '<h2>Output:</h2>';
            echo '<pre>' . htmlentities($response) . '</pre>';
        } else {
            echo 'Failed to move the uploaded file.';
        }
    } else {
        echo 'No image uploaded or an error occurred during upload.';
    }
}
?>
