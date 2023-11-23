<?php

namespace App\Http\Controllers;

use App\Enum\Role;
use App\Exports\InsuranceProvidersExport;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        if (auth()->user()->role != Role::ROLES[0]) {
            $suppliers = $suppliers->where('user_id', '=', auth()->user()->id);
        }
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        Supplier::query()->create($request->all());
        Alert::toast("Supplier created successfully", 'success');
        return to_route('suppliers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        if (auth()->user()->role != Role::ROLES[0] and $supplier->user_id != auth()->user()->id) {
            abort(403, 'Action forbidden');
        }
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        if (auth()->user()->role != Role::ROLES[0] and $supplier->user_id != auth()->user()->id) {
            abort(403, 'Action forbidden');
        }
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->all());
        Alert::toast("Supplier updated successfully", 'success');
        return to_route('suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        if (auth()->user()->role != Role::ROLES[0] and $supplier->user_id != auth()->user()->id) {
            abort(403, 'Action forbidden');
        }
        $supplier->delete();
        Alert::toast("Supplier removed successfully", 'success');
        return to_route('suppliers.index');
    }

    public function report()
    {
        return Excel::download(new InsuranceProvidersExport, 'InsuranceProvidersList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
