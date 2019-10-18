<?php

namespace App\Models;

use Darryldecode\Cart\Cart;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property string $customer_name
 * @property string $customer_email
 * @property string $customer_address
 * @property float $total_price
 * @property float $discount_price
 * @property string $payment_method
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderProduct[] $products
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCustomerAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCustomerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDiscountPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function saveNewOrderInfo($request, $order)
    {
        $order->customer_name = ucwords($request->customer_name);
        $order->customer_email = strtolower($request->customer_email);
        $order->customer_phone = $request->customer_phone;
        $order->customer_address = $request->customer_address;
        $order->delivery = (double)$request->location;

        $subTotal = \Cart::getSubTotal();
        $tax = $subTotal * 0.15;
        $delivery = $order->delivery;
        $total = $subTotal + $tax + $delivery;

        $order->total_price = $total;

        $order->save();

        return $order;
    }
}
