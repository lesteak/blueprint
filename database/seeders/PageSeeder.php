<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Yadda\Enso\Facades\EnsoCrud;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = EnsoCrud::query('page')->pluck('slug');
        $order = (EnsoCrud::query('page')->max('order') ?? 0) + 1;
        $now = Carbon::now();

        if (!$pages->contains('holding-page')) {
            EnsoCrud::query('page')->create([
                'slug' => 'holding-page',
                'order' => $order++,
                'published' => true,
                'publish_at' => $now,
                'title' => 'Holding Page',
            ]);
        }

        if (!$pages->contains('contact')) {
            EnsoCrud::query('page')->create([
                'slug' => 'contact',
                'order' => $order++,
                'published' => true,
                'publish_at' => $now,
                'title' => 'Contact',
            ]);
        }

        if (!$pages->contains('about')) {
            EnsoCrud::query('page')->create([
                'slug' => 'about',
                'order' => $order++,
                'published' => true,
                'publish_at' => $now,
                'title' => 'About',
            ]);
        }

        if (!$pages->contains('timetable')) {
            EnsoCrud::query('page')->create([
                'slug' => 'timetable',
                'order' => $order++,
                'published' => true,
                'publish_at' => $now,
                'title' => 'Timetable',
                'template' => 'subnav',
            ]);
        }

        if (!$pages->contains('trainer')) {
            EnsoCrud::query('page')->create([
                'slug' => 'trainer',
                'order' => $order++,
                'published' => true,
                'publish_at' => $now,
                'title' => 'Trainer',
            ]);
        }

        if (!$pages->contains('trainers')) {
            EnsoCrud::query('page')->create([
                'slug' => 'trainers',
                'order' => $order++,
                'published' => true,
                'publish_at' => $now,
                'title' => 'Trainers',
                'template' => 'subnav',
            ]);
        }

        if (!$pages->contains('location')) {
            EnsoCrud::query('page')->create([
                'slug' => 'location',
                'order' => $order++,
                'published' => true,
                'publish_at' => $now,
                'title' => 'Location',
            ]);
        }

        if (!$pages->contains('locations')) {
            EnsoCrud::query('page')->create([
                'slug' => 'locations',
                'order' => $order++,
                'published' => true,
                'publish_at' => $now,
                'title' => 'Locations',
            ]);
        }

        if (!$pages->contains('class')) {
            EnsoCrud::query('page')->create([
                'slug' => 'class',
                'order' => $order++,
                'published' => true,
                'publish_at' => $now,
                'title' => 'Class',
            ]);
        }

        if (!$pages->contains('classes')) {
            EnsoCrud::query('page')->create([
                'slug' => 'classes',
                'order' => $order++,
                'published' => true,
                'publish_at' => $now,
                'title' => 'Classes',
                'template' => 'subnav',
            ]);
        }

        if (!$pages->contains('home')) {
            EnsoCrud::query('page')->create([
                'slug' => 'home',
                'order' => $order++,
                'published' => true,
                'publish_at' => $now,
                'title' => 'Home',
            ]);
        }
    }
}
