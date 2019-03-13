@extends('layouts.application') 
@section('content')
<div class="m-content">
    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet m-portlet--metal m-portlet--head-solid-bg">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--font-transform-u" style="color:#302B3E;">
                                <i class="la la-file-text"></i><span style="margin:24px;">Relatórios</span>
                            </span>
                        </div>
                    </div>
                </div>
                    <div class="m-portlet__body">
                    <h6>Nos relatórios que possuem data, informe a data inicial um dia antes da data desejada.</h6>
                    <br>

<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-action-redo font-blue-hoki"></i> <span
						class="caption-subject font-blue-hoki"><h5 class="m--font-danger">Relatório de Saídas</h5></span>
				</div>
			</div>
			<div class="portlet-body">
			
				{{ Form::open(array('url' => '/relatorio/saidas')) }}
					
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<div class="form-group">
								{{ Form::label('dataInicial', 'Data Inicial')}}							
								{{ Form::text('dataInicial', Input::old('dataInicial'), array('class' =>'form-control date-picker')) }}
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<div class="form-group">
								{{ Form::label('dataFinal', 'Data Final')}}							
								{{ Form::text('dataFinal', Input::old('dataFinal'), array('class' =>'form-control date-picker')) }}
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<div class="form-group">
								{{ Form::submit('Gerar Excel', array('class' => 'btn btn-primary')) }}
							</div>
						</div>
					</div>
						
						
				</div>
				{{ Form::close() }}
			
			</div>
		</div>
	</div>
	
	<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-action-undo font-blue-hoki"></i> <span
						class="caption-subject font-blue-hoki"><h5 class="m--font-danger">Relatório de Entradas</h5> </span>
				</div>
			</div>
			<div class="portlet-body">
			
				{{ Form::open(array('url' => '/relatorio/entradas')) }}
					
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<div class="form-group">
								{{ Form::label('dataInicial', 'Data Inicial')}}							
								{{ Form::text('dataInicial', Input::old('dataInicial'), array('class' =>'form-control date-picker')) }}
							</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<div class="form-group">
								{{ Form::label('dataFinal', 'Data Final')}}							
								{{ Form::text('dataFinal', Input::old('dataFinal'), array('class' =>'form-control date-picker')) }}
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<div class="form-group">
								{{ Form::submit('Gerar Excel', array('class' => 'btn btn-primary')) }}
							</div>
						</div>
					</div>
						
						
				</div>
				{{ Form::close() }}

                <script>
                $(document).ready(function() {
                    $.noConflict();
                    var date = $('#dataInicial,#dataFinal').datepicker({
                            format: 'yyyy-mm-dd',
                            todayHighlight: true,
                            orientation:"bottom left",
                            templates:{leftArrow:'<i class="la la-angle-left"></i>',
                            rightArrow:'<i class="la la-angle-right"></i>'
                        }});
                });
                </script>
			
			</div>
		</div>
	</div>
	
	<div class="row">
	<div class="col-md-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-social-dropbox font-blue-hoki"></i> <span
						class="caption-subject font-blue-hoki"><h5 class="m--font-danger">Relatório de Estoque</h5> </span>
				</div>
			</div>
			<div class="portlet-body">
			
				{{ Form::open(array('url' => '/relatorio/estoque')) }}
					
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<div class="form-group">
								{{ Form::submit('Gerar Excel', array('class' => 'btn btn-primary')) }}
							</div>
						</div>
					</div>
						
				</div>
				{{ Form::close() }}
			
			</div>
		</div>
	</div>
                    </div>
                </div>
            </div>
        </div>
</div>





@endsection