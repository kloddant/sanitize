# sanitize

<ul>
<li>Procedure: sanitize</li>
<li>Purpose: A php function that recursively sanitizes generic user input in all cases.</li>
<li>Parameters:
<ul>
<li>$data (optional, any type): A boolean, integer, double, string, array, object, resource, NULL, or unknown type that is to be sanitized by this function.  If this is an array or object, sanitize will call itself recursively on all the values within the array or object until they are all sanitized or until the recursion depth is reached.</li>
<li>$depth (optional, integer): Should be left blank.  This parameter is set by the sanitize function when it calls itself.</li>
</ul>
</li>
<li>Produces: sanitized $data that is safer to be printed out to the page or to be used in a sql query.</li>
<li>Preconditions: The variable $sanitized is reserved in the $GLOBALS scope.</li>
<li>Postconditions: If run without setting any parameters, sanitize will sanitize everything in the $_GET, $_POST, $_COOKIE, $_REQUEST, and $_FILES arrays.  If these arrays are nonexistent and sanitize is called with no parameters, then it will do nothing.</li>
</ul>
