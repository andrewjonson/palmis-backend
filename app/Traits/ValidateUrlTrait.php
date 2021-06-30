<?php
namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

trait ValidateUrlTrait
{
    static $FILENAME = 'generated-signed-urls.txt';
    static $STORAGE_DISK = 'local';

    public function validUrl()
    {
        $urlExpireAt = base64_decode($_GET['expireAt']);
        $signature = $_GET['signature'];
        $fileContent = Storage::disk(static::$STORAGE_DISK)->get(static::$FILENAME);
        $signedUrlDataList = json_decode($fileContent);

        if (!$signedUrlDataList) {
            return false;
        }

        $signedUrlDataList = collect($signedUrlDataList);
        $signedUrl = $signedUrlDataList->where('signature', '=', $signature)->first();

        if (!$signedUrl) {
            return false;
        }

        $expireAt = Carbon::parse($signedUrl->expire_at)->format('Y-m-d H:i:s');

        if ($expireAt != $urlExpireAt) {
            return false;
        }

        if (Carbon::now() > $expireAt) {
            return false;
        }

        return true;
    }
}