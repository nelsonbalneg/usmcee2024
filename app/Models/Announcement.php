<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Announcement extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'summary', 'content', 'content_format'];

    protected $casts = ['publish_at' => 'datetime', 'expire_at' => 'datetime'];

    public function scopeVisibleToStudents($query)
    {
        $now = now();

        return $query->whereIn('status', ['published', 'scheduled'])
            ->whereIn('visibility', ['public', 'students'])
            ->where(fn ($q) => $q->whereNull('publish_at')->orWhere('publish_at', '<=', $now))
            ->where(fn ($q) => $q->whereNull('expire_at')->orWhere('expire_at', '>', $now));
    }

    public function renderedContent(): string
    {
        if ($this->content_format === 'plain_text') {
            return nl2br(e($this->content ?? ''));
        }

        if ($this->content_format !== 'html') {
            return $this->connectImages(Str::markdown($this->content ?? '', ['html_input' => 'strip', 'allow_unsafe_links' => false]));
        }

        $document = new \DOMDocument();
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML('<?xml encoding="UTF-8"><body>'.($this->content ?? '').'</body>');
        libxml_clear_errors();
        libxml_use_internal_errors($previous);
        $allowed = ['p', 'br', 'strong', 'b', 'em', 'i', 'u', 's', 'h1', 'h2', 'h3', 'h4', 'ul', 'ol', 'li', 'blockquote', 'pre', 'code', 'a', 'img', 'table', 'thead', 'tbody', 'tr', 'th', 'td', 'hr'];
        foreach (iterator_to_array($document->getElementsByTagName('*')) as $element) {
            if (in_array($element->tagName, ['html', 'body'])) {
                continue;
            }
            if (!in_array($element->tagName, $allowed)) {
                $element->parentNode?->removeChild($element);
                continue;
            }
            foreach (iterator_to_array($element->attributes) as $attribute) {
                if ($element->tagName === 'img' && ($attribute->name === 'alt'
                    || ($attribute->name === 'src' && preg_match('~^(https?://|/(?!/))~i', $attribute->value)))) {
                    continue;
                }
                if ($element->tagName === 'a' && $attribute->name === 'href'
                    && preg_match('~^(https?://|mailto:|/|#)~i', $attribute->value)
                    && !str_starts_with($attribute->value, '//')) {
                    continue;
                }
                $element->removeAttribute($attribute->name);
            }
        }

        $body = $document->getElementsByTagName('body')->item(0);

        return $body ? $this->connectImages(implode('', array_map(fn ($node) => $document->saveHTML($node), iterator_to_array($body->childNodes)))) : '';
    }

    private function connectImages(string $html): string
    {
        if (!$this->id) {
            return $html;
        }

        return preg_replace_callback('~(<img\b[^>]*\bsrc=["\x27])(?:https?://[^/"\x27]+)?/(?:admin/)?announcements/(media|images)/([a-zA-Z0-9_-]+\.(?:png|jpe?g|gif|webp))(["\x27])~i',
            fn ($match) => $match[1].e(route('student.announcements.images', [
                'announcement' => $this->id, 'directory' => $match[2], 'filename' => $match[3],
            ])).$match[4], $html);
    }
}
