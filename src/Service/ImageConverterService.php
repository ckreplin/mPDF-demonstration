<?php

namespace App\Service;

class ImageConverterService
{
    /**
     * @param string $imagePath
     * @return string
     */
    public function convertToBase64(string $imagePath): string
    {
        $type = pathinfo($imagePath, PATHINFO_EXTENSION);
        $raw = file_get_contents($imagePath);

        $base64Image = sprintf(
            "data:image/%s;base64,%s",
            $type,
            base64_encode($raw)
        );

        return sprintf('<img src="%s" alt="demo-image" />', $base64Image);
    }
}