@extends('emails.layout')

@section('title', 'Novo contato pelo site')

@section('content')
    <h1 style="margin:0 0 8px;font-size:20px;line-height:1.3;">Novo contato pelo site</h1>
    <p style="margin:0 0 24px;font-size:14px;color:#6b6b6b;">
        Recebido em {{ $contact->created_at?->timezone(config('app.timezone'))->format('d/m/Y H:i') }}
    </p>

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;line-height:1.5;">
        <tr>
            <td style="padding:8px 0;border-bottom:1px solid #ececee;width:140px;color:#6b6b6b;vertical-align:top;">Nome</td>
            <td style="padding:8px 0;border-bottom:1px solid #ececee;vertical-align:top;">{{ $contact->name }}</td>
        </tr>
        <tr>
            <td style="padding:8px 0;border-bottom:1px solid #ececee;color:#6b6b6b;vertical-align:top;">Telefone</td>
            <td style="padding:8px 0;border-bottom:1px solid #ececee;vertical-align:top;">{{ $contact->phone }}</td>
        </tr>
        <tr>
            <td style="padding:8px 0;border-bottom:1px solid #ececee;color:#6b6b6b;vertical-align:top;">Produto</td>
            <td style="padding:8px 0;border-bottom:1px solid #ececee;vertical-align:top;">{{ $contact->product ?: '—' }}</td>
        </tr>
        <tr>
            <td style="padding:8px 0;border-bottom:1px solid #ececee;color:#6b6b6b;vertical-align:top;">Página</td>
            <td style="padding:8px 0;border-bottom:1px solid #ececee;vertical-align:top;">{{ $contact->page ?: '—' }}</td>
        </tr>
        <tr>
            <td style="padding:8px 0;color:#6b6b6b;vertical-align:top;">Mensagem</td>
            <td style="padding:8px 0;vertical-align:top;white-space:pre-wrap;">{{ $contact->message ?: '—' }}</td>
        </tr>
    </table>
@endsection
