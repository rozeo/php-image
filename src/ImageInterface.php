<?php


namespace Rozeo\Image;


use GdImage;

interface ImageInterface
{
    const ROTATION_TYPE_RAD = 1;
    const ROTATION_TYPE_DEG = 2;

    public function getHandle(): GdImage;

    public function getWidth(): int;

    public function getHeight(): int;

    public function rotate(float $angle, int $bgColor = 0): self;

    public function resize(float $width, float $height): self;

    public function resizeWidth(float $width): self;

    public function resizeHeight(float $height): self;
}