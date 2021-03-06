<?php


namespace App\Services;

use App\Models\Notice;
use App\Models\NoticeRead;

class NoticeReadService
{
    public function __construct() {}

    public function unreadCountCompany(int $cid): int {
        $nowNoticeCount = Notice::where("is_delivered", true)->where("target", "全体")->orWhere("target", "企業")->count();
        $readCount = NoticeRead::where("company_id", $cid)->count();
        return $nowNoticeCount - $readCount;
    }

    public function isReadCompany(int $cid, int $nid): bool {
        $count = NoticeRead::where("company_id", $cid)->where("notice_id", $nid)->count();
        return $count > 0;
    }

    public function readCompany(int $cid, int $nid) {
        NoticeRead::create([
            'notice_id' => $nid,
            'company_id' => $cid,
        ]);
    }

    public function unreadCountUser(int $uid): int {
        $nowNoticeCount = Notice::where("is_delivered", true)->where("target", "全体")->orWhere("target", "応募者")->count();
        $readCount = NoticeRead::where("user_id", $uid)->count();
        return $nowNoticeCount - $readCount;
    }

    public function isReadUser(int $uid, int $nid): bool {
        $count = NoticeRead::where("user_id", $uid)->where("notice_id", $nid)->count();
        return $count > 0;
    }

    public function readUser(int $uid, int $nid) {
        NoticeRead::create([
            'notice_id' => $nid,
            'user_id' => $uid,
        ]);
    }
}