function clickMe() {
	alert("Clicked!");
}

function changeColor() {

	var color = $("#txtColor").val();
	console.log(color);

	$("#div1").css("background-color", color);
}

function toggleFade() {
	$("#div3").fadeToggle("slow")
}