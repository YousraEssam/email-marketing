<?php

namespace App\Http\Requests;

use App\Models\Group;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    // /**
    //  * Prepare the data for validation.
    //  */
    // protected function prepareForValidation(): void
    // {
    //     $this->merge([
    //         'body' => str_replace("&nbsp;", "", $this->body),
    //     ]);
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $groupsIds = Group::all()->pluck('id')->toArray();

        return [
            'subject' => 'required|min:1|max:255',
            'body' => 'required|min:1|max:2000',
            'group_id' => 'required|array', Rule::in($groupsIds)
        ];
    }
}
