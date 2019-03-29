<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use DB;

//class WorkingArray extends CRHBaseController
class WorkingArray extends DEHBaseController
{   
    public function __construct(
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $working_arrays = array(),
        $buttons_in_front               = "",
        $print_orientation              = "",
        $record_type                    = "table_controller", 
        //$db_connection_name             = "blues_main", 
        $db_connection_name             = "", 
        $db_snippet_connection          = "",
        $db_data_connection             = "",
        //$snippet_table                  = "",
        //$db_snippet_connection          = "",
        // Automatically adjuested strings begin here    
        
        $controller_name                = "miscThingsController", 
        $model                          = "MiscThing", 
        $node_name                      = "miscThings", 
        $model_table                    = "miscThings", 

        $link_parms_array               = array(),
        //$controller_name                = '#beginControllerName#endControllerName',
        //$model                          = '#beginModel#endModel',
        //$node_name                      = '#beginNodeName#endNodeName', 
        $no_of_blank_entries            = "5", 
        $pad_ctr                        = 5, 
        $snippet_table                  = "miscThings", 
        $snippet_node_name              = "miscThings", 
        $snippet_table_key_field_name   = "id", 
        $backup_node                    = "backup_before_redirect_to_baseline", 
        $generated_files_folder         = "generated_files", 
        $key_field_name                 = "id", 
        $bypassed_field_name            = "not_used",
        $view_files_prefix = "",

        $field_list_array_name = "",
        $field_name_list_array = "",

        $field_name_lists_array = "",
        $field_name_list_array_first_index  = "",
        $my_ctr                             = 0,
        $no_of_fields                       = 0,
        $report_definition_id               = 0,
        $snippet_model                      = "",
        $store_validation_id                = 0,
        $business_rules_array               = 0,
        $project_path                       = "",
        $table_names                        = array(),
        $active_controllers                 = array(),
        $view_variables_array               = array(),
        $parm2_array                        = array(),
        $array_of_parm2_array               = array() 

        // this is designed for use with the miscThings table
        // several sub-arrays are defined for different entities
        // this wasn't always a class but i'm converting it so i can use the same thing in programmer utilities

        //moving data related stuff out of the constructor
        // ******


        )
        {
        
        parent::__construct();
        $this->db_snippet_connection           = $db_snippet_connection;
        //$this->debug_exit(__FILE__,__LINE__,0); echo(" entering constructor");
        $this->pad_ctr                          = $pad_ctr;
        //$snippet_table = "miscThings";
        $this->model_table                    = $model_table;

        $this->working_arrays               = $working_arrays;
        $this->working_arrays['groups_that_get_padded']     = array(
            'ppv_define_query'              => 'ppv_define_query',
            'maintain_query_joins'          => 'maintain_query_joins',
            'ppv_define_business_rules'     => 'ppv_define_business_rules'
            );
        $this->working_arrays['groups_that_get_generated']     = array(
            'ppv_define_query'              => 'ppv_define_query',
            'maintain_query_joins'          => 'maintain_query_joins',
            'ppv_define_business_rules'     => 'ppv_define_business_rules'
            );

        $this->working_arrays['remaining_or_selected_groups'] = array(
        'maintain_modifiable_fields'    => 'modifiable_fields_array',
        'maintain_browse_fields'        => 'browse_select_array'
        );

        $this->working_arrays['maintain_modifiable_fields']  = array(
            'field_name'    => "",
            'from_array'    => array(),
            'to_array'      => array()
        ); 

        $this->working_arrays['maintain_browse_fields']  = array(
            'field_name'    => "",
            'from_array'    => array(),
            'to_array'      => array()
        ); 

// ******************************************************
// ******************************************************
// ******************************************************

        $this->working_arrays['related_arrays'] = array(
            'field_name_array'      => 'field_name_array',
            'field_type_array'      => 'field_type_array',
            'lookups'               => 'lookups',
            'data'                  => 'data',
            'default_values_array'  => 'default_values_array'
            );

        $this->working_arrays['xxrelated_arrays'] = array(
            '0'  => 'field_name_array',
            '1'  => 'field_type_array',
            '2'  => 'lookups',
            '3'  => 'data',
            '4'  => 'default_values_array'
            );

        //$this->generated_snippets_array        = $this->get_generated_snippets();


    }


    public function build_intermediate_join_snippets_array(
        $working_arrays,
        $what_we_are_doing) {
        // *****
        // 
        // joins_joinee_table_names_array   joins_joinee_field_names_array
            $this->show_related_arrays("11110",$working_arrays,$what_we_are_doing,__LINE__);

            $j = -1;
            $crlf = "\r\n";
            $strx = "<tr>".$crlf; // start a new row
            $working_arrays[$what_we_are_doing]['data'] = 
            array_pop($working_arrays[$what_we_are_doing]['data']);
            for ($i=0; $i<(count($working_arrays[$what_we_are_doing]['data'])); $i++){
              // these are rows of data
                //var_dump($working_arrays[$what_we_are_doing]['data']);
                //echo(count($working_arrays[$what_we_are_doing]['data']));
              //$this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);
              //$i++;
              //$strx .= "<tr>".$crlf; // start a new row
              foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $key => $value) {
                $process_cascading_select = 1;
                $process_cascaded_select = 1;
                switch ($working_arrays[$what_we_are_doing]['field_type_array'][$key]) {
                    case 'cascading_select':
              $this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);
                         if ($process_cascading_select){
                            $process_cascading_select = 0;
                        }
                        break;
                    case 'cascaded_select':
                        if ($process_cascaded_select){
                           $process_cascaded_select = 0;
                        }
                        break;
                  case 'select':
                    //echo("<br/>".$working_arrays[$what_we_are_doing]['data'][$value][$i]);
                    $strx .= 
                    "<td style=\"text-align:center\">".$crlf.
                    "{{ Form::select('".$key.$i."',".
                    "$"."working_arrays['".$what_we_are_doing."']['lookups']['".$key."'],".
                     
                    "$"."working_arrays['".$what_we_are_doing."']['data']['".$value."']['".$i."']".
                    ") }}".
                    $crlf.
                    "</td>".$crlf;
                    break;
                  case 'select_with_indexed_lookup':
                    //echo("<br/>".$working_arrays[$what_we_are_doing]['data'][$value][$i]);
                    $derivedName = 'joins_joinee_field_name_array' . $i;
                    $derivedName2 = 'joinee_field_names' . $i;
                    $strx .= // first field is always  relational operator  
                    "<td style=\"text-align:center\">".$crlf.
                    "{{ Form::select('".$key.$i."',".
                    "$"."working_arrays['".$what_we_are_doing."']['lookups']['".$derivedName2 ."'],".
                    //"$"."working_arrays['".$what_we_are_doing."']['field_name_array']['".$key."'],".
                    "$"."working_arrays['".$what_we_are_doing."']['data']['joins_joinee_field_name_array']['".$i."']".
                    ") }}".
                    $crlf.
                    "</td>".$crlf;
                    break;
                  case 'text':
                    $strx .= 
                    "<td style=\"text-align:left\">".$crlf.
                    "{{ Form::text('".$key.$i."',".
                    "$"."working_arrays['".$what_we_are_doing."']['data']['".$value."']['".$i."']) }}".                                
                    $crlf.
                    "</td>".$crlf;
                    break;
                  } 
                }
              $strx .= "</tr>".$crlf;   
              //$this->show_related_arrays("10110",$working_arrays,$what_we_are_doing,__LINE__);

              //$strx .= "</tr></table>".$crlf;   
            }  // end for        return $working_arrays;

    }
    public function build_column_names_array($tbl_name) {
        //echo ('build_column_names_array'.$tbl_name);exit("exit 99");
        $column_names_array = array();
        $columns = Schema::getColumnListing($tbl_name);
        sort($columns);
        $columns = array_combine($columns, $columns);
        return $columns;

    }

    public function generic_method_get_table_names() {
        // ********
        // ********
        $what_are_we_doing = "x";
        switch ($what_are_we_doing) {
            case "x":
            case "configure_an_unconfigured_table":
                 $table_names = DB::connection()->getDoctrineSchemaManager()->listTableNames();
               
                break;
            case "activate_deactivate_table_reporting":
                 $table_names = DB::connection()->getDoctrineSchemaManager()->listTableNames();
                
                break;
            case "reports_with_broken_links":
                $table_names = DB::connection()->getDoctrineSchemaManager()->listTableNames();
                break;
            }
        //var_dump($parm1);$this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);
        return $table_names;
    }


    //public function generic_gen_update_form_snippet($id,$working_arrays,$what_we_are_doing){
    public function gen_update_form_snippet_from_working_arrays($id,$working_arrays,$what_we_are_doing,
        $view_files_prefix,$generated_files_folder){
        // we want to select join type
           /*
            // the fields we need based on what we are doing
            // they are hard codedd in the working_arrays class
            // each field corresponds to an array of values for the fields
            // be it joins, search criteria or business rules,
            // the select arrays are also based on what we are doing
            // 
            // 
            */
            //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $schema = DB::getDoctrineSchemaManager();
     
        switch ($what_we_are_doing) { 

        case "maintain_modifiable_fields":
        case "maintain_browse_fields":  
            break;
        case "ppv_define_business_rules":
           // $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

        case "ppv_define_query":
            //$this->show_related_arrays("11111",$working_arrays,$what_we_are_doing,__LINE__);
            $coming_from = "advanced_query";

        case "maintain_query_joins":
            //echo($what_we_are_doing.$id);
            //var_dump(array_keys($working_arrays ));
            //$this->show_related_arrays("10010",$working_arrays,$what_we_are_doing,__LINE__);
            //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
            $working_arrays = 
            $this->build_intermediate_join_snippets_array(
                $working_arrays,
                $what_we_are_doing);
            $crlf = "\r\n";
            $strx = "";
            $strx .= '<table id="inner_tbl_0_5" class="table_green_lines">';

            $j = -1;
            $strx .= "<tr>".$crlf; // field names row
            foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $key => $value) {
                $strx .= "<td style=\"text-align:center\">".$crlf.$value."</td>".$crlf;
            }
            $strx .= "</tr>".$crlf;   
            $j = -1;


            $working_arrays[$what_we_are_doing]['data'] = 
            array_pop($working_arrays[$what_we_are_doing]['data']);
            for ($i=0; $i<(count($working_arrays[$what_we_are_doing]['data'])); $i++){
              // these are rows of data
                //var_dump($working_arrays[$what_we_are_doing]['data']);
                //echo(count($working_arrays[$what_we_are_doing]['data']));
              //$this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);
              //$i++;
              $strx .= "<tr>".$crlf; // start a new row
              foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $key => $value) {
                $process_cascading_select = 1;
                $process_cascaded_select = 1;
                switch ($working_arrays[$what_we_are_doing]['field_type_array'][$key]) {
                    case 'cascading_select':
                        if ($process_cascading_select){
                            $process_cascading_select = 0;
                        }
                        break;
                    case 'cascaded_select':
                        if ($process_cascaded_select){
                           $process_cascaded_select = 0;
                        }
                        break;
                  case 'select':
                    //echo("<br/>".$working_arrays[$what_we_are_doing]['data'][$value][$i]);
                    $strx .= 
                    "<td style=\"text-align:center\">".$crlf.
                    "{{ Form::select('".$key.$i."',".
                    "$"."working_arrays['".$what_we_are_doing."']['lookups']['".$key."'],".
                     
                    "$"."working_arrays['".$what_we_are_doing."']['data']['".$value."']['".$i."']".
                    ") }}".
                    $crlf.
                    "</td>".$crlf;
                    break;
                  case 'select_with_indexed_lookup':
                    //echo("<br/>".$working_arrays[$what_we_are_doing]['data'][$value][$i]);
                    $derivedName = 'joins_joinee_field_name_array' . $i;
                    $derivedName2 = 'joinee_field_names' . $i;
                    $strx .= // first field is always  relational operator  
                    "<td style=\"text-align:center\">".$crlf.
                    "{{ Form::select('".$key.$i."',".
                    "$"."working_arrays['".$what_we_are_doing."']['lookups']['".$derivedName2 ."'],".
                    //"$"."working_arrays['".$what_we_are_doing."']['field_name_array']['".$key."'],".
                    "$"."working_arrays['".$what_we_are_doing."']['data']['joins_joinee_field_name_array']['".$i."']".
                    ") }}".
                    $crlf.
                    "</td>".$crlf;
                    break;
                  case 'text':
                    $strx .= 
                    "<td style=\"text-align:left\">".$crlf.
                    "{{ Form::text('".$key.$i."',".
                    "$"."working_arrays['".$what_we_are_doing."']['data']['".$value."']['".$i."']) }}".                                
                    $crlf.
                    "</td>".$crlf;
                    break;
                  } 
                }
              $strx .= "</tr>".$crlf;   
              //$this->show_related_arrays("10110",$working_arrays,$what_we_are_doing,__LINE__);

              //$strx .= "</tr></table>".$crlf;   
            }  // end for
        }

        switch ($what_we_are_doing) { 
          case "maintain_modifiable_fields":
          case "maintain_browse_fields":  
              break;
             //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
          case "maintain_query_joins":
          case "ppv_define_query":
          case "ppv_define_business_rules":
            // you build this everytime through.  Since you can only do one thing at a time,
            // the snippet name canbe the same
            $fnam = 
            $view_files_prefix."/".$generated_files_folder."/".$id.'_snippet_string.blade.php';
             
            //echo("</br>"."writing ***".$fnam);$this->debugx('0100',__FILE__,__LINE__,__FUNCTION__);
            $this->write_file_from_string($fnam,$strx);  

            return $strx;
            break;

        } 
        

    }

    public function move_from_constructor($entity) {
        $this->generated_snippets_array         = $this->get_generated_snippets();

    }






    /*$this->working_arrays['related_arrays'] = array(
            '0'  => 'field_name_array',
            '1'  => 'field_type_array',
            '2'  => 'lookups',
            '3'  => 'data',
            '4'  => 'default_values_array'
            );*/
    public function  show_related_arrays($parmstr,$working_arrays,$what_we_are_doing,$LINE){
        $parma = str_split($parmstr);
        //var_dump($parma);var_dump($working_arrays['related_arrays']);
        //var_dump($working_arrays);


        echo("<br/>".'<span style="color:#f44242;font-size:150%;">'.__FUNCTION__." "." was called at ".$LINE."<br/>".'what_we_are_doing '."</span>".$what_we_are_doing);
        //var_dump($parma);var_dump($working_arrays['related_arrays']);
        $working_arrays['related_arrays'] = array_values($working_arrays['related_arrays']);
        //var_dump($working_arrays['related_arrays']);
        $working_arrays['related_arrays'] = array_combine($working_arrays['related_arrays'],$parma);
        //var_dump($working_arrays['related_arrays']);
        $j = -1;
        foreach ($working_arrays['related_arrays']as $related_array_name => $yes) {
            $j++;
            if ($yes == '1') {
                //echo("<br/>"." * ". $related_array_name);
                if (isset($working_arrays[$what_we_are_doing][$related_array_name])){
                    $current_array = array_wrap($working_arrays[$what_we_are_doing][$related_array_name]);
                    echo("<br/>".'<span style="color:#0000ff;font-size:150%;">'."array_keys for "."</span>". $related_array_name);
                    var_dump(array_keys($current_array));
                    echo("<br/>".'<span style="color:#0000ff;font-size:150%;">'."array_values for "."</span>". $related_array_name);
                    var_dump(array_values($current_array));
                    }
                else {
                    //if(!is_array($working_arrays[$what_we_are_doing][$related_array_name]))
                    //$this->debugx('0100',__FILE__,__LINE__,__FUNCTION__);echo("<br/>"."related_array_name: ". $related_array_name);
                    //$current_array = $working_arrays[$what_we_are_doing][$related_array_name];
                    $current_array = array();
                echo("<br/>"."array_keys for ". $related_array_name);
                var_dump(array_keys($current_array));
                echo("<br/>"."array_values for ". $related_array_name);
                var_dump(array_values($current_array));

                }
            } // we wan to see this array
        } // each of the field_name_array
             //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
    } 

    public function working_arrays_assign_from_data($working_arrays,$record,$bypassed_field_name,$model_table) {
        //echo("working_arrays_assign_from_data");
        // var_dump($record);
        //var_dump($working_arrays);
        //$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
       //* ******
        // queries and business rules can grow and differ widely from one query (or rule) to 
        //another they need to be loaded first and padded with some room for growth
        //
        // no more or no less than $this->no_of_blank_entries 
        // default values padded onto the end
        //
        // even though we have relational operators and values arrays to worry about,
        // this drives off the number of field_names = to $bypassed_field_name on the end of the array
        
        // originally we did it just for who you were but not, it seems easiest to size them after we get // the existing arrays. 
        // ****** 
        foreach ($working_arrays['remaining_or_selected_groups']as 
            $x_what_we_are_doing => $field_name) {
            $working_arrays[$x_what_we_are_doing]['field_name'] = $field_name;
            $working_arrays = $this->build_from_to_select_arrays(
                $x_what_we_are_doing,
                $working_arrays,
                $record,
                $bypassed_field_name,
                $model_table);
            //var_dump($working_arrays[$x_what_we_are_doing]);
           }
          
        // ************
        // maintain_query_joins
        // ************
         $tmp_what_we_are_doing = "maintain_query_joins";

 
        $working_arrays[$tmp_what_we_are_doing]['field_name_array'] = array(
            'join_types'            => 'joins_join_type_array',
            'joinor_field_names'    => 'joins_joinor_field_name_array',
            'joins_r_o_array'       => 'joins_r_o_array',
            'joinee_table_names'    => 'joins_joinee_table_names_array',
            'joinee_field_names'    => 'joins_joinee_field_names_array'
            );
        //var_dump($working_arrays[$tmp_what_we_are_doing]['field_name_array']);
        foreach ($working_arrays[$tmp_what_we_are_doing]['field_name_array'] as 
            $field => $value) {
            if ($field != 'joinee_field_names'){
                $working_arrays[$tmp_what_we_are_doing]['data'][$field] = json_decode($record[$value]);

            }
          }
        //$this->show_related_arrays("11110",$working_arrays,$tmp_what_we_are_doing,__LINE__);
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

        $working_arrays[$tmp_what_we_are_doing]['field_type_array'] = array(
            'join_types'            => 'select',
            'joinor_field_names'    => 'select',
            'joins_r_o_array'       => 'select',
            'joinee_table_names'    => 'cascading_select',
            'joinee_field_names'    => 'cascaded_select',
            );
 

         // set lookup arrays for each field
         foreach ($working_arrays[$tmp_what_we_are_doing]['field_name_array'] as $field => $value) {
            switch ($field) {
                case 'join_types':
                    $working_arrays[$tmp_what_we_are_doing]['lookups']['joins_join_type_array'] = array(
                        'not_used'  => 'not_used',
                        'normal'    => 'normal',
                        'left'      => 'left',
                        'right'     => 'right',
                        );
                    break;
                case 'joins_r_o_array':
                    $working_arrays[$tmp_what_we_are_doing]['lookups']['joins_r_o_array'] = array(
                        '='  => '=',
                        '>'  => '>',
                        '<'  => '<',
                        '<=' => '<=',
                        '>=' => '>=',
                        );
                    break;
                case 'field_array_names':
                    $working_arrays[$tmp_what_we_are_doing]['lookups']['field_array_names'] = array(
                        'join_types'            => 'join_types',
                        'joinor_field_names'    => 'joinor_field_names',
                        'joins_r_o_array'       => 'joins_r_o_array',
                        'joinee_table_names'    => 'joinee_table_names',
                        'joinee_field_names'    => 'joinee_field_names',
                        );
                     break;
                default:
                    # code...
                    break;
            }
         }
         $working_arrays[$tmp_what_we_are_doing]['xxxshow_related_arrays_index'] = array(
            'field_names'           => 'field_name_array',
            'field_types'           => 'field_type_array',
            'lookups'               => 'lookups',
            'data'                  => 'data',
            'default_values'        => 'default_values_array'
            );

       $working_arrays[$tmp_what_we_are_doing]['default_values_array'] = array(
            'join_types'            => 'not_used',
            'joinor_field_names'    => 'not_used',
            'joins_r_o_array'       => '=',
            'joinee_table_names'    => 'not_used',
            'joinee_field_names'    => 'not_used',
            );












       $j = -1;

        //$this->show_related_arrays("11100",$working_arrays,$tmp_what_we_are_doing,__LINE__);
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);



        // ************
        // ppv_define_query
        // ************
        $working_arrays['ppv_define_query']['data']['query_field_name_array'] = 
        json_decode($record['query_field_name_array']);
        $working_arrays['ppv_define_query']['data']['query_r_o_array'] = 
        json_decode($record['query_r_o_array']);
        $working_arrays['ppv_define_query']['data']['query_value_array'] = 
        json_decode($record['query_value_array']);
        //$this->show_related_arrays("10010",$working_arrays,'ppv_define_query',__LINE__);

        $working_arrays['ppv_define_query']['field_name_array'] = array(
            'field_name' => 'query_field_name_array',
            'r_o'        => 'query_r_o_array',
            'value'      => 'query_value_array'
            );
        $working_arrays['ppv_define_query']['field_type_array'] = array(
            'field_name'    => 'select',
            'r_o'           => 'select',
            'value'         => 'text'
            );

        $working_arrays['ppv_define_query']['lookups'] = array(
            'field_name'    => 'field_name',
            'r_o'           => 'r_o'          
            );


        $working_arrays['ppv_define_query']['default_values_array'] = array(
            'field_name' => $bypassed_field_name,
            'r_o'        => '=',
            'value'      => ''
            );
        
        //$this->show_related_arrays("10010",$working_arrays,'ppv_define_query',__LINE__);




        // *************************
        // ppv_define_business_rules
        // *************************
        $working_arrays['ppv_define_business_rules']['data']['business_rules_field_name_array'] = 
        json_decode($record['business_rules_field_name_array']);
        $working_arrays['ppv_define_business_rules']['data']['business_rules_r_o_array'] = 
        json_decode($record['business_rules_r_o_array']);
        $working_arrays['ppv_define_business_rules']['data']['business_rules_value_array'] = 
        json_decode($record['business_rules_value_array']);

        $working_arrays['ppv_define_business_rules']['field_name_array'] = array(
            'field_name' => 'business_rules_field_name_array',
            'r_o'        => 'business_rules_r_o_array',
            'value'      => 'business_rules_value_array'
            );
        $working_arrays['ppv_define_business_rules']['field_type_array'] = array(
            'field_name'            => 'select',
            'r_o'                   => 'select',
            'value'                 => 'text',
            );
        $working_arrays['ppv_define_business_rules']['lookups'] = array(
            'field_name'            => 'xx',
            'r_o'                   => '=',
            'value'                 => ''
            );
        $working_arrays['ppv_define_business_rules']['default_values_array'] = array(
            'field_name'    => 'not_used',
            'r_o'           => 'required',
            'value'         => ''
            );
  
        //var_dump($working_arrays);
        return($working_arrays);
    }


      
    public function build_from_to_select_arrays(
        $what_we_are_doing,
        $working_arrays,
        $record,
        $bypassed_field_name,
        $model_table
        ) {
        //echo(__LINE__);exit();
        $column_names_array = (array) $this->build_column_names_array($model_table);  
        $to_array =  (array) json_decode(
        $record[$working_arrays[$what_we_are_doing]['field_name']]);
        $to_array = array_combine($to_array,$to_array);
        $from_array = array_diff($column_names_array,$to_array);
        $working_arrays[$what_we_are_doing]['from_array'] = $from_array;
        $working_arrays[$what_we_are_doing]['to_array'] = $to_array;
        //var_dump($working_arrays[$what_we_are_doing]['to_array']);
        //var_dump($working_arrays[$what_we_are_doing]['from_array']);
        return $working_arrays;

    } 



    public function working_arrays_show_arrays($display_option,$index_parms,$working_arrays,$what_we_are_doing) {
        //$this->debugx('0010',__FILE__,__LINE__,__FUNCTION__);
        //echo ("<br/>".'display_option:'. $display_option);
        //var_dump(array_keys($working_arrays[$what_we_are_doing]));

        $process_indexes_array = str_split($index_parms);
        //var_dump($process_indexes_array);//exit('xit58 deh');
        //var_dump($working_arrays[$what_we_are_doing]);//exit('xit58 deh');
        $values_array = array_values($working_arrays[$what_we_are_doing]);
        $keys_array = array_keys($working_arrays[$what_we_are_doing]);
        foreach ($values_array as $index=>$value) {
            if (in_array($index,$process_indexes_array)){
                echo("<br/>".$keys_array[$index]."  "."<br/>");
                $ii = (array_keys($working_arrays[$what_we_are_doing][$keys_array[$index]]));
                //$vv = (array_values($working_arrays[$what_we_are_doing][$values_array[$index]]));
                $vv = array();
                switch ($display_option) {
                    case 'keys':
                        var_dump ($ii);
                        break;
                    case 'values':
                        var_dump($vv);
                        break;
                    case 'both':
                        //var_dump ($ii);
                        //var_dump($vv);
                        break;
                    default:
                        # code...
                        break;
                }
            }
       } // end foreach
       return;
    }

     public function working_arrays_initialize(
        $record,
        $what_we_are_doing,
        $bypassed_field_name,
        $model_table) {


        $working_arrays     = $this->working_arrays;
        
        $working_arrays     = $this->working_arrays_assign_from_data(
            $working_arrays,
            $record,
            $bypassed_field_name,
            $model_table
        );
        $working_arrays     = $this->working_arrays_build_query_relational_operators_array(
            $working_arrays,
            $record);
        $column_names       = $this->build_column_names_array($model_table);

        $working_arrays     = $this->populate_lookups(
            $what_we_are_doing,
            $working_arrays,
            $model_table,
            $bypassed_field_name);
         //$this->show_related_arrays("10010",$working_arrays,$what_we_are_doing,__LINE__);
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        if (! is_null($what_we_are_doing)){
            $working_arrays = $this->working_arrays_pad_for_growth(
            $working_arrays,
            $this->pad_ctr,
            $bypassed_field_name,
            $what_we_are_doing);
            // var_dump($working_arrays[$what_we_are_doing]);       

            //echo("</br>   * ".$this->pad_ctr."</br>");$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
            //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
            //$this->show_related_arrays("10010",$working_arrays,$what_we_are_doing,__LINE__);
        }
        return $working_arrays;

}


    public function working_arrays_pad_for_growth($working_arrays,$pad_ctr,$bypassed_field_name,$what_we_are_doing) {
        //var_dump($working_arrays);  $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $pad_ctr = 3;
        /*$pad_ctr = $this->working_arrays_set_pad_ctr(
            $pad_ctr,
            $working_arrays,
            $what_we_are_doing,
            $bypassed_field_name );
            */
            switch ($what_we_are_doing) {
                case null:
                    $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                    break;
                case 'edit1':
                case 'maintain_modifiable_fields':
                case 'maintain_browse_fields':
                     break;
                default:
                    if (! is_null($what_we_are_doing)){
                        $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                        $working_arrays = $this->working_arrays_pad_group(
                            $working_arrays,
                            $what_we_are_doing,
                            $pad_ctr,
                            $bypassed_field_name);
                        $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                        
                    }
                    break;
            } // what we are doing
        return $working_arrays;
    }

    public function working_arrays_set_pad_ctr($pad_ctr,$working_arrays,$what_we_are_doing,$bypassed_field_name ) {
        if (array_key_exists($what_we_are_doing,$this->working_arrays['groups_that_get_padded'])){

            //echo($what_we_are_doing." what_we_are_doing");$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
         foreach($working_arrays[$what_we_are_doing]['data'] as 
            $generic_array_name=>$actual_array_name) {
            //$this->debugx('0100',__FILE__,__LINE__,__FUNCTION__);
            //echo(' '.$generic_array_name." ** ".$actual_array_name);var_dump($working_arrays[$what_we_are_doing]['field_name_array'][$generic_array_name]);
            //echo($bypassed_field_name." bypassed_field_name");

            $this->show_related_arrays("00001",$working_arrays,$what_we_are_doing,__LINE__);
            //show_related_arrays field_name_array, field_type_array, lookups, default_values_array, data
            //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

            if (is_null($working_arrays[$what_we_are_doing]['data'][$generic_array_name])){
                 return $pad_ctr;
                }
            else{
                //var_dump( $working_arrays[$what_we_are_doing]['default_values_array']);
                //var_dump( $working_arrays[$what_we_are_doing]['data'][$generic_array_name]);
                foreach($working_arrays[$what_we_are_doing]['data'][$generic_array_name] as 
                $index=>$value) {
                    if ($value == $bypassed_field_name){
                        $pad_ctr -= 1;
                        //echo('<br>'.'found pad');$this->debug_exit(__FILE__,__LINE__,0);
                    }
                    
                } // end for
                var_dump($pad_ctr);$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);      
                return $pad_ctr;
           }
        }
    }

        //var_dump($pad_ctr);$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);      
    }

    public function working_arrays_pad_group($working_arrays,$what_we_are_doing,$pad_ctr,$bypassed_field_name) {
        //$this->show_related_arrays("00010",$working_arrays,$what_we_are_doing,__LINE__);
        echo('$pad_ctr'." ".$pad_ctr.'$what_we_are_doing'." ".$what_we_are_doing);
       // if(count($working_arrays[$generic_array_name])>0){
        $this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);
        //var_dump($working_arrays[$what_we_are_doing]);
        //echo('$pad_ctr'." ".$pad_ctr.'$what_we_are_doing'." ".$what_we_are_doing);
        //$this->show_related_arrays("11100",$working_arrays,$what_we_are_doing,__LINE__);
        //$this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);
        if (isset($working_arrays[$what_we_are_doing])){
        foreach($working_arrays[$what_we_are_doing]['field_name_array'] as 
            $field_name=>$actual_field_name) {
            for ($i=0; $i < $pad_ctr; $i++) {  
                $working_arrays[$what_we_are_doing]['data'][$actual_field_name][] =
                $working_arrays[$what_we_are_doing]['default_values_array'][$field_name];
            }  
        }
    }
        return $working_arrays;
    } 


    public function working_arrays_build_indexed_lookups($what_we_are_doing,$working_arrays,$model_table,$bypassed_field_name) {
        // every column of every row needs its own lookup
        echo("\n<br/>"."entering ".__FUNCTION__." ".__LINE__."\n");
        $this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
        //var_dump($working_arrays);  $this->debugx('0100',__FILE__,__LINE__,__FUNCTION__);

        switch ($what_we_are_doing) { 
        case "maintain_query_joins":
            //$this->show_related_arrays("00010",$working_arrays,$what_we_are_doing,__LINE__);
            $schema = DB::getDoctrineSchemaManager();
            //var_dump($working_arrays[$what_we_are_doing]['lookups']);
            //var_dump(array_values($working_arrays[$what_we_are_doing]['lookups']));
            //$this->show_related_arrays("01110",$working_arrays,'maintain_query_joins',__LINE__);
            //$this->show_related_arrays("00010",$working_arrays,'maintain_query_joins',__LINE__);
            //$this->show_related_arrays("10000",$working_arrays,'maintain_query_joins',__LINE__);
            //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
            $first_joins_joinee_table_name = 
            // use 1st occurrence for all not used entries
            $working_arrays[$what_we_are_doing]['data']['joins_joinee_table_names_array'][0];
            $columns = Schema::getColumnListing($first_joins_joinee_table_name);
            $columns = array_combine(array_values($columns),array_values($columns));
            //$this->show_related_arrays("10010",$working_arrays,'maintain_query_joins',__LINE__);
            $i = -1;
            foreach ($working_arrays[$what_we_are_doing]['data']['joins_joinee_field_names_array'] 
                as $index=>$value){ 
                $i++;
                if ($i == 0){
                      echo("<br/>\n".__LINE__."  ".$i." ".$value);
                }
                if ($value <> $bypassed_field_name){
                      echo("<br/>\n".__LINE__."  ".$i." ".$value);
                }
                else{ // we just need a valid array
                   
                    $working_arrays[$what_we_are_doing]['data']['joins_joinee_table_names_array'][$i] = 
                    $first_joins_joinee_table_name;
                    echo("<br/>\n".__LINE__."  ".$i." ".$first_joins_joinee_table_name);
                    $derivedName = 'joinee_field_names' . $i;
                    $working_arrays[$what_we_are_doing]['lookups'][$derivedName ] = $columns;
                    //$working_arrays[$what_we_are_doing]['lookups'][$derivedName ] = $columns;
        //$this->show_related_arrays("00010",$working_arrays,'maintain_query_joins',__LINE__);
            //$this->show_related_arrays("10010",$working_arrays,'maintain_query_joins',__LINE__);
               
                }    
            } //foreach 
            break; 
            //$this->show_related_arrays("10010",$working_arrays,'maintain_query_joins',__LINE__);
            //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

        }
        return $working_arrays;
    }


          
    public function populate_lookups($what_we_are_doing,$working_arrays,$model_table,$bypassed_field_name) {
        //$schema = DB::getDoctrineSchemaManager();
        //$columns = Schema::getColumnListing($link_parms_array['node_name']);
        //$this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);

        switch ($what_we_are_doing) { 

        case "maintain_modifiable_fields":
        case "maintain_browse_fields":  
            break;
        case "ppv_define_query":
        case "ppv_define_business_rules":
            foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $key => $value) {
                switch ($key) { 
                    case "field_name":
                        $columns = Schema::getColumnListing($model_table);
                        array_unshift($columns,"not_used");
                        $columns = 
                        array_combine(array_values($columns),array_values($columns));
                        $working_arrays[$what_we_are_doing]['lookups'] [$key] = $columns;
                        break;
                    case "r_o":
                        switch ($what_we_are_doing) {
                            case "ppv_define_query":
                                $working_arrays[$what_we_are_doing]['lookups'] [$key] = 
                                    $this->build_query_relational_operators_array();
                                break;
                            case "ppv_define_business_rules":
                                $working_arrays[$what_we_are_doing]['lookups'] [$key] = 
                                    $this->build_business_rules_relational_operators();
                             break;
                        } 
                        break;                       
                    }
                }
                break;        
        case "maintain_query_joins":
            $schema = DB::getDoctrineSchemaManager();
            //var_dump($working_arrays[$what_we_are_doing]['lookups']);
            //var_dump(array_keys($working_arrays[$what_we_are_doing]['data']));
            //var_dump(array_values($working_arrays[$what_we_are_doing]['data']));
            foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $field_name => $value) {
            // *** all but joinee_field_names
            //var_dump(array_keys($working_arrays[$what_we_are_doing]));
                switch ($field_name ) { 
                    case "join_types":
                        $array = array('not_used','normal','left','right');
                        $array = array_combine(array_values($array),array_values($array));
                        $working_arrays[$what_we_are_doing]['lookups'] [$field_name] = $array;
                        break;
                    case "joinor_field_names":
                        $columns = Schema::getColumnListing($model_table);
                        $columns = 
                        array_combine(array_values($columns),array_values($columns));

                        $working_arrays[$what_we_are_doing]['lookups'] [$field_name] = $columns;
                         break;
                      case "joins_r_o_array":
                        $join_ro_arrays = array('=','<>','<','>','<=','>=');
                        $table_names = array_combine(array_values($join_ro_arrays),array_values($join_ro_arrays));
                        $working_arrays[$what_we_are_doing]['lookups'] [$field_name] = $table_names;
                        //$columns = Schema::getColumnListing($this->model_table);
                        //$columns = array_combine(array_values($columns),array_values($columns));
                       break;
                  case "joinee_table_names":
                        $table_names = $this->generic_method_get_table_names();
                        $table_names = array_combine(array_values($table_names),array_values($table_names));
                        $working_arrays[$what_we_are_doing]['lookups'] [$field_name] = $table_names;
                        break;
                  case "joins_joinee_field_names_array":
                        // this is a select filled by an ajax call so we don't need a     lookup
                        // so i'm gonna comment all that joins_joinee_field_names_array stuff below
                        break;
                    case "bypassed_joins_joinee_field_names_array":
                        //$this->show_related_arrays("01110",$working_arrays,'maintain_query_joins',__LINE__);
                        $this->show_related_arrays("00011",$working_arrays,'maintain_query_joins',__LINE__);
                        $this->show_related_arrays("10000",$working_arrays,'maintain_query_joins',__LINE__);
                        //echo($what_we_are_doing.'count '.count($working_arrays[$what_we_are_doing]['data']['joins_joinee_field_names_array'] ));
                        //$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
                        /*
                        */
                        $i = -1;
                        // this array has not been padded
                        if (count($working_arrays[$what_we_are_doing]['data']['joins_joinee_field_names_array'] )>0){
                            foreach ($working_arrays[$what_we_are_doing]['data']['joins_joinee_field_names_array'] 
                                as $index=>$value){ 
                                    echo($i." ".$value." * ".__LINE__);
                                    //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                                    $i++;
                                    $tablex = 
                                    $working_arrays[$what_we_are_doing]['data']['joins_joinee_table_names_array'][$i];
                                    $columns = Schema::getColumnListing($tablex);
                                    $columns = array_combine(array_values($columns),array_values($columns));
                                    $derivedName = 'joinee_field_names' . $i;
                                    //$new_array[$field_name][] =$derivedName;
                                    $working_arrays[$what_we_are_doing]['lookups'][$derivedName ] = $columns;
                            } //for each 
                        } // there were some
                        break; 
                    } // end switch $field_name
               } //foreach entry in 'lookups' array

          } // end of what_we_are_doing
          return $working_arrays;
    } // populate_lookups

    public function working_arrays_build_joinee_field_names($working_arrays,$what_we_are_doing,$bypassed_field_name) {
        //echo("working_arrays_populate");
        var_dump($working_arrays[$what_we_are_doing]['data']);
        $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $i = -1;
        foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $index=>$value){ 
            if ($working_arrays[$what_we_are_doing]['data'][$value]<> $bypassed_field_name) {
                //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                $derivedName = $index . $i++;
                $new_array[$field_name][] =$derivedName;
                //$requestFieldsArray[$derivedName];
            }                         
        }
     }

        public function working_arrays_build_query_relational_operators_array($working_arrays,$record) {
       $query_relational_operators_array = $this->build_query_relational_operators_array();
 

        //var_dump($working_arrays);$this->debug_exit(__FILE__,__LINE__,1);                               
             //var_dump($record);
            //$this->debug_exit(__FILE__,__LINE__,10);
           //var_dump($working_arrays);$this->debug_exit(__FILE__,__LINE__,1);
            //$working_arrays['ppv_define_query']['lookups']['field_names']           = '';
            //$working_arrays['ppv_define_query']['lookups']['relational_operators']  = '';

            return($working_arrays);
            
}





     /**
     * write_file_from_string
     *
     */

    public function write_file_from_string($file_name,$file_as_string) {
        //$this->debug0(__FILE__,__LINE__,__FUNCTION__);
        if (is_file($file_name)){
            unlink($file_name); // delete it
        }
        $handle = fopen($file_name, "w");
        fwrite($handle, $file_as_string);
    }


    
}
        //$requestFieldsArray=$record['all(); // important!!

        //* ******
        // queries and business rules can grow and differ widely from one query (or rule) to 
        //another they need to be loaded first and padded with some room for growth
        //
        // no more or no less than $this->no_of_blank_entries 
        // default values padded onto the end
        //
        // even though we have relational operators and values arrays to worry about,
        // this drives off the number of field_names = to $bypassed_field_name on the end of the array

        // originally we did it just for who you were but not, it seems easiest to size them after we get // the existing arrays. 
        // ******