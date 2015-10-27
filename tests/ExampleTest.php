<?php

use App\Task;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;


    public function test_tasks_are_displayed_on_the_dashboard()
    {
        factory(Task::class)->create(['name' => 'Task 1']);
        factory(Task::class)->create(['name' => 'Task 2']);
        factory(Task::class)->create(['name' => 'Task 3']);

        $this->visit('/')
             ->see('Task 1')
             ->see('Task 2')
             ->see('Task 3');
    }


    public function test_tasks_can_be_created()
    {
        $this->visit('/')->dontSee('Task 1');

        $this->visit('/')
            ->type('Task 1', 'name')
            ->press('Add Task')
            ->see('Task 1');
    }


    public function test_long_tasks_cant_be_created()
    {
        $this->visit('/')
            ->type(str_random(300), 'name')
            ->press('Add Task')
            ->see('Whoops!');
    }
}
