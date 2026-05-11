@extends('layouts.app')
@section('title','Reports') @section('header','Reports & Analytics')
@section('content')
<div class="grid lg:grid-cols-2 gap-6">
    <div class="card">
        <h3 class="font-semibold mb-3">Monthly bookings (last 12 months)</h3>
        <table class="table">
            <thead><tr><th>Month</th><th>Total</th></tr></thead>
            <tbody>
            @foreach($monthly as $m)
                <tr><td>{{ $m->month }}</td><td>{{ $m->total }}</td></tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card">
        <h3 class="font-semibold mb-3">Bookings per Court</h3>
        <table class="table">
            <thead><tr><th>Court</th><th>Total</th></tr></thead>
            <tbody>
            @foreach($perCourt as $r)
                <tr><td>{{ $r->court->name ?? '—' }}</td><td>{{ $r->total }}</td></tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
