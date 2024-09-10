<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskCollection;
use App\Models\Folder;
use App\Services\TaskService;
use Illuminate\Http\Request;

class FolderTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, int $folder)
    {
        (new TaskService)->index($folder);
        $tasks = auth()->user()->folders()->where('id', $folder)?->first()?->tasks()->filter($request->all())->paginate();
        return new TaskCollection($tasks);
    }
}
