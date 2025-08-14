<?php
/**
 * Scales an image in a folder to a specific width and height.
 *
 * @param string $sourcePath The path to the source image.
 * @param string $destinationPath The path to save the scaled image.
 * @param int $newWidth The desired width of the scaled image.
 * @param int $newHeight The desired height of the scaled image.
 * @return bool Returns true on success, false on failure.
 */
function scaleImage($sourcePath, $destinationPath, $newWidth, $newHeight)
{
    // Check if the source file exists
    if (!file_exists($sourcePath)) {
        return false;
    }

    // Get image info
    $imageInfo = getimagesize($sourcePath);
    if (!$imageInfo) {
        return false;
    }

    list($originalWidth, $originalHeight, $imageType) = $imageInfo;

    // Create a new image resource from the source image
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $sourceImage = imagecreatefromjpeg($sourcePath);
            break;
        case IMAGETYPE_PNG:
            $sourceImage = imagecreatefrompng($sourcePath);
            break;
        case IMAGETYPE_GIF:
            $sourceImage = imagecreatefromgif($sourcePath);
            break;
        default:
            return false; // Unsupported image type
    }

    // Create a new blank image with the specified dimensions
    $scaledImage = imagecreatetruecolor($newWidth, $newHeight);

    // Preserve transparency for PNG and GIF
    if ($imageType == IMAGETYPE_PNG || $imageType == IMAGETYPE_GIF) {
        imagecolortransparent($scaledImage, imagecolorallocatealpha($scaledImage, 0, 0, 0, 127));
        imagealphablending($scaledImage, false);
        imagesavealpha($scaledImage, true);
    }

    // Resize the source image into the new scaled image
    imagecopyresampled(
        $scaledImage,
        $sourceImage,
        0,
        0,
        0,
        0,
        $newWidth,
        $newHeight,
        $originalWidth,
        $originalHeight
    );

    // Save the scaled image to the destination path
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $success = imagejpeg($scaledImage, $destinationPath);
            break;
        case IMAGETYPE_PNG:
            $success = imagepng($scaledImage, $destinationPath);
            break;
        case IMAGETYPE_GIF:
            $success = imagegif($scaledImage, $destinationPath);
            break;
        default:
            $success = false;
    }

    // Free up memory
    imagedestroy($sourceImage);
    imagedestroy($scaledImage);

    return $success;
}


?>
