var URL2 = "http://localhost/BD/libro";

function libroBuscar(filter, search){
	var f, s;
	f = ( filter != "" ? filter :  $('#filter-search2').val() );
	s = ( search != "" ? search :  $('#prestamo-filter').val() );
	console.log(URL2+"?"+f+"="+s);
	if ($('#prestamo-filter').val() != "default" ){
		$.ajax({
			url: URL2+"?"+f+"="+s,
			type: "GET",
			timeout: 100000,
			dataType: "json"	
		}).done(function(data){
			listarInfoLibro(data);
			console.log(data);
		}).fail(function(jqXHR, textStatus, errorThrown){
			console.log("Error al buscar libros");
		}).always(function(){
		});
	}
}

function listarInfoLibro(data){
	var row;
	document.getElementById("libro_buscar").value = "";
	$('#listaLibros tbody tr').remove();
	if(data.length > 0){
		$.each(data, function(i){
			row = $("<tr>");
			row.append("<td>" + data[i].libro_cod + "</td>");
            row.append("<td>" + data[i].libro_titulo + "</td>");
            row.append("<td>" + data[i].autor_nombre + "</td>");
			row.append("<td>" + data[i].generos + "</td>");
			row.append("<td>" + data[i].editorial_nombre + "</td>");
			row.append("<td>" + data[i].libro_paginas + "</td>");
			row.append("<td>" + data[i].libro_idioma + "</td>");
			row.append("<td>" + data[i].libro_fecha_pub + "</td>");
			row.append(`<td><a onclick="select('`+data[i].libro_cod+`', '`+data[i].libro_titulo+`', '`+data[i].autor_nombre+`')">Elegir</a></td>`);
            row.append("</tr>");
            $('#listaLibros').append(row);
		});
	} else {
		row = $('<tr><td colspan="5" align="center">No se encontraron resultados a tu busqueda</td></tr>');
        $('#listaLibros').append(row);
	}
}

function select(id, title, autor){
	var divLibro = document.getElementById("libro-prestamo");
	var info = document.getElementById("data-libro");
	var libro = document.getElementById("id-libro");
	info.innerHTML = "Titulo: "+title+"<br>Autor: "+autor;
	libro.value = id;
	divLibro.style.display = "block";
	document.getElementById("prestamo").style.display = "block";
	document.getElementById("select-libro").style.display = "none";
}

function unselect(){
	var divLibro = document.getElementById("libro-prestamo");
	var info = document.getElementById("data-libro");
	var libro = document.getElementById("id-libro");
	info.innerHTML = "";
	libro.value = "";
	divLibro.style.display = "none";
	document.getElementById("prestamo").style.display = "none";
	document.getElementById("select-libro").style.display = "block";
}

function autores(){
	var g = data.split(", ");
	var html = "";
	for(var i = 0; i < g.length; i++){
		html = html+`<a onClick="libroBuscar('genero', '`+g[i]+`')">`+g[i]+`</a>`;
		html = (i != g.length-1 ? html+", " : html);
	}
	return html;
}