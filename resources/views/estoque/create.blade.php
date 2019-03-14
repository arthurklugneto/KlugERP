@extends('layouts.application') @section('content')
<div class="m-content">
    @if (Session::has('messageErro'))
    <div class="row">
        <div class="col-md-12">
            <div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                <strong>
                    Feito.
                </strong>
                {{ Session::get('messageErro') }}.
            </div>
        </div>
    </div>
    @endif
    @if (Session::has('message'))
    <div class="row">
        <div class="col-md-12">
            <div class="m-alert m-alert--outline alert alert-info alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                <strong>
                    Feito.
                </strong>
                {{ Session::get('message') }}.
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet m-portlet--metal m-portlet--head-solid-bg">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--font-transform-u" style="color:#302B3E;">
                                <i class="flaticon-squares-4"></i><span style="margin:24px;">Lançamento de Estoque</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                {{ Form::open(array('url' => 'estoque')) }}
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">{{ Form::label('produtos', 'Produto') }}
							{{ Form::select('produtos', $produtos, null, array('class' =>
							'form-control selectpicker')) }}</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">{{ Form::label('tipo', 'Tipo Movimento')
							}} {{ Form::select('tipo', array('entrada' => 'Entrada', 'saida'
							=> 'Saida'), 'entrada',array('class' => 'form-control selectpicker')) }}</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">{{ Form::label('quantidade', 'Quantidade')
							}} {{ Form::number('quantidade', Input::old('quantidade'),
							array('class'=>'form-control m-input','min'=>'0')) }}</div>
					</div>
				</div>
				{{ Form::submit('Movimentar', array('class' => 'btn btn-primary'))
				}} {{ Form::close() }}
                </div>
                </div>
            </div>
        </div>
</div>
@endsection

<!-- data-live-search="true"-->