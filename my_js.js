// Validating Empty Field

function check_empty() {
	if (document.getElementById('hour').value === "") {
		alert("Please input hour");
		if (document.getElementById('min').value < 1 || document.getElementById('min').value > 24) {
			alert("Input Value Between 1-24");
		}

		if (document.getElementById('min').value === "") {
			alert("Please input hour");
			if (document.getElementById('min').value < 1 || document.getElementById('min').value > 24) {
				alert("Input Value Between 1-24");
			}

		} else {
			document.getElementById('form').submit();
			alert("Form Submitted Successfully...");
		}
	}
}
//Function To Display Popup
function div_show() {
	document.getElementById('abc').style.display = "block";
}
//Function to Hide Popup
function div_hide() {
	document.getElementById('abc').style.display = "none";
}