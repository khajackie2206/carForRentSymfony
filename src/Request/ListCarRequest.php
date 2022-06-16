<?php

namespace App\Request;
use Symfony\Component\Validator\Constraints as Assert;
class ListCarRequest
{
    #[Assert\Choice(['black', 'grey'])]
    #[Assert\NotBlank]
    private $color;

    #[Assert\Choice([4, 7, 9])]
    private $seat;

    #[Assert\Type('string')]
    #[Assert\NotBlank]
    private $name;

    #[Assert\NotBlank]
    #[Assert\Type(
        type: 'integer',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    private $price;
}
