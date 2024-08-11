<?php

namespace Tests\Feature;

use App\Models\ClassType;
use App\Models\ScheduledClass;
use App\Models\User;
use Database\Seeders\ClassTypeSedeer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InstructorTest extends TestCase
{
    use RefreshDatabase;
    public function test_instructor_is_redirected_to_instructor_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'instructor',
        ]);
        $response = $this
            ->actingAs($user)
            ->get('/dashboard');

        $response->assertRedirect('/instructor/dashboard');
        $this->followRedirects($response)->assertSeeText('Hey Instructor');
    }

    public function test_instructor_can_schedule_a_class(): void
    {
        //Given
        $user = User::factory()->create([    //first thing we do is setup the invironment
            'role' => 'instructor',
        ]);

        $this->seed(ClassTypeSedeer::class);
        //When
        $response = $this->actingAs($user)  //then we take an action
            ->post('/instructor/schedule', [
                'class_type_id' => ClassType::first()->id,
                'date' => '2024-09-23',
                'time' => '11:00:00',

            ]);
        //Then
        $this->assertDatabaseHas(
            'scheduled_classes',
            [

                'class_type_id' => ClassType::first()->id,
                'date_time' => '2024-09-23 11:00:00',
            ]
        );
        $response->assertRedirectToRoute('schedule.index'); //finally we make assertions
    }




    public function test_instructor_can_cancel_class(): void
    {
        //Given
        $user = User::factory()->create([
            'role' => 'instructor',
        ]);



        $this->seed(ClassTypeSedeer::class);
        $scheduledClass = ScheduledClass::create([
            'instructor_id' => $user->id,
            'class_type_id' => ClassType::first()->id,
            'date_time' => '2024-09-23 12:00:00',
        ]);

        //When

        $response = $this->actingAs($user)
            ->delete('/instructor/schedule/' . $scheduledClass->id);

        //Then
        $this->assertDatabaseMissing(
            'scheduled_classes',
            [
                'id' => $scheduledClass->id,
            ]
        );

    }


    public function test_cannot_cancel_class_less_than_two_hours_before(): void
    {
        //Given
        $user = User::factory()->create([
            'role' => 'instructor',
        ]);



        $this->seed(ClassTypeSedeer::class);
        $scheduledClass = ScheduledClass::create([
            'instructor_id' => $user->id,
            'class_type_id' => ClassType::first()->id,
            'date_time' => now()->addHours(1)->minutes(0)->seconds(0),
        ]);

        //When
        $response = $this->actingAs($user)->get('instructor/schedule');
        $response->assertDontSeeText('Cancel');

        $response = $this->actingAs($user)
            ->delete('/instructor/schedule/' . $scheduledClass->id);
        
        //Then
        $this->assertDatabaseHas(
            'scheduled_classes',
            [
                'id' => $scheduledClass->id,
            ]
        );
    }
}
