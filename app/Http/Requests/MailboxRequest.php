<?php

namespace App\Http\Requests;

class MailboxRequest extends Request
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
        $rules = [
            'domain_id' => 'required',
        ];

        if ($this->segment(2) != 'create') {
            $rules['email'] = 'required|email|unique:mailboxes,email,' . $this->segment(2);
        } else {
            $rules['email'] = 'required|email|unique:mailboxes';
        }

        return $rules;
    }
}
