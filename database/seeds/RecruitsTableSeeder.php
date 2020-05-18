<?php

use Illuminate\Database\Seeder;
use App\Enums\SkillType;

class RecruitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 30; $i++) {
            DB::table('recruits')->insert([
                'name' => '太郎' . $i,
                'name_kana' => 'タロウ',
                'birthday' => '1999/10/' . $i,
                'gender' => rand(0, 2),
                'email' => "hoge${i}@gmail.com",
                'phone' => '090111111' . $i,
                'is_mobile' => rand(0, 1) === 0,
                'is_experienced' => rand(0, 1) === 0,
                'is_completed' => rand(0, 1) === 0,
                'created_at' => date("Y-m-d H:i:s", mktime(0, 0, 0, rand(1, 12), rand(1, 30), 2020)),
            ]);

            for ($j = 0; $j < 3; $j++) {
                DB::table('recruit_skills')->insert([
                    'skill_type' => SkillType::getValues()[rand(0, 12)],
                    'recruit_id' => $i
                ]);

            }
        }
    }
}
