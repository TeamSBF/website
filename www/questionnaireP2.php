<?php
    require_once"header.php";

    if (isset($_POST['submitQuestionnaireP1']))
    {
      $validator = new FormsModel($_POST);
      $return = $validator->ValidateQuestionnaireP2();
    } 
?>

      <div class="container">
        <div class="col-sm-8 col-sm-offset-2">
          <legend><strong>Pre-Study Questionnaire Part 2<br></strong></legend>

          <form class="form-vertical" method="post">

            <div class="panel panel-primary">
              <div class="panel-heading">More About Yourself</div>
              <div class="panel-body">

                <div class="form-group">
                  <label for="currentHeight" class="control-label col-sm-12">*Current Height (in inches): *</label>
                  <div class="col-sm-4">
                    <input type="number" class="form-control" id="currentHeight" name="currentHeight" placeholder="Your height"><br>
                  </div>
                </div>  

                <div class="form-group">
                  <label for="currentWeight" class="control-label col-sm-12">*Current Weight (in pounds): *</label>
                  <div class="col-sm-4">
                    <input type="number" class="form-control" id="currentWeight" name="currentWeight" placeholder="Your weight"><br>
                  </div>
                </div>

                <div class="form-group">
                  <label for="affectedConditions" class="control-label col-sm-12">Describe how the Sit and Be Fit exercise program has affected the listed medical conditions in part 1:</label>
                  <div class="col-sm-12">
                    <textarea type="text" class="form-control" id="affectedConditions" name="affectedConditions"></textarea><br>
                  </div>
                </div>


                <label class="col-sm-12">Please rate your ability to perform certain activities that might occur during a typical day:</label>
                  <div class="well col-sm-offset-1 col-sm-11">

                    <div class="form-group">
                      <label class="control-label col-sm-7">*Lifting or carrying groceries:</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="groceries" required checked value=0>No help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="groceries" value=1>Some help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="groceries" value=2>Unable to perform</label>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label class="control-label col-sm-7">*Climbing one flight of stairs:</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="climbingStairs" required checked value=0>No help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="climbingStairs" value=1>Some help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="climbingStairs" value=2>Unable to perform</label>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label class="control-label col-sm-7">*Stepping up and down a small curb:</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="steppingCurb" required checked value=0>No help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="steppingCurb" value=1>Some help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="steppingCurb" value=2>Unable to perform</label>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label class="control-label col-sm-7">*Picking up small object from the floor:</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="pickingObject" required checked value=0>No help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="pickingObject" value=1>Some help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="pickingObject" value=2>Unable to perform</label>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label class="control-label col-sm-7">*Walking a mile or more:</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="walkingMile" required checked value=0>No help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="walkingMile" value=1>Some help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="walkingMile" value=2>Unable to perform</label>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label class="control-label col-sm-7">*Walking 2-3 blocks:</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="walkingBlocks" required checked value=0>No help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="walkingBlocks" value=1>Some help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="walkingBlocks" value=2>Unable to perform</label>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label class="control-label col-sm-7">*Walking around in your home:</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="walkingHome" required checked value=0>No help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="walkingHome" value=1>Some help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="walkingHome" value=2>Unable to perform</label>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label class="control-label col-sm-7">*Bathing or dressing yourself:</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="dressingSelf" required checked value=0>No help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="dressingSelf" value=1>Some help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="dressingSelf" value=2>Unable to perform</label>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label class="control-label col-sm-7">*Getting in and out of a car:</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="gettingOutCar" required checked value=0>No help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="gettingOutCar" value=1>Some help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="gettingOutCar" value=2>Unable to perform</label>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label class="control-label col-sm-7">*Writing on a computer Keyboard:</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="usingKeyboard" required checked value=0>No help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="usingKeyboard" value=1>Some help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="usingKeyboard" value=2>Unable to perform</label>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label class="control-label col-sm-7">*Preparing meals:</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="preparingMeal" required checked value=0>No help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="preparingMeal" value=1>Some help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="preparingMeal" value=2>Unable to perform</label>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label class="control-label col-sm-7">*Cleaning your home:</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="cleaningHome" required checked value=0>No help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="cleaningHome" value=1>Some help</label>
                      <label class="radio col-sm-offset-7"><input type="radio" name="cleaningHome" value=2>Unable to perform</label>
                    </div>                    
                  </div> <!-- end offset well -->
                  <div class="form-group">
                    <label for="affectActivities" class="control-label col-sm-12">Describe how the Sit and Be Fit exercise program affects your ability to perform the activities listed above?:</label>
                    <div class="col-sm-12">
                      <textarea type="text" class="form-control" id="affectActivities" name="affectActivities"></textarea><br>
                    </div>
                  </div> 
                  
                </div> <!-- end panel-body -->
              </div> <!-- end panel "More About Yourself" -->

              <div class="panel panel-primary">
                <div class="panel-heading">About your Feelings</div>
                <div class="panel-body">
                  <label class="col-sm-12"><h4><strong>The following questions are about your feelings. For each question, please choose the one answer that comes closest to the way you felt BEFORE ever doing the Sit and Be Fit exercise program.</strong></h4></label> 
                  <div class="well col-sm-12">
                    <label>How much of the time did you...</label>
                    <div class="col-sm-offset-1 col-sm-11">

                      <div class="form-group">
                        <label class="control-label col-sm-7">*Feel full of life?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelFullOfLifeB" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelFullOfLifeB" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelFullOfLifeB" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelFullOfLifeB" value=3>Rarely</label>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-7">*Feel nervous?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelNervousB" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelNervousB" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelNervousB" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelNervousB" value=3>Rarely</label>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-7">*Feel that you are playing a useful part in things?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelUsefulB" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelUsefulB" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelUsefulB" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelUsefulB" value=3>Rarely</label>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-7">*Feel calm and peaceful?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelCalmB" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelCalmB" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelCalmB" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelCalmB" value=3>Rarely</label>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-7">*Have a lot of energy?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelEnergyB" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelEnergyB" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelEnergyB" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelEnergyB" value=3>Rarely</label>
                      </div>                      
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-7">*Feel depressed?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelDepressedB" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelDepressedB" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelDepressedB" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelDepressedB" value=3>Rarely</label>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-7">*Feel worn out?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelWornOutB" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelWornOutB" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelWornOutB" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelWornOutB" value=3>Rarely</label>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-7">*Feel happy?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelHappyB" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelHappyB" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelHappyB" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelHappyB" value=3>Rarely</label>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-7">*Feel satisfied with your life?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelSatisfiedB" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelSatisfiedB" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelSatisfiedB" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelSatisfiedB" value=3>Rarely</label>
                      </div>

                    </div> <!-- end offset -->
                  </div> <!-- end well -->

                  <label class="col-sm-12"><h4><strong>The following questions are about how you feel currently.</strong></h4></label>
                  <div class="well col-sm-12">
                    <label>How much of the time did you...</label>
                    <div class="col-sm-offset-1 col-sm-11">

                      <div class="form-group">
                        <label class="control-label col-sm-7">*Feel full of life?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelFullOfLifeA" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelFullOfLifeA" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelFullOfLifeA" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelFullOfLifeA" value=3>Rarely</label>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-7">*Feel nervous?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelNervousA" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelNervousA" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelNervousA" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelNervousA" value=3>Rarely</label>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-7">*Feel that you are playing a useful part in things?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelUsefulA" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelUsefulA" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelUsefulA" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelUsefulA" value=3>Rarely</label>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-7">*Feel calm and peaceful?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelCalmA" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelCalmA" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelCalmA" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelCalmA" value=3>Rarely</label>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-7">*Have a lot of energy?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelEnergyA" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelEnergyA" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelEnergyA" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelEnergyA" value=3>Rarely</label>
                      </div>                      
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-7">*Feel depressed?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelDepressedA" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelDepressedA" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelDepressedA" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelDepressedA" value=3>Rarely</label>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-7">*Feel worn out?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelWornOutA" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelWornOutA" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelWornOutA" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelWornOutA" value=3>Rarely</label>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-7">*Feel happy?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelHappyA" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelHappyA" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelHappyA" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelHappyA" value=3>Rarely</label>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label class="control-label col-sm-7">*Feel satisfied with your life?:</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelSatisfiedA" required checked value=0>Always</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelSatisfiedA" value=1>Mostly</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelSatisfiedA" value=2>Half the time</label>
                        <label class="radio col-sm-offset-7"><input type="radio" name="feelSatisfiedA" value=3>Rarely</label>
                      </div>

                    </div> <!-- end offset -->
                  </div> <!-- end well -->

                  <div class="form-group">
                    <label for="affectFeelings" class="control-label col-sm-12">How are the feelings that are listed above affected when you participate in a Sit and Be Fit exercise class?:</label>
                    <div class="col-sm-12">
                      <textarea type="text" class="form-control" id="affectFeelings" name="affectFeelings"></textarea><br>
                    </div>
                  </div>

                </div> <!-- end panel-body -->
              </div> <!-- end panel "About your Feelings" -->

            <input class="col-sm-offset-10 col-sm-2 btn-primary" type="submit" id="submitButton">
          </form> <!-- end form -->
        </div> <!-- end offset centered -->
      </div> <!-- end container -->

     <?php if(isset($return) && !empty($return)){?>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
      <script>
      $(document).ready(function (){
        $("#message").html('<?= $return;?>');
        $("#message").show();
      });
      </script>
      <?php } ?>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <?php require_once"footer.php";?>