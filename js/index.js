var base_url = "http://memcached.yongche.org/services/index.php";

$(document).ready(function() {
	$("#read").bind("click", function() {
		var key = $("#key").val();

		var url = base_url;
		var data = {
			method: "read",
			key: key
		};

		request(url, data);
	});
	
	$("#changeExpireTime").bind("click", function() {
		var key = $("#key").val();
		var expireTime = $("#expireTime").val();

		var url = base_url;
		var data = {
			method: "changeExpireTime",
			key: key,
			expireTime: expireTime
		};

		request(url, data);
	});

	$("#write").bind("click", function() {
		var key = $("#key").val();
		var value = encodeURI($("#value").val());

		var url = base_url;
		var data = {
			method: "write",
			key: key,
			value: value
		};

		request(url, data);
	});

	$("#delete").bind("click", function() {
		var key = $("#key").val();

		var url = base_url;
		var data = {
			method: "delete",
			key: key
		};

		request(url, data);
	});

	$("#flush").bind("click", function() {
		var url = base_url;
		var data = {
			method: "flush"
		};

		request(url, data);
	});
});

function request(url, data) {
	$.ajax({
		type: "POST",
		url: url,
		data: data,
		success: function(data, status) {
			console.log(data);
			var r = random(1, 255);
			var g = random(1, 255);
			var b = random(1, 255);
			$("#content").html('<div style="color:rgb(' + r + ',' + g + ',' + b + ')">' + data + '</div>');
		},
		error: function() {

		}
	});
}

function random(min, max) {
	return Math.floor(min + Math.random() * max);
}