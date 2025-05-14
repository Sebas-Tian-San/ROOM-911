<?php

namespace App\Http\Controllers;

use App\Models\AccessAttemp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AccessAttempRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AccessAttempController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $accessAttemps = AccessAttemp::paginate(10000000);

        return view('access-attemp.index', compact('accessAttemps'))
            ->with('i', ($request->input('page', 1) - 1) * $accessAttemps->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $accessAttemp = new AccessAttemp();

        return view('access-attemp.create', compact('accessAttemp'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccessAttempRequest $request): RedirectResponse
    {
        AccessAttemp::create($request->validated());

        return Redirect::route('access-attemps.index')
            ->with('success', 'AccessAttemp created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $accessAttemp = AccessAttemp::find($id);

        return view('access-attemp.show', compact('accessAttemp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $accessAttemp = AccessAttemp::find($id);

        return view('access-attemp.edit', compact('accessAttemp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccessAttempRequest $request, AccessAttemp $accessAttemp): RedirectResponse
    {
        $accessAttemp->update($request->validated());

        return Redirect::route('access-attemps.index')
            ->with('success', 'AccessAttemp updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        AccessAttemp::find($id)->delete();

        return Redirect::route('access-attemps.index')
            ->with('success', 'AccessAttemp deleted successfully');
    }
}
