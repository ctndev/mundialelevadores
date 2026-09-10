<?php

namespace App\Models;

use App\Support\SiteCache;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable([
    'slug',
    'title',
    'template',
    'is_published',
    'content',
    'body',
    'meta_title',
    'meta_description',
    'canonical',
    'og_title',
    'og_description',
    'og_image',
    'robots',
])]
class Page extends Model
{
    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'content' => 'array',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function isHome(): bool
    {
        return $this->slug === 'home' || $this->template === 'home';
    }

    public function publicUrl(): string
    {
        if ($this->isHome()) {
            return url('/');
        }

        return url('/'.ltrim($this->slug, '/'));
    }

    public function seoTitle(): string
    {
        return $this->meta_title ?: $this->title;
    }

    public function seoDescription(): ?string
    {
        return $this->meta_description;
    }

    public function seoCanonical(): string
    {
        return $this->canonical ?: $this->publicUrl();
    }

    public function section(string $key, mixed $default = []): mixed
    {
        return data_get($this->content, $key, $default);
    }

    protected static function booted(): void
    {
        static::saving(function (Page $page): void {
            $page->slug = Str::slug($page->slug);
        });

        static::saved(function (): void {
            SiteCache::flush();
        });
        static::deleted(function (): void {
            SiteCache::flush();
        });
    }
}
