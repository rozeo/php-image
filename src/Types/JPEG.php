<?php


namespace Rozeo\Image\Types;


use Rozeo\Image\Image;

class JPEG extends Image
{
    private string $filepath;

    public function __construct(string $filepath)
    {
        $this->filepath = $filepath;
        parent::__construct(imagecreatefromjpeg($filepath));
    }
    
    public function getMetaData(): ?array
    {
        return ($meta = exif_read_data($this->filepath)) !== false
            ? $meta
            : null;
    }
}