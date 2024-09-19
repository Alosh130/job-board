<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class EmployerController extends \Illuminate\Routing\Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;
    public function __construct(){
        $this->authorizeResource(Employer::class);
    }
    public function create()
    {
        return view('employer.create');
    }
    public function store(Request $request)
    {
        auth()->user()->employer()->create(
            $request->validate([
                'company_name' => 'required|min:3|unique:employers,company_name'
            ])
        );

        return redirect()->route('jobs.index')
        ->with('success','Your Employer Account was Created!');
    }
}
