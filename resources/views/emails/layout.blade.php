<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
</head>
<body style="margin:0;padding:0;background:#f7f6f3;font-family:Inter,Arial,sans-serif;color:#1b1b1b;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f7f6f3;padding:32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:560px;background:#ffffff;border-radius:12px;overflow:hidden;">
                    <tr>
                        <td style="background:#0f6932;padding:20px 28px;">
                            <p style="margin:0;font-size:16px;font-weight:700;color:#ffffff;">
                                {{ setting('site_name', config('app.name')) }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px;">
                            @yield('content')
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 28px;border-top:1px solid #ececee;font-size:12px;color:#6b6b6b;">
                            E-mail automático do site. Não responda esta mensagem.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
