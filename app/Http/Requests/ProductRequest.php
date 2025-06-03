<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * تحديد ما إذا كان المستخدم مخولًا لتنفيذ هذا الطلب.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // تأكد من الإرجاع true للسماح بتنفيذ الطلب
    }

    /**
     * قواعد التحقق لطلب المنتج.
     *
     * @return array
     */
    public function rules()
    {
        return [      'name_ar' => 'required|string|max:255',
        'name_en' => 'required|string|max:255',
        'description_ar' => 'required',
        'description_en' => 'required',
        'price' => 'required|numeric|min:0',
        'discount' => 'nullable|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'attributes' => 'nullable|array',
        'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',];
        // $rules = [
        //     'name_ar' => 'required|string|max:255',
        //     'name_en' => 'required|string|max:255',
        //     'description_ar' => 'required',
        //     'description_en' => 'required',
        //     'price' => 'required|numeric|min:0',
        //     'discount' => 'nullable|numeric|min:0',
        //     'category_id' => 'required|exists:categories,id',
        //     'attributes' => 'nullable|array',
        //     'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        // ];

        // // if ($this->isMethod('post')) {
        // //     // قواعد إضافية عند الإنشاء
        // //     $rules['main_image'] = 'required|image|mimes:jpeg,png,jpg|max:2048';
        // // } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
        // //     // قواعد إضافية عند التحديث
        // //     $rules['main_image'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
        // // }

        // return $rules;
    }
}
