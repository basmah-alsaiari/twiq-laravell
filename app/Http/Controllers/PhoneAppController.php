<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;



class PhoneAppController extends Controller
{
    public function Welcome()
    {
        $phone = [

            ['Type' => 'Iphone 14', 'Price' => 3500, 'Color' => 'Black'],
            ['Type' => 'Samsung', 'Price' => 2500, 'Color' => 'White'],
            ['Type' => 'Huawei', 'Price' => 1000, 'Color' => 'Gold']

        ];
        return view('welcome', ["phones" => $phone]);
    }


    public function getPhoneData()
    {
        $phones = DB::table('products')->get();

        return view('show-phone', ["ph" => $phones]);
    }

    public function getPhoneId($id)
    {
        $phones = DB::table('products')
            ->find($id);

        return view('checkout', ["ph" => $phones]);
    }

    public function GetInvoice(Request $request)
    {
        $price = $request->price;
        Cache::put('price',$price);
        $QTY = 1;
        $total = $price * $QTY;
        $tax = $total * 0.15;
        $allTotal = $total + $tax;
        $discount = 0;
        $net = $allTotal - $discount;
        $invoiceDate = date('Y-m-d');
        $customerName = $request->userName;
        $productName = $request->productName;

        $row = [
            'CostName' => $customerName,
            'invDate' => $invoiceDate,
            'ProductName' => $productName,
            'Price' => $price,
            'Quantity' => $QTY,
            'Tax' => $tax,
            'Discount' => $discount,
            'Total' => $net,
        ];

        DB::table('invoice')->insert($row);

        $dataInvoice = DB::table('invoice')->orderBy('id','desc')->first();


        return view('invoice',['inv' => $dataInvoice]);

       // DB::table('test1')->insert(['name' => 'Moh', 'email' => 'm@m.com']);
    }
}
