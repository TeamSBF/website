<?php


    if (isset($_POST['submitQuestionnaireP2']))
    {
      if ($user)
      {
        $_POST['userID'] = $user->id;
        print_r($_POST);
        $qp2validator = new FormsModel($_POST);
        $q2return = $qp2validator->validateQuestionnaireP2();
        echo $q2return;
      }      
    }
?>

<div class="background">
  <fieldset>
      <legend><strong><h1>Pre-Study Questionnaire Part 2</h1></strong></legend>

    <form class="form-vertical" method="post">
      <div id="q2message" style="display:none"></div>
        <div>
            <div><label for="q1">Current Height (in inches): </label></div>
            <div class="input"><input type="number" name="q1" placeholder="Your height"></div>
        </div>  

        <div>
            <div><label for="q2">Current Weight (in pounds): </label></div>
            <div class="input"><input type="number" name="q2" placeholder="Your weight"></div>
        </div>

        <div>
            <div><label for="q3">Describe how the Sit and Be Fit exercise program has affected the listed medical conditions in part 1</label></div>
            <div class="input"><textarea type="text" name="q3"></textarea></div>
        </div>
      

        <hr><label><strong><h2>Please rate your ability to perform certain activities that might occur during a typical day</h2></strong></label><hr>
      
        <?php
          $question1 = array("Lifting or carrying groceries:", "Climbing one flight of stairs:", "Stepping up and down a small curb:", "Picking up small object from the floor:",
            "Walking a mile or more:", "Walking 2-3 blocks:", "Walking around in your home:", "Bathing or dressing yourself:", "Getting in and out of a car:", "Writing on a computer Keyboard:",
            "Preparing meals:", "Cleaning your home:");

          for ($i = 4; $i < count($question1)+4; $i++)
          {
            echo '<div>';
            echo '<div><label>'.$question1[$i-4].'</label></div>';
            echo '<div class="input"><input type="radio" name="q'. ($i) .'" required checked value=0>No help</div>';
            echo '<div class="input"><input type="radio" name="q'. ($i) .'" required checked value=1>Some help</div>';
            echo '<div class="input"><input type="radio" name="q'. ($i) .'" required checked value=2>Unable to perform</div>';
            echo '</div>';
          }
        ?>
        <div>
          <div><label for="affectActivities">Describe how the Sit and Be Fit exercise program affects your ability to perform the activities listed above?:</label>                
          <div class="input"><textarea type="text" name="q16"></textarea></div>
        </div>
     <!-- end panel "More About Yourself" -->

            <hr><label><strong><h2>The following questions are about your feelings. For each question, please choose the one answer that comes closest to the way you felt BEFORE ever doing the Sit and Be Fit exercise program.</h2></strong></label><hr>
    
      <label>How much of the time did you...</label>
      <?php
        $question2 = array("Feel full of life?:", "Feel nervous?:", "Feel that you are playing a useful part in things?:", "Feel calm and peaceful?:", "Have a lot of energy?:",
          "Feel depressed?:", "Feel worn out?:", "Feel happy?:", "Feel satisfied with your life?:");
        $i++;
        for ($j = $i; $j < count($question2)+$i; $j++)
          {
            echo '<div>';
            echo '<div><label>'.$question2[$j - $i].'</label></div>';
            echo '<div class="input"><input type="radio" name="q'. ($j) .'" required checked value=0>Always</div>';
            echo '<div class="input"><input type="radio" name="q'. ($j) .'" value=1>Mostly</div>';
            echo '<div class="input"><input type="radio" name="q'. ($j) .'" value=2>Half the time</div>';
            echo '<div class="input"><input type="radio" name="q'. ($j) .'" value=3>Rarely</div>';
            echo '</div>';
          }
      ?>  

            <hr><label><strong><h2>The following questions are about how you feel currently.</h2></strong></label><hr>
                                          
        <label>How much of the time did you...</label>
        <?php

          for ($k = $j; $k < count($question2)+$j; $k++)
            {
              echo '<div>';
              echo '<div><label>'.$question2[$k - $j].'</label></div>';
              echo '<div class="input"><input type="radio" name="q'. ($k) .'" required checked value=0>Always</div>';
              echo '<div class="input"><input type="radio" name="q'. ($k) .'" value=1>Mostly</div>';
              echo '<div class="input"><input type="radio" name="q'. ($k) .'" value=2>Half the time</div>';
              echo '<div class="input"><input type="radio" name="q'. ($k) .'" value=3>Rarely</div>';
              echo '</div>';
            }
        ?>  
          
          <div>
            <div><label for="q35">How are the feelings that are listed above affected when you participate in a Sit and Be Fit exercise class?:</label></div>                    
            <div><textarea type="text" name="q35"></textarea></div>
          </div>
        


            <button class="btn-primary" type="submit" name="submitQuestionnaireP2">Submit</button>
      </form> <!-- end form -->
    </fieldset> <!-- end offset centered -->
  </div> <!-- end container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 
    <script>
    <?php   if(isset($q2return)) { ?>
    
    // display message upon success  or error
    $(document).ready(function () { 
      var message;
      <?php if ($q2return == false) { ?>
        message = "<strong>Error!</strong> Something went wrong while saving the form data.";
        $("#q2message").removeClass("success").addClass("error");
        $("#q2message").html(message);
        $("#q2message").show();         
        <?php   }
        else if ($q2return === "sucess") { ?>
          message = "<strong>Success!</strong?> Form submitted!";         
          $("#q2message").removeClass("error").addClass("success");
          $("#q2message").html(message);
          $("#q2message").show();         
          <?php } ?>
        }); 
  <?php } ?>
  </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
 