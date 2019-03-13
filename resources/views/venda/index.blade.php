@extends('layouts.application') @section('content')
<div class="m-content">
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
                                <i class="la la-cart-plus"></i><span style="margin:24px;">Vendas</span>
                            </span>
                            <h3 class="m-portlet__head-text m--font-primary ">
                            <a href="{{ URL::to('venda/create') }}" class="m-portlet__nav-link btn btn-dark m-btn m-btn--air">
                                    Nova Venda
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                <table
					class="table table-striped table-bordered table-hover table-checkable order-column"
					id="registros">
					<thead>
						<tr>
							<th>#</th>
							<th>Situação</th>
							<th>Cliente</th>
							<th>Valor</th>
							<th>Valor Recebido</th>
							<th>Observações</th>
							<th>Data de Venda</th>
							<th>Data de Criação</th>
							<th>Editar</th>
							<th>Apagar</th>							
						</tr>
					</thead>
					<tbody>
						@foreach($vendas as $key => $value)
						<tr class="odd gradeX">
							<td>{{ $value->id  }}</td>
							@if( $value->situacao == 'aberta' )
							<td>
                                <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">
									aberto
								</span>
                            </td>
							@elseif( $value->situacao == 'finalizada' )
							<td>
                                <span class="m-badge m-badge--success m-badge--wide m-badge--rounded">
									finalizada
								</span>
                            </td>
							@else
							<td>
                                <span class="m-badge m-badge--warning m-badge--wide m-badge--rounded">
									incompleta
								</span>
                            </td>
							@endif
							<td>{{$value->cliente->nome}}</td>
							<td>{{$value->valor}}</td>
							<td>{{$value->valorRecebido}}</td>
							<td>{{$value->observacoes}}</td>
							<td>{{$value->dataVenda}}</td>
							<td>{{$value->created_at}}</td>
							<td>
								<a href="{{ URL::to('venda/'.$value->id.'/edit') }}"
									class="btn btn-square btn-md blue btn-success"> Editar
								</a>
							</td>
							<td>
							{{ Form::open(array('url' => 'venda/' . $value->id, 'class' => 'pull-right')) }}
                    			{{ Form::hidden('_method', 'DELETE') }}
                    			{{ Form::submit('Apagar', array('class' => 'btn btn-danger')) }}
                			{{ Form::close() }}
							</td>
							
						</tr>
						@endforeach
					</tbody>
				</table>
                        <script>
                        $(document).ready(function() {
                            $.noConflict();
                            var table = $('#registros').DataTable();
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection