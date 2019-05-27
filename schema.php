<?php 



require 'config/init.php';
require CLASS_PATH.'schema.php';
$schema = new Schema();

$sql = array(
    'users' => "CREATE TABLE IF not EXISTS users (
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			full_name varchar(50),
			email varchar(150) not null,
			password text not null,
			roles ENUM('Admin', 'Customer', 'Vendor'),
			status ENUM('Active', 'Inactive'),
			remember_token text DEFAULT null,
			api_token text DEFAULT null,
			other_info text DEFAULT null,
			added_date datetime DEFAULT CURRENT_TIMESTAMP,
			updated_date datetime on UPDATE CURRENT_TIMESTAMP
	)",
	'passwordReset' => "CREATE TABLE IF NOT EXISTS `passwordReset` (
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			email text not null,
			selector text not null,
			token longtext not null,
			expires text not null
	)",
	'categories' => "CREATE TABLE IF NOT EXISTS categories(
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			title varchar(150),
			summary text null,
			image text,
			is_parent tinyint DEFAULT 1,
			parent_id int DEFAULT null,
			show_in_menu tinyint DEFAULT 1,
			status ENUM('Active', 'Inactive')
	)",
	'news'	=> "CREATE TABLE IF NOT EXISTS news(
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			title text,
			summary longtext,
			story longtext not null,
			news_category int unsigned,
			image text,
			status ENUM('Active', 'Inactive'),
			added_by varchar(150),
			added_date varchar(150),
			updated_date datetime ON UPDATE CURRENT_TIMESTAMP

	)",
	'book'	=> "CREATE TABLE IF NOT EXISTS book(
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			title text,
			story longtext not null,
			publication text,
			price int,
			image text,
			status ENUM('Active', 'Inactive'),
			added_by varchar(150),
			added_date datetime DEFAULT CURRENT_TIMESTAMP,
			updated_date datetime ON UPDATE CURRENT_TIMESTAMP

	)",
	'series'	=> "CREATE TABLE IF NOT EXISTS series(
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			month text,
			image text,
			added_date datetime DEFAULT CURRENT_TIMESTAMP,
			updated_date datetime ON UPDATE CURRENT_TIMESTAMP

	)",
	'profile'	=> "CREATE TABLE IF NOT EXISTS profile(
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			title text,
			summary longtext,
			story longtext not null,
			image text,
			status ENUM('सक्रिय', 'निष्क्रिय'),
			added_by int,
			added_date varchar(150),
			updated_date datetime ON UPDATE CURRENT_TIMESTAMP

	)",
	'gallery'	=> "CREATE TABLE IF NOT EXISTS gallery(
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			title text,
			description varchar(150),
			thumbnail text,
			status ENUM('सक्रिय', 'निष्क्रिय'),
			added_by int,
			added_date varchar(150),
			updated_date datetime ON UPDATE CURRENT_TIMESTAMP

	)",
	'gallery_images'	=> "CREATE TABLE IF NOT EXISTS gallery_images(
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			gallery_id int,
			image_name text
	)",
	'janamat'	=> "CREATE TABLE IF NOT EXISTS janamat(
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			title int,
			added_date varchar(100)
	)",
	'bookmark'	=> "CREATE TABLE IF NOT EXISTS bookmark(
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			user_id int,
			post_id int
	)",
	'quiz' => "CREATE TABLE IF NOT EXISTS `quiz` (
		    id int unsigned not null AUTO_INCREMENT,
		    PRIMARY KEY (id),
		    title text,
		    added_date timestamp DEFAULT CURRENT_TIMESTAMP,
		    updated_date datetime 
	)",
	'quizoptions' => "CREATE TABLE IF NOT EXISTS `quizoptions` (
		    id int unsigned not null AUTO_INCREMENT,
		    PRIMARY KEY (id),
		    answers varchar(200),
		    question_id int (10),
		    added_date timestamp DEFAULT CURRENT_TIMESTAMP,
		    updated_date datetime 
	)",
	'quizans' => "CREATE TABLE IF NOT EXISTS `quizans` (
		    id int unsigned not null AUTO_INCREMENT,
		    PRIMARY KEY (id),
		    user_id int(10),
		    question_id int(10),
		    answer varchar(200)
	)",
	'answUsers' => "CREATE TABLE IF NOT EXISTS `answUsers` (
		    id int unsigned not null AUTO_INCREMENT,
		    PRIMARY KEY (id),
		    user_id int(10)
	)",
	'quizusers' => "CREATE TABLE IF NOT EXISTS `quizusers` (
		    id int unsigned not null AUTO_INCREMENT,
		    PRIMARY KEY (id),
		    user_id int(10),
		    correct_answer int(10),
		    added_date timestamp DEFAULT CURRENT_TIMESTAMP
	)",
	'winner' => "CREATE TABLE IF NOT EXISTS `winner` (
		    id int unsigned not null AUTO_INCREMENT,
		    PRIMARY KEY (id),
		    user_id int(10),
		    month varchar(100),
		    address varchar(200),
		    added_date datetime DEFAULT CURRENT_TIMESTAMP
	)",
	'ads' => "CREATE TABLE IF NOT EXISTS `ads` (
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			title text,
			url varchar(200),
			image text,
			size ENUM('३१३ X  २३६','९००  X  १००') CHARACTER SET utf8 COLLATE utf8_unicode_ci,
			status ENUM('Active', 'Inactive') CHARACTER SET utf8 COLLATE utf8_unicode_ci,
			added_date datetime DEFAULT CURRENT_TIMESTAMP,
			updated_date datetime on UPDATE CURRENT_TIMESTAMP
	)",
	'articles' => "CREATE TABLE IF NOT EXISTS `articles` (
		    id int unsigned not null AUTO_INCREMENT,
		    PRIMARY KEY (id),
		    title text,
		    summary varchar(150),
		    story varchar(150),
		    image text,
		    status ENUM('स्वीकृत', 'अस्वीकृत') CHARACTER SET utf8 COLLATE utf8_unicode_ci,
		    Author int(10),
		    added_date varchar(150),
		    updated_date datetime 
	)",
	'podcast' => "CREATE TABLE IF NOT EXISTS podcast (
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			title text,
			category text,
			duration text,
			audio text,
			image text,
			added_date datetime DEFAULT CURRENT_TIMESTAMP,
			updated_date datetime on UPDATE CURRENT_TIMESTAMP	
	)",
	'comments'	=> "CREATE TABLE IF NOT EXISTS comments(
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			user_id int,
			post_id int,
			comment varchar(2000),
			status ENUM('Active', 'Inactive')
	)",
	'push_token'	=> "CREATE TABLE IF NOT EXISTS push_token(
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			tokens varchar(2000)
	)",
	'subscribers'	=> "CREATE TABLE IF NOT EXISTS subscribers(
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			orderid varchar(200),
			uid int,
			amount int,
			version text
	)",
	'paymentSession'	=> "CREATE TABLE IF NOT EXISTS paymentSession(
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			uid int,
			shippingName varchar(200),
			shippingAddress varchar(200),
			shippingContact varchar(200),
			shippingCountry varchar(200)
	)",
	'postAuthor'	=> "CREATE TABLE IF NOT EXISTS postAuthor(
			id int unsigned not null AUTO_INCREMENT,
			PRIMARY KEY (id),
			post_id int,
			user_id int
	)",
	'category_permitted'  => "CREATE TABLE  IF NOT EXISTS category_permitted (
		   id int(11) NOT NULL,
		   user_id int(10) UNSIGNED DEFAULT NULL,
		   category_id int(10) UNSIGNED DEFAULT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
	);

foreach ($sql as $table => $query) {
	if ($schema->createTable($query)) {
		echo "<em>".$table."</em> Table created successfully.";
	} else {
		echo "Sorry! There was problem creating <em>".$table."</em> table";
	}
	echo "<br>";
}
