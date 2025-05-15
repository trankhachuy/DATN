<!-- User.php -->
<?php
require_once 'models/Model.php';
class User extends Model
{
	// khai báo các thuộc tính của class dựa vào trường trong bảng user
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	public $phone;
	public $address;
	public $email;
	public function getUser($username)
	{
		$sql_select_once = "SELECT * FROM users WHERE `username` = :username";
		$obj_select_one = $this->connection->prepare($sql_select_once);
		$arr_select = [
			':username' => $username
		];
		$obj_select_one->execute($arr_select);
		$user = $obj_select_one->fetch(PDO::FETCH_ASSOC);
		return $user;
	}

	//Đăng ký user
	public function register()
	{
					$sql_insert = "INSERT INTO users (`username`, `password`, `first_name`, `last_name`, `phone`, `address`, `email`) VALUES(:username, :password, 
		:first_name, :last_name, :phone, :address, :email)";
// 		$sql_insert = "INSERT INTO users (`username`, `password`) VALUES(:username, :password 
// )";
		$obj_insert = $this->connection->prepare($sql_insert);
		//gán giá trị thật cho các placeholder
		$arr_insert = [
			':username' => $this->username,
			':password' => $this->password,
			':first_name' => $this->first_name,
			':last_name' => $this->last_name,
			':phone' => $this->phone,
			':address' => $this->address,
			':email' => $this->email
		];
		return $obj_insert->execute($arr_insert);
	}
	public function update()
	{
		$id = $_GET['id'];
					$sql_update = "UPDATE `users` SET `id`='$id',`username`='[value-2]',`password`='[value-3]',`first_name`='[value-4]',`last_name`='[value-5]',`phone`='[value-6]',`address`='[value-7]',`email`='[value-8]',`created_at`='[value-9]',`updated_at`='[value-10]' WHERE id = $id";
// 		$sql_insert = "INSERT INTO users (`username`, `password`) VALUES(:username, :password 
// )";
		$obj_update = $this->connection->prepare($sql_update);
		//gán giá trị thật cho các placeholder
		$arr_update = [
			':username' => $this->username,
			':password' => $this->password,
			':first_name' => $this->first_name,
			':last_name' => $this->last_name,
			':phone' => $this->phone,
			':address' => $this->address,
			':email' => $this->email
		];
		return $obj_update->execute($arr_update);
	}

	public function getUserLogin($username, $password)
	{
		$sql_select_one = "SELECT * FROM users WHERE `username` = :username AND `password` = :password";
		$obj_select_one = $this->connection->prepare($sql_select_one);
		// truyền giá trị thật cho các placeholder trong câu truy vấn
		$arr_select = [
			':username' => $username,
			':password' => $password
		];
		//thực thi truy vấn
		$obj_select_one->execute($arr_select);
		$user = $obj_select_one->fetch(PDO::FETCH_ASSOC);
		return $user;
	}
}
?>