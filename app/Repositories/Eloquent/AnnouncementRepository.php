<?php
namespace App\Repositories\Eloquent;

use App\Models\Announcement;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\AnnouncementRepositoryInterface;

class AnnouncementRepository extends BaseRepository implements AnnouncementRepositoryInterface
{
    public function __construct(Announcement $model)
    {
        $this->model = $model;
    }
}