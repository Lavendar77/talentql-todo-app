<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;

class MyValidationException extends Exception
{
    public ValidationException $validationException;

    public function __construct(ValidationException $validationException)
    {
        $this->validationException = $validationException;
    }

    public function render()
    {
        return response()->json([
            'status' => false,
            'message' => $this->validationException->getMessage(),
            'data' => [
                'errors' => $this->validationException->validator->errors()
            ]
        ], $this->validationException->status);
    }
}
