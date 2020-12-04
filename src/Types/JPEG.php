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

        $this->applyExifRotation();
    }

    protected function applyExifRotation()
    {
        $exif = $this->getExif();

        if (!array_key_exists('Orientation', $exif)) {
            return;
        }

        $orientation = \intval($exif['Orientation']);

        match ($orientation) {
            6 => $this->rotate(-90),
            8 => $this->rotate(90),
        };
    }
    
    public function getExif(): array
    {
        return ($meta = exif_read_data($this->filepath)) !== false
            ? $meta
            : [];
    }
}