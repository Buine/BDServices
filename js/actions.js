function initgeneratePrestamo(){
	if (document.getElementById("generate-prestamo").style.display == "none"){
		document.getElementById("search-page").style.display = "none";
		document.getElementById("prestamos-lista").style.display = "none";
		document.getElementById("generate-prestamo").style.display = "block";
		if(document.getElementById("prestamo-info").style.display == "none"){
			document.getElementById("info2").innerText = "Debes elegir un cliente para generar un prestamo";
		} else {
			document.getElementById("info2").innerText = "";
			document.getElementById("generate-contenido").style.display = "block";
		}
	}
}

function initSearchClient(){
	if (document.getElementById("search-page").style.display == "none"){
		document.getElementById("search-page").style.display = "block";
		document.getElementById("prestamos-lista").style.display = "none";
		document.getElementById("generate-prestamo").style.display = "none";
		if($("#listaLibros").length == 0){
			libroBuscar('none','none');
			$('table').scroltable();
	 	}
	}
}

function initPrestamos(){
	if (document.getElementById("prestamos-lista").style.display == "none"){
		document.getElementById("search-page").style.display = "none";
		document.getElementById("prestamos-lista").style.display = "block";
		document.getElementById("generate-prestamo").style.display = "none";
		if(document.getElementById("prestamo-info").style.display == "none"){
			document.getElementById("info1").innerText = "Debes elegir un cliente para ver sus prestamos";
		} else {
			document.getElementById("info1").innerText = "";
			document.getElementById("prestamo-contenido").style.display = "block";
		}
	}
}