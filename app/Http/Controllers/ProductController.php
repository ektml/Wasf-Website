<?php
namespace App\Http\Controllers;
use App\Models\Like;
use App\Models\User;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where("freelancer_id" ,auth()->user()->id)->get();
        return view("freelancer.showproducts", compact("products"));
    }


    public function create()
    {
        $categories=Category::all();
        return view("freelancer.addproduct",compact("categories"));
    }


    public function store(Request $request)
    {

        $name= explode(".",$request->file("attachment")->getCLientOriginalName())[0];
        $size=number_format($request->file("attachment")->getSize()/ 1024,2);
        $type=$request->file("attachment")->getCLientOriginalExtension();
        $file_extention = $request->file("attachment")->getCLientOriginalExtension();
        $attachment_name=time(). ".".$file_extention;
        $request->file("attachment")->move(public_path('front/upload/files/'),$attachment_name);

        $file_extention=$request->file("img1")->getCLientOriginalExtension();
        $img1=time(). ".".$file_extention;
        $request->img1->move(public_path('assets/images/product/'),$img1);

        $file_extention=$request->file("img2")->getCLientOriginalExtension();
        $img2=time(). ".".$file_extention;
        $request->img2->move(public_path('assets/images/product/'),$img2);

        $file_extention=$request->file("img3")->getCLientOriginalExtension();
        $img3=time(). ".".$file_extention;
        $request->img3->move(public_path('assets/images/product/'),$img3);

        $product= Product::create([
            'name'=> $request->name,
            "freelancer_id" =>auth()->user()->id,
            'cat_id'=> $request->category_id,
            'service_id'=> $request->service_id,
            'price'=> $request->price,
            'description'=> $request->description,
            'attachment' =>  $attachment_name,
            'img1' => $img1,
            'img2' => $img2,
            'img3' => $img3,
        ]);


    foreach($request['group-a'] as $proprity){
        $product->proprity()->create([
            'key'=>$proprity['prop_key'],
            'value'=>$proprity['prop_value'],
        ]);
    }

    $product->file()->create([
        'name'=> $name,
        'user_id'=>auth()->user()->id,
        'type'=>$type,
        'url'=> $attachment_name,
        'size'=>$size,
    ]);
       


      
       toastr()->success("created susseccfully");

        return redirect()->route('freelanc.product.index'); 
    }


    public function show(Product $product)
    {
        //
    }


    public function edit(Product $product)
    {
        $categories=Category::all();
        return view('freelancer.editproduct',compact('product','categories'));
    }


    public function update(Request $request, Product $product)
    {
        //
    }


    public function destroy($id)
    {
        Product::where('freelancer_id',auth()->user()->id)->where('id',$id)->delete();
        toastr()->success('product deleted successfully');
        return redirect()->route('freelanc.product.index');
    }


    public function getCategoryServices($id)
    {
        if(APP::getLocale()=='ar'){
            $services = DB::table("services")->where("category_id" , $id)->pluck("service_ar" , "id");
        }else{
            $services = DB::table("services")->where("category_id" , $id)->pluck("service_en" , "id");
        }

        return json_encode($services);
    }


    public function displayAllProducts()
    {
           $filter=[];

        if(request()->cat_id && request()->subcat_id){
            $products = Product::where('cat_id',request()->cat_id)->where('service_id',request()
            ->subcat_id)->get();
            $categories = Category::all();

            if(request('productsearch')!=null){


            if(in_array('newest',request('productsearch'))){
                $products=$products->sortBy('created_at');
                array_push($filter,'newest');
            }
            if(in_array('highestrating',request('productsearch'))){
                $products=$products->sortByDesc(function($item){
                    return $item->likes()->count();
                });
                array_push($filter,'highestrating');
            }
            if(in_array('pricelowtoheight',request('productsearch'))){
                $products=$products->sortBy('price');
                array_push($filter,'pricelowtoheight');
            }

        }else{

           array_push($filter,'All');
        }
        $products=$products->paginate(20);
            return view('visitor.products', ['products'=>$products, 'categories'=>$categories,'cat_id'=>request()->cat_id,'subcat_id'=>request()->subcat_id,'filter'=>$filter]);

        }elseif(request()->cat_id ){
            $products = Product::where('cat_id',request()->cat_id)->get();
            $categories = Category::all();
            
            if(request('productsearch')!=null){


                if(in_array('newest',request('productsearch'))){
                    $products=$products->sortBy('created_at');
                    array_push($filter,'newest');
                }
                if(in_array('highestrating',request('productsearch'))){
                    $products=$products->sortByDesc(function($item){
                        return $item->likes()->count();
                    });
                    array_push($filter,'highestrating');
                }
                if(in_array('pricelowtoheight',request('productsearch'))){
                    $products=$products->sortBy('price');
                    array_push($filter,'pricelowtoheight');
                }
               
            }else{
                array_push($filter,'All');
            }

            $products=$products->paginate(20);
            return view('visitor.products', ['products'=>$products, 'categories'=>$categories,'cat_id'=>request()->cat_id,'filter'=>$filter]);

        }else{
            $products = Product::all();
            $categories = Category::all();
          
            if(request('productsearch')!=null){

                if(in_array('newest',request('productsearch'))){
                    $products=$products->sortBy('created_at');
                    array_push($filter,'newest');
                }
                if(in_array('highestrating',request('productsearch'))){
                    $products=$products->sortByDesc(function($item){
                        return $item->likes()->count();
                    });
                    array_push($filter,'highestrating');
                }
                if(in_array('pricelowtoheight',request('productsearch'))){
                    $products=$products->sortBy('price');
                    array_push($filter,'pricelowtoheight');
                }

            }else{
                array_push($filter,'All');
            }

            $products=$products->paginate(20);
            return view('visitor.products', compact('products', 'categories' ,'filter'));
        }
    }




    // user show product
    function usershowproduct($id)
    {
        $product= Product::findOrFail($id);
        $similar=Product::where(function($q) use($product){
            $q->where('cat_id',$product->cat_id)->orWhere("service_id",$product->serivce_id);
        })->limit(4)->get();
        return view('visitor.product',compact('similar','product'));
    }



    public function filter()
    {
        $categories = Category::all();
        $products = Product::get();
        $products = collect($products);

        if(isset($_GET['sort']) && !empty($_GET['sort'])){
            if($_GET['sort'] == 'product_newest'){
                $products = Product::orderBy('created_at', 'asc')->get();   // تنازلي من الكبير للصغير

            }elseif($_GET['sort'] == 'product_rate'){
                return Like::where('type', 'product')->orderby();
                // return Product::find(2)->likes()->count();

            }elseif($_GET['sort'] == 'product_price'){
                $products = Product::orderBy('price', 'desc')->get();       // تصاعدي من الصغير للكبير
            }
        }



        return view('visitor.filter', compact('categories', 'products'));
    }
}

