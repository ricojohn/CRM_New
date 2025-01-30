<?php

namespace App\Http\Controllers\Recording;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class recordings extends Controller
{
    public function index(){
        if (!Auth::check()) {
            // Redirect them to the Login page
            return redirect()->route('auth.logout');
        }

        return view('recording.index');
    }

    public function upload(Request $request){

        $employee_id = auth()->user()->employee_id;

        if (!Auth::check()) {
            // Redirect them to the Login page
            return redirect()->route('auth.logout');
        }

        $timestamp = now()->format('mdyHis');
        
        try {
            //code...
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $videoName = $video->getClientOriginalName(). $timestamp . '.webm';
                $videoPath = $video->storeAs('uploads/videos', $videoName, 'public');


                
            }

            // Handle screenshot upload
            if ($request->hasFile('screenshot')) {
                $screenshot = $request->file('screenshot');
                $screenshotName = 'screenshot_' . $timestamp . '.png';
                $screenshotPath = $screenshot->storeAs('uploads/screenshots', $screenshotName, 'public');

            }


            // Save recording details to the database
                DB::table('recordings')->insert([
                    'employee_id' => $employee_id,
                    'filename' => $videoName,
                    'date' => now()->toDateString(),
                    'time' => now()->toTimeString(),
                ]);

            return response()->json([
                'message' => 'Upload successful',
                'video_path' => $videoPath,
                'screenshot_path' => $screenshotPath,
            ]);

        } catch (\Throwable $th) {
            //throw $th;

            return response()->json(['message' => 'Invalid upload'], 400);
        }
    }
}
