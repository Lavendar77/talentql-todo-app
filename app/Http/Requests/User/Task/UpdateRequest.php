<?php

namespace App\Http\Requests\User\Task;

use App\Enums\TaskStatus;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->id === $this->task->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'status' => [
                'sometimes',
                new EnumValue(TaskStatus::class)
            ],
        ];
    }
}
