<?php

namespace App\Http\Controllers\Admin;

use App\Models\Schedule;
use App\Models\ReferenceSession;
use App\Models\SanggunianMember;
use App\Http\Controllers\Controller;
use App\Repositories\SettingRepository;

final class ScreenPrivilegeHour extends Controller
{
    public function __invoke(int $id)
    {
        $settingRepository = app()->make(SettingRepository::class);

        $data = Schedule::with([
            'schedule_venue',
        ])->find($id);


        return view('admin.screen.screen-privilege-hour', [
            'data' => $data,
            'selectedPrivilegeHourMember' => SanggunianMember::find($settingRepository->getValueByName('privilege_hour_member')),
            'announcementRunningSpeed' => $settingRepository->getValueByName('announcement_running_speed'),
            'announcement' => $settingRepository->getValueByName('display_announcement'),
            'fontSize' => $settingRepository->getValueByName('question_of_hour_font_size') ?? 1.9,
        ]);
    }
}
