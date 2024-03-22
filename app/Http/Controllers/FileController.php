<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileStoreRequest;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;


class FileController extends Controller
{
    protected FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index(): Response
    {
        $result = $this->fileService->getFiles(auth()->user()->id);
        if($result['status'] == 200)
        {
            return Inertia::render('File/Index', [
                'files' => $result['data']
            ]);
        }
        return Inertia::render('File/Index', [
            'message' => $result['message']
        ]);
    }

    function add(): Response
    {
        return Inertia::render('File/Add');
    }

    function store(FileStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->fileService->store($data['file'], auth()->user()->id);
        return redirect()->route('user.file.index');
    }
}
