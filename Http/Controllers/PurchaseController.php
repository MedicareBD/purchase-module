<?php

namespace Modules\Purchase\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Purchase\DataTables\PurchaseDataTable;
use Modules\Purchase\Entities\Purchase;

class PurchaseController extends Controller
{
    public function index(PurchaseDataTable $dataTable)
    {
        return $dataTable->render('purchase::index');
    }

    public function create()
    {
        return view('purchase::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            //
        ]);

        return response()->json([
            'message' => __('Purchase Created Successfully'),
            'redirect' => route('admin.purchase.index'),
        ]);
    }

    public function show(Purchase $purchase)
    {
        return view('purchase::show', compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        return view('purchase::edit', compact('purchase'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            //
        ]);

        $purchase->update([
            //
        ]);

        return response()->json([
            'message' => __('Purchase Updated Successfully'),
            'redirect' => route('admin.purchase.index'),
        ]);
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        return response()->json([
            'message' => __('Purchase Updated Successfully'),
        ]);
    }

    public function searchManufacturer(Request $request)
    {
        $search = $request->get('search');

        if (! is_null($search)) {
            $users = User::role('Manufacturer')
                ->orderby('name', 'asc')
                ->select(['id', 'name as text', 'avatar'])
                ->where('name', 'like', '%'.$search.'%')
                ->paginate(20);
        } else {
            return response()->json();
        }

        return response()->json($users);
    }
}
