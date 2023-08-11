<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderNoteRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderNoteController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Order $order)
    {
        return view('admin.pages.order.note.form', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderNoteRequest $request
     * @param Order $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(OrderNoteRequest $request, Order $order)
    {
        $order->update($request->validated());

        return redirect(route('admin.orders.index'))->with('success', 'Note berhasil diubah');
    }
}
