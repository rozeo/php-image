<?php


namespace Rozeo\Image;


use GdImage;

abstract class Image implements ImageInterface
{
    private GdImage $handle;

    private int $width;
    private int $height;

    protected function __construct(GdImage $handle)
    {
        $this->handle = $handle;

        $this->updateSize();
    }

    public function getHandle(): GdImage
    {
        return $this->handle;
    }

    private function updateSize(): void
    {
        $this->width = imagesx($this->handle);
        $this->height = imagesy($this->handle);
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function rotate(float $angle, int $bgColor = 0): ImageInterface
    {
        $this->handle = imagerotate($this->handle, $angle, $bgColor);
        $this->updateSize();

        return $this;
    }

    public function resize(float $width, float $height): ImageInterface
    {
        $this->handle = imagescale($this->handle, $width, $height);
        $this->updateSize();

        return $this;
    }

    public function resizeWidth(float $width): ImageInterface
    {
        $scale = $width / $this->width;

        return $this->resize($width, $this->height * $scale);
    }

    public function resizeHeight(float $height): ImageInterface
    {
        $scale = $height / $this->height;

        return $this->resize($this->width * $scale, $height);
    }

    public function flip(): ImageInterface
    {
        imageflip($this->handle, IMG_FLIP_BOTH);
        return $this;
    }

    public function flipHorizontal(): ImageInterface
    {
        imageflip($this->handle, IMG_FLIP_HORIZONTAL);
        return $this;
    }

    public function flipVertical(): ImageInterface
    {
        imageflip($this->handle, IMG_FLIP_VERTICAL);
        return $this;
    }
}