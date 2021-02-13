do
{
	var name=prompt("Пожалуйста, введите ваше имя:","");
	if (name)
  	{
  		break;
  	}
}while(!name)
var storedItem = localStorage.getItem("storedItem");
function displaymessage()
{
	var Item =document.getElementById("link1").value;
	localStorage.setItem("storedItem", Item);
	document.getElementById("savedText").innerHTML = Item + "SAVED";
}
function get()
{
	localStorage.getItem("storedItem");
	document.getElementById("openedText").innerHTML = storedItem + "OPENED";
}