<?php

namespace App\Services;

use Illuminate\Http\Response;

class TaskService
{
    /**
     * Find the folder or abort with a 403 response if the user does not own it.
     */
    public function findFolderOrAbort($folderId)
    {
        $folder = auth()->user()->folders()->find($folderId);

        if (!$folder) {
            abort(Response::HTTP_FORBIDDEN, 'You do not own this folder.');
        }

        return $folder;
    }
}
