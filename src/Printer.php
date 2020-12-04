<?php


namespace Rozeo\Image;


class Printer implements PrinterInterface
{
    const TYPE_JPEG = 1;
    const TYPE_PNG  = 2;

    /**
     * @var string
     */
    private string $outputDirectory;

    public function __construct(string $outputDirectory)
    {
        $this->outputDirectory = rtrim($outputDirectory, DIRECTORY_SEPARATOR);

        if (!file_exists($this->outputDirectory)) {
            mkdir($this->outputDirectory, 0755, true);
        }
    }

    private function makeOutputPath(string $name, string $postfix): string
    {
        return implode(DIRECTORY_SEPARATOR, [
            $this->outputDirectory,
            $name
        ]) . $postfix;
    }

    public function output(string $name, int $type, ImageInterface $image): bool
    {
        return match ($type) {
            self::TYPE_JPEG => $this->outputJPEG($name, $image),
            self::TYPE_PNG  => $this->outputPNG($name, $image),
            default => false,
        };
    }

    public function outputJPEG(string $name, ImageInterface $image, int $quality = 90): bool
    {
        $path = $this->makeOutputPath($name, '.jpg');
        return imagejpeg($image->getHandle(), $path, $quality);
    }

    public function outputPNG(string $name, ImageInterface $image, int $quality = 90, $filters = null): bool
    {
        $path = $this->makeOutputPath($name, '.png');
        return imagepng($image->getHandle(), $path, $quality, $filters);
    }
}