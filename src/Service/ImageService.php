<?php

namespace App\Service;

use App\Entity\Image;
use App\Repository\ImageRepository;

class ImageService
{
    private ImageRepository $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function addImage(Image $image)
    {
        $this->imageRepository->save($image);
    }
}
