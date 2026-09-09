# Mundial Elevadores

Monolito Laravel (site público + admin Filament).

## Local (Docker CTN)

1. No arquivo `hosts` do Windows, adicione:

   `127.0.0.1 mundialelevadores.local`

2. Recarregue o Nginx do Docker:

   `docker exec proxy nginx -s reload`

3. No projeto:

```bash
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

- Site: http://mundialelevadores.local
- Admin: http://mundialelevadores.local/ctn-admin
- Login: `yuri@ctn.dev.br` / `123456`

Banco padrão: SQLite (`database/database.sqlite`).

A pasta `project/` (Mobirise) permanece no repositório e não é usada pela aplicação.
