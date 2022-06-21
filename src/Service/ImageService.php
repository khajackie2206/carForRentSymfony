<?php

namespace App\Service;

use App\Entity\Image;
use App\Manager\FileManager;
use App\Repository\ImageRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageService
{
    private FileManager $fileManager;
    private ImageRepository $imageRepository;

    public function __construct(FileManager $fileManager, ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
        $this->fileManager = $fileManager;
    }

    public function addImage(Image $image): void
    {
        $this->imageRepository->save($image);
    }

    public function upload(UploadedFile $file): Image
    {
        $image = new Image();
        $imagePath = $this->fileManager->upload($file);
        $image->setPath($imagePath);
        $this->imageRepository->save($image);

        return $image;
    }
}
