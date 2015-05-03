<?php
    

    if (isset($_POST['submitQuestionnaireP1']))
    {
      $validator = new FormsModel($_POST);
      $return = $validator->ValidateQuestionnaireP2();
    } 
?>

<div class="background">
  <fieldset>
      <legend><strong><h1>Pre-Study Questionnaire Part 2</h1></strong></legend>

    <form class="form-vertical" method="post">
      
        <div>
            <div><label for="currentHeight">*Current Height (in inches): *</label></div>
            <div class="input"><input type="number" name="currentHeight" placeholder="Your height"></div>
        </div>  

        <div>
            <div><label for="currentWeight">*Current Weight (in pounds): *</label></div>
            <div class="input"><input type="number" name="currentWeight" placeholder="Your weight"></div>
        </div>

        <div>
            <div><label for="affectedConditions">Describe how the Sit and Be Fit exercise program has affected the listed medical conditions in part 1</label></div>
            <div class="input"><textarea type="text" name="affectedConditions"></textarea></div>
        </div>
      

        <hr><label><strong><h2>Please rate your ability to perform certain activities that might occur during a typical day</h2></strong></label><hr>
      
        <div>
            <div><label>*Lifting or carrying groceries:</label></div>
          <div class="input"><input type="radio" name="groceries" required checked value=0>No help</div>
          <div class="input"><input type="radio" name="groceries" value=1>Some help</div>
          <div class="input"><input type="radio" name="groceries" value=2>Unable to perform</div>
        </div>
        
        <div>
            <div><label>*Climbing one flight of stairs:</label></div>
          <div class="input"><input type="radio" name="climbingStairs" required checked value=0>No help</div>
          <div class="input"><input type="radio" name="climbingStairs" value=1>Some help</div>
          <div class="input"><input type="radio" name="climbingStairs" value=2>Unable to perform</div>
        </div>
        
        <div>
            <div><label>*Stepping up and down a small curb:</label></div>
          <div class="input"><input type="radio" name="steppingCurb" required checked value=0>No help</div>
          <div class="input"><input type="radio" name="steppingCurb" value=1>Some help</div>
          <div class="input"><input type="radio" name="steppingCurb" value=2>Unable to perform</div>
        </div>
        
        <div>
            <div><label>*Picking up small object from the floor:</label></div>
          <div class="input"><input type="radio" name="pickingObject" required checked value=0>No help</div>
          <div class="input"><input type="radio" name="pickingObject" value=1>Some help</div>
          <div class="input"><input type="radio" name="pickingObject" value=2>Unable to perform</div>
        </div>
        
        <div>
            <div><label>*Walking a mile or more:</label></div>
          <div class="input"><input type="radio" name="walkingMile" required checked value=0>No help</div>
          <div class="input"><input type="radio" name="walkingMile" value=1>Some help</div>
          <div class="input"><input type="radio" name="walkingMile" value=2>Unable to perform</div>
        </div>
        
        <div>
            <div><label>*Walking 2-3 blocks:</label></div>
          <div class="input"><input type="radio" name="walkingBlocks" required checked value=0>No help</div>
          <div class="input"><input type="radio" name="walkingBlocks" value=1>Some help</div>
          <div class="input"><input type="radio" name="walkingBlocks" value=2>Unable to perform</div>
        </div>
        
        <div>
            <div><label>*Walking around in your home:</label></div>
          <div class="input"><input type="radio" name="walkingHome" required checked value=0>No help</div>
          <div class="input"><input type="radio" name="walkingHome" value=1>Some help</div>
          <div class="input"><input type="radio" name="walkingHome" value=2>Unable to perform</div>
        </div>
       
        <div>
            <div><label>*Bathing or dressing yourself:</label></div>
          <div class="input"><input type="radio" name="dressingSelf" required checked value=0>No help</div>
          <div class="input"><input type="radio" name="dressingSelf" value=1>Some help</div>
          <div class="input"><input type="radio" name="dressingSelf" value=2>Unable to perform</div>
        </div>
        
        <div>
            <div><label>*Getting in and out of a car:</label></div>
          <div class="input"><input type="radio" name="gettingOutCar" required checked value=0>No help</div>
          <div class="input"><input type="radio" name="gettingOutCar" value=1>Some help</div>
          <div class="input"><input type="radio" name="gettingOutCar" value=2>Unable to perform</div>
        </div>
        
        <div>
            <div><label>*Writing on a computer Keyboard:</label></div>
          <div class="input"><input type="radio" name="usingKeyboard" required checked value=0>No help</div>
          <div class="input"><input type="radio" name="usingKeyboard" value=1>Some help</div>
          <div class="input"><input type="radio" name="usingKeyboard" value=2>Unable to perform</div>
        </div>
        
        <div>
            <div><label>*Preparing meals:</label></div>
          <div class="input"><input type="radio" name="preparingMeal" required checked value=0>No help</div>
          <div class="input"><input type="radio" name="preparingMeal" value=1>Some help</div>
          <div class="input"><input type="radio" name="preparingMeal" value=2>Unable to perform</div>
        </div>
        
        <div>
            <div><label>*Cleaning your home:</label></div>
          <div class="input"><input type="radio" name="cleaningHome" required checked value=0>No help</div>
          <div class="input"><input type="radio" name="cleaningHome" value=1>Some help</div>
          <div class="input"><input type="radio" name="cleaningHome" value=2>Unable to perform</div>
        </div>                 

        <div>
          <div><label for="affectActivities">Describe how the Sit and Be Fit exercise program affects your ability to perform the activities listed above?:</label>                
          <div class="input"><textarea type="text" name="affectActivities"></textarea></div>
        </div>
     <!-- end panel "More About Yourself" -->

            <hr><label><strong><h2>The following questions are about your feelings. For each question, please choose the one answer that comes closest to the way you felt BEFORE ever doing the Sit and Be Fit exercise program.</h2></strong></label><hr>
    
      <label>How much of the time did you...</label>
        <div>
            <div><label>*Feel full of life?:</label></div>
          <div class="input"><input type="radio" name="feelFullOfLifeB" required checked value=0>Always</div>
          <div class="input"><input type="radio" name="feelFullOfLifeB" value=1>Mostly</div>
          <div class="input"><input type="radio" name="feelFullOfLifeB" value=2>Half the time</div>
          <div class="input"><input type="radio" name="feelFullOfLifeB" value=3>Rarely</div>
        </div>
        
        <div>
            <div><label>*Feel nervous?:</label></div>
          <div class="input"><input type="radio" name="feelNervousB" required checked value=0>Always</div>
          <div class="input"><input type="radio" name="feelNervousB" value=1>Mostly</div>
          <div class="input"><input type="radio" name="feelNervousB" value=2>Half the time</div>
          <div class="input"><input type="radio" name="feelNervousB" value=3>Rarely</div>
        </div>
       
        <div>
            <div><label>*Feel that you are playing a useful part in things?:</label></div>
          <div class="input"><input type="radio" name="feelUsefulB" required checked value=0>Always</div>
          <div class="input"><input type="radio" name="feelUsefulB" value=1>Mostly</div>
          <div class="input"><input type="radio" name="feelUsefulB" value=2>Half the time</div>
          <div class="input"><input type="radio" name="feelUsefulB" value=3>Rarely</div>
        </div>
        
        <div>
            <div><label>*Feel calm and peaceful?:</label></div>
          <div class="input"><input type="radio" name="feelCalmB" required checked value=0>Always</div>
          <div class="input"><input type="radio" name="feelCalmB" value=1>Mostly</div>
          <div class="input"><input type="radio" name="feelCalmB" value=2>Half the time</div>
          <div class="input"><input type="radio" name="feelCalmB" value=3>Rarely</div>
        </div>
        
        <div>
          <label>*Have a lot of energy?:</label>
          <div class="input"><input type="radio" name="feelEnergyB" required checked value=0>Always</div>
          <div class="input"><input type="radio" name="feelEnergyB" value=1>Mostly</div>
          <div class="input"><input type="radio" name="feelEnergyB" value=2>Half the time</div>
          <div class="input"><input type="radio" name="feelEnergyB" value=3>Rarely</div>
        </div>                      
        
        <div>
            <div><label>*Feel depressed?:</label></div>
          <div class="input"><input type="radio" name="feelDepressedB" required checked value=0>Always</div>
          <div class="input"><input type="radio" name="feelDepressedB" value=1>Mostly</div>
          <div class="input"><input type="radio" name="feelDepressedB" value=2>Half the time</div>
          <div class="input"><input type="radio" name="feelDepressedB" value=3>Rarely</div>
        </div>
        
        <div>
            <div><label>*Feel worn out?:</label></div>
          <div class="input"><input type="radio" name="feelWornOutB" required checked value=0>Always</div>
          <div class="input"><input type="radio" name="feelWornOutB" value=1>Mostly</div>
          <div class="input"><input type="radio" name="feelWornOutB" value=2>Half the time</div>
          <div class="input"><input type="radio" name="feelWornOutB" value=3>Rarely</div>
        </div>
        
        <div>
            <div><label>*Feel happy?:</label></div>
          <div class="input"><input type="radio" name="feelHappyB" required checked value=0>Always</div>
          <div class="input"><input type="radio" name="feelHappyB" value=1>Mostly</div>
          <div class="input"><input type="radio" name="feelHappyB" value=2>Half the time</div>
          <div class="input"><input type="radio" name="feelHappyB" value=3>Rarely</div>
        </div>
        
        <div>
            <div><label>*Feel satisfied with your life?:</label></div>
          <div class="input"><input type="radio" name="feelSatisfiedB" required checked value=0>Always</div>
          <div class="input"><input type="radio" name="feelSatisfiedB" value=1>Mostly</div>
          <div class="input"><input type="radio" name="feelSatisfiedB" value=2>Half the time</div>
          <div class="input"><input type="radio" name="feelSatisfiedB" value=3>Rarely</div>
        </div>
       <!-- end well -->

            <hr><label><strong><h2>The following questions are about how you feel currently.</h2></strong></label><hr>
                                          
        <label>How much of the time did you...</label>
          <div>
              <div><label>*Feel full of life?:</label></div>
            <div class="input"><input type="radio" name="feelFullOfLifeA" required checked value=0>Always</div>
            <div class="input"><input type="radio" name="feelFullOfLifeA" value=1>Mostly</div>
            <div class="input"><input type="radio" name="feelFullOfLifeA" value=2>Half the time</div>
            <div class="input"><input type="radio" name="feelFullOfLifeA" value=3>Rarely</div>
          </div>
          
          <div>
            <label>*Feel nervous?:</label>
            <div class="input"><input type="radio" name="feelNervousA" required checked value=0>Always</div>
            <div class="input"><input type="radio" name="feelNervousA" value=1>Mostly</div>
            <div class="input"><input type="radio" name="feelNervousA" value=2>Half the time</div>
            <div class="input"><input type="radio" name="feelNervousA" value=3>Rarely</div>
          </div>
          
          <div>
              <div><label>*Feel that you are playing a useful part in things?:</label></div>
            <div class="input"><input type="radio" name="feelUsefulA" required checked value=0>Always</div>
            <div class="input"><input type="radio" name="feelUsefulA" value=1>Mostly</div>
            <div class="input"><input type="radio" name="feelUsefulA" value=2>Half the time</div>
            <div class="input"><input type="radio" name="feelUsefulA" value=3>Rarely</div>
          </div>
          
          <div>
              <div><label>*Feel calm and peaceful?:</label></div>
            <div class="input"><input type="radio" name="feelCalmA" required checked value=0>Always</div>
            <div class="input"><input type="radio" name="feelCalmA" value=1>Mostly</div>
            <div class="input"><input type="radio" name="feelCalmA" value=2>Half the time</div>
            <div class="input"><input type="radio" name="feelCalmA" value=3>Rarely</div>
          </div>
          
          <div>
              <div><label>*Have a lot of energy?:</label></div>
            <div class="input"><input type="radio" name="feelEnergyA" required checked value=0>Always</div>
            <div class="input"><input type="radio" name="feelEnergyA" value=1>Mostly</div>
            <div class="input"><input type="radio" name="feelEnergyA" value=2>Half the time</div>
            <div class="input"><input type="radio" name="feelEnergyA" value=3>Rarely</div>
          </div>                      
          
          <div>
              <div><label>*Feel depressed?:</label></div>
            <div class="input"><input type="radio" name="feelDepressedA" required checked value=0>Always</div>
            <div class="input"><input type="radio" name="feelDepressedA" value=1>Mostly</div>
            <div class="input"><input type="radio" name="feelDepressedA" value=2>Half the time</div>
            <div class="input"><input type="radio" name="feelDepressedA" value=3>Rarely</div>
          </div>
          
          <div>
              <div><label>*Feel worn out?:</label></div>
            <div class="input"><input type="radio" name="feelWornOutA" required checked value=0>Always</div>
            <div class="input"><input type="radio" name="feelWornOutA" value=1>Mostly</div>
            <div class="input"><input type="radio" name="feelWornOutA" value=2>Half the time</div>
            <div class="input"><input type="radio" name="feelWornOutA" value=3>Rarely</div>
          </div>
          
          <div>
              <div><label>*Feel happy?:</label></div>
            <div class="input"><input type="radio" name="feelHappyA" required checked value=0>Always</div>
            <div class="input"><input type="radio" name="feelHappyA" value=1>Mostly</div>
            <div class="input"><input type="radio" name="feelHappyA" value=2>Half the time</div>
            <div class="input"><input type="radio" name="feelHappyA" value=3>Rarely</div>
          </div>
          
          <div>
              <div><label>*Feel satisfied with your life?:</label></div>
            <div class="input"><input type="radio" name="feelSatisfiedA" required checked value=0>Always</div>
            <div class="input"><input type="radio" name="feelSatisfiedA" value=1>Mostly</div>
            <div class="input"><input type="radio" name="feelSatisfiedA" value=2>Half the time</div>
            <div class="input"><input type="radio" name="feelSatisfiedA" value=3>Rarely</div>
          </div>

          <div>
            <div><label for="affectFeelings">How are the feelings that are listed above affected when you participate in a Sit and Be Fit exercise class?:</label></div>                    
            <div><textarea type="text" id="affectFeelings" name="affectFeelings"></textarea></div>
          </div>
            <div class="inputs"><button type="submit" name="submitQ2">Submit</button></div>
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
