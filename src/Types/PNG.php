<?php


namespace Rozeo\Image\Types;


use Rozeo\Image\Image;

class PNG extends Image
{
    public function __construct(string $filepath)
    {
        parent::__construct(imagecreatefrompng($filepath));
    }

    public function getMetaData(): ?array
    {
        return null;
    }
}