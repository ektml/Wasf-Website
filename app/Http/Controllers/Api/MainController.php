<?php
namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Models\Photo;
use App\Models\AboutUs;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\FreelancerService;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiResponseTrait;

class MainController extends Controller
{
    use ApiResponseTrait;
    
    public function getServicesOfCategories($cat_id=[])
    {
        try{
            $services = [];
            $cate_id = json_decode($cat_id);
            
            foreach ($cate_id as $id)
            {
                foreach(Service::where('category_id',$id)->get() as $serv)
                {
                   array_push($services,$serv);
                }
            }

            return $this->returnData(201, 'Categories Returned Successfully', $services);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'There Is No AboutUs Info');
        }
    }
    
    
    public function addServiceToFreelancer($cat_id,$serv_id){
        try{
         
            return $this->returnData(201, 'Categories Returned Successfully');
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'There Is No AboutUs Info');
        }
    }
    

    public function aboutUs()
    {
        try{
            $aboutUs = AboutUs::all();
            return $this->returnData(201, 'AboutUs Info Returned Successfully', $aboutUs);
        }catch(\Exception $e){
            return $this->returnError(400, 'There Is No AboutUs Info');
        }
    }





    public function contactUs()
    {
        try{
            $contactUs = ContactUs::all();
            return $this->returnData(201, 'ContactUs Info Returned Successfully', $contactUs);
        }catch(\Exception $e){
            return $this->returnError(400, 'There Is No ContactUs Info');
        }
    }





    public function getAllCategories()
    {
        try{
            $categories = Category::all();
        if(!$categories)
            return $this->returnError('404', 'Categories Not Found');
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Categories Returned Failed');
        }
        return $this->returnData(201, 'Categories Returned Successfully', $categories);
    }



    
    
    
    
    
    public function ProductsOfCategory(Request $request, $cat_id, $serv_id = null)
    {
        try{
            $category = Category::find($cat_id);
            $service = Service::find($serv_id);
            
            if(!$category){
                return $this->returnError('400', "Category Doesn't Exists");
            }elseif($category && !$service){
                $products = Product::where('cat_id', $cat_id)->with(['freelancer', 'category', 'service'])->get();
                $services= $category->services()->select('id', 'service_en','category_id')->get();
                
                foreach($products as $product){
                    $product['img1'] = asset('assets/images/product/'.$product->img1);
                    $product['img2'] = asset('assets/images/product/'.$product->img2);
                    $product['img3'] = asset('assets/images/product/'.$product->img3);
                    $product->freelancer->profile_image = asset('Admin3/assets/images/users/'.$product->freelancer->profile_image);
                    $product['likes'] = $product->likes()->count();
                }
                return $this->returnData(200, 'Products Returned Successfully', compact('services','products'));
                
            }elseif($category && $service){
                $products = Product::where('cat_id', $cat_id)->where('service_id', $serv_id)->with(['freelancer', 'category', 'service'])->get();
                foreach($products as $product){
                    $product['img1'] = asset('assets/images/product/'.$product->img1);
                    $product['img2'] = asset('assets/images/product/'.$product->img2);
                    $product['img3'] = asset('assets/images/product/'.$product->img3);
                    $product->freelancer->profile_image = asset('Admin3/assets/images/users/'.$product->freelancer->profile_image);
                    $product['likes'] = $product->likes()->count();
                }
                return $this->returnData(200, 'Products Returned Successfully', compact('products'));
            }
        }catch(\Exception $e){
            echo $e;
            return $this->returnData(201, 'Products Returned Successfully', $products);
        }
    }






    public function FreelancersOfCategory(Request $request, $cat_id, $serv_id = null)
    {
        try{
            $category = Category::find($cat_id);
            $freelancer_detail = [];
            if($serv_id == null){
            if($category->services()->exists()){
                $services= $category->services()->select('id', 'service_en','category_id')->get();
                $service_id = $category->services->first()->id;
                $freelancers = FreelancerService::select('freelancer_id')->where('parent_id', $cat_id)
                ->where('service_id', $service_id)->get();
                foreach($freelancers as $freelancer){
                    $name = User::find($freelancer)->first();
                    $name['profile_image'] = asset('Admin3/assets/images/users/'.$name->profile_image);
                    array_push($freelancer_detail,$name);
                }
                return $this->returnData(200, 'Freelancers Returned Successfully',compact('services','freelancer_detail') );
            }else{
                $freelancers = FreelancerService::select('freelancer_id')->where('parent_id', null)
                ->where('service_id', $cat_id)->get();

                foreach($freelancers as $freelancer){
                    $data = User::find($freelancer)->first();
                    array_push($freelancer_detail, $data);
                }
                return $this->returnData(200, 'Freelancers Returned Successfully',compact( 'freelancer_detail'));
            }
            }else{
                $freelancer_detail=[];
                $freelancers =  FreelancerService::where('parent_id', $cat_id)->where('service_id', $serv_id)->get();
                foreach($freelancers as $freelancer){
                    $data = User::find($freelancer->freelancer_id);
                    $data['profile_image'] = asset('Admin3/assets/images/users/'.$data->profile_image);
                    array_push($freelancer_detail, $data);
                }
                return $this->returnData(200, 'Freelancers Returned Successfully',compact('freelancer_detail') );
            }
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Freelancers Returned Failed');
        }
    }






    public function store(Request $request)
    {
        try {
            $request->validate([
                'cat_id' => 'required',
                'service_id' => 'required',
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
                'attachment' => 'required',
                'img1' => 'required',
                'img2' => 'nullable',
                'img3' => 'nullable',
            ]);

            if(Auth::user()->type == 'freelancer'){
                $product= Product::create([
                'freelancer_id' => Auth::user()->id,
                'cat_id'=> $request->cat_id,
                'service_id'=> $request->service_id,
                'name'=> $request->name,
                'price'=> $request->price,
                'description'=> $request->description,
                'attachment' => $request->attachment,
                'img1' => $request->img1,
                'img2' => $request->img2,
                'img3' => $request->img3,
            ]);
                return $this->returnData(201, 'Product Created Successfully', $product);
            }else{
                $product['attachment'] = asset('front/upload/files/'.$request->attachment);
                $product['img1'] = asset('assets/images/product/'.$request->img1);
                if($request->has('img2')){
                    $product['img2'] = asset('assets/images/product/'.$request->img2);
                }
                if($request->has('img3')){
                    $product['img3'] = asset('assets/images/product/'.$request->img3);
                }
                return $this->returnError(400, "U Can't Add Product as U aren't A Freelancer");
            }
        }catch(\Exception $e){
            echo $e;
        }
    }



    public function getAllServices()
    {
        try{
            $services = Service::all();
        if(!$services)
            return $this->returnError('404', 'Services Not Found');
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Services Returned Failed');
        }
        return $this->returnData(200, 'Services Returned Successfully', $services);
    }
    
    
    
    
    
    public function allProductsInCart()
    {
        try{
            $cart_items = Cart::with('cartsable')->get();
            $total = Cart::select('price')->get();
            
            foreach($cart_items as $item){
                $item->cartsable['attachment'] = asset('assets/images/product/'.$item->cartsable['attachment']);
                $item->cartsable['img1'] = asset('assets/images/product/'.$item->cartsable['img1']);
                $item->cartsable['img2'] = asset('assets/images/product/'.$item->cartsable['img2']);
                $item->cartsable['img3'] = asset('assets/images/product/'.$item->cartsable['img3']);
            }
            return $this->returnData(200, 'Carts Returned Successfully', compact('cart_items', 'total'));
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, "Carts Don't Found");
        }
    }
    
    
    
}
