<?php
namespace App\Http\Controllers\admin;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $categories = Category::all();
        return view('Admin.services.index', compact('services', 'categories'));
    }


    public function store(Request $request)
    {
        $services = $request->validate([
            'service_ar' => 'required|unique:services',
            'service_en' => 'required|unique:services',
            'service_icon' => 'required',
            'category_id' => 'required|',
        ],[
            'service_ar.required' =>'يرجي ادخال اسم الخدمة العربي',
            'service_en.required' =>'يرجي ادخال اسم الخدمة الانجليزي',
            'service_ar.unique' =>'اسم الخدمة العربي مسجل مسبقا',
            'service_en.unique' =>'اسم الخدمة الانجليزي مسجل مسبقا',
            'service_icon.required' => 'يرجى ادخال رمز الخدمة',
            'category_id.required' => 'يرجى اختيار اسم القسم التابع للخدمة',
        ]);

        $data = $request->only('service_en', 'service_ar', 'service_icon', 'category_id');
        Service::create($data);

        session()->flash('Add', 'تم اضافة الخدمة بنجاح ');
        return back();
    }


    public function update(Request $request, $id)
    {
        // $services = $request->validate([
        //     'service_ar' => 'required|unique:services',
        //     'service_en' => 'required|unique:services',
        //     'service_icon' => 'required',
        //     'category_id' => 'required',
        // ],[
        //     'service_ar.required' =>'يرجي ادخال اسم الخدمة العربي',
        //     'service_en.required' =>'يرجي ادخال اسم الخدمة الانجليزي',
        //     'service_ar.unique' =>'اسم الخدمة العربي مسجل مسبقا',
        //     'service_en.unique' =>'اسم الخدمة الانجليزي مسجل مسبقا',
        //     'service_icon.required' => 'يرجى ادخال رمز الخدمة',
        //     'category_id.required' => 'يرجى اختيار اسم القسم التابع للخدمة',
        // ]);

        $data = $request->only('service_en', 'service_ar', 'service_icon', 'category_id');
        Service::find($id)->update($data);

        session()->flash('Edit', 'تم تعديل الخدمة بنجاح ');
        return back();
    }


    public function destroy(Request $request, $id)
    {
        Service::find($id)->delete();
        session()->flash('Delete' , 'تم حذف الخدمة بنجاج');
        return back();
    }
}
