<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class DefaultRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        if (in_array('auth:sanctum', Route::current()->gatherMiddleware())) {
            $input = $this->all();
            $input['user_id'] = Auth()->id();
            $this->replace($input);
        }
    }
}
