<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('post'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $post = $this->route('post');

        return [
            'title' => 'required|max:255',
            'slug' => [
                'required',
                Rule::unique('posts', 'slug')->ignore($post->id),
            ],
            'body' => 'required',
            'visibility' => 'required|in:public,private',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|file|max:1024',
            'remove_image' => 'nullable|in:0,1',
        ];
    }

    /**
     * Get the validated data from the request.
     * Remove non-database fields from the validated data.
     *
     * @return array
     */
    public function validatedForDatabase(): array
    {
        $validated = $this->validated();

        // Remove fields that are not in database
        unset($validated['remove_image']);

        return $validated;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The post title is required.',
            'title.max' => 'The post title cannot exceed 255 characters.',
            'slug.required' => 'The slug is required.',
            'slug.unique' => 'The slug has already been taken; please use a different one.',
            'body.required' => 'The post content is required.',
            'visibility.required' => 'The post visibility must be selected.',
            'visibility.in' => 'Post visibility can only be public or private.',
            'cover_image.image' => 'The file must be an image.',
            'cover_image.max' => 'The image size cannot exceed 1MB.',
            'category_id.required' => 'The category must be selected.',
            'category_id.exists' => 'The selected category is invalid.',
        ];
    }
}