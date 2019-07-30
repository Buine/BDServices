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
			row.append(`<td><a>Recibir</a></td>`);
            row.append("</tr>");
            $('#listaPrestamos').append(row);
		});
	} else {
		row = $('<tr><td colspan="5" align="center">No se encontraron prestamos</td></tr>');
        $('#listaPrestamos').append(row);
	}
}

function compareDates() {
	var from = document.getElementById('fecha-prestamo').value;
	var to = document.getElementById('fecha-entrega').value;
	
	var fromDate = new Date(from);
	var toDate = new Date(to);
	
	return fromDate < toDate;
}

function generarPrestamo(){
	var libro = document.getElementById("id-libro").value;
	var doc = (document.getElementById("doc-info").innerText).split(": ")[1];
	if(libro != "" && doc != ""){
		if(compareDates()){
			var fecha1 = document.getElementById('fecha-prestamo').value;
			var fecha2 = document.getElementById('fecha-entrega').value;
			var jsond = '{"doc": "'+doc+'", "libro": "'+libro+'", "fec_prestamo": "'+fecha1+'", "fec_regreso": "'+fecha2+'"}';
			console.log(jsond);
			$.ajax({
				url:URL4,
				type: "POST",
				timeout: 100000,
				dataType: "json",
				data: jsond
			}).done(function(data){
				alert(data.Mensaje);
				console.log(data);
				//location.reload();
				defaultScreen();
			}).fail(function(jqXHR, textStatus, errorThrown){
				console.log("Error al crear el prestamo");
				console.log(errorThrown);
			}).always(function(){
			});
		} else {
			alert("Las fecha son invalidas. Verifique las fechas");
		}
	} else {
		alert("Algo anda mal con los datos del cliente, vuelve a seleccionarlo y intentalo de nuevo")
	}
}

function defaultScreen(){
	prestamoListar();
	unselect();
	document.getElementById('fecha-prestamo').value = "";
	document.getElementById('fecha-entrega').value = "";
	document.getElementById("id-libro").value = "";
}