<?php require_once"header.php";
$array = [ ["30 Second Chair Stand","Lower body strength evaluation. Assess strength for climbing stairs, walking, and getting out of a chair, car, or tub. Number of full stands that can be completed in 30 seconds with arms folded across chest. If the arms are pulled away from the chest or you rock back and forward to help you stand that is unacceptable and the test will be stopped at that point. You may rest while siting on the chair and continue if you are still within the 30 seconds."],
              ["Arm Curl","Assess upper body strength, needed for performing household and other activities involving lifting and carrying things such as groceries, suitcases and grandchildren. Number of bicep curls – lifting the weight from the arm extended up to the shoulder and back down – that can be completed in 30 seconds holding a 5 lb weight (for women) or an 8 lb weight (for men). You may not use the back to help “throw” the weight up. The weight must come up and touch the shoulder and the return to the lowered position should be with control, not just dropping the arm. You may rest in the down position and continue with lifts if you are still within the 30 seconds." ],
              ["2-Minute Step Test","Aerobic endurance test. Number of full steps completed in 2 minutes, raising the knee to a point halfway between the kneecap and the hip on each step. If the knee does not come up high enough you will be reminded to lift it higher. If you are testing yourself at home stand in front of a mirror so you can assess the knee height." ],
              ["8 Foot Up and Go","Assess agility and dynamic balance needed for quick maneuvering such as getting on or off a bus, getting up to attend to something in the kitchen, going to the bathroom, or getting up to answer the phone. Number of seconds it takes to get up out of a chair, walk 8 feet, turn around a cone, and return to the chair and sit down. The entire movement must be in control. You may use your hands to help get up from the chair and to sit back down."],
              ["Unilateral Balance Test","Fall risk evaluation.  Balance test determined by how long you can stand on one foot without moving, or touching the lifted foot back to the ground.  The lifted leg may not be braced against the support leg, lift the lower leg up and to the rear till the knee is at 90 degrees. Not acceptable is excessive movement of arms or body to hold position" ],
              ["Functional Reach","Assess balance in a forward motion. Reach as far forward as you can keep your arm parallel to the yardstick without touching the wall or taking a step forward. Do not overreach and risk falling." ] 
         ];?>
<div class="background">
<h1 class="demoHeaders">Assessments</h1>
<!-- Accordion -->
<div id="accordion">
    <?php for($x=0;$x<count($array);$x++){?>
             <h2><?php echo $array[$x][0];?></h2>  
             <div><p>Definition:<?php echo $array[$x][1];?></p>
             <iframe width="100%" height="315" src="https://www.youtube.com/embed/m0APvLqZr5E " frameborder="0" allowfullscreen></iframe></div>
    <?php }?>
</div>
</div>
<?php require_once"footer.php";?>
