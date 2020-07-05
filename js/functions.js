function home(){
	document.location.href = 'index.php';
}
function insert(){
	document.location.href = 'index.php?insert';
}
function edit(){
	document.location.href = 'index.php?read';
}
function about(){
	document.location.href = 'index.php?about';
}
function del(val){
	var r = confirm('Data should be deleted?');
	console.log(document.location.href, val)
	if(r) document.location.href = 'index.php?delete='+val;
}
function shuffle(val){
	var r = confirm('Do you wish to shuffle groups?');
	if(r) document.location.href = 'php/shuffle.php';
}
