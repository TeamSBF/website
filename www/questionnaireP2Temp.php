<?php

    if (isset($_POST['submitQuestionnaireP1']))
    {
      $validator = new FormsModel($_POST);
      $return = $validator->ValidateQuestionnaireP2();
    } 
?>

<div class="background">
  <fieldset>
    <legend><strong>Pre-Study Questionnaire Part 2<br></strong></legend>

    <form class="form-vertical" method="post">
      <fieldset>
        <div>
          <label for="currentHeight">*Current Height (in inches): *</label>                  
          <input type="number" name="currentHeight" placeholder="Your height"><br>                  
        </div>  

        <div>
          <label for="currentWeight">*Current Weight (in pounds): *</label>                  
          <input type="number" name="currentWeight" placeholder="Your weight"><br>                  
        </div>

        <div>
          <label for="affectedConditions">Describe how the Sit and Be Fit exercise program has affected the listed medical conditions in part 1:</label>                  
          <textarea type="text" name="affectedConditions"></textarea><br>                  
        </div>
      </fieldset><br><br>

      <label><h4><strong>Please rate your ability to perform certain activities that might occur during a typical day:</strong></h4></label><br>
      <fieldset>
        <div>
          <label>*Lifting or carrying groceries:</label>
          <div><input type="radio" name="groceries" required checked value=0>No help</div>
          <div><input type="radio" name="groceries" value=1>Some help</div>
          <div><input type="radio" name="groceries" value=2>Unable to perform</div>
        </div>
        <hr>
        <div>
          <label>*Climbing one flight of stairs:</label>
          <div><input type="radio" name="climbingStairs" required checked value=0>No help</div>
          <div><input type="radio" name="climbingStairs" value=1>Some help</div>
          <div><input type="radio" name="climbingStairs" value=2>Unable to perform</div>
        </div>
        <hr>
        <div>
          <label>*Stepping up and down a small curb:</label>
          <div><input type="radio" name="steppingCurb" required checked value=0>No help</div>
          <div><input type="radio" name="steppingCurb" value=1>Some help</div>
          <div><input type="radio" name="steppingCurb" value=2>Unable to perform</div>
        </div>
        <hr>
        <div>
          <label>*Picking up small object from the floor:</label>
          <div><input type="radio" name="pickingObject" required checked value=0>No help</div>
          <div><input type="radio" name="pickingObject" value=1>Some help</div>
          <div><input type="radio" name="pickingObject" value=2>Unable to perform</div>
        </div>
        <hr>
        <div>
          <label>*Walking a mile or more:</label>
          <div><input type="radio" name="walkingMile" required checked value=0>No help</div>
          <div><input type="radio" name="walkingMile" value=1>Some help</div>
          <div><input type="radio" name="walkingMile" value=2>Unable to perform</div>
        </div>
        <hr>
        <div>
          <label>*Walking 2-3 blocks:</label>
          <div><input type="radio" name="walkingBlocks" required checked value=0>No help</div>
          <div><input type="radio" name="walkingBlocks" value=1>Some help</div>
          <div><input type="radio" name="walkingBlocks" value=2>Unable to perform</div>
        </div>
        <hr>
        <div>
          <label>*Walking around in your home:</label>
          <div><input type="radio" name="walkingHome" required checked value=0>No help</div>
          <div><input type="radio" name="walkingHome" value=1>Some help</div>
          <div><input type="radio" name="walkingHome" value=2>Unable to perform</div>
        </div>
        <hr>
        <div>
          <label>*Bathing or dressing yourself:</label>
          <div><input type="radio" name="dressingSelf" required checked value=0>No help</div>
          <div><input type="radio" name="dressingSelf" value=1>Some help</div>
          <div><input type="radio" name="dressingSelf" value=2>Unable to perform</div>
        </div>
        <hr>
        <div>
          <label>*Getting in and out of a car:</label>
          <div><input type="radio" name="gettingOutCar" required checked value=0>No help</div>
          <div><input type="radio" name="gettingOutCar" value=1>Some help</div>
          <div><input type="radio" name="gettingOutCar" value=2>Unable to perform</div>
        </div>
        <hr>
        <div>
          <label>*Writing on a computer Keyboard:</label>
          <div><input type="radio" name="usingKeyboard" required checked value=0>No help</div>
          <div><input type="radio" name="usingKeyboard" value=1>Some help</div>
          <div><input type="radio" name="usingKeyboard" value=2>Unable to perform</div>
        </div>
        <hr>
        <div>
          <label>*Preparing meals:</label>
          <div><input type="radio" name="preparingMeal" required checked value=0>No help</div>
          <div><input type="radio" name="preparingMeal" value=1>Some help</div>
          <div><input type="radio" name="preparingMeal" value=2>Unable to perform</div>
        </div>
        <hr>
        <div>
          <label>*Cleaning your home:</label>
          <div><input type="radio" name="cleaningHome" required checked value=0>No help</div>
          <div><input type="radio" name="cleaningHome" value=1>Some help</div>
          <div><input type="radio" name="cleaningHome" value=2>Unable to perform</div>
        </div>                 

        <div>
          <label for="affectActivities">Describe how the Sit and Be Fit exercise program affects your ability to perform the activities listed above?:</label>                
          <textarea type="text" name="affectActivities"></textarea><br>
        </div>
    </fieldset><br><br> <!-- end panel "More About Yourself" -->

    <label><h4><strong>The following questions are about your feelings. For each question, please choose the one answer that comes closest to the way you felt BEFORE ever doing the Sit and Be Fit exercise program.</strong></h4></label><br>
    <fieldset>
      <label>How much of the time did you...</label>
        <div>
          <label>*Feel full of life?:</label>
          <div><input type="radio" name="feelFullOfLifeB" required checked value=0>Always</div>
          <div><input type="radio" name="feelFullOfLifeB" value=1>Mostly</div>
          <div><input type="radio" name="feelFullOfLifeB" value=2>Half the time</div>
          <div><input type="radio" name="feelFullOfLifeB" value=3>Rarely</div>
        </div>
        <hr>
        <div>
          <label>*Feel nervous?:</label>
          <div><input type="radio" name="feelNervousB" required checked value=0>Always</div>
          <div><input type="radio" name="feelNervousB" value=1>Mostly</div>
          <div><input type="radio" name="feelNervousB" value=2>Half the time</div>
          <div><input type="radio" name="feelNervousB" value=3>Rarely</div>
        </div>
        <hr>
        <div>
          <label>*Feel that you are playing a useful part in things?:</label>
          <div><input type="radio" name="feelUsefulB" required checked value=0>Always</div>
          <div><input type="radio" name="feelUsefulB" value=1>Mostly</div>
          <div><input type="radio" name="feelUsefulB" value=2>Half the time</div>
          <div><input type="radio" name="feelUsefulB" value=3>Rarely</div>
        </div>
        <hr>
        <div>
          <label>*Feel calm and peaceful?:</label>
          <div><input type="radio" name="feelCalmB" required checked value=0>Always</div>
          <div><input type="radio" name="feelCalmB" value=1>Mostly</div>
          <div><input type="radio" name="feelCalmB" value=2>Half the time</div>
          <div><input type="radio" name="feelCalmB" value=3>Rarely</div>
        </div>
        <hr>
        <div>
          <label>*Have a lot of energy?:</label>
          <div><input type="radio" name="feelEnergyB" required checked value=0>Always</div>
          <div><input type="radio" name="feelEnergyB" value=1>Mostly</div>
          <div><input type="radio" name="feelEnergyB" value=2>Half the time</div>
          <div><input type="radio" name="feelEnergyB" value=3>Rarely</div>
        </div>                      
        <hr>
        <div>
          <label>*Feel depressed?:</label>
          <div><input type="radio" name="feelDepressedB" required checked value=0>Always</div>
          <div><input type="radio" name="feelDepressedB" value=1>Mostly</div>
          <div><input type="radio" name="feelDepressedB" value=2>Half the time</div>
          <div><input type="radio" name="feelDepressedB" value=3>Rarely</div>
        </div>
        <hr>
        <div>
          <label>*Feel worn out?:</label>
          <div><input type="radio" name="feelWornOutB" required checked value=0>Always</div>
          <div><input type="radio" name="feelWornOutB" value=1>Mostly</div>
          <div><input type="radio" name="feelWornOutB" value=2>Half the time</div>
          <div><input type="radio" name="feelWornOutB" value=3>Rarely</div>
        </div>
        <hr>
        <div>
          <label>*Feel happy?:</label>
          <div><input type="radio" name="feelHappyB" required checked value=0>Always</div>
          <div><input type="radio" name="feelHappyB" value=1>Mostly</div>
          <div><input type="radio" name="feelHappyB" value=2>Half the time</div>
          <div><input type="radio" name="feelHappyB" value=3>Rarely</div>
        </div>
        <hr>
        <div>
          <label>*Feel satisfied with your life?:</label>
          <div><input type="radio" name="feelSatisfiedB" required checked value=0>Always</div>
          <div><input type="radio" name="feelSatisfiedB" value=1>Mostly</div>
          <div><input type="radio" name="feelSatisfiedB" value=2>Half the time</div>
          <div><input type="radio" name="feelSatisfiedB" value=3>Rarely</div>
        </div>
      </fieldset><br><br> <!-- end well -->

      <label><h4><strong>The following questions are about how you feel currently.</strong></h4></label><br>
      <fieldset>                                    
        <label>How much of the time did you...</label>
          <div>
            <label>*Feel full of life?:</label>
            <div><input type="radio" name="feelFullOfLifeA" required checked value=0>Always</div>
            <div><input type="radio" name="feelFullOfLifeA" value=1>Mostly</div>
            <div><input type="radio" name="feelFullOfLifeA" value=2>Half the time</div>
            <div><input type="radio" name="feelFullOfLifeA" value=3>Rarely</div>
          </div>
          <hr>
          <div>
            <label>*Feel nervous?:</label>
            <div><input type="radio" name="feelNervousA" required checked value=0>Always</div>
            <div><input type="radio" name="feelNervousA" value=1>Mostly</div>
            <div><input type="radio" name="feelNervousA" value=2>Half the time</div>
            <div><input type="radio" name="feelNervousA" value=3>Rarely</div>
          </div>
          <hr>
          <div>
            <label>*Feel that you are playing a useful part in things?:</label>
            <div><input type="radio" name="feelUsefulA" required checked value=0>Always</div>
            <div><input type="radio" name="feelUsefulA" value=1>Mostly</div>
            <div><input type="radio" name="feelUsefulA" value=2>Half the time</div>
            <div><input type="radio" name="feelUsefulA" value=3>Rarely</div>
          </div>
          <hr>
          <div>
            <label>*Feel calm and peaceful?:</label>
            <div><input type="radio" name="feelCalmA" required checked value=0>Always</div>
            <div><input type="radio" name="feelCalmA" value=1>Mostly</div>
            <div><input type="radio" name="feelCalmA" value=2>Half the time</div>
            <div><input type="radio" name="feelCalmA" value=3>Rarely</div>
          </div>
          <hr>
          <div>
            <label>*Have a lot of energy?:</label>
            <div><input type="radio" name="feelEnergyA" required checked value=0>Always</div>
            <div><input type="radio" name="feelEnergyA" value=1>Mostly</div>
            <div><input type="radio" name="feelEnergyA" value=2>Half the time</div>
            <div><input type="radio" name="feelEnergyA" value=3>Rarely</div>
          </div>                      
          <hr>
          <div>
            <label>*Feel depressed?:</label>
            <div><input type="radio" name="feelDepressedA" required checked value=0>Always</div>
            <div><input type="radio" name="feelDepressedA" value=1>Mostly</div>
            <div><input type="radio" name="feelDepressedA" value=2>Half the time</div>
            <div><input type="radio" name="feelDepressedA" value=3>Rarely</div>
          </div>
          <hr>
          <div>
            <label>*Feel worn out?:</label>
            <div><input type="radio" name="feelWornOutA" required checked value=0>Always</div>
            <div><input type="radio" name="feelWornOutA" value=1>Mostly</div>
            <div><input type="radio" name="feelWornOutA" value=2>Half the time</div>
            <div><input type="radio" name="feelWornOutA" value=3>Rarely</div>
          </div>
          <hr>
          <div>
            <label>*Feel happy?:</label>
            <div><input type="radio" name="feelHappyA" required checked value=0>Always</div>
            <div><input type="radio" name="feelHappyA" value=1>Mostly</div>
            <div><input type="radio" name="feelHappyA" value=2>Half the time</div>
            <div><input type="radio" name="feelHappyA" value=3>Rarely</div>
          </div>
          <hr>
          <div>
            <label>*Feel satisfied with your life?:</label>
            <div><input type="radio" name="feelSatisfiedA" required checked value=0>Always</div>
            <div><input type="radio" name="feelSatisfiedA" value=1>Mostly</div>
            <div><input type="radio" name="feelSatisfiedA" value=2>Half the time</div>
            <div><input type="radio" name="feelSatisfiedA" value=3>Rarely</div>
          </div>

          <div>
            <label for="affectFeelings">How are the feelings that are listed above affected when you participate in a Sit and Be Fit exercise class?:</label>                    
            <textarea type="text" id="affectFeelings" name="affectFeelings"></textarea><br>
          </div>
        </fieldset>


        <input class="btn-primary" type="submit" id="submitQ2">
      </form> <!-- end form -->
    </fieldset> <!-- end offset centered -->
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
