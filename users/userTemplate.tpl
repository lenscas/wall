<!DOCTYPE HTML>
<html>
<head>
	<title>{TITLE}</title>
	<meta charset="utp-8">
</head>
	<body>
		<!-- START BLOCK : login -->	
			<a href="index.php?actie=register">register</a>
			<form method="POST" action="index.php?actie=login">
				<p>
					<label>username</label>
					<input type="text" name='username' id="name">
				</p>
				<p>
					<label>password</label>
					<input type="password" name='password' id="password">
				</p>
				<p>
					<input type="submit" name='submit' value="submit">
				</p>
			</form>
		<!-- END BLOCK : login -->

		<!-- START BLOCK : profile -->	
			<p>{NAAM}</p>
			<p>{ACHTERNAAM}</p>
			<p>{ADRES}</p>
			<p>{GEBOORTEDATUM}</p>
			<p>{MOBIEL}</p>
			<p>{TELEFOON}</p>
			<p>{WOONPLAATS}</p>
			<!-- START BLOCK : edit -->
				<a href="edit.php?id={ID}&actie=edit">edit </a>
			<!-- END BLOCK :  edit-->
		<!-- END BLOCK : profile -->
		<!-- START BLOCK : userCreate -->
			<form method="POST" action="{FILE}?actie=register">
				<p>
					<label>e-mail</label>
					<input type="text" name='mail' id="mail" value="{MAIL}">
				</p>
				<p>
					<label>password</label>
					<input type="text" name='password' id="password">
				</p>
					<label>first name</label>
				<p>
					<input type="text" name='firstName' id="firstName" value="{NAAM}">
				</p>
					<label>last name</label>
				<p>
					<input type="text" name='lastName' id="lastName" value="{ACHTERNAAM}">
				</p>
					<label>birthdate</label>
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
					<input type="text" name='telephone' id="telephone" value="{name}">
				</p>
					<label>mobiel</label>
				<p>
					<input type="text" name='mobiel' id="mobiel" value="{name}">
				</p>
				
				<p>
					<input type="submit" name='submit' value="submit">
				</p>
			</form>	
	<!-- END BLOCK : userCreate -->
	</body>
</html>