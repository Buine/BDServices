var URL3 = "http://192.168.1.9/BD/autor";

function autorListar(filter, search){
	var f = filter;
	var s = search;
		$.ajax({
			url: URL3+"?"+f+"="+s,
			type: "GET",
			timeout: 100000,
			dataType: "json"	
		}).done(function(data){
			listarInfoA(data);
			console.log(data);
		}).fail(function(jqXHR, textStatus, errorThrown){
			console.log("Error al listar autores");
		}).always(function(){
		});
}

function listarInfoA(data){
	var autores = document.getElementById("prestamo-filter");
	
	if(data.length > 0){
		$.each(data, function(i){
			var opt = document.createElement('option');
			opt.text = data[i].autor_nombre;
			opt.value = data[i].autor_nombre; 
            autores.add(opt);
		});
	}
}