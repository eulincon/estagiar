$(document).ready(function(){

//Mascaras
$('#telefone').mask('(00) 0 0000-0000')
$('#cep').mask('00000-000')

//Validações Cores
$.validator.setDefaults({
	errorClass: 'text-danger',
	highlight: function(element){
		$(element)
		.addClass('is-invalid')
	},
	unhighlight: function(element){
		$(element)
		.removeClass('is-invalid')
//.addClass('is-valid')
}
})
//Validações
$('#curriculo').validate({
	rules:{
		instituicao: {
			required: true,
			minlength: 10
		},
		cidade: {required: true},
		estado_dados_pessoais: {required: true},
		cargo: {
			required: true
		}
	},
	submitHandler: function(form){
		alert('Só Sucesso')
	}

})

$('.form-check-input').click(function(){
	let selection = $(this).closest('.row').find('input.data-termino')
	if(selection.attr('disabled')){
		selection.removeAttr('disabled')
	}else{
		selection.val('')
		selection.attr('disabled','disabled')
	}
})

$.getJSON('http://mendesepereira.neuroteks.com/entrevista/estados_cidades.json', function (data) {
var items = []
var options = '<option value="">escolha um estado</option>'
$.each(data, function (key, val) {
  options += '<option value="' + val.sigla + '">' + val.nome + '</option>'
})
$(".uf").html(options)
$(".uf").change(function () {
  var cidade = $(this).closest('.row').find(".cidade")
  //console.log(cidade)
  var options_cidades = ''
  var str = ''
  $(this).find('option:selected').each(function () {
    str += $(this).text()
  })

  $.each(data, function (key, val) {
    if(val.nome == str) {
      $.each(val.cidades, function (key_city, val_city) {
        options_cidades += '<option value="' + val_city + '">' + val_city + '</option>'
      })
    }
  })
  cidade.html(options_cidades)
}).change()
})


$("#cep").focusout(function(){
$.ajax({
  url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
  dataType: 'json',
  success: function(resposta){
    $("#endereco").val(resposta.logradouro)
    $("#bairro").val(resposta.bairro)
    $("#uf").val(resposta.uf)
    $.getJSON('http://mendesepereira.neuroteks.com/entrevista/estados_cidades.json', function (data) {
        var options_cidades = ''
        var str = ''
        $("#uf option:selected").each(function () {
          str += $(this).text()
        })
        $.each(data, function (key, val) {
          if(val.nome == str) {
            $.each(val.cidades, function (key_city, val_city) {
              options_cidades += '<option value="' + val_city + '">' + val_city + '</option>'
            })
          }
        })
        $("#cidade").html(options_cidades)
        $("#cidade").val(resposta.localidade)
    })
    $("#numero").focus()
  }
})
})

})