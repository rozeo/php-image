<?php


namespace Rozeo\Image\Types;


use Rozeo\Image\Image;

class BMP extends Image
{
    public function __construct(string $filepath)
    {
        parent::__construct(imagecreatefrombmp($filepath));
        imagecreatefrom
    }
}