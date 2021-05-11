
function contextMenu(e){
    if(e.button == 2){
        document.getElementById("menuCapa").cas("top", e.pageY - 20);
        document.getElementById("menuCapa").cas("left", e.pageX - 20);
        document.getElementById("menuCapa").show("fast");
    }
}


/*
window.oncontextmenu = function(){
    showContextMenu();
    return flase
}

document.body.onclick = function (e){
    var isRightMB;
    e = e || window.event;

    if("which" in e){
        isRightMB = e.which == 3;
    }else if("button" in e){
        isRightMB = e.button == 2;
    }
}*/

/*
window.onclick = hideContextMenu;
window.onkeydown = listenKeys;
var contextMenu = document.getElementById("contextMenu");


function showContextMenu(event){
    contextMenu.style.display = "block";
    contextMenu.style.left = event.clientX + "px";
    contextMenu.style.top = event.clientY + "px";
    return false;
}

function hideContextMenu(){
    contextMenu.style.display = "none";
}

function listenKeys(event){
    var keyCode = event.which || event.keyCode;
    
    if(keyCode == 27){
        hideContextMenu();
    }
}*/