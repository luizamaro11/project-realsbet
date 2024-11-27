<?php

namespace App\Http\Controllers;

use App\Models\Affiliates;
use App\Models\Commission;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use NumberFormatter;

class CommissionController extends Controller
{
    public function index(Request $request)
    {
        $affiliates = Affiliates::all(['id', 'name']);

        if ($request->commission_affiliate_id) {
            $commissions = Commission::where('affiliates_id', $request->commission_affiliate_id)->get();
        } else {
            $commissions = Commission::all();
        }

        foreach ($commissions as $commission) {
            $value = $commission->value;
            
            $formatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);
            $formattedValue = $formatter->formatCurrency($value, 'BRL');

            $commission->value = $formattedValue;
            $commission->affiliatesName = $commission->affiliates->name;
        }

        return Inertia::render('Commission/Index', [
            'commission' => $commissions, 'affiliates' => $affiliates
        ]);
    }

    public function create()
    {
        $affiliates = Affiliates::all(['id', 'name']);
        return Inertia::render('Commission/Create', ['affiliates' => $affiliates]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'value' => 'required',
            'date_commission' => 'required|date',
            'affiliates_id' => 'required'
        ]);

        Commission::create([
            'value' => $request->value,
            'date_commission' => $request->date_commission,
            'affiliates_id' => $request->affiliates_id
        ]);

        return redirect()->route('commission.index')
            ->with('success', 'Comissão adicionado com sucesso');
    }

    public function edit(Commission $commission)
    {
        $affiliates = Affiliates::all(['id', 'name']);
        return Inertia::render('Commission/Edit', [
            'commission' => $commission, 'affiliates' => $affiliates
        ]);
    }

    public function update(Commission $commission, Request $request): RedirectResponse
    {
        $request->validate([
            'value' => 'required',
            'date_commission' => 'required|date',
            'affiliates_id' => 'required'
        ]);

        $commission->update([
            'value' => $request->value,
            'date_commission' => $request->date_commission,
            'affiliates_id' => $request->affiliates_id,
        ]);

        return back();
    }

    public function destroy(Commission $commission): RedirectResponse
    {
        $commission->delete();
        return redirect()->route('commission.index');
    }
}
