<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbase = "invoice";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbase);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

} 
//echo "Connected  to database successfully";


        $sql = "SELECT item_name,unit_price FROM items"; // selecting data from database
		$result = $conn->query($sql);//runs the query
        if ($result->num_rows > 0) {
    // output data of each row//
   
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>INVOICE SYSTEM</title>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <style>
table, th, td {
    border: 1px solid black;
}

 .mytable
 {
	 border:1px solid black;
	 width:800px;  
	 background-color: #dddddd; 
	 cellpadding:5px; 
	 cellpadding:5px;
	 float:center;
	  margin-left:300px;
	 
 }
  .yarikul{
	  width:350px;
	  height:160px; 
	 float:left; margin-top:5px; 
	  padding:10px; margin-left:5px;
	  margin-top:30px;
	  margin-left:20px;
	  color:black;
	 	  
  }
  .top{
	width:800px;
    border:1px solid black;	
	float:center;
	margin-top:250px;
	margin-left:300px;
	height:50px;
	  
	   
   }
   
   body{
	   padding:0px;
	   margin:0px; 
	  
	   
   }
   .fm{
	   margin-top:10px;
   }
   .ad{
	   float:right;
	   margin-right:190px;
	   clear:both;
   }   
  #prnt{
	  
	   float:right;
	   margin-right:190px;
  }
  .nav{
	  border:1px solid black; 
	  width:100%; 
	  height:70px; 
	  background-color:green;
	  margin-top:0px;
  }
  .foot{
	  background-color:green;
	  border:1px solid black;
	  margin-top:79px;
	  width:100%;
	  height:70px;
	  align:center;
  }
  
</style>
</head>
<body>

    <div  class ="nav">
    <h1 style="text-align:center; color:white"> INVOICE SYSTEM<h1></div>
   <div class ="yarikul">
      <h2 style="color:red;">Yarikul Invoice System</h2>
       <p>Address: Rajbagh Near Huriyat office <br> Mobile:123456789<br>Pin:190034 </p> </div>
 
     <div class ="top">
   <form class="fm">
    Customer Name:<input type="text" id="user" name="name" size="15"><span>&nbsp; &nbsp; &nbsp; </span>
    Contact:<input type="tex" name="Contact" id="num" maxlength="10" size="15" > <span>&nbsp; &nbsp; &nbsp; </span>
	 Address:<input type="text" name="address" id="add" size="15"><?php
   echo "Date" . date("d/m/Y");
?> 
  </form>
  </div> 
 <table  class="mytable" id="myTable">


	 <tr>
            <th align="left"> Items</th>
			<th align="left"> Unit price</th>
			<th align="left"> Quantity</th>
			<th align="left"> Total Price </th>
			
	 </tr>
     <tr>
    <td>
    <select class="item" >
	<option value=""> Select Item </option>
	<?php while($row = $result->fetch_assoc()) { ?>
	 <option id="opt" value="<?php echo $row["item_name"]; ?>" unitprice="<?php echo $row["unit_price"];?>"> <?php echo $row["item_name"];?> </option> 
	 <?php } } ?>	 
     </select> 
	</td>	
	<td>
	<input type="text" id="unitprice" disabled >
	</td>
	<td>
	<input type="text"  class="qty">
	</td>
	<td>
	<input type="text" id="total">
	</td> 
	<tr>
	   <input class="ad" type="button" id="addrow"  value="Add More" >
	   
	   
	</tr>
	<tfoot>
	<th colspan="3">GRAND TOTAL</th>
	<td><input type="text" id="grandtotal" align="left"></td>
	  </tfoot>
</table>
  <div>
 <input id="prnt" type="button" onClick="window.print()" value="print!"/>
</body>
</div>

    <div  class ="foot">
    <h4 style="text-align:center; color:white">Developed By Sajid Khaki<h4></div>
</html>
<script>

$(document).ready(function(){
	  $("body .mytable").on("change", ".item", function (e) {
    	   $(this).closest("tr").find("#unitprice").val(  $(this).closest("tr").find(".item option:selected").attr('unitprice') );
    });
	
  $("#addrow").click(function(){
	  
	    	$(".mytable").append( $("table").find('tr').first().next().clone());
			$('.mytable tr:last input').val('');
            
   });
   
    $("body .mytable").on("input", ".qty", function (e) {
		var grandtotal=0;
		 var quantity= $(this).closest("tr").find(".qty ").val();
		 var unitprice= $(this).closest("tr").find("#unitprice ").val();
		 var total= quantity * unitprice;
		 $(this).closest("tr").find("#total").val(total);
		  $(".mytable tr" ).each(function(){
			 grandtotal=total+grandtotal;
			 	 
		 });
		     $("#grandtotal").val(grandtotal);
 
	  });	  

 });	  

 
 
  $( document ).ready(function() {
    $('#lnkPrint').click(function()
     {
         window.print();
     });
});
 


</script>