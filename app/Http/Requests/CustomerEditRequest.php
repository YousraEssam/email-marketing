<?php

namespace App\Http\Requests;

use App\Enums\GenderType;
use App\Models\Group;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CustomerEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $groupsIds = Group::all()->pluck('id')->toArray();

        return [
            'first_name' => 'required|min:1|max:20',
            'last_name'  => 'required|min:1|max:20',
            'email'  => 'required|email|unique:customers,email,'.$this->customer->id,
            'gender' => 'nullable', new Enum(GenderType::class),
            'birth_date' => 'nullable|date_format:Y-m-d',
            'group_id' => 'required|array', Rule::in($groupsIds)
        ];
    }
}
