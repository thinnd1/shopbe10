<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use App\Models\ProductImage;
use App\Models\Brands; 

class product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'price_unit',
        'image',
        'quantity',
        'brand_id',
        'category_id',
        'product_description',
    ];

    protected static $marks = [
        Wishlist::class,
    ];

    // Categorie product relation
    public function Categorie(){
      return $this->belongsToMany(Category::class);
    }
    // Wishlist product relation
    public function WishlistProduct(){
       return $this->belongsToMany(WishlistItem::class); 
    }
    // Product image relation
    public function ProductImage(){
        return $this->hasMany(ProductImage::class);
    }
    public function ProductBrand(){
        return $this->hasOne(Brands::class); 
    }

    public function insert($data)
    {
        return Product::create($data);
    }

    public function getAllProduct()
    {
        return Product::all();
    }

    public function getProductId($id)
    {
        return Product::where('id', $id)->first();
    }

    public function updateProduct($id, $data)
    {
        $product = Product::find($id);

        $product->name = $data['name'];
        $product->price_unit = $data['price_unit'];
        $product->image = $data['image'];
        $product->quantity = $data['quantity'];
        $product->brand_id = $data['brand_id'];
        $product->category_id = $data['category_id'];
        $product->product_description = $data['product_description'];

        return $product->save();
    }

    public function deleteProduct($id)
    {
        return Product::where('id', $id)->delete();
    }
}
