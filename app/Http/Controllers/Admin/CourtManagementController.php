<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourtRequest;
use App\Models\Court;

class CourtManagementController extends Controller
{
    public function __construct() {}

    public function index()
    {
        $this->authorize('viewAny', Court::class);
        $courts = Court::orderBy('name')->paginate(10);
        return view('admin.courts.index', compact('courts'));
    }

    public function create()
    {
        $this->authorize('create', Court::class);
        return view('admin.courts.create');
    }

    public function store(CourtRequest $request)
    {
        $data = $request->validated();
        $data['is_available'] = $request->boolean('is_available', true);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courts', 'public');
        }
        Court::create($data);
        return redirect()->route('admin.courts.index')->with('success', 'Court created.');
    }

    public function edit(Court $court)
    {
        $this->authorize('update', $court);
        return view('admin.courts.edit', compact('court'));
    }

    public function update(CourtRequest $request, Court $court)
    {
        $data = $request->validated();
        $data['is_available'] = $request->boolean('is_available', false);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courts', 'public');
        }
        $court->update($data);
        return redirect()->route('admin.courts.index')->with('success', 'Court updated.');
    }

    public function destroy(Court $court)
    {
        $this->authorize('delete', $court);
        $court->delete();
        return back()->with('success', 'Court deleted.');
    }
}
