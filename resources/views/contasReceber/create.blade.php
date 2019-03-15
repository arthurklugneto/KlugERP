@extends('layouts.application') @section('content')
<div class="m-content">
    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet m-portlet--metal m-portlet--head-solid-bg">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--font-transform-u" style="color:#302B3E;">
                                <i class="la la-plus-circle"></i><span style="margin:24px;">Contas a Receber</span>
                            </span>
                            <h3 class="m-portlet__head-text m--font-primary ">
                            <a href="{{ URL::to('contasReceber') }}" class="m-portlet__nav-link btn btn-danger m-btn m-btn--air">
                                    Cancelar
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                {{ Form::open(array('url' => 'contasReceber')) }}
					
					<div class="row">
						
						<div class="col-md-4">
							<div class="form-group">
								{{ Form::label('cliente_id', 'Cliente') }}
								{{ Form::select('cliente_id', $clientes, null, array('class' => 'form-control selectpicker')) }}
							</div>
						</div>
					</div>
					
					<div class="row">
						
						<div class="col-md-4">
							<div class="form-group">
								{{ Form::label('dataEmissao', 'Data Emissão')}}							
								{{ Form::text('dataEmissao', Input::old('dataEmissao'), array('class' =>'form-control date-picker')) }}
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="form-group">
								{{ Form::label('dataVencimento', 'Data Vencimento')}}							
								{{ Form::text('dataVencimento', Input::old('dataVencimento'), array('class' =>'form-control date-picker')) }}
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="form-group">
								{{ Form::label('dataRecebimento', 'Data Recebimento')}}							
								{{ Form::text('dataRecebimento', Input::old('dataRecebimento'), array('class' =>'form-control date-picker')) }}
							</div>
						</div>
						
						
					</div>
					
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								{{ Form::label('descricao', 'Descrição')}}							
								{{ Form::text('descricao', Input::old('descricao'), array('class' =>'form-control')) }}
							</div>
						</div>
					
						<div class="col-md-4">
							<div class="form-group">
								{{ Form::label('planoContas', 'Plano de Contas') }}
								{{ Form::select('planoContas', $planoContas, null, array('class' => 'form-control selectpicker')) }}
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								{{ Form::label('valorOriginal', 'Valor Original')}}							
								{{ Form::number('valorOriginal', 0, array('class' =>'form-control','step'=>'any','min'=>'0')) }}
							</div>
						</div>
							
						<div class="col-md-4">
							<div class="form-group">
								{{ Form::label('valorLiquido', 'Valor Líquido')}}							
								{{ Form::number('valorLiquido', 0, array('class' =>'form-control','step'=>'any','min'=>'0')) }}
							</div>
						</div>
							
						<div class="col-md-4">
							<div class="form-group">
								{{ Form::label('valorRecebido', 'Valor Recebido')}}							
								{{ Form::number('valorRecebido', 0, array('class' =>'form-control','step'=>'any','min'=>'0')) }}
							</div>
						</div>
							
					</div>			
					
					
					
				{{ Form::submit('Recebimentos', array('class' => 'btn btn-primary')) }} 
				{{ Form::close() }}

                <script>
                    $(document).ready(function() {
                        $.noConflict();
                        var date = new Date();
                        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                        var date = $('#dataEmissao,#dataVencimento,#dataRecebimento').datepicker({
                                format: 'yyyy-mm-dd',
                                todayHighlight: true,
                                orientation:"bottom left",
                                templates:{leftArrow:'<i class="la la-angle-left"></i>',
                                rightArrow:'<i class="la la-angle-right"></i>'
                            }});
                        $('#dataEmissao,#dataVencimento').datepicker( 'setDate', today );
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

