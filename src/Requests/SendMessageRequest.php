<?php

namespace Socieboy\Chat\Requests;

use App\Http\Requests\Request;

class SendMessageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ($this->get('from_user_id') == auth()->user()->id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message'       => 'required',
            'from_user_id'  => 'required|exists:users,id',
            'to_user_id'    => 'required|exists:users,id'
        ];
    }
}
