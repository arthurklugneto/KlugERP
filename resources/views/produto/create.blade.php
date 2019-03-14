@extends('layouts.application') @section('content')
<div class="m-content">
    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet m-portlet--metal m-portlet--head-solid-bg">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--font-transform-u" style="color:#302B3E;">
                                <i class="flaticon-gift"></i><span style="margin:24px;">Produtos</span>
                            </span>
                            <h3 class="m-portlet__head-text m--font-primary ">
                            <a href="{{ URL::to('produto') }}" class="m-portlet__nav-link btn btn-danger m-btn m-btn--air">
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
                {{ Form::open(array('url' => 'produto')) }}

					<div class="form-group">
					{{ Form::label('codigo', 'Código') }} 
					{{ Form::number('codigo',$proximoCodigo, array('class' =>'form-control','min'=>'1')) }}
					</div>
					
					<div class="form-group">
					{{ Form::label('codigoEan', 'Código de Barras') }} 
					{{ Form::text('codigoEan', Input::old('codigoEan'), array('class'	=>'form-control')) }}
					</div>

					<div class="form-group">
					{{ Form::label('nome', 'Nome') }} 
					{{ Form::text('nome', Input::old('nome'), array('class'	=>'form-control')) }}
					</div>
					
					<div class="form-group">
					{{ Form::label('precoCusto', 'Preço de Custo') }} 
					{{ Form::number('precoCusto', 0, array('class'	=>'form-control','step'=>'any','min'=>'0')) }}
					</div>
					
					<div class="form-group">
					{{ Form::label('precoVenda', 'Preço de Venda') }} 
					{{ Form::number('precoVenda', 0, array('class'=>'form-control','step'=>'any','min'=>'0')) }}
					</div>
					
					<div class="form-group">
					{{ Form::label('margem', 'Margem de Lucro') }} 
					{{ Form::number('margem', 0, array('class'	=>'form-control','step'=>'any','min'=>'0')) }}
					</div>
					
					<div class="form-group">
					{{ Form::label('categoria_id', 'Categoria') }} 
					{{ Form::select('categoria_id', $categorias, null, array('class' => 'form-control selectpicker')) }}
					</div>

				{{ Form::submit('Gravar', array('class' => 'btn btn-primary')) }} 
				{{ Form::close() }}                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
