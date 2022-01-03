<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyBlog</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-light bg-light">
            <span class="navbar-brand mb-0 h1" style="font-weight: bold;">MyCodeBlog</span>
        </nav>
    </header>
    <section>
        <div class="container" style="width: 70%;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: white; padding-left: 0px;">
                    <li class="breadcrumb-item">
                        <!-- A notação @{...}  permite gerar as URLs do Thymeleaf -->
                        <a href="posts">Posts</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Novo Post</li>
                </ol>
            </nav>
            <div>
                <form method="post" action="/newsApp">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group">
                        <input type="text" class="form-control" name="title" placeholder="Título *" id="title" value="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="subtitle" placeholder="Subtítulo *" id="subtitle" value="">
                    </div>
                    <input type="hidden" name="author_id" id="author_id" value="1">
                    <textarea id="description" type="text" class="form-control" name="description" placeholder="Texto *"></textarea>
                    <small class="form-text text-muted">(*) Campos obrigatórios</small>
                    <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Publicar</button>
                    <a href="/" class="btn btn-light" role="button" style="margin-top: 10px;">Cancelar</a>
                </form>
            </div>
        </div>
    </section>
</body>

</html>