<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    public function create() {
        return view('form');
    }

    public function store(Request $request) {
        $messages = [
            'last_name.required' => 'Merci de saisir votre nom.',
            'first_name.required' => 'Merci de saisir votre prénom.',
            'email.required' => 'L\'adresse e‑mail est requise.',
            'email.email' => 'Veuillez renseigner une adresse e‑mail valide.',
            'address.max' => 'L\'adresse est trop longue.',
            'cv.required' => 'Veuillez joindre votre CV en PDF.',
            'cv.mimes' => 'Le CV doit être au format PDF.',
            'cv.max' => 'Le CV ne doit pas dépasser 10 Mo.',
        ];

        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'cv' => 'required|file|mimes:pdf|max:10240',
        ], $messages);

        // Store the CV on the "public" disk (accessible via /storage/...)
        $cvPath = null;
        if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        Candidature::create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'address' => $validated['address'] ?? null,
            'cv_path' => $cvPath,
        ]);

        return redirect('/')->with('success', 'Candidature soumise avec succès !');
    }
}
