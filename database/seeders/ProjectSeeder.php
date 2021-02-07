<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $pr1 = new \App\Models\Project();
        $pr1->title = "Project 1";
        $pr1->credit_count = 16;
        $pr1->text = "Text Pr 1";
        $pr1->save();

        $pr2 = new \App\Models\Project();
        $pr2->title = "Project 2";
        $pr2->credit_count = 8;
        $pr2->text = "Text pr 2";
        $pr2->save(); 
    }
}
