@extends('layouts.application') @section('content')
<div class="m-content">
    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet m-portlet--metal m-portlet--head-solid-bg">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--font-transform-u" style="color:#302B3E;">
                                <i class="la la-cart-arrow-down"></i><span style="margin:24px;">Compras <small>Editando</small></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    {{ Form::open(array('url' => 'compra/'.$compra->id.'/edit')) }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">{{ Form::label('produtos', 'Categoria') }}
                                {{ Form::select('produtos', $produtos, null, array('class' =>
                                'form-control selectpicker')) }}</div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">{{ Form::label('quantidade', 'Quantidade')
                                }} {{ Form::number('quantidade', Input::old('quantidade'),
                                array('class' =>'form-control','min'=>'0')) }}</div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">{{ Form::label('valor', 'Valor Unitário')
                                }} {{ Form::number('valor', Input::old('valor'), array('class'
                                =>'form-control','step'=>'any','min'=>'0')) }}</div>
                        </div>

                    </div>
                    {{ Form::submit('Adicionar Item', array('class' => 'btn
                    btn-primary')) }} {{ Form::close() }}
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nome</th>
                                        <th>Quantidade</th>
                                        <th>Valor</th>
                                        <th>Remover</th>
                                    </tr>
                                </thead>

                                @if( !empty( $comprasProdutos ) ) @foreach($comprasProdutos as $key
                                => $value)
                                <tbody>
                                    <tr>
                                        <td>{{ $value->produto->codigo }}</td>
                                        <td>{{ $value->produto->nome }}</td>
                                        <td>{{ $value->quantidade }}</td>
                                        <td>{{ $value->valor }}</td>
                                        <td>{{ Form::open(array('url' =>
                                            'compra/'.$value->id.'/removeItem')) }} {{
                                            Form::submit('Apagar', array('class' => 'btn btn-primary')) }}
                                            {{ Form::close() }}</td>
                                    </tr>
                                </tbody>
                                @endforeach @endif

                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light bordered">
                                <div class="portlet-body">{{ Form::open(array('url' =>
                                    'compra/'.$compra->id.'/finalizar')) }} {{ Form::submit('Finalizar
                                    Compra', array('class' => 'btn btn-primary')) }} {{ Form::close()
                                    }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

