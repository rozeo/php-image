<?php


namespace Rozeo\Image\Types;


use Rozeo\Image\Image;

class TGA extends Image
{
    public function __construct(string $filepath)
    {
        parent::__construct(imagecreatefromtga($filepath));
    }

    public function getMetaData(): ?array
    {
        return null;
    }
}