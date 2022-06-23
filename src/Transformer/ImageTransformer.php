<?php

namespace App\Transformer;

use App\Entity\Image;

class ImageTransformer
{
    public function toArray(Image $image): array
    {
        return [
            'id' => $image->getId(),
            'path' => $image->getPath()
        ];
    }
}
