<?php


namespace Rozeo\Image;


use InvalidArgumentException;
use Rozeo\Image\Types\JPEG;
use Rozeo\Image\Types\PNG;

class ImageFactory
{
    public function __construct()
    {
    }

    /**
     * @param string $filepath
     * @return ImageInterface
     * @throws InvalidArgumentException
     */
    public function make(string $filepath): ImageInterface
    {
        if (!file_exists($filepath)) {
            throw new \InvalidArgumentException("File not found.");
        }

        $mime = mime_content_type($filepath);

        return match ($mime) {
            "image/jpeg" => new JPEG($filepath),
            "image/png" => new PNG($filepath),
            default => throw new InvalidArgumentException("Invalid file type"),
        };
    }
}