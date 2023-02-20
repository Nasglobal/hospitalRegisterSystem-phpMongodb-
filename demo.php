<?php
 require_once('dbconnect.php');

 //$result= $patientdb->biodata->aggregate([['$group'=>['_id'=>'$payment_record.patientid','sumAmount'=>['$sum' => '$payment_record.amount']]],['$match'=>['sumAmount'=>['$gt'=>50000]],['$lookup' => ['from' => "payment",'localField' => "_id",'foreignField' => "patientid", 'as' => "payment_record"]],['$unwind'=>'$payment_record']]]);





$result= $patientdb->biodata->aggregate([['$lookup' => ['from' => "payment",'localField' => "_id",'foreignField' => "patientid", 'as' => "payment_record"]],
    ['$unwind'=>'$payment_record'],
	['$group'=>['_id'=>'$name','sumAmount'=>['$sum' => '$payment_record.amount']]],
	['$match'=>['sumAmount'=>['$gt'=>50000]]],['$project'=>['_id'=>1,'biodata._id'=>1,'sumAmount'=>1]]]);

  foreach($result as $list){
      //echo $list->biodata->_id . '<br>';
  	  echo $list->_id. '<br>';
	  echo $list->sumAmount. '<br>';
  }

  //var_dump($result);
?>