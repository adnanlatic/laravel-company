<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Input;
use \Image;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // taking companies from database and passing to view index
        $companies = Company::paginate(10);
        return view('company.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // add new company view
        return view('company.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        // storing new company to database
        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
        if ($request->hasFile("logo")) {
            $image_temp = Input::file('logo');
            $extension = $image_temp->getClientOriginalName();
            $filename = time().'-'.$extension;
            $photo = 'storage/'. $filename;
            Image::make($image_temp)->save($photo);
            $company->logo = $filename;
        }
        $company->save();

        // sending email
        $maildata = [
          'title' => 'NEW COMPANY CREATED',
          'content' => 'Company '.$request->name.' has been added to database!'
        ];

        Mail::send('email.newCompany',$maildata, function($message){
            $message->to('adnanlatic@gmail.com', 'Adnan Latic')->subject('New company added!');
          });

        return redirect('/company');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        // finding company for editing from database
        $companyForEditing = Company::find($company->id);
        return view('company.edit',compact('companyForEditing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        // updating edited company
        $companyEdit = Company::find($company->id);
        $input = $request->all();
        if ($request->hasFile("logo")) {
            $image_temp = Input::file('logo');
            $extension = $image_temp->getClientOriginalName();
            $filename = time().'-'.$extension;
            $photo = 'storage/'. $filename;
            Image::make($image_temp)->save($photo);
            $input['logo'] = $filename;
        }else {
          // keep old photo
          $input['logo'] = $request->oldPhoto;
        }
        $companyEdit->update($input);
        return redirect('company');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        // deleting selected company
        Company::find($company->id)->delete();
        return redirect()->back()->with('flash_message_success','Deleted succesufully!');
    }
}
