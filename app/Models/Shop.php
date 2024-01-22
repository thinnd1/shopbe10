<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'country',
        'city',
        'password',
    ];

    /**
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'mp_store_categories');
    }

    /**
     * @return BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'mp_store_members');
    }
    public function getAllShop()
    {
        return Shop::orderByDesc('id')->get();
    }

    public function getShopId($id)
    {
        return Shop::where('id', $id)->first();
    }

    public function insertShop($data)
    {
        return Shop::create($data);            
    }

    public function updateShop($id, $data)
    {
        $shop = Shop::find($id);

        $shop->name = $data['name'];
        $shop->email = $data['email'];
        $shop->phone = $data['phone'];
        $shop->address = $data['address'];
        $shop->password = Hash::make($data['password']);

        return $shop->save();
    }
    public function deleteShop($id)
    {
        return Shop::where('id', $id)->delete();
    }
}
