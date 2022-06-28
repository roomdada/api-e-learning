<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'title' => 'required|string|max:255',
      'description' => 'required|string|max:255',
      'duration' => 'required|integer|max:255',
      'price' => 'required',
      'category_id' => 'required|integer',
      'point' => 'required|integer|max:2',
    ];
  }
}
