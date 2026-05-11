<?php

namespace App\Http\Controllers;

use App\Models\Court;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function index(Request $request)
    {
        $courts = Court::query()
            ->when($request->search, fn($q,$s) => $q->where('name', 'like', "%{$s}%"))
            ->when($request->type, fn($q,$t) => $q->where('type', $t))
            ->orderBy('name')
            ->paginate(9)
            ->withQueryString();

        return view('courts.index', compact('courts'));
    }

    public function show(Court $court)
    {
        return view('courts.show', compact('court'));
    }
}
