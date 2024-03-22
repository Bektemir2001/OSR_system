<?php

namespace App\Services;
use App\Repositories\FileRepository;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileService
{
    protected FileRepository $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function getFiles(int $user_id): array
    {
        try {
            $data = $this->fileRepository->getFiles($user_id);
            return ['data' => $data, 'status' => 200];
        }
        catch (Exception $exception)
        {
            return ['message' => $exception->getMessage(), 'status' => 500];
        }
    }

    public function store(UploadedFile $file, int $user_id): array
    {
        try {
            $file_original_name = $file->getClientOriginalName();
            $file_extension = $file->getClientOriginalExtension();
            $file = Storage::disk('public')->put('files', $file);
            $this->fileRepository->store($file, $file_original_name, $file_extension, $user_id);
            return ['data' => 'success', 'status' => 201];
        }
        catch (Exception $exception)
        {
            return ['message' => $exception->getMessage(), 'status' => 500];
        }
    }

}
