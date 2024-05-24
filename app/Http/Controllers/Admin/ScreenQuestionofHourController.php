<?php

namespace App\Http\Controllers\Admin;

use App\Models\Schedule;
use App\Models\ReferenceSession;
use App\Http\Controllers\Controller;
use App\Repositories\SettingRepository;

final class ScreenQuestionofHourController extends Controller
{
    public function __invoke(int $id)
    {
        $settingRepository = app()->make(SettingRepository::class);

        $data = Schedule::with('schedule_venue')->find($id);
        return view('admin.screen.screen-question-of-hour', [
            'data' => $data,
            'announcementRunningSpeed' => $settingRepository->getValueByName('announcement_running_speed'),
            'announcement' => $settingRepository->getValueByName('display_announcement'),
            'guestFullName' => $settingRepository->getValueByName('question_of_hour_guest'),
            'fontSize' => $settingRepository->getValueByName('question_of_hour_font_size') ?? 1.9,
        ]);
    }
}
