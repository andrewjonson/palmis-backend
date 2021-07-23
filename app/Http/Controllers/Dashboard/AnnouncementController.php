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
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function create(AnnouncementRequest $request)
    {
        try {
            $this->announcementRepository->create($request->all());
            return $this->successResponse(trans('announcements.created'), DATA_CREATED);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function update(AnnouncementRequest $request, $announcementId)
    {
        $announcementId = hashid_decode($announcementId);
        $announcement = $this->announcementRepository->find($announcementId);
        if (!$announcement) {
            throw new AuthorizationException;
        }

        try {
            $this->announcementRepository->update($request->all(), $announcementId);
            return $this->successResponse(trans('announcements.updated'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function delete($announcementId)
    {
        $announcementId = hashid_decode($announcementId);
        $announcement = $this->announcementRepository->find($announcementId);
        if (!$announcement) {
            throw new AuthorizationException;
        }

        try {
            $announcement->delete();
            return $this->successResponse(trans('announcements.deleted'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
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
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function restore($announcementId)
    {
        $announcementId = hashid_decode($announcementId);
        $data = $this->announcementRepository->onlyTrashedById($announcementId);
        if (!$data) {
            throw new AuthorizationException;
        }

        try {
            $data->restore();
            return $this->successResponse(trans('announcements.restored'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function forceDelete($announcementId)
    {
        $announcementId = hashid_decode($announcementId);
        $data = $this->announcementRepository->onlyTrashedById($announcementId);
        if (!$data) {
            throw new AuthorizationException;
        }

        try {
            $data->forceDelete();
            return $this->successResponse(trans('announcements.force_deleted'), DATA_OK);
        } catch(\Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}
