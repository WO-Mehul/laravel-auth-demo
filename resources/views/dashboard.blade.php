@extends('layout')
@section('title', 'Demo | Dashboard')
@section('content')
    <h1>Welcome {{$userName}}!</h1>
    <div class="container mx-auto px-4">
        <div class="py-8">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-2xl font-bold mb-4">Dashboard</h2>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">Total Users: {{ $totalUsers }}</h3>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-lg font-semibold">Users by Role:</h4>
                        <ul>
                            @foreach ($usersByRole as $role)
                                <li>{{ $role->name }}: {{ $role->users_count }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-lg font-semibold">Users Created Each Month (Last Year):</h4>
                        <ul>
                            @foreach ($usersByMonth as $data)
                                <li>{{ date('F Y', strtotime($data->year . '-' . $data->month . '-01')) }}: {{ $data->count }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold">Average Users Created per Day (Last Month):</h4>
                        <p>{{ $averageUsersPerDay }} users per day</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
