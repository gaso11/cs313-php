function clickMe() {
	alert("Clicked!");
}

function changeColor() {
	$("#div1").css("background-color", $("input:text").val());
}

function toggleFade() {
	$("#div3").fadeToggle("slow")
}