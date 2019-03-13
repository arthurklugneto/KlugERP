<!DOCTYPE html>
<html>
<head>
<title>Look! I'm CRUDding</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('nerds') }}">Aviso ao Desenvolvedor</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('nerds') }}">Ver Todos</a></li>
        <li><a href="{{ URL::to('nerds/create') }}">Criar Aviso</a>
        <li><a href="{{ URL::to('/') }}">Inicio</a>
    </ul>
</nav>

<h1>Edit {{ $nerd->name }}</h1>

<!-- if there are creation errors, they will show here -->
{{ Html::ul($errors->all()) }}

{{ Form::model($nerd, array('route' => array('nerds.update', $nerd->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Descrição') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Detalhe') }}
        {{ Form::text('email', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('nerd_level', 'Ação') }}
        {{ Form::select('nerd_level', 
        	array('0' => 'Selecione o Tipo', 
        			'1' => 'Quero isso no futuro', 
        			'2' => 'Arrume isso agora !!!'), 
        	Input::old('nerd_level'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Atualizar', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>