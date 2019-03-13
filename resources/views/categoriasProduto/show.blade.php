@extends('layouts.application') @section('content')
<div class="m-content">
    <div class="row">
        <div class="col-md-12">
        <div class="m-portlet m-portlet--metal m-portlet--head-solid-bg">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--font-transform-u" style="color:#302B3E;">
                                <i class="flaticon-gift"></i><span style="margin:24px;">Categorias de Produto</span>
                            </span>
                            <h3 class="m-portlet__head-text m--font-primary ">
                            <a href="{{ URL::to('categoriasProduto') }}" class="m-portlet__nav-link btn btn-danger m-btn m-btn--air">
                                    Voltar
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group m-form__group">
                                <label for="example_input_full_name">
                                    <h6 class="m-section__heading">Identificador</h6>
                                </label>
                                <p class="m--font-transform-u">{{ $categoria->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group m-form__group">
                                <label for="example_input_full_name">
                                    <h6 class="m-section__heading">Nome</h6>
                                </label>
                                <p class="m--font-transform-u">{{ $categoria->nome }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection
	
