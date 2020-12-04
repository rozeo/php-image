<?php


namespace Rozeo\Image\Types;


use Rozeo\Image\Image;

class WEBP extends Image
{
    public function __construct(string $filepath)
    {
        parent::__construct(imagecreatefromwebp($filepath));
    }

    public function getMetaData(): ?array
    {
        return null;
    }
}