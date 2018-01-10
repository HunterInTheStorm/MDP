
var locate = window.location
document.EvilForm.X.value = locate;
var text = document.EvilForm.X.value;

function delineate(str) {
    theleft = str.indexOf("=") + 1;
    theright = str.lastIndexOf("&");
    return(str.substring(theleft, theright));
}
var xval = delineate(text);
document.getElementById("inptX").value = xval;

function delineate2(str) {
    point = str.lastIndexOf("=");
    return(str.substring(point+1,str.length));
}
yval = delineate2(text);
document.getElementById("inptY").value = yval;

var price = parseInt(xval) * parseInt(yval);
document.getElementById("inptS").value = "1 Soul and " + price.toString() +  " millennia of HardCore Barb runs";