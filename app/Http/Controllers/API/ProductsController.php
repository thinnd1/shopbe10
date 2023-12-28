<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\CategoryController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;

class ProductsController extends Controller
{

    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index(Request $request)
    {
      $product = $this->product->getAllProduct();
      return response()->json($product);
    }

    public function imageProductIndex(Request $request)
    {
      $product_images = DB::table('products')
      ->join('product_images', 'products.id', '=', 'product_images.product_id')
      ->select('products.*', 'product_images.image_uri')
      ->where('products.id',$request->id)
      ->pluck('image_uri')
      ->all();
        if($product_images){
          return response()->json($product_images);
        }else{
          return response()->json(['product not found !!']);
        }
    }

    public function show($id)
    {
      $product = $this->product->getProductId($id);
      return response()->json($product);
    }

    public function ProductCategorieFilter(){

    }

    public function ProductArticleImages(){
      $ProductArticleimg = DB::table('products')
       ->join('product_images','products.id','=','product_images.product_id')
       ->get();
      return response()->json($ProductArticleimg);
    }

    #Create product admin
    public function create(Request $request)
    {

      // $validator = $request->validate([
      //   'name' => 'required|max:255|min:5|unique:products',
      //   'price_unit' => 'required|numeric',
      //   'image' => 'required',
      //   'quantity' => 'required|integer|min:1',
      //   'product_description' => 'min:10'
      // ]);

      
        // $image_name = time().'.'.$request->product_image->extension();  
        // $request->file->move(public_path('uploads'), $image_name);

        $image = $request->file('product_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        dd(11);

      $data = [
        'name' => $request['name'],
        'price_unit' => $request['price_unit'],
        'image' => $request['product_image'],
        'quantity' => $request['product_quantity'],
        'brand_id' => $request['brand_id'],
        'category_id' => $request['product_category'],
        'product_description' => $request['product_description'],
      ];

      $product = $this->product->insert($data);

      return response()->json([
        'status'=>'ok',
        'massage'=> 'product created successfuly',
        'product'=> $product
       ]);
    }
    #Update product admin
    public function update(Request $request)
    {
      $product = $this->product->updateProduct($request['id'], $request);

      return response()->json([
        'status'=>'ok',
        'massage'=> 'product update successfuly',
        'product'=> $product
       ]);

    }
    #Delete product admin
    public function delete()
    {
      $this->product->delete($id);
      return response()->json([
        'status' => 'ok',
        'message' => 'product deleted successfuly'
      ]);
    }
}
