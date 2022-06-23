<?php

namespace App\Transformer;

class ValidatorTransformer
{
    public function toArray($errors): array
    {
        $results = [];
        foreach ($errors as $error) {
            $results[$error->getPropertyPath()] = $error->getMessage();
        }

        return $results;
    }
}
