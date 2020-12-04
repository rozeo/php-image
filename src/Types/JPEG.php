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
            2 => $this->flipHorizontal(),
            3 => $this->flip(),
            4 => $this->flipVertical(),
            5 => $this->rotate(-90)->flipHorizontal(),
            6 => $this->rotate(-90),
            7 => $this->rotate(90)->flipHorizontal(),
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