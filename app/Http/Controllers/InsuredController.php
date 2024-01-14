<?php

namespace App\Http\Controllers;

use App\Enum\Role;
use App\Exports\PolicyExport;
use App\Http\Requests\StoreInsuredRequest;
use App\Http\Requests\UpdateInsuredRequest;
use App\Models\Commission;
use App\Models\Insured;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
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
    public function store(Request $request)
    {

        $data = $request->all();
        $validator = Validator::make($data, [
            'product_id' => ['required', 'exists:products,id'],
            'sum_insured' => ['required', 'numeric'],
            'premium' => ['required', 'numeric'],
            'rate' => ['required', 'numeric'],
            'policy_number' => ['required'],
            'supplier_id' => ['required'],
            'currency_id' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'status' => ['required'],
            'number_of_terms' => ['required'],
            'policy_schedule' => 'nullable|mimes:docx,pdf,png,jpeg,jpg',
            'stamp_duty' => ['required'],
            'levy' => ['required'],
            'commission_id' => ['required'],
        ],
            [
            'commission_id.required'=>"Commission band is required",
            'product_id.required'=>"Risk is required",
            'sum_insured.required'=>"Sum insured is required",
            'premium.required'=>"Risk premium is required",
            'rate.required'=>" Rate is required",
            'policy_number.required'=>" Policy number is required",
            'supplier_id.required'=>" Insurance provider is required",
            'currency_id.required'=>" Currency is required",
            'start_date.required'=>" Insurance start period is required",
            'end_date.required'=>" Insurance end period is required",
            'number_of_terms.required'=>"Insured number of terms is required",
            'stamp_duty.required'=>"Stamp duty is required",
            'levy.required'=>"Levy is required",
        ]);

        if ($validator->fails()) {
            $errors = "<ol>";
            foreach ($validator->errors()->all() as $error) {
                $errors .="<li>".$error."</li>";
            }
            $errors .= "</ol>";
            Alert::html("Correct These Errors",$errors)->autoClose(false);
            return back();
        }

        if (isset($data['policy_schedule'])) {
            $fileName = time() . '_' . $data['policy_number'] . '_' . $data['policy_schedule']->getClientOriginalName();
            $data['policy_schedule']->storeAs('uploads', $fileName, 'public');
            $data['policy_schedule_link'] = $fileName;
            unset($data['policy_schedule']);
        }

        $commission = Commission::query()->where('id', '=', $data['commission_id'])->first();
        $data['commission_amount'] = $data['premium'] * ($commission->commission_percentage / 100);
        $data['total_premium'] = $data['premium'] + $data['stamp_duty'] + $data['levy'];

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
