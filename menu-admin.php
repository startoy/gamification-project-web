<!-- 
<nav class="" style="font-size: 20px;display: flex;justify-content: center;margin-bottom:1%;margin-top:1%;">
	<ul class="nav nav-pills">
		<li role="presentation" class="nav-user">
			<a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> 
			<b>HOME</b>
			</a>
		</li>
		<li role="presentation" class="nav-user">
			<a href="profile.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
			<b>PROFILE</b>
			</a>
			</li>
	</ul>
	
</nav>

 -->

 	<ul class="nav nav-pills nav-user center-block">
<!-- 		<li role="presentation" class="">
			<a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> 
			<b>HOME</b>
			</a>
		</li> -->
<!-- 		<li role="presentation" class="">
			<a href="profile.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
			<b>PROFILE</b>
			</a>
		</li> -->
		<li role="presentation" class="">
			<a href="editsection.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			<b>MANAGE SECTION</b>
			</a>
		</li>
		<li role="presentation" class="">
			<a href="editaccount.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			<b>MANAGE ACCOUNT</b>
			</a>
		</li>
		<li>
			<a href="logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> 
			<b>LOGOUT</b>
			</a>
		</li>
	</ul>

<style>
.nav-user{
	clear:right;
	font-size: 20px; /* ขนาดอักษร*/
	display: flex; /* samelength */
	justify-content: center; /* จัดกลาง */
	margin-bottom:0%; /* ข้างล่างห่าง */
	margin-top:0px; /* ข้างบนห่าง */
	background-color:#664412 ; /* สีพื้นหลังของแถบ */
}
.nav-user > li > a {
	color:white; /* สีตัวอักษร */
	background-color:#594326 ; /* พื้นหลังแต่ละเมนู */
	display: inline-block;

}

.nav-user > li > a:hover {
	background-color:#B4090B; /* สีเมื่อเมาส์ไปวาง */
}

/*
.nav-user {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #111;
}*/

</style>