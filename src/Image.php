<?php


namespace Rozeo\Image;


use GdImage;

abstract class Image implements ImageInterface
{
    private GdImage $handle;

    private int $width;
    private int $height;

    private $released;

    protected function __construct(GdImage $handle)
    {
        $this->handle = $handle;
        $this->released = false;

        $this->updateSize();
    }

    public function free(): void
    {
        if (!$this->released) {
            imagedestroy($this->handle);
        }
        $this->released = true;
    }

    public function getHandle(): ?GdImage
    {
        return !$this->released
            ? $this->handle
            : null;
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
        if (!$this->released) {
            $this->handle = imagerotate($this->handle, $angle, $bgColor);
            $this->updateSize();
        }
        return $this;
    }

    public function resize(float $width, float $height): ImageInterface
    {
        if (!$this->released) {
            $this->handle = imagescale($this->handle, $width, $height);
            $this->updateSize();
        }
        return $this;
    }

    public function resizeWidth(float $width): ImageInterface
    {
        $scale = $width / $this->width;

        return !$this->released
            ? $this->resize($width, $this->height * $scale)
            : $this;
    }

    public function resizeHeight(float $height): ImageInterface
    {
        $scale = $height / $this->height;

        return !$this->released
            ? $this->resize($this->width * $scale, $height)
            : $this;
    }

    public function flip(): ImageInterface
    {
        if (!$this->released) {
            imageflip($this->handle, IMG_FLIP_BOTH);
        }
        return $this;
    }

    public function flipHorizontal(): ImageInterface
    {
        if (!$this->released) {
            imageflip($this->handle, IMG_FLIP_HORIZONTAL);
        }
        return $this;
    }

    public function flipVertical(): ImageInterface
    {
        if (!$this->released) {
            imageflip($this->handle, IMG_FLIP_VERTICAL);
        }
        return $this;
    }
}