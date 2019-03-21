$(document).ready(function() {
	if ($('.header_div').eq(0).children().length < 1) { //Load header+footer manually if PHP didn't do it.
		$(".header_div").load("./header.php");
		$(".footer_div").load("./footer.php");
	}
	
	get_user();
	
	//Initialize hidden elements
	$(".hide_me_code").hide();
	$(".hide_me_project").hide();
});

function set_user(username) {
	$("#display_name").html(username + "<br><a href='javascript:logout()''>Log Out</a>");
}

function logout () {
	document.cookie = 'token=; expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/; domain=.spms.westus.cloudapp.azure.com';
	window.location.href = "./index.php";
}

function register() {
	var username = $('#username').val();
	var password = $('#password').val();
	var password_confirm = $('#password_confirm').val();
	//alert('user: ' + username + '; pass: ' + password);
	
	$('#feedback').empty(); //clear previous errors
	
	if (password != password_confirm) { //ensure passwords match
		$('#feedback').html('Passwords do not match');
		return;
	}
	
	$.ajax({
		method: "POST",
		crossDomain: true,
		xhrFields: { withCredentials: true },
		url: "http://spms.westus.cloudapp.azure.com:8080/SPMS/api/authenticate/register",
		contentType: 'application/json',
		data: JSON.stringify({
			"username": username,
			"password": password
		}),
	})
	.done(function(data, textStatus, xhr) {
		window.location.href = "./index.php";
	})
	.fail(function (xhr, textStatus, errorThrown) {
		var statusNum = xhr.status;
		
		switch (statusNum) {
			case 400:
				$('#feedback').html("Username already in use");
				break;
			case 500:
				$('#feedback').html("Internal server error, try registering again later.");
				break;
			default:
				$('#feedback').html("The server returned an undefined response: Status code " + statusNum);
		}
	});
}

function authenticate_user () {
	var username = $('#username').val();
	var password = $('#password').val();
	//alert('user: ' + username + '; pass: ' + password);
	
	$('#feedback').empty();
	
	$.ajax({
		method: "POST",
		crossDomain: true,
		xhrFields: { withCredentials: true },
		url: "http://spms.westus.cloudapp.azure.com:8080/SPMS/api/authenticate",
		contentType: 'application/json',
		data: JSON.stringify({
			"username": username,
			"password": password
		}),
	})
	.done(function(data, textStatus, xhr) {
		window.location.href = "./index.php";
	})
	.fail(function (xhr, textStatus, errorThrown) {
		var statusNum = xhr.status;
		var feedback = "";
		
		switch (statusNum) {
			case 401:
				feedback = "Invalid username and/or password";
				break;
			default:
				feedback = "The server returned an undefined response: Status code " + statusNum;
				break;
		}
		console.log(feedback);
		$('#feedback').html(feedback);
	});
}

function get_user() {
	
	$.ajax({
		method: "GET",
		crossDomain: true,
		xhrFields: { withCredentials: true },
		url: "http://spms.westus.cloudapp.azure.com:8080/SPMS/api/authenticate/getUsername",
	})
	.done(function(data, textStatus, xhr) {
		console.log('Logged-in user according to server: ' + data.username);
		set_user(data.username);
	})
	.fail(function (xhr, textStatus, errorThrown) {
		var statusNum = xhr.status;
		var feedback = "";
		
		switch (statusNum) {
			case 401:
				feedback = "get_user: 401 (token not found, or invalid)";
				//TODO: redirect to sign on page?
				break;
			case 500:
				feedback = "Auth'ed without a valid token. Guess we got hacked.";
				break;
			default:
				feedback = "The server returned an undefined response: Status code " + statusNum;
				break;
		}
		console.log(feedback);
		//$('#feedback').html(feedback);
		
	});
}

//TODO: return statements don't actually cause this function to return since they're inside inline functions- delete this
function is_authenticated () {
	var is_auth = -1;
	
	$.ajax({
		method: 'GET',
		crossDomain: true,
		xhrFields: { withCredentials: true },
		url: "http://spms.westus.cloudapp.azure.com:8080/SPMS/api/authenticate/checkAuth"
	})
	.done(function() {
		is_auth = 1;
	})
	.fail(function () {
		is_auth = 0;
	})
	.always(function () {
		console.log("Auth status: " + is_auth);
		$("#auth_result").html("Auth status: " + is_auth);
		if (is_auth == 1) {
			return true;
		} else {
			return false;
		}
	});
}

function ping() {
	$.ajax({
		method: "GET",
		url: "http://spms.westus.cloudapp.azure.com:8080/SPMS/api/ping",
		statusCode: {
			//successful request functions (just 2xx?) take DONE callback params; failures take FAIL callback params
			200: function (data, status) {
				$('#ping_result').html("data: " + data + "\n<br>Status: " + status);
			}
		}
	})
	.done(function(data, textStatus, xhr) {
		//handled with statusCode
	})
	.fail(function (xhr, textStatus, errorThrown) {
		var statusNum = xhr.status;
		var text = xhr.statusText; //same as textStatus param?
		$('#ping_result').html("Failed! Status: " + statusNum + "<br>Explanation: " + text);
	});
}

//Function to hide/unhide sections on click
$(".hide_me").click(function() {
	var el = this;

	if( $(el).siblings().css("display") ==  "none") {
		$(el).siblings().show("medium");
	}
	else {
		$(el).siblings().hide("medium");
	}
});

//Function to hide/unhide specific elements
function hide_me(el) {
	if( $(el).css("display") ==  "none") {
		
		if ($(el).attr('class') == "hide_me_code"){
			$(".hide_me_code").hide(); //hide all other codes
		} else {
			$(".hide_me_project").hide(); //hide all other projects
		}
		
		$(el).show("medium");
		
	}
	else {
		$(el).hide("medium");
	}
}









/* LOCAL CODE THAT DOESN'T NEED TO ACCESS THE DATABASE -----------------------*/

/* Clears all input fields on the page */
function clear_inputs() {
	$(":input").each(function() {
		//Avoid clearing username and character list fields
		if ($(this).attr("id") == "pName") {
			return;
		}
		if ($(this).attr("id") == "char_list") {
			return;
		}

		switch(this.type) {
			case "password":
			case "text":
			case "textarea":
			case "file":
			case "select-one":
			case "select-multiple":
			case "date":
			case "number":
			case "tel":
			case "email":
				$(this).val("");
				break;
			case "checkbox":
			case "radio":
				this.checked = false;
				break;
		}
	});
}


/* Escapes all regex special characters in a string */
function escape_regex(str) {
	return str.replace(/([;&,\.\+\*\~':"\!\^#$%@\[\]\(\)=>\|])/g, '\\$1');
}
