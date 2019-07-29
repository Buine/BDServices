var URL = "http://localhost/BD/libro";

function libroBuscar(filter, search){
	var f, s;
	f = ( filter != "" ? filter :  $('#filter-search').val() );
	s = ( search != "" ? search :  $('#libro_buscar').val() );
	console.log(f+" "+s);
	if ($('#libro_buscar').val() != "" || (filter != "" && search != "") ){
		$.ajax({
			url: URL+"?"+f+"="+s,
			type: "GET",
			timeout: 100000,
			dataType: "json"	
		}).done(function(data){
			listarInfo(data);
			console.log(data);
		}).fail(function(jqXHR, textStatus, errorThrown){
			console.log("Error al buscar libros");
		}).always(function(){
		});
	}
}

function listarInfo(data){
	var row;
	$('#listaLibros tbody tr').remove();
	if(data.length > 0){
		$.each(data, function(i){
			row = $("<tr>");
			row.append("<td>" + data[i].libro_cod + "</td>");
            row.append("<td>" + data[i].libro_titulo + "</td>");
            row.append("<td>" + data[i].autor_nombre + "</td>");
			row.append("<td>" + generos(data[i].generos) + "</td>");
			row.append("<td>" + data[i].editorial_nombre + "</td>");
			row.append("<td>" + data[i].libro_paginas + "</td>");
			row.append("<td>" + data[i].libro_idioma + "</td>");
			row.append("<td>" + data[i].libro_fecha_pub + "</td>");
            row.append("</tr>");
            $('#listaLibros').append(row);
		});
	} else {
		row = $('<tr><td colspan="5" align="center">No se encontraron resultados a tu busqueda</td></tr>');
        $('#listaLibros').append(row);
	}
}

function generos(data){
	var g = data.split(", ");
	var html = "";
	for(var i = 0; i < g.length; i++){
		html = html+`<a onClick="libroBuscar('genero', '`+g[i]+`')">`+g[i]+`</a>`;
		html = (i != g.length-1 ? html+", " : html);
	}
	return html;
}