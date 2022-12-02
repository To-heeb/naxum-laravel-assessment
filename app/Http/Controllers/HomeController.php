<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
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

        $purchasers = DB::table('users as purchasers')
            ->select(
                'purchasers.id as purchaser_id',
                'purchasers.first_name as purchaser_first_name',
                'purchasers.last_name as purchaser_last_name',
                'purchasers.referred_by as purchaser_referred_by',
                'purchasers.enrolled_date as purchaser_enrolled_date',
                'user_category.category_id as purchaser_category_id',
                'distributors.id as distributor_id',
                'distributors.first_name as distributor_first_name',
                'distributors.last_name as distributor_last_name',
                'distributors.referred_by as distributor_referred_by',
                'distributors.enrolled_date as distributor_enrolled_date',
            )
            ->join('user_category', 'user_category.user_id', '=', 'purchasers.id')
            ->leftJoin('users as distributors', 'distributors.id', '=', 'purchasers.referred_by');
        //->toSql();

        $order_items = DB::table('order_items')
            ->select(
                'order_items.id as order_item_id',
                'order_id',
                'product_id',
                'quantity',
                'price',
                DB::raw('price*quantity  AS total_price_per_order_item')
            )
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->orderBy('order_id');

        $orders = DB::table('orders')
            ->select(
                'orders.id as real_order_id',
                'orders.purchaser_id as order_purchaser_id',
                'invoice_number',
                'order_date',
                'purchasers.id as purchaser_id',
                'purchasers.first_name as purchaser_first_name',
                'purchasers.last_name as purchaser_last_name',
                'purchasers.referred_by as purchaser_referred_by',
                'purchasers.enrolled_date as purchaser_enrolled_date',
                'purchaser_category.category_id as purchaser_category_id',
                'distributors.id as distributor_id',
                'distributors.first_name as distributor_first_name',
                'distributors.last_name as distributor_last_name',
                'distributors.referred_by as distributor_referred_by',
                'distributors.enrolled_date as distributor_enrolled_date',
                'distributor_category.category_id as distributor_category_id',
                DB::raw('sum(total_price_per_order_item)  AS order_total'),
            )
            ->joinSub($order_items, 'order_items', function ($join) {
                $join->on('order_items.order_id', '=', 'orders.id');
            })
            ->groupBy('real_order_id')
            ->orderBy('order_date')
            ->join('users as purchasers', 'purchasers.id', '=', 'orders.purchaser_id')
            ->join('user_category as purchaser_category', 'purchaser_category.user_id', '=', 'purchasers.id')
            ->leftJoin('users as distributors', 'distributors.id', '=', 'purchasers.referred_by')
            ->join('user_category as distributor_category', 'distributor_category.user_id', '=', 'distributors.id')
            //->get()
            ->paginate(10);

        foreach ($orders as $order) {
            $order->referred_distributor_count = DB::table('users')
                ->join('user_category', 'user_category.user_id', '=', 'users.id')
                ->where('category_id', 1)
                ->where('referred_by', $order->distributor_id)
                ->where('enrolled_date', '<=', $order->order_date)->get()->count();

            if ($order->referred_distributor_count <= 0 or $order->referred_distributor_count <= 4) {
                $order->percentage = 5;
                $order->commission = (5 / 100) * $order->order_total;
            } elseif ($order->referred_distributor_count >= 5  and $order->referred_distributor_count <= 10) {
                # code...
                $order->percentage = 10;
                $order->commission = (10 / 100) * $order->order_total;
            } elseif ($order->referred_distributor_count >= 11  and $order->referred_distributor_count <= 20) {
                $order->percentage = 15;
                $order->commission = (15 / 100) * $order->order_total;
            } elseif ($order->referred_distributor_count >= 21  and $order->referred_distributor_count <= 30) {
                $order->percentage = 20;
                $order->commission = (20 / 100) * $order->order_total;
            } else {
                $order->percentage = 30;
                $order->commission = (30 / 100) * $order->order_total;
            }
        }

        //->toSql();

        //dd($orders);
        return view('task_one', compact('orders'));
    }

    public function task_two()
    {

        // vet this again
        $users = DB::table('users')
            ->select('users.id as user_id', 'first_name', 'last_name', 'referred_by', 'enrolled_date', 'category_id')
            ->join('user_category', 'user_category.user_id', '=', 'users.id');


        $order_items = DB::table('order_items')
            ->select('order_items.id as order_item_id', 'order_id', 'product_id', 'quantity', 'price',  DB::raw('price*quantity  AS total_price_per_order_item'))
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->orderBy('order_id');

        $orders = DB::table('orders')
            ->select('orders.id as real_order_id', 'purchaser_id', 'referred_by as referrer', 'invoice_number', DB::raw('sum(total_price_per_order_item)  AS total_price_per_order'))
            ->rightJoinSub($order_items, 'order_items', function ($join) {
                $join->on('order_items.order_id', '=', 'orders.id');
            })
            ->groupBy('real_order_id')
            ->orderBy('total_price_per_order', 'desc')
            ->joinSub($users, 'users', function ($join) {
                $join->on('users.user_id', '=', 'orders.purchaser_id');
            });

        $distributors = DB::table('users', 'distributors')
            ->select(DB::raw('RANK() OVER(ORDER BY total_sales desc) AS num_row'), 'distributors.id as distributor_id', 'first_name', 'last_name', 'referred_by', 'real_order_id', 'purchaser_id', 'referrer', DB::raw('sum(total_price_per_order)  AS total_sales'))
            ->joinSub($orders, 'orders', function ($join) {
                $join->on('orders.referrer', '=', 'distributors.id');
            })

            ->groupBy('distributor_id')
            ->orderBy('total_sales', 'desc')
            ->limit(100)
            ->get()
            ->paginate(10);
        //->toSql();

        //dd($distributors);
        return view('task_two', compact('distributors'));
    }

    public function get_order_items(Request $request)
    {
        dd($request);
        $order_id = 24343;
        $order_items = DB::table('order_items')
            ->select('order_items.id as order_item_id', 'order_id', 'product_id', 'sku', 'name', 'quantity', 'price',  DB::raw('price*quantity  AS total'))
            ->where('order_id', $order_id)
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->orderBy('sku')
            ->get();

        return $data = $order_items->map(function ($order_item_detail) {
            return [
                'id' => $order_item_detail->order_item_id,
                'name' => $order_item_detail->name,
                'sku' => $order_item_detail->sku,
                'quantity' => $order_item_detail->quantity,
                'price' => $order_item_detail->price,
                'total' => $order_item_detail->total
            ];
        })->all();
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
