<!DOCTYPE html>
<html>
<head>
	<title>Searching and stuff</title>
</head>
<body>


<form method="GET" action="/search/results">

	<div>
		Enter a search term: <input type="input" name="query">
		<select name="type">
			<option value="product">Products</option>
			<option value="category">Categories</option>
			<option value="brand">Brands</option>
		</select>
	</div>
	<div><input type="submit" value="Search!"/></div>
</form>


</body>
</html>