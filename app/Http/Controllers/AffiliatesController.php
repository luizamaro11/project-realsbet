<?php

namespace App\Http\Controllers;

use App\Models\Affiliates;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Inertia\Response;

class AffiliatesController extends Controller
{
    public function index()
    {
        return Inertia::render('Affiliates/Index', [
            'affiliates' => Affiliates::all()
        ]);
    }

    public function create()
    {
        return Inertia::render('Affiliates/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date_birth' => 'required|date',
            'email' => 'required|string|lowercase|email|max:255|unique:' . Affiliates::class,
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
        ]);

        Affiliates::create([
            'name' => $request->name,
            'date_birth' => $request->date_birth,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('affiliates.index')
            ->with('success', 'Afiliado adicionado com sucesso');
    }

    public function edit(Affiliates $affiliate)
    {
        return Inertia::render('Affiliates/Edit', ['affiliate' => $affiliate]);
    }

    public function update(Affiliates $affiliate, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date_birth' => ['required', 'date'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(Affiliates::class)->ignore($affiliate->id),
            ],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
        ]);

        $affiliate->update([
            'name' => $request->name,
            'date_birth' => $request->date_birth,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'user_id' => Auth::user()->id
        ]);

        return back();
    }

    public function destroy(Affiliates $affiliate, Request $request): RedirectResponse
    {
        $affiliate->delete();

        return redirect()->route('affiliates.index');
    }
}
