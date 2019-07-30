var URL4 = "http://localhost/BD/prestamo";

function prestamoListar(){
	var s = (document.getElementById("doc-info").innerText).split(": ")[1];
		$.ajax({
			url: URL4+"?doc="+s,
			type: "GET",
			timeout: 100000,
			dataType: "json"	
		}).done(function(data){
			listarInfoP(data);
			console.log(data);
		}).fail(function(jqXHR, textStatus, errorThrown){
			console.log("Error al listar prestamos");
		}).always(function(){
		});
}

function listarInfoP(data){
	document.getElementById("prestamo_buscar").value = "";
	var row;
	$('#listaPrestamos tbody tr').remove();
	if(data.length > 0){
		$.each(data, function(i){
			row = $("<tr>");
			row.append("<td>" + data[i].prestamo_cod + "</td>");
            row.append("<td>" + data[i].libro_titulo + "</td>");
            row.append("<td>" + data[i].autor_nombre + "</td>");
			row.append("<td>" + data[i].prestamo_fecha_sal + "</td>");
			row.append("<td>" + data[i].prestamo_fecha_reg + "</td>");
			row.append("<td>" + (data[i].prestamo_estado == 'E' ? "Entregado" : "Pendiente") + "</td>");
			row.append(`<td><a onclick="select('`+data[i].prestamo_cod+`')">Recibir</a></td>`);
            row.append("</tr>");
            $('#listaPrestamos').append(row);
		});
	} else {
		row = $('<tr><td colspan="5" align="center">No se encontraron prestamos</td></tr>');
        $('#listaPrestamos').append(row);
	}
}