<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

        @foreach($languages as $to)
            @foreach($letters as $letter)
                <url>
                    <loc>{{url('/dictionary')}}/{{$from}}-to-{{$to->slug}}?letter={{$letter->letters}}</loc>
                    <lastmod>{{ $letter->created_at->tz('UTC')->toAtomString() }}</lastmod>
                    <changefreq>weekly</changefreq>
                    <priority>0.8</priority>
                </url>
            @endforeach
        @endforeach

</urlset>