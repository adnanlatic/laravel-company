<?php

namespace Tests\Feature;

use App\Employee;
use App\Company;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
{
  /** @test */
  public function only_logged_user_can_see_employee_lists()
  {
      $response = $this->get('/employee');
      $response->assertRedirect('/');
  }
  /** @test */
  public function can_add_new_employee()
    {
      $this->withoutExceptionHandling();
      $company = factory(Company::class)->create();
      $employee = factory(Employee::class)->create([
        'firstName' => 'Adnan',
        'lastName' => 'Latic',
        'company_id' => $company->id,
        'email' => 'adnanlatic@gmail.com',
        'phone' => '+387 61 395 166'
      ]);
      $response = $this->post('/employee', $company->toArray());

      $response->assertStatus(302);
      $this->assertEquals('Adnan', Employee::where('id',$employee->id)->pluck('firstName')->first());
    }

    /** @test */
    public function can_update_the_employee()
    {
      $this->withoutExceptionHandling();
      $response = $this->post('/login', [
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);
      $company = factory(Company::class)->create();
      $employee = factory(Employee::class)->create([
          'firstName' => 'Adnan',
          'lastName' => 'Latic',
          'company_id' => $company->id,
          'email' => 'adnanlatic@gmail.com',
          'phone' => '+387 61 395 166'
        ]);
      $employee->firstName ='John';

      $response = $this->put('/employee/' . $employee->id, $employee->toArray());
      $response->assertStatus(302);
      $this->assertEquals('John', $employee->fresh()->firstName);
    }

    /** @test */
    public function can_delete_the_employee()
    {
      $response = $this->post('/login', [
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);
      $this->withoutExceptionHandling();
      $company = factory(Company::class)->create();
      $employee = factory(Employee::class)->create([
          'company_id' => $company->id
        ]);

      $this->assertEquals($employee->id, Employee::where('id',$employee->id)->pluck('id')->first());
      $this->delete('/employee/' . $employee->id);
      $this->assertEquals(0, Employee::where('id',$employee->id)->count());

    }
}
