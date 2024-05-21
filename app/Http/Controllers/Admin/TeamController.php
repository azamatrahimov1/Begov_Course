<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use App\Services\UploadFileService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();

        return view('admin.team.index', compact('teams'));
    }

    public function store(StoreTeamRequest $request)
    {
        try {
            $validatedData = $request->validated();

            if ($request->hasFile('image')) {
                $filename = UploadFileService::uploadFile($request->file('image'), 'images');
                $validatedData['image'] = $filename;
            }

            Team::create([
                'name' => $validatedData['name'],
                'job' => $validatedData['job'],
                'image' => $filename,
                'telegram' => $validatedData['telegram'],
                'facebook' => $validatedData['facebook'],
                'instagram' => $validatedData['instagram'],

            ]);

            return redirect()->route('team.index')->with('success', 'Team created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating team: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all(),
            ]);

            return redirect()->back()->with('error', 'Error creating team: ' . $e->getMessage());
        }
    }

    public function edit(Team $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(UpdateTeamRequest $request, Team $team)
    {
        try {
            $validatedData = $request->validated();

            if ($request->hasFile('image')) {
                if ($team->image && Storage::disk('public')->exists($team->image)) {
                    UploadFileService::deleteFile($team->image);
                }

                $validatedData['image'] = UploadFileService::uploadFile($request->file('image'), 'images');
            }

            $validatedData['name'] = $request->name;
            $validatedData['job'] = $request->job;
            $validatedData['telegram'] = $request->telegram;
            $validatedData['facebook'] = $request->facebook;
            $validatedData['instagram'] = $request->instagram;

            $team->update($validatedData);

            return redirect()->route('team.index')->with('success', 'Team updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating Team: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Error updating Team. Please check the logs for details.');
        }
    }


    public function destroy(Team $team)
    {
        try {

            if ($team->image) {
                UploadFileService::deleteFile($team->image);
            }

            $team->delete();

            return redirect()->route('team.index')->with('success', 'Team deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting team: ' . $e->getMessage());
        }
    }
}
