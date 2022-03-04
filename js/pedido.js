

valor_total_geral = 0.0;

$(document).ready(function(){

	$('.adicionarProduto').click(function(){
		//alert('vai adicionar');

		codigoNovoProduto = $('#codigoNovoProduto').val();
		qtdeNovoProduto = $('#qtdeNovoProduto').val();

		if (codigoNovoProduto > 0 && qtdeNovoProduto > 0) {
			adicionarProduto(codigoNovoProduto, qtdeNovoProduto);
		}else{
			alert('Necessario informar um produto e uma quantidade');
		}
	});


	$(document).on('click', "#tabela-produto tbody .deleta-produto", function(e){
		var cod_cesta = $(this).attr("cod_cesta");
		var descricao = $(this).attr("descricao");
		var valortotal = $(this).attr("valortotal");

		var apagar = confirm('Deseja excluir o produto: '+descricao+'?');
			if (apagar){
				var elemento = $(this);


				$.ajax({
					url: 'cadastroComanda.php?func=remprod&cod_cesta='+cod_cesta,
					type: 'GET',
					dataType: 'JSON',      //nao precisa esta linha
					success: function(resposta){
						elemento.parents().addClass("strikeout");
						elemento.removeClass("deleta-produto");
						diminuiValorTotal(valortotal);
					},
					error: function(xhr, textStatus, errorThrown){
						alert(xhr.responseText);
					}
				});

			}else{
				event.preventDefault();
			}
	});


	$('.confere').click(function(){
		confereProduto();
	});



	$(document).on('submit', '#form-pedido', function(e){

		e.preventDefault();

		var codigo = $('#codigo').val();
		var mesa = $('#mesa').val();
		var garcom = $('#garcom').val();
		var valortotal = $('#valortotal').val();


		$.ajax({
				url: 'cadastroComanda.php?func=gravapedido',
				type: 'POST',
				//dataType: 'JSON',
				data:{
					'codigo': codigo,
					'mesa': mesa,
					'garcom': garcom,
					'valortotal': valortotal
				},
				//dataType: 'JSON',      //nao precisa esta linha
				success: function(resposta){
					//alert('Pedido salvo!');

					html = '<div class="alert alert-success alert-dismissible fade show" role="alert"> '+
                                ' Pedido cadastrado com <strong>sucesso!</strong> '+
                                ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"> '+
                                ' <span aria-hidden="true">&times;</span> '+
                                ' </button> '+
                            	' </div> ';
                    $('#mensagem').append(html).delay();
				},
				error: function(xhr, textStatus, errorThrown){
					alert(xhr.responseText);
				}
		});

	});

});


function adicionarProduto(cod_produto, quantidade, valoruni, valortotal){
	//alert('vai adicionar');
	$.ajax({
		url: 'cadastroComanda.php?func=addprod&id='+cod_produto+'&quantidade='+quantidade+'&valorunit='+valoruni+'&valortotal='+valortotal,
		type: 'GET',
		dataType: 'JSON',
		success: function(resposta){

			var tam = resposta.length;
			for (var i=0; i<=tam; i++) {

				var cod_cesta = resposta[i].cod_cesta;
				var codigo = resposta[i].codigo;
				var descricao = resposta[i].descricao;
				var preco_unitario = resposta[i].preco_unitario;
				var valortotal = resposta[i].valortotal;

				html = '<tr>'+
						'<td>'+codigo+'</td>'+
						'<td>'+descricao+'</td>'+
						'<td>'+quantidade+'</td>'+
						'<td>'+preco_unitario+'</td>'+
						'<td>'+valortotal.toLocaleString('pt-br', {minimumFractionDigits: 2})+'</td>'+
						'<td>'+
							'<a href="#" class="deleta-produto" valortotal="'+valortotal+'" cod_cesta="'+cod_cesta+'" descricao="'+descricao+'"> '+
							' <i class="fa fa-trash"></i>'+
							'</a>'+
							'</td>'+
					    '</tr>';

				$('.tabela-produto tbody').append(html).delay();
				somaValorTotal(valortotal);

			}

		},
		error: function(xhr, textStatus, errorThrown){
			alert(xhr.responseText);
		}
	});
}


function somaValorTotal(valortotal){
	valor_total_geral += valortotal; 
	atualizaValorTotal(valor_total_geral);
}


function diminuiValorTotal(valortotal){
	valor_total_geral -= valortotal;
	atualizaValorTotal(valor_total_geral);
}


function atualizaValorTotal(valor){
	$('#valortotal').val(valor_total_geral.toLocaleString('pt-br', {minimumFractionDigits: 2}));

}

function confereProduto(){
	$.ajax({
		url: 'cadastroComanda.php?func=confere',
		type: 'GET',
		dataType: 'JSON',
		success: function(resposta){
			alert(resposta);
		},
		error: function(xhr, textStatus, errorThrown){
			alert(xhr.responseText);
		}
	});
}