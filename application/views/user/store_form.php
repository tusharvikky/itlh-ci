<!DOCTYPE html>
<html>
<head>
	<title>register</title>
</head>
<body>
	<span class="errors">
		<?php //echo validation_errors(); ?>
		<?php 
		if(!empty($errors)){
			foreach ($errors as $key => $value) {
				echo $value;
			}			
		}
		 ?>
	</span>
	<form action="/user/register_post" method="post">
		<label for="email">Email</label>
		<input type="text" name="email" id="email">
		<button type="submit"> Submit </button>
	</form>

<ul>
	<?php 
		if(!empty($users)){
			foreach ($users as $user) {
				echo "<li> $user->email <a href='/user/delete/$user->id'> Delete </a> </li>";
			}
		}
	 ?>

</ul>

</body>
</html>