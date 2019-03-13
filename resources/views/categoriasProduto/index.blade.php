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
                                <i class="flaticon-gift"></i><span style="margin:24px;">Categorias de Produtos</span>
                            </span>
                            <h3 class="m-portlet__head-text m--font-primary ">
                            <a href="{{ URL::to('categoriasProduto/create') }}" class="m-portlet__nav-link btn btn-dark m-btn m-btn--air">
                                    Novo
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
							<th>Nome</th>
							<th>Data Criação</th>
							<th style="width: 100px">Editar</th>
							<th style="width: 100px">Apagar</th>
						</tr>
					</thead>
					<tbody>
						@foreach($categoriasProdutos as $key => $value)
						<tr class="odd gradeX">
							<td><a href="{{ URL::to('categoriasProduto/' . $value->id ) }}" class="btn btn-square btn-sm btn-metal">{{ $value->id }}</a></td>
							<td>{{ $value->nome }}</td>
							<td>{{ $value->created_at }}</td>
							<td><a class="btn btn-small btn-success" href="{{ URL::to('categoriasProduto/' . $value->id . '/edit') }}">Editar</a></td>
							<td>
							{{ Form::open(array('url' => 'categoriasProduto/' . $value->id, 'class' => 'pull-right')) }}
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
