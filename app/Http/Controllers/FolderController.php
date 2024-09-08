<?php

namespace App\Http\Controllers;

use App\Http\Requests\FolderRequest;
use App\Http\Resources\FolderCollection;
use App\Http\Resources\FolderResource;
use App\Models\Folder;
use Illuminate\Support\Facades\Gate;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $folders = auth()->user()->folders()->paginate();
        return new FolderCollection($folders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FolderRequest $request)
    {
        auth()->user()->folders()->create($request->validated());
        return response()->json([
            'message' => 'Folder Created Successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Folder $folder)
    {
        Gate::authorize('view', $folder);
        return new FolderResource($folder);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FolderRequest $request, Folder $folder)
    {
        Gate::authorize('update', $folder);
        $folder->update($request->validated());
        return response()->json([
            'message' => 'Folder Updated Successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Folder $folder)
    {
        Gate::authorize('delete', $folder);
        $folder->delete();
        return response()->json([
            'message' => 'Folder Deleted Successfully',
        ]);
    }
}
