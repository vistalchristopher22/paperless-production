<?php

namespace App\ViewComposers;

use App\Models\Committee;
use Illuminate\View\View;

final class CommitteeViewComposer
{
    /**
     * The categories repository implementation.
     */
    protected Committee $committee;

    /**
     * Create a new category composer.
     *
     * @param Category $committees
     * @return void
     */
    public function __construct(Committee $committee)
    {
        $this->committee = $committee;
    }

    /**
     * Bind data to the view.
     *
     * @return void
     */
    public function compose(View $view)
    {
        $committees = $this->committee->with(['lead_committee_information', 'lead_committee_information.chairman_information', 'submitted', 'submitted.division_information'])
            ->whereNull('schedule_id')
            ->get();

        $view->with('onReviewData', $committees);
    }
}
