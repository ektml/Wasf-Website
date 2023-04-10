<?php
namespace App\Http\Controllers\Api;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Api\ApiResponseTrait;

class ProductController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        try{
            $products = Product::with(['freelancer', 'category', 'service', 'likes'])->get();
            foreach($products as $product){
                $product['img1'] = asset('assets/images/product/'.$product->img1);
                $product['img2'] = asset('assets/images/product/'.$product->img2);
                $product['img3'] = asset('assets/images/product/'.$product->img3);
                
            if(!stripos($product->freelancer->profile_image, "Admin3/assets/images/users/")){
                    $product->freelancer->profile_image = asset('Admin3/assets/images/users/'.$product->freelancer->profile_image);
              }
                $product['likesCount'] = $product->likes()->count();
            }

            return $this->returnData(201, 'Products Returned Successfully', $products);
        }catch(\Exception $e){
            echo $e;
            return $this->returnData(201, 'Products Returned Successfully', $products);
        }
    }
    
    
    


    public function createProduct(Request $request)
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
                'img2' => 'required',
                'img3' => 'required',
            ]);

            $file_extension = $request->file("attachment")->getCLientOriginalExtension();
            $file_name = time(). "." .$file_extension;
            $request->file("attachment")->move(public_path('front/upload/files/'), $file_name);

            $file_extension = $request->file("img1")->getCLientOriginalExtension();
            $img1 = time(). "." .$file_extension;
            $request->file("img1")->move(public_path('assets/images/product/'), $img1);

            $file_extension = $request->file("img2")->getCLientOriginalExtension();
            $img2 = time(). "." .$file_extension;
            $request->file("img2")->move(public_path('assets/images/product/'), $img2);

            $file_extension = $request->file("img3")->getCLientOriginalExtension();
            $img3 = time(). "." .$file_extension;
            $request->file("img3")->move(public_path('assets/images/product/'), $img3);

            if(Auth::user()->type == 'freelancer'){
                $product= Product::create([
                'freelancer_id' => Auth::user()->id,
                'cat_id'=> $request->cat_id,
                'service_id'=> $request->service_id,
                'name'=> $request->name,
                'price'=> $request->price,
                'description'=> $request->description,
                'attachment' => $file_name,
                'img1' => $img1,
                'img2' => $img2,
                'img3' => $img3,
            ]);
                $product['attachment'] = asset('front/upload/files/'.$file_name);
                $product['img1'] = asset('assets/images/product/'.$img1);
                $product['img2'] = asset('assets/images/product/'.$img2);
                $product['img3'] = asset('assets/images/product/'.$img3);
                return $this->returnData(201, 'Product Created Successfully', $product);
            }else{
                return $this->returnError(400, "U Can't Add Product as U aren't A Freelancer");
            }
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Product Created Failed');
        }
    }






    public function getProduct(Request $request, $id)
    {
        try{
            $product = Product::with(['freelancer', 'category', 'service', 'likes'])->find($id);
            if(!$product){
                return $this->returnError('404', 'Product Not Found');
            }
            $product['attachment'] = asset('front/upload/files/'.$product->attachment);
            $product['img1'] = asset('assets/images/product/'.$product->img1);
                if($product['img2']){
                    $product['img2'] = asset('assets/images/product/'.$product->img2);
                }
                if($product['img3']){
                    $product['img3'] = asset('assets/images/product/'.$product->img3);
                }
                if(!stripos($product->freelancer->profile_image, "Admin3/assets/images/users/")){
                    $product->freelancer->profile_image = asset('Admin3/assets/images/users/'.$product->freelancer->profile_image);
              }
            return $this->returnData(200, 'Product Returned Successfully', $product);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Product Returned Failed');
        }
    }
    
    
    



    public function editProduct(Request $request, $id)
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

            $product = Product::find($id);
            if(!$product){
                return $this->returnError('404', 'Product Not Found');
            }

            $product->update([
                'cat_id' => $request->cat_id,
                'service_id' => $request->service_id,
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'attachment' => $request->attachment,
                'img1' => $request->img1,
                'img2' => $request->img2,
                'img3' => $request->img3,
            ]);
                $product['attachment'] = asset('front/upload/files/'.$request->attachment);
                $product['img1'] = asset('assets/images/product/'.$request->img1);
                if($request->has('img2')){
                    $product['img2'] = asset('assets/images/product/'.$request->img2);
                }
                if($request->has('img2')){
                    $product['img3'] = asset('assets/images/product/'.$request->img3);
                }
                return $this->returnData(200, 'Product Updated Successfully', $product);
        }catch(\Exception $e){
            echo $e;
            return $this->returnError('404', 'Product Not Found');
        }
    }


    public function destroy($id)
    {
        try {
            $product = Product::find($id)->delete();
        if(!$product){
            return $this->returnError('404', 'Product Not Found');
        }
            return $this->returnSuccess(200, 'Product Deleted Successfully');
        }catch(\Exception $e){
            echo $e;
            return $this->returnError('404', 'Product Not Found');
        }
    }






    public function addOrRemoveProductLikes(Request $request, $id)
    {
        try{
            $flag = false;
            $action = "append";
            $product = Product::findOrFail($id);

        if($product->likes->where("user_id", auth()->user()->id)->count() == 0){
            $product->likes()->create([
                "user_id" => auth()->user()->id,
                "type" => "product",
            ]);
            $action = "add";
        }else{
            $product->likes()->where("user_id", auth()->user()->id)->delete();
            $action = "delete";
            return $this->returnSuccess(200, 'Remove Like Successfully');
            }
        $flag = true;
            return $this->returnSuccess(200, 'Add Like Successfully');
        }catch(\Exception $e){
            echo $e;
            return $this->returnSuccess(400, 'There is an error');
        }
    }
    
    
    
    
    
    
    public function addProductToCart($id)
    {
        try{
            if(!Cart::where('user_id', auth()->user()->id)->where('cartsable_id', $id)->exists())
            {
                $product = Product::findorfail($id);
                $img = '';
                foreach(array($product->img1, $product->img2, $product->img3) as $image)
                {
                    if($image != null){
                        $img = $image;
                        break;
                    }
                }
            $product->carts()->create([
                'name' => $product->name,
                'user_id' => auth()->user()->id,
                'price' => $product->price,
                'image' => $img,
                'type' => "product",
            ]);
            return $this->returnData(200, 'Product Add to Cart Successfully', $product);
            }else{
                return $this->returnData(201, 'Product Already On Cart');
            }
        }catch(\Exception $e){
            echo $e;
            return $this->returnError('404', 'There is an error');
        }
    }
    
    
    
    
    
    public function removeProductFromCart($id)
    {
        try{
            if(Product::find($id)){
                cart::where('cartsable_id', $id)->delete();
                return $this->returnData(200, 'Product Deleted From Cart Successfully');
            }else{
            return $this->returnError(400, "Product Doesn't Exists");
            }
        }catch(\Exception $e){
            echo $e;
            return $this->returnError(400, 'Fail Delete From Cart');
        }
    }
}
