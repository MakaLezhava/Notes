(function(){
	var button = document.getElementsByName("save")[0];
	var delete_button = document.getElementById('delete');
button.onclick = function(event) {
    event.preventDefault();
    
    var client = (new XMLHttpRequest) || (new ActiveXObject);
    var note = document.getElementsByName("note")[0];
    
    client.open("POST", "notes.php", true);
    client.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    client.onreadystatechange = function() {
        var postResp = JSON.parse(client.response);
        
        if(client.status === 201) {
            document.getElementById("msg").innerHTML = postResp.status.message;
            
            var xmlhttp = (new XMLHttpRequest) || (new ActiveXObject);
            
            xmlhttp.open("GET", "notes.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/json");
            
            xmlhttp.onreadystatechange = function() {
                console.log(xmlhttp.status);
                var getResp = JSON.parse(xmlhttp.response);
                
                var newBody = drawTableBody(getResp);
                
                var table = document.getElementsByTagName("table")[0];
                var oldBody = table.getElementsByTagName("tbody")[0];
                
                table.replaceChild(newBody, oldBody);
            };
            
            xmlhttp.send();
        } else if(client.status === 400) {
            document.getElementById("msg").innerHTML = postResp.status.message;
        }
    };
    
    client.send("note=" + note.value);
    
    note.value = "";
};

function drawTableBody(jsonArray) {
    var tbody = document.createElement("tbody");
    
    jsonArray.forEach(function(elem){
        var tr = document.createElement("tr");
        
        var noteTd = document.createElement("td");
        noteTd.innerHTML = elem.note;
        tr.appendChild(noteTd);
        
        var idTd = document.createElement("td");
        idTd.innerHTML = elem.id;
        tr.appendChild(idTd);
        
        var dateTd = document.createElement("td");
        dateTd.innerHTML = elem.date;
        tr.appendChild(dateTd);
        
        var checkTd = document.createElement("td");
        checkTd.innerHTML = "<input type='checkbox' value='" + elem.id + "'>";
        tr.appendChild(checkTd);
        
        tbody.appendChild(tr);
    });
    
    return tbody;
}


})()