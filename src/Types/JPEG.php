<?php


namespace Rozeo\Image\Types;


use Rozeo\Image\Image;

class JPEG extends Image
{
    public function __construct(string $filepath)
    {
        parent::__construct(imagecreatefromjpeg($filepath));
    }
}