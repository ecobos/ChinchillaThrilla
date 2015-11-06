<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>



<form action="./" method="post">

<div>User: 
	<select name="user_id" />
		<?php foreach($data['users'] as $user): ?>
			<option value="<?php echo $user->user_id;?>"><?php echo $user->name;?>
			</option>
		<?php endforeach; ?>
	</select>
</div>
<div>Product:
	<select name="product_id">
		<?php foreach($data['products'] as $product): ?>
			<option value="<?php echo $product->prod_id;?>"><?php echo $product->prod_name;?>
			</option>
		<?php endforeach; ?>
	</select>
</div>
<div>Review: <textarea name="review_text"></textarea></div>
<div><input type="submit"/></div>
	
</form>




</body>
</html>