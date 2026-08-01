<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfferIntro;
use Illuminate\Http\Request;

class OfferIntroController extends Controller
{
    public function edit()
    {
        $offerIntro = OfferIntro::firstOrFail();

        return view('admin.offer-intro.form', compact('offerIntro'));
    }

    public function update(Request $request)
    {
        $offerIntro = OfferIntro::firstOrFail();

        $validated = $request->validate([
            'sub_title' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required'],
        ]);

        $offerIntro->update($validated);

        return redirect()
            ->route('admin.offer-intro.edit')
            ->with('success', 'Data updated successfully.');
    }
}
