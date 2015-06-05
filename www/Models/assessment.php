<?php

    class assessment
    {
        private $data;
        
        public function __construct($info)
	    {
		  $this->data = $info;
	    }
        
        public function validateAssessments()
	    {
		  return $this->validateSaveAssessments();
	    }
        
        public function validateAssessmentData()
        {
            return $this->validateData();
        }
        
        private function validateData()
        {
            $insert = $this->validateAndBuildQuery();
            //Throw error
            if(is_string($insert))
                return $insert;
            $save = DatabaseManager::Query($insert);
     //       printr($save->Errors());
   //         printr($insert->Query(true));
	//		printr($save);
            if($save->RowCount()<1)
                return "Failed to save data.";
            
            return $this->SaveUpdate();           
        }
        
        private function SaveUpdate()
        {
            $settings=QueryFactory::Build('select');
            $settings->Select('value')->Where(['name','=','ttl_assessment_frequency'])->From("settings");
            $time = DatabaseManager::Query($settings);
			//printr($time);
            $time = strtotime($time->Result()['value']);
             
            $update = QueryFactory::Build('update'); 
            $update->Table("users")->Set(["NextAssessment",$time])->Where(["id","=",$this->data["userID"]]);
            $save = DatabaseManager::Query($update);
           
            $count=QueryFactory::Build('select');
            $count->Select("TestNumber","Chairstand","ArmCurl","StepTest","FootUpAndGo","leftunilateralbalancetest","rightunilateralbalancetest","FunctionalReach")->From('assessments')->Where(['userid', '=', $this->data["userID"]]);
            $save =DatabaseManager::Query($count);
            $count=$save->RowCount();
            $res=$save->Result();
            if(!is_array($res))
                $res=[$res];
            
            $largest=-1;
            $testNum=-1;
			//echo "count: ". $count. "<br>";
            //printr($res);//---------------------------------------------------------------------
			
			//if more then one
			if($count > 1)
			{
				//get last form
				for($i = 0;$i < $count;$i++ )
				{
					if($res[$i]["TestNumber"] >$testNum)
					{
						$largest=$i;
						$testNum=$res[$i]["TestNumber"];
					}
				}
				$res=$res[$largest];
			}
			
            unset($res["TestNumber"]);
            $insert = QueryFactory::Build('insert');
            $insert->Into("assessments")->Set(["userid",$this->data["userID"]],["TestNumber",$count+1]);
            foreach(array_keys($res) as $key)
            {
                $value = -2;
                if($res[$key]>-1)
                    $value = -1;
                 $insert->Set([$key,$value]); 
            }
            $save=DatabaseManager::Query($insert);
            if($save->RowCount() > 0)
                return "SUCCESS";
            return "Failed to insert data correctly";
        }
        
        private function validateAndBuildQuery()
        {
            $data = $this->data;
            $insert = QueryFactory::Build('update');
		    $insert->Table("assessments"); 
            $insert->Where(["userid","=",$data["userID"],"AND"],["DateCompleted","=",0]);
//			printr($data);
            foreach(array_keys($data) as $key)
            {
                $value=$data[$key];
//				echo $value . "<br>";
				if(!empty($value))
				{	
					if(is_array($value))
					{
						if($this->validateNumber($value[0])&&$this->validateNumber($value[1])) 
						{
							$value=$value[0]*60+$value[1];
						}
						else
						{
							return $key." Invalid Format(ONLY NUMBERS GREATER THAN OR EQUAL TO ZERO ARE ACCEPTED!)";   
						}
					}
					
                    if($this->validateNumber($value))
                    {
                        $insert->Set([$key,$value]);   
                    }
                    else
                    {
                        return $key." Invalid Format(ONLY NUMBERS GREATER THAN OR EQUAL TO ZERO ARE ACCEPTED!)";   
                    }     
                }
            }
            $insert->Set(["DateCompleted","UNIX_TIMESTAMP()"]);
            return $insert;   
        }
        
        private function validateNumber($value)
        {
               if(is_numeric($value) && $value >= 0 && $value < PHP_INT_MAX)
                   return true;
                return false;
        }
        
        private function validateSaveAssessments()
        {
            $insert = QueryFactory::Build('insert');
		    $insert->Into("assessments"); 
           // $insert->Set(['userID',$this->data['userID']]);
            $insert = $this->validate($insert);
            if($insert==false)
                return false;
            //Throw error
            $save = DatabaseManager::Query($insert);
            // check for success or failure
            if ($save->RowCount() == 1)
            {
                return "SUCCESS";
            }
            else
            {
               return false;   
            }
        }
        private function validate($insert)
        {
            $p = $this->data;
            $insert->Set(["userID",$p['userID']]);
            if(isset($p['ArmCurl']))
            {
                $insert->Set(['Armcurl',-1]);
            }
            
            if(isset($p['ChairStand']))
            {
                $insert->Set(['Chairstand',-1]);   
            }
            
            if(isset($p['Steptest']))
            {
                $insert->Set(['StepTest',-1]);   
            }
            
            if(isset($p['FootUpandGo']))
            {
                $insert->Set(['FootUpAndGo',-1]);
            }
            
            if(isset($p['Unilateral']))
            {
                $insert->Set(['leftunilateralbalancetest',-1]);
                $insert->Set(['rightunilateralbalancetest',-1]);
            }
            
            if(isset($p['Functional']))
            {
                $insert->Set(['FunctionalReach',-1]);   
            }
            if(isset($p['Functional'])|| isset($p['Unilateral'])|| isset($p['FootUpandGo'])||isset($p['Steptest'])||isset($p['ChairStand'])||isset($p['ArmCurl']))
            {
                $date = QueryFactory::Build('update');
		        $date->Table("users");
                $date->Set(['NextAssessment',"UNIX_TIMESTAMP()"]);
				$date->Where(["id","=",$p["userID"]]);
                $s = DatabaseManager::Query($date);
                return $insert;
            }
            else
            {?>
                <script>alert("Please select at least one assessment.");</script><?php
            }

        }


    }
?>