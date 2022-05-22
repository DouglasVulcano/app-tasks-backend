<?php

namespace App\Http\Requests;

use App\Http\Requests\DefaultRequest;
use Illuminate\Validation\Rule;

class UserTasksRequest extends DefaultRequest
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
            'userId'  => [ 'required',  Rule::exists('users', 'id')->where('id', $this->user_id) ],
        ];
    }
}
