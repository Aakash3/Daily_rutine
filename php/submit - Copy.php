<?php
//	$file = $_POST['file'];
	$file=$_FILES['file']['name'];
	$ftmp=$_FILES['file']['tmp_name'];

	$f_size=$_FILES['file']['size'];
	$fextension=explode('.',$file);
	$fextension=strtolower(end($fextension));
	$f_newfile=uniqid().'.'.$fextension;		//unique id of that file
	$store="../uploads/".$f_newfile;
	if($fextension=='docx'||$fextension=='doc'||$fextension=='txt'||$fextension=='pdf'){
		if($f_size<=1000000){
move_uploaded_file($ftmp, $store);
// Start the session
session_start();
//echo"HELLO, '".$_SESSION["name"]."'";
$account=$_SESSION["user"];
?>
<meta charset="UTF-8">
<?php
$servername = "fdb17.biz.nf";
$username = "2429679_incent";
$password = "incent1234";
$databasename = "2429679_incent";
$conn = new mysqli($servername, $username, $password,$databasename);
if ($conn->connect_error) {

/*  To check what is error, use this statement.
	die("Connection failed: " . $conn->connect_error);
	window.location.href='../index.html';
*/
	echo("<SCRIPT LANGUAGE='JavaScript'>
			window.history.back();
			window.alert('Sorry!! Database Connection Failed. Take screenshot and sent email to INCENT Team.');
			</SCRIPT>");
}
else{

$query_user = mysqli_query($conn,"SELECT SN,account,first_name FROM account WHERE account = '".$account."'");
	if(mysqli_num_rows($query_user) > 0)
	{
		while ($row=mysqli_fetch_row($query_user))
		{

		$i_sn = ($row[0]);
		$i_user = ($row[1]);
		$i_name = ($row[2]);
	}
	}
	$team = $_POST['team'];
	$no_team = $_POST['no_team'];
	$mem_name = $_POST['mem_name'];
	$sch_name = $_POST['sch_name'];
	$sch_address = $_POST['sch_address'];
	$principal = $_POST['principal'];
	$sch_phone = $_POST['sch_phone'];
	$sch_email = $_POST['sch_email'];
	$title = $_POST['title'];
	$summary = $_POST['summary'];
//.............Getting file type

	$sql = "INSERT INTO idea(i_sn,i_user,i_name,team,no_team,mem_name,sch_name,sch_address,principal,sch_phone,sch_email,title,summary,file) VALUES('$i_sn', '$i_user', '$i_name', '$team', '$no_team', '$mem_name', '$sch_name', '$sch_address', '$principal', '$sch_phone', '$sch_email', '$title', '$summary', '$f_newfile')";

	if($conn->query($sql) === TRUE){
		echo("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Your data have been submitted. Thank you for participate.');
			window.location.href='../index.html';
			</SCRIPT>");
	mysqli_close($conn);
	}else{
		echo"Cannot insert data. something Wrong in data";
		echo("<SCRIPT LANGUAGE='JavaScript'>
			window.history.back();
			window.alert('There is fault in your data. Please check your data and Try again to submit. Thank you!');
			</SCRIPT>");
	}
}

//last part of checking file.
		}else{
echo("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('File size should not be greater than 1MB.');
			window.history.back();
			</SCRIPT>");
		}
}else{
		echo("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Please upload *.docx, *.doc, *.txt or *.pdf Files Only.');
			window.history.back();
			</SCRIPT>");

}

?>
