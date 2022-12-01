<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    @foreach($languages as $to)
        @foreach($meanings as $word)
            <url>
                <loc>{{url('/dictionary')}}/{{$from}}-to-{{$to->slug}}/{{$word->dictionary_name}}-meaning-in-{{$to->slug}}</loc>
                <lastmod>{{ $word->created_at->tz('UTC')->toAtomString() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endforeach

</urlset>