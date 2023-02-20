<?php
require_once('dbconnect.php');
session_start();
if(!isset($_SESSION['user'])){
  header("location:index.php");
}

					 if(isset($_POST["name"]) && isset($_POST["gender"]) && isset($_POST["age"]) && isset($_POST["nationality"]) && isset($_POST["phone"])){
					 $patientid = mt_rand(10000,99999);
					 $name = trim(ucwords($_POST['name']));
					 $gender = trim(ucwords($_POST['gender']));
					 $age = trim(ucwords($_POST['age']));
					 $nationality = trim(ucwords($_POST['nationality']));
					 $phone = trim($_POST['phone']);
	                 
					if(empty($name) || empty($gender) || empty($age) || empty($nationality) || empty($phone)){
					?>
	      <script> alert('sorry empty field not permitted'); </script>
		  <?php
	}else{
	 $patientdb->biodata->insertOne(
	['_id' => (int)$patientid, 'name' => $name,'gender'=>$gender,'age'=>$age,'nationality'=>$nationality,'phone'=>$phone]
	);
	?>
    <script>alert('Record submitted successfully');</script>
	<?php
	}
	 }
	 //editing  patientsbiodata
	  if(isset($_POST["sub"])){
	                 $patientid = (int)trim($_POST['patientid']);
					 $name = trim(ucwords($_POST['ename']));
					 $gender = trim(ucwords($_POST['egender']));
					 $age = trim(ucwords($_POST['eage']));
					 $nationality = trim(ucwords($_POST['enationality']));
					 $phone = trim($_POST['ephone']);
	                 
					if(empty($name) || empty($gender) || empty($age) || empty($nationality) || empty($phone)){
					?>
	      <script> alert('sorry empty field not permitted'); </script>
		  <?php
	}else{
	 $patientdb->biodata->updateOne(
	['_id' => (int)$patientid],
	['$set'=>['name' => $name,'gender'=>$gender,'age'=>$age,'nationality'=>$nationality,'phone'=>$phone]]
	);
	?>
    <script>alert('Record Editted successfully');</script>
	

	<?php
	}
	 }
	?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="images/logo.png" rel="icon"/>
        <title>Online Hospital Management System</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        </head>
	 <script type="text/javascript">
           function load1(thediv,thefile) {
           var xmlhttp = new XMLHttpRequest();
           xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(thediv).innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", thefile, true);
        xmlhttp.send();
             }

			 function del(){
          var s = confirm("Are u sure you want to delete this Patient ?");
            if(s==true){
                return true;
                
            }else{
                return false;
                window.preventDefault();
            }
}
       </script>
    <body>
        <div class="container-fluid">
            
        <!--- Header Start -------->
        <div class="row header">

            <div class="col-md-10">
                    <h2 >Hospital Payment System</h3>
            </div>

            <div class="col-md-2 ">
                <ul class="nav nav-pills ">
                    <li class="dropdown dmenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin <span class="caret"></span></a>
                            <ul class="dropdown-menu ">
                                <li><a href="">Change Profile</a></li>
                                <li role="separator" class="divider"></li>
                                 <li><a href="resource.php?user=<?php echo $_SESSION['user'] ?>">Logout</a></li>
                            </ul>
                     </li>
                </ul>
            </div>
        </div>
  <!--- Header Ends --------->
       
        <div class="row">
    
        <!----- Menu Area Start ------>
        <div class="col-md-2 menucontent">
          
            <a href="#"><h1>Dashboard</h1></a>
                
                <ul class="nav nav-pills nav-stacked">
                  <li role="presentation"><a href="register.php">Create User</a></li>
                  <li role="presentation"><a href="#">Doctors</a></li>
				  <li role="presentation"><a href="#">Patients</a></li>
                  <li role="presentation"><a href="#">Nurse</a></li>
                  <li role="presentation"><a href="#">Profile</a></li>
                </ul>
        </div>
        <!---- Menu Ares Ends  -------->
        
<!-------   Content Area start  --------->
<div class="col-md-10 maincontent" >

    <!-----------  Content Menu Tab Start   ------------>
    <div class="panel panel-default contentinside">
        <div class="panel-heading"><b>Manage Patients Payment</b></div>

        <!----------------   Panel Body Start   --------------->
        <div class="panel-body">
            <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a data-toggle="pill" href="#viewpatients"><b>List of Patients</b></a></li>
                    <li role="presentation"><a data-toggle="pill" href="#addpatients"><b>Add Patient</b></a></li>
					<li role="presentation"><a data-toggle="pill" href="#viewpayment"><b>View All Payment Above #50,000</b></a></li>
					
            </ul>
			<br>
			<div class="tab-content">
            <!----------------   Display Department Data List start   --------------->
			
            <div id="viewpatients" class="tab-pane fade in active">

                   <table class="table table-bordered table-hover">
				             <tr class="active">
                           <td><b>Patient ID</b></td>
                           <td><b>Name</b></td>
                           <td><b>Gender</b></td>
						   <td><b>Age</b></td>
						   <td><b>nationality</b></td>
                           <td><b>Phone Number</b></td>
                           <td><b>Operations</b></td>
                   </tr>
				   <?php
			 $resultlist = $patientdb->biodata->find();
			 foreach($resultlist as $list){
			 
			?>
                   <tr>
				    
        
                           <td><?php echo $list->_id ?></td>
                           <td><?php echo $list->name ?></td>
                           <td><?php echo $list->gender ?></td>
						   <td><?php echo $list->age ?></td>
						   <td><?php echo $list->nationality ?></td>
						   <td><?php echo $list->phone ?></td>
                           <td>
						    <button type="button" onclick="load1('makepayment','resource.php?id=<?php echo $list->_id ?>')" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-euro" aria-hidden="true"></span>Make Payment</button>
							<button type="button" onclick="load2('paymentrecord','resource.php?ph=<?php echo $list->_id ?>')" class="btn btn-success" data-toggle="modal" data-target="#myModalP">Payment history</button>
							<button type="button" onclick="load3('editbiodata','resource.php?edit=<?php echo $list->_id ?>')" class="btn btn-primary" data-toggle="modal" data-target="#myModalEdit"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>Edit</button>
                            <a  href="resource.php?del=<?php echo $list->_id ?>" class="btn btn-danger" onclick='return del()' ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</a>
                           
						   </td>
						  
                   </tr>
            <?php
						   }
						   ?>
                  </table>
               </div>  
              <!----------------   Display Department Data List ends   --------------->
              
              <!------ Edit Department Modal Start ---------->
			  <?php
			   if(isset($_POST["submitp"])){
					 $patientid =trim($_POST['patientid']) ;
					 $amount = (int)trim($_POST['amount']);
					 $descp = trim($_POST['descp']);
					 $date = date("Y-m-d h:i:sa");
					
					if( empty($amount) || empty($descp)){
					?>
	      <script> alert('sorry empty field not permitted'); </script>
		  <?php
	}else{
	 $patientdb->payment->insertOne(
	['patientid' => (int)$patientid,'amount'=>$amount,'descp'=>$descp,'date'=>$date]
	);
	
	?>
    <script>alert('Record submitted successfully');</script>
	<?php
	
	}
	 }
	?>
                            
             
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                       
                    
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Make Payment</h4>
                        </div>
                        
                        <div class="modal-body">
                        <div class="panel panel-default">
                            <div class="panel-body" >
							<div id="makepayment" ></div>
                              </div>
                         </div>
                         </div>
                    </div>
                 </div>
               </div>
			   <!------------paymenthistory--------->

			   <script type="text/javascript">
           function load2(thediv,thefile) {
           var xmlhttp = new XMLHttpRequest();
           xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(thediv).innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", thefile, true);
        xmlhttp.send();
             }
			  function load3(thediv,thefile) {
           var xmlhttp = new XMLHttpRequest();
           xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(thediv).innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", thefile, true);
        xmlhttp.send();
             }
       </script>
  

			   <div id="myModalP" class="modal fade" role="dialog">
          <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Payment History</h4>
      </div>
      <div class="modal-body">
	  <ul class='list-group'>
	   
       <div id="paymentrecord">

	   </div>
	   </ul>
		 
      </div>
	  <br>
	  <br>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!----------------   Modal ends here  --------------->


 <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                       
                    
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Patient's Biodata</h4>
                        </div>
                        
                        <div class="modal-body">
                        <div class="panel panel-default">
                            <div class="panel-body" >
							<div id="editbiodata" ></div>
                              </div>
                         </div>
                         </div>
                    </div>
                 </div>
               </div>
			 
        	 
              
              
              <!----------------   Add Department Start   --------------->
               <div id="addpatients" class="tab-pane fade">

                   <div class="panel panel-default">
                       <div class="panel-body">
					       <?php
		       if(isset($GLOBALS['msg'])){
			      $message = $GLOBALS['msg'];
			      echo $message;
		       }
		       ?>
                           <form class="form-horizontal" action="#" method="post" >

                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Name</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" name="name" placeholder="Patient's Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Gender</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" name="gender" placeholder="gender">
                                </div>
                             </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Age</label>
                                <div class="col-sm-4">
                                   <input type="number" class="form-control" name="age" placeholder="Enter age">
                                </div>
								</div>
								<div class="form-group">
                                <label  class="col-sm-4 control-label">Nationality</label>
                                <div class="col-sm-4">
                                  <input type="text" class="form-control" name="nationality" placeholder="nationality">
                                </div>
                             </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Phone Number</label>
                                <div class="col-sm-4">
                                   <input type="number" class="form-control" name="phone" placeholder="Phone Number">
                                </div>
 
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-10">
                                  <button type="submit" class="btn btn-primary">Add Patient</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
                   <!----------------   Add Department Ends   --------------->     
             <div id="viewpayment" class="tab-pane fade">
			 <table class="table table-bordered table-hover">
                   <tr class="active">
                           <td><b>Patient Name</b></td>
                           <td><b>Total Cumulative Payment</b></td>
						   
                   </tr>
				   <?php
			$paymentlist= $patientdb->biodata->aggregate([['$lookup' => ['from' => "payment",'localField' => "_id",'foreignField' => "patientid", 'as' => "payment_record"]],
                                                   ['$unwind'=>'$payment_record'],
	                                               ['$group'=>['_id'=>'$name','sumAmount'=>['$sum' => '$payment_record.amount']]],
	                                               ['$match'=>['sumAmount'=>['$gt'=>50000]]],['$project'=>['_id'=>1,'sumAmount'=>1]]]);
			foreach($paymentlist as $plist){
			
			?>
                   <tr>
                           <td><?php echo $plist->_id ?></td>
                           <td><?php echo "#".$plist->sumAmount ?></td>
						   
                           
                   </tr>
           <?php
		   }
		   ?>
                  </table>

			 </div>
        <!----------------   Panel Body Ends   --------------->
    </div>
    <!-----------  Content Menu Tab Ends   ------------>
	</div>
</div>

<!-------   Content Area Ends  --------->
        </div>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

