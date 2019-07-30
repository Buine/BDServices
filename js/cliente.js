var URL = "http://192.168.1.9/BD/cliente";

function listarClientes(filter, search){
	var f, s;
	f = ( filter != "" ? filter :  $('#filter-search').val() );
	s = ( search != "" ? search :  $('#cliente_buscar').val() );
	console.log(f+" "+s);
	if ($('#cliente_buscar').val() != "" || (filter != "" && search != "") ){
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
	$('#listaClientes tbody tr').remove();
	if(data.length > 0){
		$.each(data, function(i){
			row = $("<tr>");
			row.append("<td>" + data[i].cliente_doc + "</td>");
            row.append("<td>" + data[i].cliente_nombre + "</td>");
            row.append("<td>" + data[i].cliente_apellido + "</td>");
			row.append("<td>" + data[i].cliente_genero + "</td>");
			row.append("<td>" + data[i].cliente_fecha_nac + "</td>");
			row.append("<td>" + data[i].cliente_rh + "</td>");
			row.append("<td>" + data[i].dep_nombre + "</td>");
			row.append("<td>" + data[i].mun_nombre + "</td>");
			row.append(`<td><a href=#left-panel onclick="prestamo('`+data[i].cliente_doc+`', '`+data[i].cliente_nombre+`', '`+data[i].cliente_apellido+`', '`+data[i].cliente_genero+`'); prestamoListar();">Prestamo</a></td>`);
            row.append("</tr>");
            $('#listaClientes').append(row);
		});
	} else {
		row = $('<tr><td colspan="5" align="center">No se encontraron resultados a tu busqueda</td></tr>');
        $('#listaClientes').append(row);
	}
}

function prestamo(doc, nombre, apellido, genero){
	document.getElementById("prestamo-info").style.display = "block";
	
	var element_name = document.getElementById("name-info");
	var element_doc = document.getElementById("doc-info");
	element_name.innerText = "Cliente: "+nombre+" "+apellido;
	element_doc.innerText = "Documento: "+doc;
}

/*
function generos(data){
	var g = data.split(", ");
	var html = "";
	for(var i = 0; i < g.length; i++){
		html = html+`<a onClick="libroBuscar('genero', '`+g[i]+`')">`+g[i]+`</a>`;
		html = (i != g.length-1 ? html+", " : html);
	}
	return html;
}
*/