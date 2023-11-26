<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdvertRequest;
use App\Http\Requests\UpdateAdvertRequest;
use App\Models\Advert;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adverts = Advert::all();
        return view('adverts.index', compact('adverts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adverts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdvertRequest $request)
    {
        $data = $request->all();

        if (isset($data['banner'])) {
            $fileName = time() . '_' . $data['banner']->getClientOriginalName();
            $data['banner']->storeAs('uploads', $fileName, 'public');
            $data['banner_url'] = $fileName;
            unset($data['banner']);
        }
        Advert::query()->create($data);
        Alert::toast('Advert Banner Successfully Posted', 'success');
        return to_route('adverts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Advert $advert)
    {
        return view('adverts.show', compact('advert'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advert $advert)
    {
        return view('adverts.edit', compact('advert'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdvertRequest $request, Advert $advert)
    {

        $data = $request->all();

        if (isset($data['banner'])) {
            $file_path = storage_path() . '/app/public/uploads/' . $advert->banner_url;
            if (File::exists($file_path)) {
                unlink($file_path);
            }
            $fileName = time() . '_' . $data['banner']->getClientOriginalName();
            $data['banner']->storeAs('uploads', $fileName, 'public');
            $data['banner_url'] = $fileName;
            unset($data['banner']);
        }
        $advert->update($data);
        Alert::toast('Advert Banner Successfully Updated', 'success');
        return to_route('adverts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advert $advert)
    {
        $file_path = storage_path() . '/app/public/uploads/' . $advert->banner_url;
        if (File::exists($file_path)) {
            unlink($file_path);
        }
        $advert->delete();
        Alert::toast('Advert Banner Successfully Deleted', 'success');
        return to_route('adverts.index');
    }
}
