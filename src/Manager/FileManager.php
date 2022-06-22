<?php

namespace App\Manager;

use Aws\S3\S3Client;
use Aws\Result;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class FileManager
{
    private $targetDirectory;
    private $bucketName;
    private S3Client $s3Client;
    private $slugger;
    private ContainerBagInterface $params;

    public function __construct($targetDirectory, $bucketName, S3Client $s3Client, SluggerInterface $slugger, ContainerBagInterface $params)
    {
        $this->targetDirectory = $targetDirectory;
        $this->bucketName = $bucketName;
        $this->s3Client = $s3Client;
        $this->slugger = $slugger;
        $this->params = $params;
    }

    public function upload(UploadedFile $file)
    {
        $imageName = $this->getImageName($file);
        $file->move($this->targetDirectory, $imageName);
        $imagePath = $this->targetDirectory . $imageName;
        $imageUpload = $this->uploadS3($imageName, $imagePath);
        unlink($imagePath);
        $s3Path = $imageUpload->get('ObjectURL');

        return $this->getRelativelyPath($s3Path);
    }

    private function getImageName(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);

        return $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();
    }

    private function getRelativelyPath(string $fullPath): string
    {
        $s3Path = $this->params->get('s3url');

        return substr($fullPath, strlen($s3Path));
    }

    private function uploadS3(string $imageName, string $imagePath): Result
    {
        return $this->s3Client->putObject(
            [
                'Bucket' => $this->bucketName,
                'Key' => 'car/' . $imageName,
                'SourceFile' => $imagePath,
            ]
        );
    }
}
