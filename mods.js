do
{
	var name=prompt("Пожалуйста, введите ваше имя:","");
	if (name)
  	{
  		break;
  	}
}while(!name)
var xhReq = new XMLHttpRequest();
var link = "https://xtupis.github.io/GGGG/mods.json";
xhReq.open("GET", link , false);
xhReq.send(null);
var jsonObject = JSON.parse(xhReq.responseText);
document.write(jsonObject);
