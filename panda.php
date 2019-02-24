<?php
session_start();
?>
<!DOCTYPE html>
<head>
<title>Test</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
td{
width:13%;
text-align:center;
padding:10px;	
}

.add_span, .add_spanlog{
	color:red;
	font-weight:bold;
	font-size:13px;
}
table{
width:80%;
margin:auto;
font-size:17px;	
}
.form-control{
margin-bottom:-15px !important;	
}

</style>


</head>
<body>


<?php

//session variable used to keep the user logged in. So we check if it is active initially to determine what should be rendered on the page
//if it is not active the register and log-in forms will be shown, otherwise the news management system will be shown, with the data related to the user/author

if(empty($_SESSION['codigo'])){
$codigo=$_SESSION['codigo'];	
print<<<HERE
<div class="container">

HERE;
//jquery will be used to handle some events (update, delete, etc). Even though not strictly necessary it makes the user's experience nicer.  Also some Ajax, to not to have to resort to refreshing the page on every update on the database
?>
<script>
$(document).ready(function(){
  $("#register").click(function(){
    $("#register1").toggle();
  });
  
  $("#login").click(function(){
    $("#login1").toggle();
 
});
});
</script>

<?php
print<<<HERE
 <div class="row" style="width:90%; margin:auto">
  <h1><button class="btn btn-primary" id="register">Register</button></h1>
  <div id="register1">
  <div class="form-horizontal">
  <div class="form-group">
      <label class="control-label col-sm-2" for="nam">Name:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="lna">Last Name:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="lastname" placeholder="Enter Last name" name="lastname">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="lna">Gender:</label>
      <div class="col-sm-4">
      <div class="radio">
      <label><input type="radio" id="male" name="gender" checked>Male</label>
    </div>
    <div class="radio">
      <label><input type="radio" id="female" name="gender">Female</label>
    </div>
      </div>
      </div>
  
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-4">
        <input type="email" class="form-control" id="email"  placeholder="Enter email" name="email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-4">          
        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-4">
        <button type="submit" class="btn btn-default" id="registerform">Submit</button>
      </div>
    </div>
      <div class="col-sm-offset-2 col-sm-4" style="display:none" id="registration_done">
        <div class="text-success"><b>You have been registered, you can log in!</b></div>
      </div>
  </div>
  </div>
  </div>

  
  <div class="row" style="width:90%;margin:auto">
  <h1><button class="btn btn-warning" id="login">Log in</button></h1>
  <div id="login1">
  <div class="form-horizontal">
  <div class="form-group">
      <label class="control-label col-sm-2" for="ema">Email:</label>
      <div class="col-sm-4">
        <input type="email" class="form-control" id="emaillog" placeholder="Enter email" name="emaillog">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-4">          
        <input type="password" class="form-control" id="passwordlog" placeholder="Enter password" name="passwordlog">
      </div>
    </div>
	
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-2">
        <button type="submit" class="btn btn-default" id="loginform">Submit</button>
      </div>
    </div>
    
  </div>
  </div>
  </div>
  
</div>


HERE;
 ?>
  
  
  <script>


$(document).ready(function(){
$(document).on('click', '#registerform', function(e) {
   
$(".add_span").hide();
var name = $("#name").val();
//some basic form validation is implemented, before accepting the details submitted by the user who wants to register. It could be made more complex accordingly
//ideally we would not store the password as it is, for security reasons. We could use hash methods instead (not done in this exercise to simplify it)
var lastname = $("#lastname").val();
var email = $("#email").val();
var password = $("#password").val();
var regex=/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,6})+$/;
var regex2=/^([a-z0-9`àèìòùáéíóúñÑçÇöÖüÜ_-]*[a-zÑñçÇöÖüÜàèìùòáéíóú]+[a-z0-9`ñÑçÇöÖüÜàèìòùáéíóú_-]*){5,}$/i;
//alert(email);
if($('#male').is(':checked')){
var gender="male";
}
else{
var gender="female";    
}
//alert(gender);
var total_reg=0;
if(name==""){
$(this).parents("#register1").find("#name").after("<span class='add_span'><br>you need to enter your name</span>");
total_reg++;
}
else if((name.length>35)||(name.length<2)){
$(this).parents("#register1").find("#name").after("<span class='add_span'><br>the name needs to have between 2 and 35 characters</span>");
total_reg++;
}
if(lastname==""){
$(this).parents("#register1").find("#lastname").after("<span class='add_span'><br>you need to enter your last name</span>");
total_reg++;
}
else if((lastname.length>35)||(lastname.length<2)){
$(this).parents("#register1").find("#lastname").after("<span class='add_span'><br>the last name needs to have between 2 and 35 characters</span>");
total_reg++;
}

if(email==""){
$(this).parents("#register1").find("#email").after("<span class='add_span'><br>you need to enter an email address</span>");
total_reg++;
}

else if (!regex.test(email)) {
$(this).parents("#register1").find("#email").after("<span class='add_span'><br>you need to enter a valid email</span>");
total_reg++;
} 
if(password==""){
$(this).parents("#register1").find("#password").after("<span class='add_span'><br>you need to enter a password</span>");
total_reg++;
}
else if((password.length>18)||(password.length<7)){
$(this).parents("#register1").find("#password").after("<span class='add_span'><br>the last name needs to have between 2 and 35 characters</span>");
total_reg++;
}
else if (!regex2.test(password)) {
$(this).parents("#register1").find("#password").after("<span class='add_span'><br>the password you entered has no valid characters</span>");
total_reg++;
} 


//if all data is fine the variable total_reg remains unchanged, and then we use Ajax to enter the data in the database
if(total_reg==0){
    
$.post("register_user.php",
    {
       
  name: name,
	lastname: lastname,
 password: password,
 gender:gender,
 email:email
        
	    
    },
    function(data, status){
	    // alert("Data: " + data + "\nStatus: " + status);
			
$("#registration_done").show();

  });

    
}

});


$(document).on('click', '#loginform', function(e) {
   
$(".add_spanlog").hide();
var emaillog = $("#emaillog").val();
var passwordlog = $("#passwordlog").val();

var total_log=0;
if(emaillog==""){
$(this).parents("#login1").find("#emaillog").after("<span class='add_spanlog'><br>you need to enter an email</span>");
total_log++;
}

if(passwordlog==""){
$(this).parents("#login1").find("#passwordlog").after("<span class='add_spanlog'><br>you need to enter a password</span>");
total_log++;
}



if(total_log==0){
//if user can log in, the session variable will be started and, as a consequence, he/she will be shown the management system, o calling window.location    
$.post("login_user.php",
    {
       
 emaillog: emaillog,
 passwordlog: passwordlog
        
	    
    },
    function(data, status){
	     //alert("Data: " + data + "\nStatus: " + status);
			
if(data=="great"){
   
  window.location = "panda.php"
}


  });

}

});




});

</script>
<?php


}
else
{
//the user is logged in
print<<<HERE

<div class="container-fluid_number">
<div class="row" styles="width:90%;margin:auto">
      <div class="col-sm-3">
        <div style="width:90%;margin:auto;padding-top:50px;padding-left:50px"><button class="btn btn-outline-secondary" id="log_out">Log-out</button></div>
        </div>
        

<div class="col-sm-9">
<h1 style="text-align:center;padding:20px;margin-right:30%">News Management</h1
</div>
</div>
<div class="row" style="width:90%;margin:auto">
<table id="table1" class="table table-hover table-responsive table-striped" style="padding:15px">
<tr style="font-weight:bold;height:50px" class="info">
<td>Name</td>
<td>Description</td>

<td></td>
<td></td>

</tr>

HERE;
$codigo=$_SESSION['codigo'];

//I create a table in which the user can see the pieces of news uploaded by him/her, update their data, delete it (deactivate it) and add new pieces of news. 

include('conexioninclude.php');
$query=mysqli_query($con,"SELECT * FROM news WHERE (author_id='$codigo' && is_active='yes')"); 
$variab=0;
if (mysqli_num_rows($query) > 0) {
while($reg=mysqli_fetch_array($query))
{

$variab++;
$name=$reg['name'];
$description=$reg['description'];

$id=$reg['id'];
print<<<HERE
<tr class="$variab">
<td class="$variab idid" style="display:none">$id</td>
<td class="$variab namename inpu">$name<div class="namename2" style="display:none"><br><input style="text-align:center;color:#999999" class="form_control add_name" value="$name"></div></td>
<td class="$variab descriptiondescription inpu">$description<div class="descriptiondescription2" style="display:none"><br><input class="form_control add_description" style="text-align:center;color:#999999" value="$description"></div></td>

<td class="$variab updateupdate"><button class="update btn btn-primary">update</button></td>
<td class="$variab deletedelete"><button class="delete1 btn btn-warning">delete</button></td>
</tr>
HERE;
}
}
print<<<HERE

</table>


<table  style="width:100%" class="table table-responsive" >
<tr id="add_row" style="width:20%;text-align:center:margin:auto"><td><button id="add_button" class="btn btn-info">add news</button></td></tr>
</table>
HERE;
?>
<script>


$(document).ready(function(){

$(document).on('click', '#log_out', function(e) {
//simple ajax method to call th ephp file where the session variable is unset. Then, on calling the current page again the user finds himself/herself logged out
$.ajax({url: "panda_logout.php", success: function(result){
window.location = "panda.php"      
    }});


  });



$(document).on('click', '#add_button', function(e) {
$("#add_row").hide();
$("#table1").append("<tr class='new_row'><td><input class='add_name' placeholder='Enter name'></td><td><textarea class='add_description form-control' placeholder='Enter description'></textarea></td><td><button class='submit_button btn btn-success'>submit</button></td><td><button class='delete btn btn-warning'>delete</button></td></tr>");
 $("input").addClass('form-control');//this class adds some style to the input elements
  });

	

	   
//when the user has added a new row to add a new piece of news. To send this info to the database he will use the submit_button button:	   

$(document).on('click', '.submit_button', function(e) {

var name = $(this).parents(".new_row").find(".add_name").val();
var description = $(this).parents(".new_row").find(".add_description").val();

$(this).parents(".new_row").find(".add_span").remove();  
//basic validation used, it could be more complex
var total_fields=1;

if(name==""){
$(this).parents(".new_row").find(".add_name").after("<span class='add_span'><br>you need to enter a name</span>");


total_fields++;

}
else if((name.length)>35||(name.length<2)){

$(this).parents(".new_row").find(".add_name").after("<span class='add_span'><br>the name needs to have between 2 and 35 characters</span>");	
total_fields++;
}

if(description==""){
$(this).parents(".new_row").find(".add_description").after("<span class='add_span'><br>you need to enter a description</span>");
total_fields++;

}
else if((description.length)>600||(description.length<2)){

$(this).parents(".new_row").find(".add_description").after("<span class='add_span'><br>the description needs to have between 2 and 600 characters</span>");	
total_fields++;
}



//so if every input data is validated we can send the data to the database, icluding the author/user id for further use
if(total_fields==1){	
var author = <? echo $_SESSION['codigo']; ?>;

$.post("adding_news.php",
    {
       
        name: name,
	description: description,
        author: author 
        
	    
    },
    function(data, status){
	       //alert("Data: " + data + "\nStatus: " + status);
			
$("#new_row").hide();
$("#add_row").show();
//there is an array in the php page, as response, so we get its variables using JSON:
var duce = jQuery.parseJSON(data);
var name2 = duce[0];  
var description2 = duce[1];
var author = duce[2];
var id2 = duce[3];

//we remove the row the user added and create a new one directly from the database and ready to be updated or deleted, like the others:
$(".new_row").remove();
 var class_number=$("#table1 tr:last").prop('className');
 var sisi = parseInt(class_number) + parseInt(1);
$("#table1").append("<tr class='"+sisi+"'><td class='"+sisi+" idid' style='display:none'>"+id2+"</td><td class='"+sisi+" authorauthor' style='display:none'>"+author+"</td><td class='"+sisi+" namename inpu'>"+name2+"<div class='namename2' style='display:none'><br><input style='text-align:center;color:#999999' value='"+name2+"'></div></td><td class='"+sisi+" descriptiondescription inpu'>"+description2+"<div class='descriptiondescription2' style='display:none'><br><input style='text-align:center;color:#999999' value='"+description2+"'></div></td><td class='"+sisi+" updateupdate'><button class='update btn btn-primary'>update</button></td><td class='"+sisi+" deletedelete'><button class='delete1 btn btn-warning'>delete</button></td></tr>");

  });

}
	
});
	   


//button to delete/deactivate rows (of pieces of news) already stored in the database.We only need to retrive their id value:
	   
$(document).on('click', '.delete1', function(e) {
var sisi = $(this).parent().prop('className').split(' ')[0];
var id= $("."+sisi+".idid").text();


  $.post("deleting_news.php",
    {
		id:id,
	    
    },
    function(data, status){
	       // alert("Data: " + data + "\nStatus: " + status);
			$("."+sisi).hide();

    });

});
//when the user clicks on the update button to change any of the details for a piece of news/row. 
$(document).on('click', '.update', function(e) {

$(this).addClass('submit').removeClass('update');
$(this).addClass('btn-success').removeClass('btn-primary');

$(this).text("submit");
var sisi = $(this).parent().prop('className').split(' ')[0];

$("."+sisi).css("background-color","#eeeeee");
$("."+sisi+".inpu").children().css("display","block");
$("."+sisi).css("height","60px");
});


$(document).on('click', '.submit', function(e) {

var sisi = $(this).parent().prop('className').split(' ')[0];
	
 var id= $("."+sisi+".idid").text();
 var author= $("."+sisi+".authorauthor").text();
 var name= $("."+sisi+".namename").find("input").val();
 var description= $("."+sisi+".descriptiondescription").find("input").val();
  
 $(this).parents("."+sisi).find(".add_span").remove();   

//similar method than when the user tries to submit a recently added row 
var total_fields=1;
if(name==""){
$(this).parents("."+sisi).find(".add_name").after("<span class='add_span'><br>you need to enter a name</span>");
total_fields++;

}

else if((name.length)>35||(name.length<2)){
$(this).parents("."+sisi).find(".add_name").after("<span class='add_span'><br>the name needs to have between 2 and 35 characters</span>");	
total_fields++;
}
if(description==""){
$(this).parents("."+sisi).find(".add_description").after("<span class='add_span'><br>you need to enter a description</span>");
total_fields++;

}
else if((description.length)>300||(description.length<2)){
$(this).parents("."+sisi).find(".add_description").after("<span class='add_span'><br>the description need to have between 2 and 300 characters</span>");	
total_fields++;
}

if(total_fields==1){

$.post("update_news.php",
    {
        id:id,
	name: name,
	description: description,
        author:author
		
	    
    },
    function(data, status){
	//alert("Data: " + data + "\nStatus: " + status);
var duce = jQuery.parseJSON(data);				
var name2 = duce[0];
var description2 = duce[1];
var author2 = duce[2];
var id2=duce[3];
$(this).addClass('update').removeClass('submit');
//once the data has been stored in the database adnd we get the response forom the php file, through Ajax, we modify the row so that it can also be updated and deleted like the other rows.
$("."+sisi).html("<td class='"+sisi+" idid' style='display:none'>"+id2+"</td><td class='"+sisi+" namename inpu'>"+name2+"<div class='namename2' style='display:none'><br><input style='text-align:center;color:#999999'  value='"+name2+"'></div></td><td class='"+sisi+" descriptiondescription inpu'>"+description2+"<div class='descriptiondescription2' style='display:none'><br><input style='text-align:center;color:#999999' value='"+description2+"'></div></td><td class='"+sisi+" updateupdate'><button class='update btn btn-primary'>update</button></td><td class='"+sisi+" deletedelete'><button class='delete1 btn btn-warning'>delete</button></td>");
//to add the selected attributes to the option elements which were chosen (in case the user keeps updating):
$("."+sisi).find(".selectbox").val(level2).find("option[value=" + level2 +"]").attr('selected',true);
$("."+sisi).find(".selectbox2").val(classs2).find("option[value=" + classs2 +"]").attr('selected',true);


    });
}
});

//when the user deletes a recently added row whihc has not been sent to the database yet:
$(document).on('click', '.delete', function(e) {
$(this).parent().parent().hide();
$("#add_row").show();

});
	 

	
});	
	

</script>
</div>

</div>
<?php
}
?>
</body>
</html>