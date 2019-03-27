<?php

namespace App\Http\Forms;

use App\Comment;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\ThrottleException;
use Illuminate\Foundation\Http\FormRequest;

class CreatePostForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('create', new Comment);
    }

    protected function failedAuthorization()
    {
        throw new ThrottleException('You are commenting too frequently');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => 'required|spamfree'
        ];
    }

    public function persist($post)
    {
        return $post->addComment([
            'body' => request('body'),
            'user_id' => auth()->id()
        ])->load('owner');
    }
}
