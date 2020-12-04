<?php


namespace Rozeo\Image\Types;


use Rozeo\Image\Image;

class GIF extends Image
{
    public function __construct(string $filepath)
    {
        parent::__construct(imagecreatefromgif($filepath));
    }
}