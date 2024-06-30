<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_orders = Order::all();
        return view('order.index', ['title' => 'menu', 'list_order' => $list_orders]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Create Order';
        $data['list_menu'] = Menu::all();
        return view('order.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'table'         => 'required|numeric',
            'customer_name' => 'required|min:3',
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.notes' => 'nullable|string'
        ]);


        $order = new Order([
            'customer_name' => $request->customer_name,
            'table'         => $request->table,
            'total_price'   => $request->total_price
        ]);
        $order->save();

        foreach ($request->items as $item) {
            $menu = Menu::find($item['menu_id']);
            if ($menu) {
                $order->menus()->attach($menu, [
                    'quantity' => $item['quantity'],
                    'menu_price' => $item['price'],
                    'note' => $item['notes']
                ]);
            }
        }

        return redirect()->route('order.index')->with(['success'=>'Data berhasil disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
