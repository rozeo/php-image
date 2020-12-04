<?php


namespace Rozeo\Image;


interface PrinterInterface
{
    public function output(string $name, int $type, ImageInterface $image): bool;
}