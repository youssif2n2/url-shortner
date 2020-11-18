/* global console ,alert , document , window , XMLHttpRequest */

function send(){
    var url = document.getElementById('url');
    var link = document.getElementById('link');
    
    var obj = new XMLHttpRequest();
    obj.onreadystatechange = function(){
        if(obj.readyState == 4 && obj.status == 200){
            link.innerHTML = obj.responseText;
            console.log(obj.responseText);
        }
    }
    obj.open('POST' , 'get.php');
    obj.setRequestHeader("Content-Type" , "application/x-www-form-urlencoded");
    obj.send('url=' + url.value);
}