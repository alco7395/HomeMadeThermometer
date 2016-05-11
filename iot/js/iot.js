/**
 * 
 */

function start() {

        var deviceID = "1b0021000247343337373738";
        var accessToken = "dc2160cec739de8ea942c6f12fb00190b4a22ff6";
        var eventSource = new EventSource("https://api.spark.io/v1/devices/" + deviceID + "/events/?access_token=" + accessToken);

        eventSource.addEventListener('open', function(e) {
            console.log("Opened!"); },false);

        eventSource.addEventListener('error', function(e) {
            console.log("Errored!"); },false);

        eventSource.addEventListener('Temperature', function(e) {
            var rawData = JSON.parse(e.data);
            insertRow('API/v1/apitest.php', rawData);
            var parsedData = JSON.parse(rawData.data);
            var status = document.getElementById('status');
            var cel = document.getElementById("cel");
            var fah   = document.getElementById("fah");
            var graph = document.getElementById("graph");
            if (parsedData.status == 0){
            	status.innerHTML = "Turned Off";
            	graph.innerHTML = "<img src='images/home.jpg'>";
            	$("#status1").css("background-color","white");
            } else if(parsedData.status == 1){
            	status.innerHTML = "Turned On";
            	graph.innerHTML = "<img src='images/person.jpg'>";
            	$("#status1").css("background-color","green");
            } else if (parsedData.status ==2){
            	status.innerHTML = "Warning";
            	$("#status1").css("background-color","yellow");
            } else if (parsedData.status == 3){
            	status.innerHTML = "Danger";
            	$("#status1").css("background-color","red");
            }
            cel.innerHTML = '<h1>' + parsedData.Celcius.toFixed(2) + '</h1>';
            fah.innerHTML = '<h1>' + parsedData.fahrenheit.toFixed(2) + '</h1>';
            d='status=' + parsedData.status;
            console.log(d);
            notification('API/v1/records.php',d);
            
        }, false);
}

function insertRow (link, data){
	var datas =[]
	datas.push(data);
	$.ajax({
		url: link,
		type: 'post',
		data: data,
		success: function (data){
			myFirstChart.dispose();
			$('#chart-1').html(data);
		}
	})
}


function notification (link, data){
	$.ajax({
		url: link,
		type: 'post',
		data: data,
		success: function (data){
			if (data == 1){
				noti('Thermometer is on', 'Test body');
			} else if (data == 2){
				noti ('Warning temperature', 'Test body');
			} else if (data == 3){
				noti('Danger temperature', 'Test body');
			}
			
		}
	})
}

function noti(title, body){
		var postObject = {
		    type: "note",
		    title: title,
		    body: body
		}
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "https://api.pushbullet.com/v2/pushes", true);
		xhttp.setRequestHeader("Authorization", "Bearer o.NlRiqEyKtP3P4B3sm8i3X4CKXUQcrOYo");
		xhttp.setRequestHeader("Content-type", "application/json");
		xhttp.send(JSON.stringify(postObject));
}

