<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>

        
        
        @foreach($languages as $from)

            <loc>http://127.0.0.1:8000/language_site/{{$from->slug}}</loc>
            <lastmod>2022-08-02T10:49:26+00:00</lastmod>

            <loc>http://127.0.0.1:8000/word_site/{{$from->slug}}</loc>
            <lastmod>2022-08-02T10:49:26+00:00</lastmod>

            <loc>http://127.0.0.1:8000/letter_site/{{$from->slug}}</loc>
            <lastmod>2022-08-02T10:49:26+00:00</lastmod>

            <loc>http://127.0.0.1:8000/search_site/{{$from->slug}}</loc>
            <lastmod>2022-08-02T10:49:26+00:00</lastmod>

        @endforeach
    </sitemap>
</sitemapindex>