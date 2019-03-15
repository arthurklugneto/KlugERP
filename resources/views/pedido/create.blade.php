@extends('layouts.application') @section('content')
<div class="m-content">
    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet m-portlet--metal m-portlet--head-solid-bg">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--font-transform-u" style="color:#302B3E;">
                                <i class="la la-gavel"></i><span style="margin:24px;">Novo Pedido</span>
                            </span>
                            <h3 class="m-portlet__head-text m--font-primary ">
                            <a href="{{ URL::to('pedido') }}" class="m-portlet__nav-link btn btn-danger m-btn m-btn--air">
                                    Cancelar
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                {{ Form::open(array('url' => 'pedido')) }}
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">{{ Form::label('cliente_id', 'Cliente') }}
								{{ Form::select('cliente_id', $clientes, null, array('class' =>
								'form-control selectpicker')) }}</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								{{ Form::label('dataVenda', 'Data Pedido')}}							
								{{ Form::text('dataVenda', Input::old('dataVenda'), array('class'	=>'form-control date-picker')) }}
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								{{ Form::label('observacoes', 'Observações') }} 
								{{ Form::text('observacoes', Input::old('observacoes'), array('class' =>'form-control')) }}
							</div>
						</div>
					</div>					
					
					
					
				{{ Form::submit('Iniciar Pedido', array('class' => 'btn btn-primary')) }} {{
				Form::close() }}
                <script>
                $(document).ready(function() {
                    var date = new Date();
                    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                    $.noConflict();
                    var date = $('#dataVenda').datepicker({
                            format: 'yyyy-mm-dd',
                            todayHighlight: true,
                            orientation:"bottom left",
                            templates:{leftArrow:'<i class="la la-angle-left"></i>',
                            rightArrow:'<i class="la la-angle-right"></i>'
                        }});
                    $('#dataVenda').datepicker( 'setDate', today );
                });
                </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection