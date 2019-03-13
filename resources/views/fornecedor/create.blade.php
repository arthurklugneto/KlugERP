@extends('layouts.application') @section('content')
<div class="m-content">
    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet m-portlet--metal m-portlet--head-solid-bg">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--font-transform-u" style="color:#302B3E;">
                                <i class="flaticon-users"></i><span style="margin:24px;">Fornecedor</span>
                            </span>
                            <h3 class="m-portlet__head-text m--font-primary ">
                            <a href="{{ URL::to('fornecedor') }}" class="m-portlet__nav-link btn btn-danger m-btn m-btn--air">
                                    Cancelar
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                <!-- VALIDATIONS ERRORS----------------------------- -->
                <div class="row">
                    <div class="col-md-12">{{ Html::ul($errors->all()) }}</div>
                </div>
                {{ Form::open(array('url' => 'fornecedor')) }}

				<div class="form-group">{{ Form::label('nome', 'Nome') }} {{
					Form::text('nome', Input::old('nome'), array('class'
					=>'form-control')) }}</div>

				<div class="form-group">{{ Form::label('cnpjcpf', 'CNPJ / CPF') }}
					{{ Form::text('cnpjcpf', Input::old('cnpjcpf'), array('class'
					=>'form-control')) }}</div>

				<div class="form-group">{{ Form::label('ierg', 'Inscrição Estadual /
					RG') }} {{ Form::text('ierg', Input::old('ierg'), array('class'
					=>'form-control')) }}</div>

				<div class="form-group">{{ Form::label('endereco', 'Endereço') }} {{
					Form::text('endereco', Input::old('endereco'), array('class'
					=>'form-control')) }}</div>

				<div class="form-group">{{ Form::label('numero', 'Número') }} {{
					Form::text('numero', Input::old('numero'), array('class'
					=>'form-control')) }}</div>

				<div class="form-group">{{ Form::label('cep', 'CEP') }} {{
					Form::text('cep', Input::old('cep'), array('class'
					=>'form-control')) }}</div>

				<div class="form-group">{{ Form::label('bairro', 'Bairro') }} {{
					Form::text('bairro', Input::old('bairro'), array('class'
					=>'form-control')) }}</div>

				<div class="form-group">{{ Form::label('cidade', 'Cidade') }} {{
					Form::text('cidade', Input::old('cidade'), array('class'
					=>'form-control')) }}</div>

				<div class="form-group">{{ Form::label('estado', 'Estado') }} {{
					Form::text('estado', Input::old('estado'), array('class'
					=>'form-control')) }}</div>

				<div class="form-group">{{ Form::label('complemento', 'Complemento')
					}} {{ Form::text('complemento', Input::old('complemento'),
					array('class' =>'form-control')) }}</div>

				<div class="form-group">{{ Form::label('contato', 'Contato') }} {{
					Form::text('contato', Input::old('contato'), array('class'
					=>'form-control')) }}</div>

				<div class="form-group">{{ Form::label('email', 'E-mail') }} {{
					Form::email('email', Input::old('email'), array('class'
					=>'form-control')) }}</div>

				<div class="form-group">{{ Form::label('telefone', 'Telefone') }} {{
					Form::text('telefone', Input::old('telefone'), array('class'
					=>'form-control')) }}</div>

				<div class="form-group">{{ Form::label('celular', 'Celular') }} {{
					Form::text('celular', Input::old('celular'), array('class'
					=>'form-control')) }}</div>

				<div class="form-group">{{ Form::label('observacoes', 'Observações')
					}} {{ Form::text('observacoes', Input::old('observacoes'),
					array('class' =>'form-control')) }}</div>

				{{ Form::submit('Gravar', array('class' => 'btn btn-primary')) }} {{
				Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
