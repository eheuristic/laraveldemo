<!DOCTYPE html>
<html>
    <head>
        <title>{{ Theme::place('title') }}</title>
        <meta charset="utf-8">
        <meta name="keywords" content="{{ Theme::place('keywords') }}">
        <meta name="description" content="{{ Theme::place('description') }}">
        {{ Theme::asset()->styles()}}
        {{ Theme::asset()->scripts()}}
    </head>
    <body>
        {{ Theme::partial('header') }}

        <div class="container">
            {{ Theme::content() }}
        </div>

        {{ Theme::partial('footer') }}

        {{ Theme::asset()->container('footer')->scripts() }}
    </body>
</html>