<?php
   require_once('dbconnect.php');
   
   
   if(isset($_GET['id'])){
    $patient_id=(int)$_GET['id'];
    if(!empty($patient_id)){
	 $result = $patientdb->biodata->findOne(
	 ['_id'=>$patient_id]
	 );
		 
           echo "
		   <form class='form-horizontal' action='#' method='post' >
                                    
                                <div class='form-group'>
                                    <label  class='col-sm-4 control-label'>Patient's ID</label>
                                    <div class='col-sm-4'>
                                        <input type='number' class='form-control' name='patientid' value='$result->_id' readonly='readonly'>
                                    </div>
                                </div>
                                    
                               
                                 <div class='form-group'>
                                       <label class='col-sm-4 control-label'>Enter Amount</label>
                                       <div class='col-sm-4'>
                                         <input type='number' class='form-control' name='amount' value=''>
                                       </div>
                                 </div>
								  <div class='form-group'>
                                       <label class='col-sm-4 control-label'>What is the payment for?</label>
                                       <div class='col-sm-4'>
                                         <input type='text' class='form-control' name='descp' value=''>
                                       </div>
                                 </div>
								 <div class='form-group'>
                                       
                                       <div class='col-sm-4 col-sm-offset-4'>
                                         <input type='submit' name='submitp' class='btn btn-primary' value='Make Payment'>
                                       </div>
                                 </div>
								 
                               
                                 <div class='modal-footer'>
                                    <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                    
                                 </div>
                            </form>";
							
							}}


if(isset($_GET['ph'])){
   $total=0;
    $patientid=(int)$_GET['ph'];
    if(!empty($patientid)){
	$result1 = $patientdb->payment->findOne(
	['patientid' => $patientid]);
	if(!$result1){
		echo "<button type='submit' class='btn btn-danger'><b>NO PAYMENT RECORED FOUND</b></button>";
	}else{
	echo "
	<button type='submit' class='btn btn-success'><b> payment history</b></button>
	<br>
	<br>
	<li class='list-group-item'><span class='badge'><b>AMOUNT</b></span><b>DATE AND TIME</b></li>
	";
	$result = $patientdb->payment->find(
	['patientid' => (int)$patientid]);
	foreach($result as $listp){
	    $total=$total + (int)$listp->amount;
	  echo  "
           <li class='list-group-item'><span class='badge'><b> # $listp->amount</b></span><b>$listp->date</b></li>
           
		";
		}
		echo " 
		<br>
		<div class='col-sm-offset-3 col-sm-6'>
           <button type='submit' class='btn btn-primary'>Total : # $total </button>
           </div>
";
		}}

		}
		 if(isset($_GET['user'])){
		   session_start();
      
			session_destroy(); 
			header('location:index.php');

		}


		if(isset($_GET['del'])){
		$patientid=(int)$_GET['del'];
       if(!empty($patientid)){
	    $patientdb->biodata->deleteOne(['_id'=>$patientid]);
		header('location:admin.php');
	   }
		}

		if(isset($_GET['edit'])){
    $patient_id=(int)$_GET['edit'];
    if(!empty($patient_id)){
	 $result = $patientdb->biodata->findOne(
	 ['_id'=>$patient_id]
	 );

	 echo"
	             <form class='form-horizontal' method='post' >

				  <div class='form-group'>
                                <label  class='col-sm-4 control-label'>patient Id</label>
                                <div class='col-sm-4'>
                                  <input type='number' class='form-control' value='$result->_id' name='patientid' readonly>
                                </div>
                            </div>

                            <div class='form-group'>
                                <label  class='col-sm-4 control-label'>Name</label>
                                <div class='col-sm-4'>
                                  <input type='text' class='form-control' value='$result->name' name='ename' >
                                </div>
                            </div>

                            <div class='form-group'>
                                <label  class='col-sm-4 control-label'>Gender</label>
                                <div class='col-sm-4'>
                                  <input type='text' value='$result->gender' class='form-control' name='egender'>
                                </div>
                             </div>

                            <div class='form-group'>
                                <label class='col-sm-4 control-label'>Age</label>
                                <div class='col-sm-4'>
                                   <input type='number' value='$result->age' class='form-control' name='eage' >
                                </div>
								</div>
								<div class='form-group'>
                                <label  class='col-sm-4 control-label'>Nationality</label>
                                <div class='col-sm-4'>
                                  <input type='text' class='form-control' value='$result->nationality' name='enationality'>
                                </div>
                             </div>

                            <div class='form-group'>
                                <label class='col-sm-4 control-label'>Phone Number</label>
                                <div class='col-sm-4'>
                                   <input type='number' value='$result->phone' class='form-control' name='ephone'>
                                </div>
 
                            </div>


                            <div class='form-group'>
                                <div class='col-sm-offset-4 col-sm-10'>
                                  <button type='submit' name='sub' class='btn btn-primary'>Edit Patient</button>
                                </div>
                            </div>
                        </form>

	 ";
	 }
	 }
							
?>

                        
     