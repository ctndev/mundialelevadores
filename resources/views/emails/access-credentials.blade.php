@extends('emails.layout')

@section('title', $isReset ? 'Sua senha de acesso foi redefinida' : 'Seu acesso ao painel')

@section('content')
    <h1 style="margin:0 0 8px;font-size:20px;line-height:1.3;">
        {{ $isReset ? 'Senha redefinida' : 'Bem-vindo ao painel' }}
    </h1>
    <p style="margin:0 0 16px;font-size:14px;line-height:1.5;">
        Olá, {{ $user->name }}.
        @if ($isReset)
            Uma nova senha temporária foi gerada para o seu acesso.
        @else
            Seu usuário de acesso foi criado.
        @endif
    </p>
    <p style="margin:0 0 8px;font-size:14px;color:#6b6b6b;">E-mail de acesso</p>
    <p style="margin:0 0 16px;font-size:16px;font-weight:700;">{{ $user->email }}</p>
    <p style="margin:0 0 8px;font-size:14px;color:#6b6b6b;">Senha temporária</p>
    <p style="margin:0 0 24px;font-size:28px;font-weight:800;letter-spacing:0.12em;">{{ $temporaryPassword }}</p>
    <p style="margin:0 0 16px;font-size:14px;line-height:1.5;">
        No primeiro acesso, você precisará trocar essa senha por uma senha segura,
        com no mínimo 10 caracteres, incluindo letras minúsculas, maiúsculas, números e símbolos.
    </p>
    <p style="margin:0;">
        <a href="{{ url('/ctn-admin/login') }}" style="display:inline-block;background:#0f6932;color:#ffffff;text-decoration:none;padding:12px 18px;border-radius:8px;font-size:14px;font-weight:700;">
            Acessar o painel
        </a>
    </p>
@endsection
