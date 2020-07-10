function multipleaction(path){
	var f = document.querySelector("form");
	var a = f.setAttribute("action", path);
	document.querySelector("form").submit();
}