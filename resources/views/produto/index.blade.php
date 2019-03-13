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
                                <i class="flaticon-gift"></i><span style="margin:24px;">Produtos</span>
                            </span>
                            <h3 class="m-portlet__head-text m--font-primary ">
                            <a href="{{ URL::to('produto/create') }}" class="m-portlet__nav-link btn btn-dark m-btn m-btn--air">
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
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Estoque</th>
                                    <th>Preço Custo</th>							
                                    <th>Margem</th>
                                    <th>Preço Venda</th>
                                    <th>Categoria</th>							
                                    <th>Data Criação</th>
                                    <th style="width: 100px">Editar</th>
                                    <th style="width: 100px">Apagar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produtos as $key => $value)
                                <tr class="odd gradeX">
                                    <td><a href="{{ URL::to('produto/' . $value->produto->id ) }}" class="btn btn-square btn-sm btn-metal">{{ $value->id }}</a></td>
                                    <td>{{$value->produto->codigo}}</td>
                                    <td>{{$value->produto->nome}}</td>
                                    <td>{{$value->quantidade}}</td>
                                    <td>{{$value->produto->precoCusto}}</td>
                                    <td>{{$value->produto->margem}}</td>
                                    <td>{{$value->produto->precoVenda}}</td>
                                    <td>{{$value->produto->categoria->nome}}</td>
                                    <td>{{$value->produto->created_at}}</td>
                                    <td><a class="btn btn-small btn-success" href="{{ URL::to('produto/' . $value->produto->id . '/edit') }}">Editar</a></td>
                                    <td>
                                    {{ Form::open(array('url' => 'produto/' . $value->produto->id, 'class' => 'pull-right')) }}
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

