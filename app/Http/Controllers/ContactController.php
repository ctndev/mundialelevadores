<?php

namespace App\Http\Controllers;

use App\Jobs\SendContactFormMailJob;
use App\Models\Contact;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'telefone' => ['required', 'string', 'max:50'],
            'mensagem' => ['nullable', 'string', 'max:5000'],
            'produto' => ['nullable', 'string', 'max:255'],
            'pagina' => ['nullable', 'string', 'max:255'],
        ], [
            'nome.required' => 'Informe o seu nome.',
            'telefone.required' => 'Informe o telefone ou WhatsApp.',
        ]);

        $message = trim((string) ($validated['mensagem'] ?? ''));

        $contact = Contact::query()->create([
            'name' => trim($validated['nome']),
            'phone' => trim($validated['telefone']),
            'message' => $message !== '' ? $message : null,
            'product' => filled($validated['produto'] ?? null) ? trim((string) $validated['produto']) : null,
            'page' => filled($validated['pagina'] ?? null) ? trim((string) $validated['pagina']) : null,
        ]);

        if (SiteSetting::contactNotificationEmails() !== []) {
            SendContactFormMailJob::dispatch($contact);
        }

        return response()->json(['ok' => true]);
    }
}
