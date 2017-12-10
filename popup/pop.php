<!DOCTYPE html>
<html>
<head>
<title>Popup contact form</title>
<link href="elements.css" rel="stylesheet">
<script src="my_js.js"></script>
</head>
<!-- Body Starts Here -->
<body id="body" style="overflow:hidden;">
<div id="abc">
<!-- Popup Div Starts Here -->
<div id="popupContact">
<!-- Contact Us Form -->
<<form class="form-check-inline" action="second.php" method="post" id="form" align="center">
Select time to book:<br>
					<label><b>Time</b></label>
					<select name="hour" id="hour">
						<option value="8">08</option>
						<option value="9">09</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
					</select>
					<label><b>:</b></label>
					<select name="min" id="min">
						<option value="00">00</option>
						<option value="05">05</option>
						<option value="10">10</option>
						<option value="15">15</option>
						<option value="20">20</option>
						<option value="25">25</option>
						<option value="30">30</option>
						<option value="35">35</option>
						<option value="40">40</option>
						<option value="45">45</option>
						<option value="50">50</option>
						<option value="55">55</option>
						<option value="60">60</option>
					</select>
<span style="display: inline;">
  <button type="submit" name="submit" id="submit" value="1">submit</button>
  <button name="cancel" id="submit" formaction="pop.php">cancel</button>
</span>					


</form>
</div>
<!-- Popup Div Ends Here -->
</div>
<!-- Display Popup Button -->
<h1>Click Button To Popup Form Using Javascript</h1>
<button id="popup" onclick="div_show()">Popup</button>
</body>
<!-- Body Ends Here -->
</html>