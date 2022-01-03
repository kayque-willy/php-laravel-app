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
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">My Blog</span>
            </div>
        </nav>
    </header>
    <main>
        <div class="container" style="width: 60%; padding-bottom: 30px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: white; padding-left: 0px;">
                    <li class="breadcrumb-item">
                        <!-- A notação @{..} retorna para URL anterior do Thymeleaf -->
                        <a href="..">Posts</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Posts</li>
                </ol>
            </nav>
            <article>
                <h1 class="card-title" style="font-weight: bold; margin-bottom: 20px;"><span>Exemplo de Post</span></h1>
                <p class="card-subtitle mb-2 text-muted">
                    <i class="material-icons">person_outline</i>
                    <span>Kayque</span>
                    <br>
                    <i class="material-icons">date_range</i>
                    <span>2021-12-30</span>
                </p>
                <section>
                    <p class="card-text" style="margin-top: 40px;"><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sagittis, mi ut congue suscipit, nisl justo lacinia lorem, at sollicitudin quam nunc ac lacus. Nam sit amet mi sem. Quisque nec molestie risus, vitae congue orci. Aliquam erat volutpat. Praesent porta arcu at sapien mattis, dictum efficitur nisi placerat. Donec eu eros et orci scelerisque semper. Quisque a eros massa. Vestibulum finibus, nisi a iaculis ornare, nulla lorem convallis augue, sed pellentesque justo odio ut sapien. Pellentesque magna nibh, iaculis mollis pulvinar et, varius non elit. Donec fringilla lobortis orci, id interdum sem. Duis consequat nisi odio, a cursus metus varius in. Phasellus at nunc metus. Donec lectus diam, sollicitudin et dapibus quis, faucibus quis ipsum. Pellentesque sollicitudin felis a arcu tempor bibendum. Cras tempor, augue vel interdum tincidunt, velit ante maximus libero, vel elementum diam augue et elit.</span></p>
                </section>
                <!-- A notação @{..} retorna para URL anterior do Thymeleaf -->
                <a href=".." class="btn btn-primary" role="button" style="margin-top: 10px;">Voltar</a>
            </article>
        </div>
    </main>

</html>