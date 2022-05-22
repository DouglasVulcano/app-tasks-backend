<?php

namespace App\Http\Requests;

use App\Http\Requests\DefaultRequest;
use Illuminate\Validation\Rule;

class ShowTaskRequest extends DefaultRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required', Rule::exists('tasks', 'id')->where('user_id', $this->user_id) ]
        ];
    }
}
