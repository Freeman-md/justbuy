<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [['E-Commerce Application With Integrated Payment Gateway', 'Built an e-commerce application during Aptech Global Techwiz 2021', 'https://github.com/Freeman-md/justbuy', 'https://xclusivejustbuy.herokuapp.com', 1, 'TailwindCSS, Alpine, Laravel, Livewire'],
    ['Single Page Application - Shopping Cart ', '', 'https://github.com/Freeman-md/coursework', 'https://mevn-cart.netlify.app', 0, 'Mongo DB, Express, Vue, Node'],
    ['E - Commerce Single Page Application', '', 'https://github.com/Freeman-md/djackets', 'https://djackets-vue.netlify.app', 1, 'Django, Django REST Framework, Vue'],
    ['HIOS Notepad and Todo Application Clone - SPA', '', 'https://github.com/Freeman-md/notepad', 'https://vue-ts-notepad.netlify.app', 1, 'Vue, TypeScript, Vuetify, Firebase'],
    ['Madam Boutique Online Store ', 'Madam Boutique is a sophisticated complete e-commerce application using HTML, CSS & JS', 'https://github.com/Freeman-md/madam-boutique', 'https://js-commerce.netlify.app', 1, 'HTML, CSS, Bootstrap 4, JavaScript, Jquery'],
    ['Todo Application using React JS', '', 'https://github.com/Freeman-md/react-todos', 'https://react-bootstrap5-todos.netlify.app', 0, 'React JS, Bootstrap 5']]

        for ($i = 0; $i < count($projects); $i++) {
            Project::create([
                'title' => $projects[$i][0],
                'description' => $projects[$i][1],
                'github' => $projects[$i][2],
                'live' => $projects[$i][3],
                'star' => $projects[$i][4],
                'stacks' => $projects[$i][]
            ]);
        }
    }
}
