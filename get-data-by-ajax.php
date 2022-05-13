<?php
  include_once "lib/Session.php";

  include_once 'lib/Database.php';


  Session::checkSession();


  if(isset($_SESSION['permission'])){

    $userPermission = $_SESSION['permission'];
  }

  if(!isset($userPermission)){
    Session::destroySession();
  }

  include_once 'classes/Slot.php';

  include_once 'classes/Rate.php';


  $slot = new Slot();

  $rate = new Rate();

  // get slot data

  if(isset($_POST['get_slot'])){

    $categoryId = $_POST['get_slot'];

    if ($categoryId!=null) {
      $getSlot = $slot->get_slot_by_category($categoryId);
      
      while($slot = mysqli_fetch_assoc($getSlot)){

        echo "<option value='{$slot['id']}'>".$slot['slot_name']."</option>";

      }
    }

  }


// get rate data

  if(isset($_POST['get_rate'])){

    $categoryId = $_POST['get_rate'];

    if ($categoryId!=null) {
      $getRate = $rate->get_rate_by_category($categoryId);
      
      while($rate = mysqli_fetch_assoc($getRate)){

        if ($rate['rate_type']==1) {
          $rateType = 'Hourly';
        }
        elseif ($rate['rate_type']==2) {
          $rateType = 'Fixed';
        }

        echo "<option value='{$rate['id']}'>".$rate['rate_name']." - ".$rateType."</option>";
      }
    }
  }



