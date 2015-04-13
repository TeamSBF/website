<?php
    require_once"header.php";

    if (isset($_POST['submitEnrollment']))
    {
      //echo var_dump($_POST); //DEBUG
      $validator = new FormsModel($_POST);
      $return = $validator->ValidateEnrollment();
    } 
?>


<div class="container">

  <div class="col-sm-8 col-sm-offset-2">
    <form method="post" class="form-horizontal">
      <legend><strong>Enrollment Form</strong></legend>
      <div class="alert" id="message" style="display:none"></div>
      <div class="panel panel-primary">
        <div class="panel-heading">enrollment</div>
        <div class="panel-body">
          <div class="form-group">
            <label for="lName" class="control-label col-sm-3">Last Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="lName" placeholder="Last Name" value="<?php if(isset($_POST['lName'])){echo htmlspecialchars($_POST['lName']);} ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="fName" class="control-label col-sm-3">First Name</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="fName" placeholder="First Name" value="<?php if(isset($_POST['fName'])){echo htmlspecialchars($_POST['fName']);} ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="streetAddress" class="control-label col-sm-3">Street Address</label>
            <div class="col-sm-9">
              <textarea type="text" class="form-control" name="streetAddress" placeholder="Street Address" rows="3" value="<?php if(isset($_POST['streetAddress'])){echo htmlspecialchars($_POST['streetAddress']);} ?>">
              </textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="city" class="control-label col-sm-3">City</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="city" placeholder="City" value="<?php if(isset($_POST['city'])){echo htmlspecialchars($_POST['city']);} ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="phone" class="control-label col-sm-3">Phone</label>
            <div class="col-sm-9">
              <input type="tel" class="form-control" name="phone" placeholder="Phone Number" value="<?php if(isset($_POST['phone'])){echo htmlspecialchars($_POST['phone']);} ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="email" class="control-label col-sm-3">Email</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" name="email" placeholder="johnDoe@abc.com" value="<?php if(isset($_POST['email'])){echo htmlspecialchars($_POST['email']);} ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="dob" class="control-label col-sm-3">Date of Birth</label>
            <div class="col-sm-9">
              <input type="date" class="form-control" name="dob" value="<?php if(isset($_POST['dob'])){echo htmlspecialchars($_POST['dob']);} ?>">
            </div>
          </div>

          <div class="form-group">
            <div class="control-label col-sm-3" style="font-weight:bold">Gender</div>
            <label class="radio-inline col-sm-offset-1"><input type="radio" name="gender" required checked value="Male">Male</label>
            <label class="radio-inline"><input type="radio" name="gender" value="Female">Female</label>
          </div>

          <div class="form-group">
            <label for="healthHistory" class="control-label col-sm-3">Health History</label>
            <div class="col-sm-9">
              <textarea type="text" class="form-control" name="healthHistory" rows="3">
              </textarea>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-4">Do you watch Sit and Be Fit?</label>
            <label class="radio-inline"><input type="radio" name="watchSbf" required checked value="yes">Yes</label>
            <label class="radio-inline"><input type="radio" name="watchSbf" value="no">No</label>
          </div>

          <div class="form-group" name="howManyTimes">
            <label for="howMany" class="control-label col-sm-3">How many times a week?</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" name="howMany" value="<?php if(isset($_POST['howMany'])){echo htmlspecialchars($_POST['howMany']);}else{echo 1;} ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-4">Control Group (will NOT participate in Sit and Be Fit)
            </label>
            <label class="radio-inline"><input type="radio" name="controlGrp" required checked value="yes">Yes</label>
            <label class="radio-inline"><input type="radio" name="controlGrp" value="no">No</label>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-4">Experimental Group (participate in Sit and Be Fit)
            </label>
            <label class="radio-inline"><input type="radio" name="experimentalGrp" required checked value=1>Yes
            </label>
            <label class="radio-inline"><input type="radio" name="experimentalGrp" value=0>No
            </label>
          </div>

          <input class="col-sm-offset-10 col-sm-2 btn-primary" type="submit" name="submitEnrollment">
        </div>
      </div>
    </div>
  </form>

  <div id="returnMessage" class="alert"></div>
</div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <?php if(isset($return) && !empty($return)){?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
    $(document).ready(function (){
      $("#message").addClass('alert-danger');
      $("#message").html('<?= $return;?>');
      $("#message").show();
    });
    </script>
    <?php } ?>

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
<?php require_once"footer.php";?>

















