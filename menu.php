<?php

	echo '
	<div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    
			<div class="sb-sidenav-menu">
	            <div class="nav">
	                <div class="sb-sidenav-menu-heading">Menu Principal</div>
	                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"
	                    ><div class="sb-nav-link-icon"><i class="fa fa-columns"></i></div>
	                    Categoria Produto
	                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div
	                ></a>
	                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	                    <nav class="sb-sidenav-menu-nested nav">
							<a class="nav-link" href="categoria-lista.php">Lista</a>
							<a class="nav-link" href="categoria-novo.php">Novo</a></nav>
	                </div>
	                

	                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsProd" aria-expanded="false" aria-controls="collapseLayoutsProd"
	                    ><div class="sb-nav-link-icon"><i class="fa fa-tasks"></i></div>
	                    Produto
	                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div
	                ></a>
	                <div class="collapse" id="collapseLayoutsProd" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	                    <nav class="sb-sidenav-menu-nested nav">
	                        <a class="nav-link" href="produto-lista.php">Lista</a>
	                        <a class="nav-link" href="produto-novo.php">Novo</a></nav>
	                </div>
			
	                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsFunc" aria-expanded="false" aria-controls="collapseLayoutsFunc"
	                    ><div class="sb-nav-link-icon"><i class="fa fa-tasks"></i></div>
	                    Funcionário
	                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div
	                ></a>
	                <div class="collapse" id="collapseLayoutsFunc" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	                    <nav class="sb-sidenav-menu-nested nav">
	                        <a class="nav-link" href="funcionario-lista.php">Lista</a>
	                        <a class="nav-link" href="funcionario-novo.php">Novo</a></nav>
	                </div>
			
	                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsMesa" aria-expanded="false" aria-controls="collapseLayoutsMesa"
	                    ><div class="sb-nav-link-icon"><i class="fa fa-tasks"></i></div>
	                    Mesa
	                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div
	                ></a>
	                <div class="collapse" id="collapseLayoutsMesa" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	                    <nav class="sb-sidenav-menu-nested nav">
	                        <a class="nav-link" href="mesa-lista.php">Lista</a>
	                        <a class="nav-link" href="mesa-novo.php">Novo</a></nav>
	                </div>

	                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePedido" aria-expanded="false" aria-controls="collapsePedido"
	                    ><div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
	                    Comanda
	                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div
	                ></a>
	                <div class="collapse" id="collapsePedido" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	                    <nav class="sb-sidenav-menu-nested nav">
	                        <a class="nav-link" href="comanda-lista.php">Lista</a>
	                        <a class="nav-link" href="comanda-novo.php">Novo</a></nav>
	                </div>

	                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser"
	                    ><div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
	                    Usuário
	                    <div class="sb-sidenav-collapse-arrow"><i class="fa fa-angle-down"></i></div
	                ></a>
	                <div class="collapse" id="collapseUser" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	                    <nav class="sb-sidenav-menu-nested nav">
	                        <a class="nav-link" href="usuario-lista.php">Lista</a>
	                        <a class="nav-link" href="usuario-novo.php">Novo</a></nav>
	                </div>


	                <a class="nav-link" href="sair.php">
	                    <div class="sb-nav-link-icon"><i class="fa fa-sign-out"></i></div>
	                    Sair
	                </a>


	                
	                


	            </div>
	        </div>

	        <div class="sb-sidenav-footer">
	            <div class="small">Disciplina:</div>
	            Programação Web I
	        </div>

	  	</nav>
	</div>


	';
?>