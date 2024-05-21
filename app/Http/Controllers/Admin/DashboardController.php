<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateChartRequest;
use App\Models\Chart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $charts = Chart::all();

        return view('admin.dashboard.index', compact('user', 'charts'));
    }

    public function edit(Chart $chart)
    {
        return view('admin.dashboard.edit', compact('chart'));
    }

    public function update(UpdateChartRequest $request, Chart $chart)
    {
        $validatedData = $request->validated();

        $chart->update($validatedData);

        return redirect()->route('dashboard.index')->with('success', 'Chart updated successfully!');
    }
}
