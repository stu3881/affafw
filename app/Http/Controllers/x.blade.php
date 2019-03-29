<?php
    public function generic_method_request_3parms(REQUEST $request,$parm1,$parm2) {
        // ********
        // serveral functions require the same parameters 
        // rather than define separate routes for all of them, we pass a parm that defines different functions
        // this keeps us from having to add more and more routes
        // ********
        var_dump($request);
        var_dump($parm1);
        var_dump($parm2);
        $this->debugx('1101',__FILE__,__LINE__,__FUNCTION__);
        $active_tables          = array(); 
        $view_variables_array   = array();
        $what_are_we_doing      = $parm1;
        // ****************
        // this method can call itself (via a view of course)
        // if it has, the stuff we need has to be decoded
        // ****************
        $parm2 = json_decode($parm2);
        //var_dump($parm2);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        if (!isset($parm2['encoded_variables_array'])){
            $decoded_variables_array = array();
            $decoded_variables_array['encoded_variables_array'] = "xxx";
            $decoded_variables_array['parm1'] = $parm1;
            //var_dump($decoded_variables_array);
            var_dump($decoded_variables_array);
            //$this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);
                   }
        else{
            $decoded_variables_array = json_decode($parm2['encoded_variables_array']);
            $parm1 = $decoded_variables_array['parm1'];
            var_dump($decoded_variables_array);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        }
    }

    public function generic_method_request_2parms(REQUEST $request,$parm1,$parm2) {
        // ********
        // serveral functions require the same parameters 
        // rather than define separate routes for all of them, we pass a parm that defines different functions
        // this keeps us from having to add more and more routes
        // ********
        //var_dump($request);
        //var_dump($parm1);
        //var_dump($parm2);
        $parm2_array = json_decode($parm2);
        //$this->debugx('1101',__FILE__,__LINE__,__FUNCTION__);
        $active_tables          = array(); 
        $view_variables_array   = array();
        $what_are_we_doing      = $parm1;
        // ****************
        // this method can call itself (via a view of course)
        // if it has, the stuff we need has to be decoded
        // ****************

        //var_dump($parm2);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        if (in_array('we_have_done_first_read',$parm2_array)){

       
            $parm2_array[] = 'we_have_done_first_read';
            $decoded_variables_array = array();
            $decoded_variables_array['encoded_variables_array'] = "xxx";
            $decoded_variables_array['parm1'] = $parm1;
            }
        else{
            //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        }
        if (in_array('coming_from_programmer_utilities',$parm2_array)){

       
            $parm2_array[] = 'we_have_done_first_read';
            $decoded_variables_array = array();
            $decoded_variables_array['encoded_variables_array'] = "xxx";
            $decoded_variables_array['parm1'] = $parm1;
            }
        else{
            $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        }
        //var_dump($parm1);var_dump($parm2);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);

        // ****************
        // ****************
        // ****************

        //$a = $this->generic_method_get_data($request,$parm1,$parm2);
        //$b = $this->generic_method_get_active_controllers($request,$parm1,$parm2);
        $get_data = 0;
        $what_are_we_doing = $parm1;

        switch ($parm1) {
            case "configure_an_unconfigured_table":
                $get_data = 1;
                break;
            case "activate_deactivate_table_reporting":
                $get_data = 1;
                break;
            case "reports_with_broken_links":
                $get_data = 1;
                //$this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);     
                 break;
            }

         //$this->debugx('0100',__FILE__,__LINE__,__FUNCTION__);     

        $all_tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();


        if ($get_data){
            $active_controllers = MiscThing
               ::where('record_type','=','table_controller')
               ->where('table_reporting_active','=',1)
               ->get();   
            $main_menu_array = $this->define_main_menu_links();
            $method_parameters_array = $this->define_method_parameters($main_menu_array);
         
            foreach ($active_controllers as $db_result) {
                $active_tables[$db_result->node_name] = $db_result->node_name;
                $array1[$db_result->node_name]['key_value'] = $db_result->id;
                $method_parameters_array[$what_are_we_doing]['node'] = $db_result->node_name;
                if (!in_array('node_names',$parm2_array)){
                    $parm2_array[] = 'node_names';
                }
                $parm2_array[] = $db_result->node_name;
            }
           

        }
        else{
            if (in_array('we_have_done_first_read',$parm2_array)){
                $get_data = 0;
                echo('<br>'.'
                : ');//var_dump($request->json_array1);
                $table_name = $what_are_we_doing;
                $node_name = $what_are_we_doing;
                var_dump($decoded_variables_array);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                $view_files_prefix = $what_are_we_doing;
                $this->clean_orphan_files($table_name,$node_name,$view_files_prefix);  //2parms
                $all_tables = array();
                var_dump($decoded_variables_array);$this->debug1(__FILE__,__LINE__,__FUNCTION__);
            }
        }


        //echo('<br>'.'json_array1: ');var_dump($request->json_array1);
        //echo('<br>'.'what_are_we_doing: ');
        //var_dump($what_are_we_doing);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
 
        // ***************************
        foreach($all_tables as $table){

            switch ($what_are_we_doing) {
                case "configure_an_unconfigured_table":
                    if (!in_array($table,$active_tables)){
                        $view_variables_array[$table]['what_are_we_doing']  = $what_are_we_doing;
                        $view_variables_array[$table]['functions'][0]       = 'configure';
                        $view_variables_array[$table]['class'][0]           = "text_align_left";
                    }
                    break;
                case "activate_deactivate_table_reporting":
                    $view_variables_array[$table]['what_are_we_doing']  = $what_are_we_doing;
                    if (!in_array($table,$active_tables)){
                       $view_variables_array[$table]['functions'][0]    = 'activate';
                        $view_variables_array[$table]['class'][0]       = "text_align_left";
                        }
                    else {
                        $view_variables_array[$table]['functions'][0]   = 'de_activate';
                        $view_variables_array[$table]['class'][0]       = "text_align_left mycart-btn"; // dark blue            
                        }
                    $view_variables_array[$table]['functions'][1]       = 'validate';
                    $view_variables_array[$table]['class'][1]           = "text_align_left";
                    break;
                case "reports_with_broken_links":
                    if (in_array($table,$active_tables)){
        // echo($table);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                        $view_variables_array[$table]['what_are_we_doing']  = $what_are_we_doing;
                        $view_variables_array[$table]['functions'][0]       = "reports_with_broken_links";
                        $view_variables_array[$table]['class'][0]           = "text_align_left";

                        $view_variables_array[$table]['functions'][1]       = "reports_with_broken_links";
                        $view_variables_array[$table]['class'][1]           = "text_align_left";
                        //if (is_null($parm2 )){
                            $view_variables_array[$table]['functions'][0]       = "reports_with_broken_links";
                            $view_variables_array[$table]['class'][0]           = "text_align_left";
                            
                            $view_variables_array[$table]['functions'][1]       = "reports_with_broken_links";
                            $view_variables_array[$table]['class'][1]           = "text_align_left";

                /*            }
                        else {
                            $view_variables_array = json_decode($parm2);
                            //var_dump($view_variables_array);$this->debug1(__FILE__,__LINE__,__FUNCTION__);
                            }
                  */
                        //var_dump($json_array1);$this->debug1(__FILE__,__LINE__,__FUNCTION__);
                        //$view_variables_array[$table]['functions'][0] = 'listbrokenLinks';
 
                    }
                    break;
            } // end switch
            //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);

         } //  for all_tables

        $required_variables_array = array(
            'array1'            => $view_variables_array,
            //'parm2'             => json_encode($decoded_variables_array),
            'node_name'         => $this->node_name,     
            'myStrings'         => $this->myStrings
            );
        //var_dump($view_variables_array);//var_dump(json_encode($decoded_variables_array));
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        return view($this->node_name.'.dynamicMenu0')
            // VARIABLES WE'RE PASSING TO A VIEW
            ->with('report_definition_key'    ,$this->report_definition_id)
            ->with('parm1'                    ,$parm1)
            ->with('array_of_encoded_variables',json_encode($decoded_variables_array))
            //->with('parm1_for_2parms_link'      ,json_encode($decoded_variables_array))
            ->with('parm2_for_2parms_link'      ,json_encode($decoded_variables_array))
            ->with('what_we_are_doing'          ,$parm1)
            ->with('parm2_array'                ,json_encode($parm2_array))
            ->with('required_variables'         ,$required_variables_array);
    }
    ?>