@extends('layouts.app')

@section('content')
    <div class="table">
        <table class="table table-sm">
            <thead>
            <tr>
                <th>Currency</th>
                <th>Code</th>
                <th>Mid</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rates as $rate)
                <tr>
                    <td>{{ $rate->currency }}</td>
                    <td>{{ $rate->code}}</td>
                    <td>{{ $rate->mid }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
