<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\Image;

class UploadFileService
{
    private $targetDirectory;
    private ImageService $imageService;


    public function __construct($targetDirectory, ImageService $imageService)
    {
        $this->targetDirectory = $targetDirectory;
        $this->imageService = $imageService;
    }

    public function upload(?UploadedFile $file): ?Image
    {
        if ($file == null) {
            return null;
        }
        $fileName = uniqid() . '.' . $file->guessExtension();
        try {
            $file->move(
                $this->targetDirectory,
                $fileName
            );
        } catch (FileException $e) {
            return null;
        }
        $fileName = 'images/' . $fileName;
        $image = $this->getImage($fileName);
        return $image;
    }

    public function getImage(string $fileName): Image
    {
        $image = new Image();
        $image->setPath($fileName);
        $this->imageService->addImage($image);
        return $image;
    }
}
