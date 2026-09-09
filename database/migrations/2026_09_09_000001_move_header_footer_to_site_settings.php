<?php

use App\Support\LayoutContent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $home = DB::table('pages')->where('slug', 'home')->first();
        $content = $home ? json_decode((string) $home->content, true) : null;

        $this->setSetting('header', is_array($content['header'] ?? null) ? $content['header'] : LayoutContent::header());
        $this->setSetting('footer', is_array($content['footer'] ?? null) ? $content['footer'] : LayoutContent::footer());

        foreach (DB::table('pages')->get() as $page) {
            $pageContent = json_decode((string) $page->content, true);

            if (! is_array($pageContent)) {
                continue;
            }

            unset($pageContent['header'], $pageContent['footer']);

            DB::table('pages')->where('id', $page->id)->update([
                'content' => json_encode($pageContent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            ]);
        }

        Cache::forget('site_settings');
    }

    public function down(): void
    {
        DB::table('site_settings')->whereIn('key', ['header', 'footer'])->delete();

        Cache::forget('site_settings');
    }

    /**
     * @param  array<string, mixed>  $value
     */
    private function setSetting(string $key, array $value): void
    {
        $now = now();
        $encoded = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $updated = DB::table('site_settings')
            ->where('key', $key)
            ->update(['value' => $encoded, 'updated_at' => $now]);

        if ($updated === 0) {
            DB::table('site_settings')->insert([
                'key' => $key,
                'value' => $encoded,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
};
