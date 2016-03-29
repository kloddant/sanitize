# sanitize

<table>
	<tr>
		<td>Procedure:</td>
		<td>sanitize</td>
	</tr>
	<tr>
		<td>Purpose:</td>
		<td>
			A php function that attempts to recursively sanitize generic user input in all cases.  To be used, not in place of prepared statements, but in addition to them.  Useful as a stopgap measure for already comprmised systems until prepared statements can be put in place.  Helpful against xss attacks.  Useful to add to files just in case of unknown security flaws.  
		</td>
	</tr>
	<tr>
		<td>Parameters:</td>
		<td>
			<ul>
				<li>$data (optional, any type): A boolean, integer, double, string, array, object, resource, NULL, or unknown type that is to be sanitized by this function.  If this is an array or object, sanitize will call itself recursively on all the values within the array or object until they are all sanitized or until the recursion depth is reached.</li>
				<li>$depth (optional, integer): Should be left blank.  This parameter is set by the sanitize function when it calls itself.</li>
			</ul>
		</td>
	</tr>
	<tr>
		<td>Produces:</td>
		<td>
			sanitized $data that is safer to be printed out to the page or to be used in a sql query.
		</td>
	</tr>
	<tr>
		<td>Preconditions:</td>
		<td>
			The variable $sanitized is reserved in the $GLOBALS scope.
		</td>
	</tr>
	<tr>
		<td>Postconditions:</td>
		<td>
			If run without setting any parameters, sanitize will sanitize everything in the $_GET, $_POST, $_COOKIE, $_REQUEST, and $_FILES arrays.  If these arrays are nonexistent and sanitize is called with no parameters, then it will do nothing.
		</td>
	</tr>
	<tr>
		<td>Usage:</td>
		<td>
			require_once('sanitize.php');<br />
			sanitize();
		</td>
	</tr>
</table>
