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
                                <i class="la la-plus-circle"></i><span style="margin:24px;">Contas a Receber</span>
                            </span>
                            <h3 class="m-portlet__head-text m--font-primary ">
                            <a href="{{ URL::to('contasReceber/create') }}" class="m-portlet__nav-link btn btn-dark m-btn m-btn--air">
                                    Nova Conta
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
                                <th></th>
                                <th>Cliente</th>
                                <th>Emissão</th>
                                <th>Vencimento</th>
                                <th>Vl. Líquido</th>
                                <th>Vl. Recebido</th>
                                <th>Situação</th>
                                <th>Editar</th>
                                <th>Apagar</th>							
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contasReceber as $key => $value)
                            <tr class="odd gradeX">
                                <td>{{ $value->id  }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-focus btn-warning" data-toggle="modal" data-target="#m_modal_{{$key}}">
                                        <i class="flaticon-light"></i> <small> Detalhes</small>
                                    </button>
                                </td>
                                <td>{{ $value->cliente->nome}}</td>
                                <td>{{$value->dataEmissao}}</td>
                                <td>{{$value->dataVencimento}}</td>
                                <td>{{$value->valorLiquido}}</td>
                                <td>{{$value->valorRecebido}}</td>
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
                                <td>
                                    <a href="{{ URL::to('contasReceber/'.$value->id.'/edit') }}"
                                        class="btn btn-square btn-md blue btn-success"> Editar
                                    </a>
                                </td>
                                <td>
                                {{ Form::open(array('url' => 'contasReceber/' . $value->id, 'class' => 'pull-right')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Apagar', array('class' => 'btn btn-danger')) }}
                                {{ Form::close() }}
                                </td>
                                
                            </tr>

                            <div class="modal fade" id="m_modal_{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">
                                            <i class="flaticon-light"></i> Detalhes da Conta
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <small class="m--font-transform-u">cliente</small>
                                                    <h5>{{ $value->cliente->nome}}</h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <small class="m--font-transform-u">Situação</small>
                                                    @if( $value->situacao == 'aberta' )
                                                    <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">
                                                            aberto
                                                        </span>
                                                    @elseif( $value->situacao == 'finalizada' )
                                                    <span class="m-badge m-badge--success m-badge--wide m-badge--rounded">
                                                            finalizada
                                                        </span>
                                                    @else
                                                        <span class="m-badge m-badge--warning m-badge--wide m-badge--rounded">
                                                            incompleta
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <small class="m--font-transform-u">descrição</small>
                                                    <h5>{{ $value->descricao}}</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <small class="m--font-transform-u">plano de contas</small>
                                                    <h5>{{ $value->planoConta->nome}}</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <small class="m--font-transform-u">Data emissão</small>
                                                    <h5>{{ $value->dataEmissao}}</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <small class="m--font-transform-u">Data vencimento</small>
                                                    <h5>{{ $value->dataVencimento}}</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <small class="m--font-transform-u">Data pagamento</small>
                                                    <h5>{{ $value->dataPagamento}}</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <small class="m--font-transform-u">valor original</small>
                                                    <h5><small>R$</small>{{ number_format($value->valorOriginal, 2)}}</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <small class="m--font-transform-u">valor líquido</small>
                                                    <h5><small>R$</small>{{ number_format($value->valorLiquido, 2)}}</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <small class="m--font-transform-u">valor pago</small>
                                                    <h5><small>R$</small>{{ number_format($value->valorPago, 2)}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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