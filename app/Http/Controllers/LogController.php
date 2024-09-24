<?php

namespace App\Http\Controllers;

use App\Http\Resources\LogCollection;
use App\Http\Resources\LogResource;
use App\Models\Log;
use Illuminate\Support\Facades\Gate;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logs = auth()->user()->logs()->paginate();
        return new LogCollection($logs);
    }

    /**
     * Display the specified resource.
     */
    public function show(Log $log)
    {
        Gate::authorize('view', $log);
        return new LogResource($log);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Log $log)
    {
        Gate::authorize('delete', $log);
        $log->delete();
        return response()->json([
            'message' => 'Log Deleted Successfully',
        ], 204);
    }
}
