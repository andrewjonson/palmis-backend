<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnnouncementResource;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Requests\Dashboard\AnnouncementRequest;
use App\Repositories\Interfaces\AnnouncementRepositoryInterface;

class AnnouncementController extends Controller
{
    use ResponseTrait;

    public function __construct(AnnouncementRepositoryInterface $announcementRepository)
    {
        $this->announcementRepository = $announcementRepository;
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;
        try {
            $announcements = $this->announcementRepository->search($keyword, $rowsPerPage);
            return AnnouncementResource::collection($announcements);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function create(AnnouncementRequest $request)
    {
        try {
            $this->announcementRepository->create($request->all());
            return $this->successResponse(trans('announcements.created'), 201);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function update(AnnouncementRequest $request, $announcementId)
    {
        $announcement = $this->announcementRepository->find($announcementId);
        if (!$announcement) {
            throw new AuthorizationException;
        }

        try {
            $this->announcementRepository->update($request->all(), $announcementId);
            return $this->successResponse(trans('announcements.updated'), 200);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function delete($announcementId)
    {
        $announcement = $this->announcementRepository->find($announcementId);
        if (!$announcement) {
            throw new AuthorizationException;
        }

        try {
            $announcement->delete();
            return $this->successResponse(trans('announcements.deleted'), 200);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function onlyTrashed(Request $request)
    {
        $keyword = $request->keyword;
        $rowsPerPage = $request->rowsPerPage;
        try {
            $results = $this->announcementRepository->onlyTrashed($keyword, $rowsPerPage);
            return AnnouncementResource::collection($results);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function restore($announcementId)
    {
        $data = $this->announcementRepository->onlyTrashedById($announcementId);
        if (!$data) {
            throw new AuthorizationException;
        }

        try {
            $data->restore();
            return $this->successResponse(trans('announcements.restored'), 200);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }

    public function forceDelete($announcementId)
    {
        $data = $this->announcementRepository->onlyTrashedById($announcementId);
        if (!$data) {
            throw new AuthorizationException;
        }

        try {
            $data->forceDelete();
            return $this->successResponse(trans('announcements.force_deleted'), 200);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), 500);
        }
    }
}
