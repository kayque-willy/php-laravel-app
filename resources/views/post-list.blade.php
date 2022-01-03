<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Blog</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

    <header>
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid text-center">
                <span class="navbar-brand mb-0 h1">News</span>
                <a href="/newsApp" class="btn btn-primary" role="button">Novo Post</a>
            </div>
        </nav>
    </header>

    <section>
        <div class="container" style="width: 60%; padding-bottom: 30px;">
            <h1 class="text-center">Exemplo de Aplicação Laravel PHP</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: white; padding-left: 0px;">
                    <li class="breadcrumb-item active" aria-current="page">Posts</li>
                </ol>
            </nav>
            @foreach ($data as $news)
            <div class="card shadow-sm bg-white rounded" style="margin-top: 20px;">
                <div class="card-body">
                    <p class="card-subtitle mb-2 text-muted" style="font-size: 0.8rem;">
                        <span>Id do autor: {{ $news['author_id'] }}</span>
                        <span>{{ $news['published_at'] }} </span>
                    </p>
                    <a href="/newsApp/{{$news['id']}}">
                        <h4 class="card-title" style="font-weight: bold; color: black; padding-top: 5px;">
                            <span>{{ $news['title'] }}</span>
                        </h4>
                    </a>
                    <h5 class="card-subtitle mb-2 text-muted" style="font-size: 0.8rem;">
                        <span>{{ $news['subtitle'] }}</span>
                    </h5>
                    <form method="post" action="/editNewsApp/{{ $news['id'] }}">
                        @csrf
                        @method('GET')
                        <button class="btn btn-primary" type="submit" name="action" value="edit">
                            Editar
                        </button>
                    </form>
                    <form method="post" action="/">
                        @csrf
                        @method('DELETE')
                        <input value="{{ $news['id'] }}" type="hidden" name="id">
                        <button class="btn btn-primary" type="submit">
                            Remover
                        </button>
                    </form>
                    <p class="card-text"><span>{{ $news['description'] }}</span></p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

</body>

</html>