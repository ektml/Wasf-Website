<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\FreelancerService;

class FreelancerServiceController extends Controller
{
    
 public function addservice(Request $request){
  
    $categoryIds = $request->input('category');
    $serviceIds = $request->input('service');
 

    FreelancerService::where('freelancer_id',auth()->user()->id)->delete();
    foreach ($categoryIds as $categoryId) {
        $category = Category::findorfail($categoryId);
        
        if ($category && in_array($categoryId,array_keys($serviceIds) ) ) {

            $selectedServiceIds = $serviceIds[$categoryId] ?? [];
          
            foreach ( $selectedServiceIds as $service) {

                // $service->selected = in_array($service->id, $selectedServiceIds);
                
            FreelancerService::create([
                'freelancer_id'=>auth()->user()->id,
                'parent_id'=>$categoryId,
                'service_id'=>$service,

            ]);
            }

        }
        else{
            FreelancerService::create([
                'freelancer_id'=>auth()->user()->id,
                'parent_id'=>null,
                'service_id'=>$categoryId,

            ]);
        }

    }
    
  return  redirect()->back()->with(['message'=>"service update successfully"]);
 }

 public function processForm(Request $request)
{
    $categoryIds = $request->input('category');
    $serviceIds = $request->input('service');
    
    foreach ($categoryIds as $categoryId) {
        $category = App\Models\Category::find($categoryId);
        
        if ($category) {
            $selectedServiceIds = $serviceIds[$categoryId] ?? [];
            
            foreach ($category->services as $service) {
                $service->selected = in_array($service->id, $selectedServiceIds);
                $service->save();
            }
        }
    }
    
    // Redirect back to the form
    return redirect()->back();
}


}
