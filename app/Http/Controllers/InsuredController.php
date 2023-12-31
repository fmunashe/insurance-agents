<?php

namespace App\Http\Controllers;

use App\Enum\Role;
use App\Exports\PolicyExport;
use App\Http\Requests\StoreInsuredRequest;
use App\Http\Requests\UpdateInsuredRequest;
use App\Models\Commission;
use App\Models\Insured;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
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

        $data = $request->all();
        if (isset($data['policy_schedule'])) {
            $fileName = time() . '_' . $data['policy_number'] . '_' . $data['policy_schedule']->getClientOriginalName();
            $data['policy_schedule']->storeAs('uploads', $fileName, 'public');
            $data['policy_schedule_link'] = $fileName;
            unset($data['policy_schedule']);
        }

        $commission = Commission::query()->where('id', '=', $data['commission_id'])->first();
        $data['commission_amount'] = $data['premium'] * ($commission->commission_percentage / 100);


        Insured::query()->create($data);
        Alert::toast('Insurance Successfully Attached', 'success');
        return to_route('clients.show', [$request->client_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Insured $insurance)
    {
        if (!isset($insurance->policy_schedule_link)) {
            Alert::toast('No Policy Schedule found for this policy', 'danger');
            return back();
        }
        return Response()->file(storage_path() . '/app/public/uploads/' . $insurance->policy_schedule_link);
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
        $file_path = storage_path() . '/app/public/uploads/' . $insurance->policy_schedule_link;
        if (File::exists($file_path)) {
            unlink($file_path);
        }
        $insurance->delete();
        Alert::toast('Insurance Policy Successfully Removed From Risk', 'success');
        return back();
    }

    public function getPolicies()
    {
        $policies = Insured::all();
        if (auth()->user()->role != Role::ROLES[0]) {
            $policies = Insured::query()
                ->join('products', 'products.id', '=', 'insureds.product_id')
                ->join('clients', 'clients.id', '=', 'products.client_id')
                ->where('clients.user_id', '=', auth()->user()->id)
                ->selectRaw('insureds.*')
                ->get();
        }
        return view('policy.index', compact('policies'));
    }

    public function showPolicy(Insured $policy): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('policy.show', compact('policy'));
    }

    public function PolicyReport(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new PolicyExport, 'InsurancePolicyList.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}
