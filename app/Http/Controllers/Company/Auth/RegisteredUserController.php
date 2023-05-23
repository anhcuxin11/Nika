<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('company.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_no' => ['required', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone_company' => ['required', 'string', 'max:255'],
            'email_company' => ['required', 'string', 'email', 'max:255', 'unique:companies'],
            'fax_company' => ['required', 'string', 'max:255'],
            'name_person' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:companies'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        // dd($request->all());
        $company = Company::create([
            'company_no' => $request->company_no,
            'name' => $request->name,
            'address' => $request->address,
            'phone_company' => $request->phone_company,
            'email_company' => $request->email_company,
            'fax_company' => $request->fax_company,
            'name_person' => $request->name_person,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($company));

        Auth::guard('company')->login($company);

        return redirect()->route('company.dashboard');
    }
}
