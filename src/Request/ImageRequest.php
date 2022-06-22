<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class ImageRequest
{
    #[Assert\Image(
        maxSize: '4M',
        mimeTypes: ['image/*'],
        mimeTypesMessage: 'Image invalid!!!',
    )]
    private $image;

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): self
    {
        $this->image = $image;
        return $this;
    }
}
