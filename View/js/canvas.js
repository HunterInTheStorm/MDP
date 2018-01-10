var canvas = document.getElementById("paper");
var context = canvas.getContext('2d');

var x = 0;
var y = 0;

var background = new Image();
background.src = 'View/recources/test.png';

var image = new Image();

function OpenInNewTab(url) {
    var win = window.open(url, '_blank');
    win.focus();
}

function getMousePos(canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    return {
        xx: evt.clientX - rect.left,
        yy: evt.clientY - rect.top
    };
}
      
canvas.addEventListener('click', function(evt) {
    var mousePos = getMousePos(canvas, evt);
    console.log("SADSD");
    var mX = mousePos.xx;
    var mY = mousePos.yy;
    for (obj in arr) {
        if (arr[obj].Coordinate_X < mX && arr[obj].Coordinate_X + arr[obj].width > mX && arr[obj].Coordinate_Y < mY && arr[obj].Coordinate_Y + arr[obj].height > mY) {
            var url = arr[obj].Link;
            OpenInNewTab(url);
        }
    }   
}, false);

function setImage(input) {
	image = new Image();
	var test = new Image();

	if (input.files && input.files[0]) {
    	var reader = new FileReader();
    	reader.onload = function (e) {
    		test.src = e.target.result;
    		console.log(test.height);
    		console.log(test.width);
    		if((test.height != 25 && test.width != 25) && (test.height != 50 && test.width != 50) && (test.height != 75 && test.width != 75)) {
    			alert("Incorect image dimention. Choose an image with dimentions 25x25, 50x50 or 75x75");
    		} else {
    			image.src = e.target.result;
    		}
    	};
   		reader.readAsDataURL(input.files[0]);
        findFreeSpot();
 	}
}

function checkSpot(increment_x, increment_y) {
    var tx = x + increment_x;
    var ty = y + increment_y;
    if(tx < 0 || ty < 0 || tx > 975 || ty > 975)
        return;
    var is_spot_takken = false;
    for (obj in arr) {
        var target_x = arr[obj].Coordinate_X;
        var target_y = arr[obj].Coordinate_Y;
        var target_w = arr[obj].width;
        var target_h = arr[obj].height;
        var check = false;
        var ckeckee = {x: tx + image.width/4, y: ty + image.height/4};
        check = check || target_x < ckeckee.x && target_x + target_w > ckeckee.x && target_y < ckeckee.y && target_y + target_h > ckeckee.y;
        
        ckeckee = {x: tx + image.width/2, y: ty + image.height/4};
        check = check || target_x < ckeckee.x && target_x + target_w > ckeckee.x && target_y < ckeckee.y && target_y + target_h > ckeckee.y;
        
        ckeckee = {x: tx + (3*image.width)/4, y: ty + image.height/4};
        check = check || target_x < ckeckee.x && target_x + target_w > ckeckee.x && target_y < ckeckee.y && target_y + target_h > ckeckee.y;
        
        ckeckee = {x: tx + image.width/4, y: ty + image.height/2};
        check = check || target_x < ckeckee.x && target_x + target_w > ckeckee.x && target_y < ckeckee.y && target_y + target_h > ckeckee.y;
        
        ckeckee = {x: tx + image.width/2, y: ty + image.height/2};
        check = check || target_x < ckeckee.x && target_x + target_w > ckeckee.x && target_y < ckeckee.y && target_y + target_h > ckeckee.y;
        
        ckeckee = {x: tx + (3*image.width)/4, y: ty + image.height/2};
        check = check || target_x < ckeckee.x && target_x + target_w > ckeckee.x && target_y < ckeckee.y && target_y + target_h > ckeckee.y;
        
        ckeckee = {x: tx + image.width/4, y: ty + (3*image.height)/4};
        check = check || target_x < ckeckee.x && target_x + target_w > ckeckee.x && target_y < ckeckee.y && target_y + target_h > ckeckee.y;
        
        ckeckee = {x: tx + image.width/2, y: ty + (3*image.height)/4};
        check = check || target_x < ckeckee.x && target_x + target_w > ckeckee.x && target_y < ckeckee.y && target_y + target_h > ckeckee.y;

        ckeckee = {x: tx + (3*image.width)/4, y: ty + (3*image.height)/4};
        check = check || target_x < ckeckee.x && target_x + target_w > ckeckee.x && target_y < ckeckee.y && target_y + target_h > ckeckee.y;        
        if (check) {
            is_spot_takken = true;
            break
        }
    }
    if(!is_spot_takken) {
        x = tx;
        y = ty;
    }
}

function storeCoordinates(xCoord, yCoord) {
	document.getElementById("xc").value = xCoord.toString();
	document.getElementById("yc").value = yCoord.toString();
}

document.onkeydown = function(e) {

    switch (e.keyCode) {
        case 37:
            if(x > 0) {
            	checkSpot(-25, 0);
            	storeCoordinates(x,y);
            }
            break;
        case 38:
            if(y > 0) {
                checkSpot(0, -25);
            	storeCoordinates(x,y);
            }
            break;
        case 39:
            if(x < 975) {
                checkSpot(25, 0);
            	storeCoordinates(x,y);
            }
            break;
        case 40:
            if(y < 975) {
                checkSpot(0, 25);
                storeCoordinates(x,y);
            }
            break;
        case 87:
            if(y > 0) {
                checkSpot(0, -25);
            	storeCoordinates(x,y);
            }
            break;
        case 65:
            if(x > 0)  {
            	checkSpot(-25, 0);
            	storeCoordinates(x,y);
            }
            break;
        case 83:
            if(y < 975) {
            	checkSpot(0, 25);
            	storeCoordinates(x,y);
        	}
            break;
        case 68:
            if(x < 975) {
            	checkSpot(25, 0);
            	storeCoordinates(x,y);
        	}
            break;
  
	};
}

function findFreeSpot() {
    var tx = 0;
    var ty = 0;
    var working = true;
    var found = false;
    while(working) {
        for (obj in arr) {
            if (arr[obj].Coordinate_X <= tx && arr[obj].Coordinate_X + arr[obj].width > tx && arr[obj].Coordinate_Y <= ty && arr[obj].Coordinate_Y + arr[obj].height > ty) {
                found = false;
                break;
            } else {
                found = true;
            }
        }
        if (found) {
            break;
        }
        if(tx == ty) {
            tx += 25
        } else {
            ty += 35;
        }
        if(tx >= 1000 && tx >= 1000) {
            image = new Image();
            alert("No more space");
            break
        }
    }
    x = tx;
    y = ty;
}

var render = function () {
	context.clearRect(0 ,0 , canvas.width, canvas.height);
	
	var backgroundX = 0;
	var backgroundY = 0;

	var width = 100;
	var height = 100;
	
	context.drawImage(background, 0, 0);
	context.drawImage(image, x, y);
	
}




setInterval(render, 20);




