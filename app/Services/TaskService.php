<?php

namespace App\Services;

use Illuminate\Http\Response;

class TaskService
{

    public function create($folderId)
    {
        return $this->findFolderOrAbort($folderId);
    }

    public function update($folderId)
    {
        return $this->findFolderOrAbort($folderId);
    }

    /**
     * Find the folder or abort with a 403 response if the user does not own it.
     */
    protected function findFolderOrAbort($folderId)
    {
        $folder = auth()->user()->folders()->find($folderId);

        if (!$folder) {
            abort(Response::HTTP_FORBIDDEN, 'You do not own this folder.');
        }

        return $folder;
    }
}
