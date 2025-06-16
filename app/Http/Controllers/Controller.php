<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function updateUserStatus(Request $request, $id)
    {
       
        // Validate incoming request
        $request->validate([
            'status' => 'required|string|in:admin,editor,user', // Adjust validation rules as per your needs
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update user role based on the selected status
    //    $result =  $user->update([
    //         'role' => $request->status,
    //     ]);
        $user->role = $request->input('status');
        $user->save();
        // dd($result);
        // Optionally, you can redirect back with a success message
        return redirect()->back()->with('success', 'User status updated successfully.');
    }
    public function clearCache()
    {
        // Clear application cache
        Artisan::call('cache:clear');
        // Clear view cache
        Artisan::call('view:clear');
        // Clear config cache
        Artisan::call('config:clear');
        // Clear route cache
        Artisan::call('route:clear');
        return 0;

        // return redirect()->back()->with('success', 'All caches cleared successfully.');
    }

    public function createStorageLink()
    {
        // Create the storage link
        Artisan::call('storage:link');

        return redirect()->back()->with('success', 'Storage link created successfully.');
    }
    public function npmRunDev()
    {
        $process = new Process(['npm', 'run', 'dev']);
        $process->setWorkingDirectory(base_path());
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return redirect()->back()->with('success', 'NPM run dev command executed successfully.');
    }

    public function npmRunBuild()
    {
        $process = new Process(['npm', 'run', 'build']);
        $process->setWorkingDirectory(base_path());
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return redirect()->back()->with('success', 'NPM run build command executed successfully.');
    }
}
