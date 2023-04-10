<?php
namespace App\Http\Requests;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            "name"=>['required'],
            "category"=>['required'],
            "service"=>['nullable'],
            "name"=>['required'],
            "price"=>['required', "numeric"],
            "description"=>['required'],
             "attachment"=>['required', "max:200", "file"],
            "img1"=>['required', 'image'],
            "img2"=>['nullable', 'image'],
            "img3"=>['nullable', 'image'],
            // "group-a"=>['required','min:1']
        ];
    }
}
