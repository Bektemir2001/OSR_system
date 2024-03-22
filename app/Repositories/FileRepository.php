<?php

namespace App\Repositories;

use App\Models\File;
use Illuminate\Support\Collection;

class FileRepository
{
    public function getFiles(int $user_id): Collection
    {
        return File::where('user_id', $user_id)->get();
    }

    public function store(string $file_name, string $file_original_name, string $file_extension, int $user_id): void
    {
        File::create([
            'name' => $file_name,
            'original_name' => $file_original_name,
            'type' => $file_extension,
            'user_id' => $user_id
        ]);

    }
}
