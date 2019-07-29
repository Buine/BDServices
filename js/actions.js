function initgeneratePrestamo(){
	if (document.getElementById("generate-prestamo").style.display == "none"){
		document.getElementById("search-page").style.display = "none";
		document.getElementById("generate-prestamo").style.display = "block";
	}
}

function initSearchBook(){
	if (document.getElementById("search-page").style.display == "none"){
		document.getElementById("search-page").style.display = "block";
		document.getElementById("generate-prestamo").style.display = "none";
		if($("#listaLibros").length == 0){
			libroBuscar('none','none');
			$('table').scroltable();
	 	}
	}
}