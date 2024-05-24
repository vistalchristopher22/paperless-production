<?php

namespace Database\Seeders;

use App\Enums\CommitteeStatus;
use App\Models\Agenda;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agendaCount = Agenda::count();
        foreach (range(1, 20) as $range) {
            $user = User::inRandomOrder()->limit(1)->first()->id;
            $leadCommittee = Agenda::inRandomOrder()->limit(rand(1, $agendaCount))->first()->id;
            $expandedCommittee = Agenda::inRandomOrder()->limit(rand(1, $agendaCount))->first()->id;
            DB::table('committees')->insert([
                'name' => fake()->word,
                'content' => fake()->paragraph(2000),
                'lead_committee' => $leadCommittee,
                'expanded_committee' => $expandedCommittee,
                'file_path' => null,
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'status' => CommitteeStatus::APPROVED->value,
                'submitted_by' => $user,
            ]);
        }
    }
}
