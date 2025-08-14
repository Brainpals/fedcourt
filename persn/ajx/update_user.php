<?php
include 'xyz.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $psn = $_POST['psn'];
    $fullname = $_POST['fullname'];
    $sex = $_POST['sex'];
    $gsm = $_POST['gsm'];

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $psn . '_' . $fileName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Save image path to DB if needed
            $linkr->updateImagePath($psn, $targetFilePath);
        } else {
            echo "Image upload failed.";
            exit;
        }
    }

    // Update staff record
    $nameParts = explode(' ', $fullname, 3);
    $surname = $nameParts[0];
    $firstname = $nameParts[1] ?? '';
    $middlename = $nameParts[2] ?? '';

    $stmt = $linkr->runQuery("UPDATE payems_staff SET surname = ?, firstname = ?, middlename = ?, sex = ?, gsmnumber = ? WHERE psn = ?");
    $stmt->execute([$surname, $firstname, $middlename, $sex, $gsm, $psn]);

    echo "Staff updated successfully.";
}
?>
