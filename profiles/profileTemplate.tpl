<!DOCTYPE HTML>
<html>
	<head>
		<title>{TITLE}</title>
		<meta charset="utp-8">
	</head>
	<body>
		<a href="index.php?actie=logout">log-out</a>
		<!-- START BLOCK : profile -->	
				<p>first name: {NAAM}</p>
				<p>last name: {ACHTERNAAM}</p>
				<p>adres: {ADRES}</p>
				<p>birthdate: {GEBOORTEDATUM}</p>
				<p>mobile: {MOBIEL}</p>
				<p>telephone: {TELEFOON}</p>
				<p>residence: {WOONPLAATS}</p>
							
				<!-- START BLOCK : edit -->
					<a href="index.php?id={ID}&actie=editProfile">edit </a>
				<!-- END BLOCK :  edit-->
			
			<!-- END BLOCK : profile -->
			<!-- START BLOCK : userEdit -->
			<form method="POST" action="index.php?actie=userEdit&id={ID}">
				<p>
					<label>e-mail</label>
					<input type="text" name='mail' id="mail" value="{MAIL}">
				</p>
				<p>
					<label>password</label>
					<input type="password" name='password' id="password" value="{PASSWORD}" >
				</p>
					<label>first name</label>
				<p>
					<input type="text" name='firstName' id="firstName" value="{NAAM}">
				</p>
					<label>last name</label>
				<p>
					<input type="text" name='lastName' id="lastName" value="{ACHTERNAAM}">
				</p>
				<select name="birthdayDay">
				<option value="0" selected="1">Dag</option>
				<!-- START BLOCK : day -->
					<option value="{DAY}">{DAY}</option>
				<!-- END BLOCK : day -->
				</select>
				<select name="birthdayMonth">
				<option value="0" selected="1">Maand</option>
				<!-- START BLOCK : month -->
					<option value="{VALUE}">{MONTH}</option>
				<!-- END BLOCK : month -->
				</select>
				<select name="birthdayYear">
				<option value="0" selected="1">Jaar</option>
				<!-- START BLOCK : year -->
					<option value="{YEAR}">{YEAR}</option>
				<!-- END BLOCK : year -->
			
			</select>
					<label>address</label>
				<p>
					<input type="text" name='address' id="address" value="{ADRES}">
				</p>
					<label>postalcode</label>
				<p>
					<input type="text" name='postalcode' id="birth" value="{POSTCODE}">
				</p>
					<label>residence</label>
				<p>
					<input type="text" name='residence' id="residence" value="{WOONPLAATS}">
				</p>
					<label>telephone</label>
				<p>
					<input type="text" name='telephone' id="telephone" value="{TELEFOON}">
				</p>
					<label>mobiel</label>
				<p>
					<input type="text" name='mobiel' id="mobiel" value="{MOBIEL}">
				</p>
				
				<p>
					<input type="submit" name='submit' value="submit">
				</p>
			</form>	
	<!-- END BLOCK : userEdit -->
		<!-- START BLOCK : row -->
			<div>
				<div>
					<img src="{LINK}">
					<p><a href="index.php?actie=profile&id={ID}">{USER}</a></p>
	    		</div>	
	    		<div>
	    			<pre>{CONTENT}</pre>
	    		</div>
	    		<div>
	    			<p>{DATE}</p>
				</div>
			</div>
			<!-- END BLOCK : comment -->
		<div>
	</body>
</html>