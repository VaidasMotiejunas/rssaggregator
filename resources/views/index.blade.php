<!doctype html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/app.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Rss Feed</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
        </style>
    </head>
    <body>

    <div id="app">
        <main-component
            :data="{{ json_encode($data) }}"
        ></main-component>
    </div>

    <script src="js/app.js">
    </script>
    </body>
</html>
