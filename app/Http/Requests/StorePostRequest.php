<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:255',
            'slug' => 'required|unique:posts,slug',
            'body' => 'required',
            'visibility' => 'required|in:public,private',
            'cover_image' => 'image|file|max:1024',
            'generated_unsplash' => 'nullable|in:on,off',
            'category_id' => 'required|exists:categories,id',
        ];
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
            'title.min' => 'The post title must be at least 3 characters.',
            'title.max' => 'The post title cannot exceed 255 characters.',
            'slug.required' => 'The slug is required.',
            'slug.unique' => 'The slug has already been taken, please use a different one.',
            'body.required' => 'The post content is required.',
            'visibility.required' => 'The post visibility must be selected.',
            'visibility.in' => 'Post visibility can only be public or private.',
            'cover_image.image' => 'The file must be an image.',
            'cover_image.max' => 'The image size cannot exceed 1MB.',
            'category_id.required' => 'The category must be selected.',
            'category_id.exists' => 'The selected category is invalid.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'judul',
            'slug' => 'slug',
            'body' => 'konten',
            'visibility' => 'visibilitas',
            'cover_image' => 'gambar cover',
            'category_id' => 'kategori',
        ];
    }
}