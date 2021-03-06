<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
		<title>KlugERP</title>
        <meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
        <link href="/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="/assets/demo/default/media/img/logo/favicon.ico" />

        <!-- DataTable -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

        <!-- Datepicker -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>


    </head>

    <body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- BEGIN: Header -->
			<header id="m_header" class="m-grid__item    m-header "  m-minimize-offset="200" m-minimize-mobile-offset="200" >
				<div class="m-container m-container--fluid m-container--full-height">
					<div class="m-stack m-stack--ver m-stack--desktop">
						<!-- BEGIN: Brand -->
						<div class="m-stack__item m-brand  m-brand--skin-dark ">
							<div class="m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-stack__item--middle m-brand__logo">
									<a href="index.html" class="m-brand__logo-wrapper">
										<img alt="" src="/assets/demo/default/media/img/logo/logo_default_dark.png"/>
									</a>
								</div>
								<div class="m-stack__item m-stack__item--middle m-brand__tools">
									<!-- BEGIN: Left Aside Minimize Toggle -->
									<a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block 
					 ">
										<span></span>
									</a>
									<!-- END -->
							<!-- BEGIN: Responsive Aside Left Menu Toggler -->
									<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>
									<!-- END -->
							<!-- BEGIN: Responsive Header Menu Toggler -->
									<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>
									<!-- END -->
			<!-- BEGIN: Topbar Toggler -->
									<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
										<i class="flaticon-more"></i>
									</a>
									<!-- BEGIN: Topbar Toggler -->
								</div>
							</div>
						</div>
						<!-- END: Brand -->
						<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
							<!-- BEGIN: Horizontal Menu -->
							<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
								<i class="la la-close"></i>
							</button>
							<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
								
							</div>
                            <!-- END: Horizontal Menu -->								
                            <!-- BEGIN: Topbar -->
							
							<!-- END: Topbar -->
						</div>
					</div>
				</div>
			</header>
			<!-- END: Header -->		
		<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
					<i class="la la-close"></i>
				</button>
				<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
					<!-- BEGIN: Aside Menu -->
                        <div 
                            id="m_ver_menu" 
                            class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
                            m-menu-vertical="1"
                            m-menu-scrollable="0" m-menu-dropdown-timeout="500"  
                            >
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
							<li class="m-menu__section">
								<h3 class="m-menu__section-text">
									Menu Principal
								</h3>
								<i class="m-menu__section-icon flaticon-more-v3"></i>
                            </li>
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                <a  href="/" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon la la-home"></i>
									<span class="m-menu__link-text">
										Início
									</span>
								</a>
							</li>
                            @if (Auth::user())
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                <a  href="/home" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon la la-user-plus"></i>
									<span class="m-menu__link-text">
										Administrativo
									</span>
								</a>
							</li>
                            @else
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                <a  href="/login" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon la la-external-link-square"></i>
									<span class="m-menu__link-text">
										Entrar
									</span>
								</a>
							</li>
                            @endif	
                            <li class="m-menu__section">
								<h3 class="m-menu__section-text">
									Cadastros
								</h3>
								<i class="m-menu__section-icon flaticon-more-v3"></i>
                            </li>
                            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
								<a  href="javascript:;" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon la la-gift"></i>
									<span class="m-menu__link-text">
										Produtos
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu ">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">										
										<li class="m-menu__item " aria-haspopup="true" >
											<a  href="/categoriasProduto" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Categoria de Produtos
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true" >
											<a  href="/produto" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Produtos
												</span>
											</a>
										</li>
									</ul>
								</div>
							</li>
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                <a  href="/cliente" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon la la-user"></i>
									<span class="m-menu__link-text">
										Clientes
									</span>
								</a>
							</li>
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                <a  href="/fornecedor" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon la la-users"></i>
									<span class="m-menu__link-text">
										Fornecedores
									</span>
								</a>
							</li>
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                <a  href="/planoContas" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon la la-file-archive-o"></i>
									<span class="m-menu__link-text">
										Plano de Contas
									</span>
								</a>
							</li>
                            <li class="m-menu__section">
								<h3 class="m-menu__section-text">
									Movimentos
								</h3>
								<i class="m-menu__section-icon flaticon-more-v3"></i>
                            </li>
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                <a  href="/compra" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon la 	la-cart-arrow-down"></i>
									<span class="m-menu__link-text">
										Compras
									</span>
								</a>
							</li>
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                <a  href="/venda" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon la 	la-cart-plus"></i>
									<span class="m-menu__link-text">
										Vendas
									</span>
								</a>
							</li>
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                <a  href="/estoque" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon la la-delicious"></i>
									<span class="m-menu__link-text">
										Estoque
									</span>
								</a>
							</li>
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                <a  href="/pedido" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon la la-gavel"></i>
									<span class="m-menu__link-text">
										Pedidos
									</span>
								</a>
							</li>
                            <li class="m-menu__section">
								<h3 class="m-menu__section-text">
									Financeiro
								</h3>
								<i class="m-menu__section-icon flaticon-more-v3"></i>
                            </li>
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                <a  href="/contasPagar" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon la la-minus-circle"></i>
									<span class="m-menu__link-text">
										Contas a Pagar
									</span>
								</a>
							</li>
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                <a  href="/contasReceber" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon la la-plus-circle"></i>
									<span class="m-menu__link-text">
										Contas a Receber
									</span>
								</a>
							</li>
                            <li class="m-menu__section">
								<h3 class="m-menu__section-text">
									Relatórios
								</h3>
								<i class="m-menu__section-icon flaticon-more-v3"></i>
                            </li>
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                                <a  href="/relatorio" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon la la-newspaper-o"></i>
									<span class="m-menu__link-text">
										Gerar Relatório
									</span>
								</a>
							</li>
                            <li class="m-menu__section">
								<h3 class="m-menu__section-text">
									Versão 1.0.01 TCC
								</h3>
								<i class="m-menu__section-icon flaticon-more-v3"></i>
                            </li>
						</ul>
					</div>
					<!-- END: Aside Menu -->
				</div>
				<!-- END: Left Aside -->
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<!-- END: Subheader -->
					
                        @yield('content')
					
				</div>
			</div>
			<!-- end:: Body -->
            <!-- begin::Footer -->
			<footer class="m-grid__item		m-footer ">
				<div class="m-container m-container--fluid m-container--full-height m-page__container">
					<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
						<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
							<span class="m-footer__copyright">
								2019 &copy; Arthur Klug Neto
							</span>
						</div>
					</div>
				</div>
			</footer>
			<!-- end::Footer -->
		</div>
		<!-- end:: Page -->
    	   
	    <!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>
		<!-- end::Scroll Top -->

		<script src="/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
		<script src="/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>

        
	</body>

</html>