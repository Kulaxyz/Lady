{{ Request::header('Content-Type : text/xml') }}
<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($posts as $post)
        <url>
            <loc>{{ route('show', $post->slug) }}</loc>
            <lastmod>{{ $post->updated_at->tz('GMT')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>1</priority>
        </url>
    @endforeach
    @foreach($tags as $tag)
            <url>
                <loc>{{ route('tag', $tag->slug) }}</loc>
                @if($tag->updated_at !== null)
                <lastmod>{{ $tag->updated_at->tz('GMT')->toAtomString() }}</lastmod>
                @endif
                <changefreq>monthly</changefreq>
                <priority>1</priority>
            </url>
    @endforeach
</urlset>
