<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Inertia\Inertia;
use App\Models\BoardSession;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Pipes\BoardSession\FileUpload;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Support\Facades\Pipeline;
use App\Pipes\BoardSession\ConvertFileToPDF;
use App\Pipes\BoardSession\DeleteFileUpload;
use App\Transformers\BoardSessionLaraTables;
use App\Pipes\BoardSession\StoreBoardSession;
use App\Repositories\BoardSessionRespository;
use App\Pipes\BoardSession\DeleteBoardSession;
use App\Pipes\BoardSession\GeneratePublicLink;
use App\Pipes\BoardSession\UpdateBoardSession;
use App\Http\Requests\StoreBoardSessionRequest;
use App\Http\Requests\UpdateBoardSessionRequest;
use App\Pipes\BoardSession\ExtractTextFromWordDocument;

final class BoardSessionController extends Controller
{
    public function __construct(private readonly BoardSessionRespository $boardSessionRepository)
    {
        $this->middleware('verify.user')->only(['locked', 'unlocked', 'destroy']);
    }

    public function list(): array
    {
        return Laratables::recordsOf(BoardSession::class, BoardSessionLaraTables::class);
    }

    /**
     * @throws Exception
     */
    public function index()
    {
        $boardSession = BoardSession::with(['schedule_information' => [
            'schedule_venue',
        ], 'file_link', 'submitted'])->orderBy('created_at', 'DESC');
        return Inertia::render('BoardSessionIndex', [
            'boardSessions' => $boardSession->paginate(10),
            'availableRegularSessions' => [],
        ]);
    }

    public function create()
    {
        return Inertia::render('BoardSessionCreate');
    }

    public function store(StoreBoardSessionRequest $request)
    {
        return DB::transaction(function () use ($request) {
            return Pipeline::send($request->all())
                ->through(StoreBoardSession::class)
                ->when(request()->file_path, function ($pipe) {
                    return $pipe->through([
                        StoreBoardSession::class,
                        FileUpload::class,
                        ConvertFileToPDF::class,
                        GeneratePublicLink::class,
                        ExtractTextFromWordDocument::class,
                    ]);
                })
                ->then(fn () => response()->json(['success' => true, 'message' => 'Board session created successfully']));
        });
    }

    public function show(int $id)
    {
        $boardSession = $this->boardSessionRepository->findBy('id', $id);
        return redirect()->to($boardSession->file_link->view_link);
    }

    public function edit(int $id)
    {
        $boardSession = $this->boardSessionRepository->findBy('id', $id);
        return Inertia::render('BoardSessionEdit', [
            'boardSession' => $boardSession,
        ]);
    }

    public function update(UpdateBoardSessionRequest $request, BoardSession $board_session)
    {
        return DB::transaction(function () use ($request, $board_session) {
            return Pipeline::send($request->merge(['session' => $board_session])->all())
                ->through(UpdateBoardSession::class)
                ->when(request()->file_path !== $board_session->file_path, function ($pipe) {
                    return $pipe->through([
                        UpdateBoardSession::class,
                        FileUpload::class,
                        ConvertFileToPDF::class,
                        GeneratePublicLink::class,
                        ExtractTextFromWordDocument::class,
                    ]);
                })->then(fn () => response()->json(['success' => true, 'message' => 'Board session updated successfully']));
        });
    }


    public function destroy(BoardSession $board_session)
    {
        DB::transaction(function () use ($board_session) {
            Pipeline::send($board_session)
                ->through([
                    DeleteBoardSession::class,
                    DeleteFileUpload::class,
                ])
                ->then(fn ($data) => $data);
        });

        return response()->json(['success' => true, 'message' => 'Board session deleted successfully']);
    }
}
