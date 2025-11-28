<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Receita: {{ $recipe->title }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { margin-bottom: 0; }
        .section { margin-bottom: 20px; }
        .label { font-weight: bold; }
        ul { margin: 0; padding-left: 20px; }
    </style>
</head>
<body>
    <h1>{{ $recipe->title }}</h1>
    <div class="section">
        <span class="label">Categoria:</span> {{ $recipe->categoryName }}<br>
        <span class="label">Autor:</span> {{ $recipe->userName }}<br>
        <span class="label">Tempo de preparo:</span> {{ $recipe->preparationTimeMinutes ?? '-' }} minutos<br>
        <span class="label">Porções:</span> {{ $recipe->servings ?? '-' }}<br>
    </div>
    <div class="section">
        <span class="label">Ingredientes:</span>
        <ul>
            @foreach($recipe->ingredients ?? [] as $ingredient)
                <li>{{ $ingredient }}</li>
            @endforeach
        </ul>
    </div>
    <div class="section">
        <span class="label">Modo de preparo:</span>
        <ol>
            @foreach($recipe->steps as $step)
                <li>{{ $step }}</li>
            @endforeach
        </ol>
    </div>
</body>
</html>
