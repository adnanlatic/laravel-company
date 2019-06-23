<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Company;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
  /** @test */
  public function only_logged_user_can_see_company_lists()
  {
      $response = $this->get('/company');
      $response->assertRedirect('/');
  }
  /** @test */
  public function can_add_new_company()
    {
      $this->withoutExceptionHandling();
      $companyName = 'Apple';
      $company = factory(Company::class)->create([
        'name' => $companyName,
        'email' => 'info@apple.com',
        'website' => 'www.apple.com'
      ]);
      $response = $this->post('/company', $company->toArray());

      $response->assertStatus(302);
      $this->assertEquals($companyName, Company::where('id',$company->id)->pluck('name')->first());
    }

    /** @test */
    public function can_update_the_company()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/login', [
              'email' => 'admin@admin.com',
              'password' => 'password',
          ]);
        $companyName = 'LG';
        $company = factory(Company::class)->create([
          'name' => $companyName,
          'email' => 'info@lg.com',
          'website' => 'www.lg.com'
        ]);
        $company->name ='IBM';

        $response = $this->put('/company/' . $company->id, $company->toArray());
        $response->assertStatus(302);
        $this->assertEquals('IBM', Company::where('id',$company->id)->pluck('name')->first());

    }

    /** @test */
    public function can_delete_the_company()
    {
      $response = $this->post('/login', [
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);
      $this->withoutExceptionHandling();
      $company = factory(Company::class)->create();

      $this->assertEquals($company->id, Company::where('id',$company->id)->pluck('id')->first());
      $this->delete('/company/' . $company->id);
      $this->assertEquals(0, Company::where('id',$company->id)->count());

    }

}
