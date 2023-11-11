<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInsuredRequest;
use App\Http\Requests\UpdateInsuredRequest;
use App\Models\Insured;
use RealRashid\SweetAlert\Facades\Alert;

class InsuredController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInsuredRequest $request)
    {
        Insured::query()->create($request->all());
        Alert::toast('Insurance Successfully Attached', 'success');
        return to_route('clients.show', [$request->client_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Insured $insured)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Insured $insured)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInsuredRequest $request, Insured $insured)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Insured $insurance)
    {
        $insurance->delete();
        Alert::toast('Insurance Policy Successfully Removed From Product', 'success');
        return back();
    }
}
