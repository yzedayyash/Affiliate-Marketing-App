<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseTransactions;



    public function test_user_login_redirect()
    {
        $response = $this->get('/');

        $response->assertStatus(302);

        $response->assertRedirect('login');

    }

    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get('/');
         $response->assertStatus(200);

    }

    public function test_user_login()
    {

        $email = time().'test2@test.com';
        $user = User::factory()->create(
            ['email' => $email ,
            ]
        );


        $response = $this->post('/login' , [
            'email' => $email,
            'password' => 'password'
        ]);
       $response->assertRedirect('/');




    }

    public function test_admin_login()
    {
        $email = time().'test2@test.com';
        $user = User::factory()->create(
            ['email' => $email ,

            'is_admin' => 1 ]
        );


        $response = $this->post('/login' , [
            'email' => $email,
            'password' => 'password'
        ]);
       $response->assertRedirect('/admin');
    }

    public function test_wrong_credentals_login()
    {
        $email = time().'test2@test.com';
        $user = User::factory()->create(
            ['email' => $email ,

            'is_admin' => 1 ]
        );


        $response = $this->post('/login' , [
            'email' => $email,
            'password' => 'password1'
        ]);
       $response->assertRedirect('/login');
    }


    public function test_user_enter_to_admin_area()
    {
        $email = time().'test2@test.com';
        $user = User::factory()->create(
            ['email' => $email ,]
        );


        $response = $this->post('/login' , [
            'email' => $email,
            'password' => 'password'
        ]);
       $response->assertRedirect('/');


       $response = $this->get('/admin');
       $response->assertStatus(404);


    }

    public function test_unauth_user_can_enter_to_user_area()
    {


        $email = time().'wrong@test.com';

        $response = $this->post('/login' , [
            'email' => $email,
            'password' => 'password'
        ]);
       $response->assertRedirect('/login');





    }


}
