$(document).ready(function(){ 
		$("table").dataTable( {
		"bJQueryUI": true,
		"sPaginationType": "full_numbers"
	} );
}); 

$(function(){
	$("input, textarea, select").tipTip({defaultPosition: "right", activation: "focus"});
});

jQuery(function($){
   $(".cnpj").mask("99.999.999-9999/99");
   $(".telefone").mask("(99) 9999-9999");
   $(".data_nota").mask("99/99/9999");
});

$(function() {
	$("input[type=submit], button").button();
});

$(function() {
	$("#data_nota").datepicker();
});

$(document).ready(function(){
    $(".form").validate();
});

$(document).ready(function(){
    $("#aviso").modal();
});
