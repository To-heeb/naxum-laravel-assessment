<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //

    public function index()
    {
        $order = Order::leftJoin('users', 'users.id', '=', 'orders.purchaser_id')
            ->join('user_category', 'user_category.user_id', '=', 'users.id');

        $order->rightJoin('order_items', 'order_items.order_id', '=', 'orders.id');
        //->join();

        //$order = Order::all();
        dd($order->paginate(10));
    }

    public function task_one()
    {
        DB::enableQueryLog();
        // $users = DB::table('users')
        //     ->select('users.id as user_id', 'first_name', 'last_name', 'referred_by', 'enrolled_date', 'category_id')
        //     ->join('user_category', 'user_category.user_id', '=', 'users.id')->limit(100);
        // $order_items = DB::table('order_items')
        //     ->select('order_items.id as order_item_id', 'order_id', 'product_id', 'quantity', 'price', DB::raw('sum(quantity) as total_qunatity'), DB::raw('sum(price) as price_amount'), DB::raw('price*quantity  AS total_price'))
        //     ->join('products', 'products.id', '=', 'order_items.product_id')
        //     ->groupBy('order_id', 'product_id');
        // //DB::raw('count(*) as user_count, status')
        // $orders = DB::table('orders')
        //     ->select('orders.id as real_order_id', 'purchaser_id', 'invoice_number', 'order_date', 'user_id', 'first_name', 'last_name', 'referred_by', 'enrolled_date', 'category_id', 'order_id', 'product_id', 'quantity', 'price', 'total_qunatity', 'price_amount', 'total_price')
        //     ->joinSub($users, 'users', function ($join) {
        //         $join->on('users.user_id', '=', 'orders.purchaser_id');
        //     })->joinSub($order_items, 'order_items', function ($join) {
        //         $join->on('order_items.order_id', '=', 'orders.id');
        //     })
        //     ->orderBy('real_order_id')->get();
        // ->chunk(10, function ($orders) {
        // });
        //dd(DB::getQueryLog());

        // $orders =
        $orders = DB::table("orders", "orders_table")
            ->select('orders_table.id as real_order_id', 'purchaser_id', 'invoice_number', 'order_date', 'users.id as user_id', 'first_name', 'last_name', 'referred_by', 'enrolled_date', 'category_id', 'order_id', 'product_id')
            ->join('users', 'users.id', '=', 'orders_table.purchaser_id')
            ->join('user_category', 'user_category.user_id', '=', 'users.id')
            ->join('order_items', 'order_items.order_id', '=', 'orders_table.id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->orderBy('orders')
            ->paginate(5);

        // manipluate query still
        //dd($orders);
        return view('task_one', compact('orders'));
    }

    public function task_two()
    {

        $orders = DB::table("orders", "orders_table")
            ->select('orders_table.id as real_order_id', 'purchaser_id', 'invoice_number', 'order_date', 'users.id as user_id', 'first_name', 'last_name', 'referred_by', 'enrolled_date', 'category_id', 'order_id', 'product_id')
            ->join('users', 'users.id', '=', 'orders_table.purchaser_id')
            ->join('user_category', 'user_category.user_id', '=', 'users.id')
            ->join('order_items', 'order_items.order_id', '=', 'orders_table.id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->paginate(10);

        dd($orders);

        return view('task_two');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
