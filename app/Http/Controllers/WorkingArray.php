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
        $array_of_parm2_array               = array(), 
        $crlf = "\r\n"
 
        )
       // this is designed for use with the miscThings table
        // several sub-arrays are defined for different entities
        // this wasn't always a class but i'm converting it so i can use the same thing in programmer utilities

        //moving data related stuff out of the constructor
        // ******

        {
        

        parent::__construct();
        $this->db_snippet_connection           = $db_snippet_connection;
        $this->crlf = $crlf;
        //$this->debug_exit(__FILE__,__LINE__,0); echo(" entering constructor");
        $this->pad_ctr                          = $pad_ctr;
        //$snippet_table = "miscThings";
        $this->model_table                    = $model_table;

        $this->working_arrays               = $working_arrays;

        $this->working_arrays['what_we_are_doing_choices']     = array(
            'maintain_browse_fields'        => 'maintain_browse_fields',
            'maintain_modifiable_fields'    => 'maintain_modifiable_fields',
            'maintain_query_joins'          => 'maintain_query_joins',
            'ppv_define_business_rules'     => 'ppv_define_business_rules',
            'ppv_define_query'              => 'ppv_define_query'
            );

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

        $this->working_arrays['groups_with_lookups']     = array(
            'ppv_define_query'              => 'ppv_define_query',
            'maintain_query_joins'          => 'maintain_query_joins',
            'ppv_define_business_rules'     => 'ppv_define_business_rules'
            );

        $this->working_arrays['remaining_or_selected_groups'] = array(
        'maintain_modifiable_fields'    => 'modifiable_fields_array',
        'maintain_browse_fields'        => 'browse_select_array'
        );
/*
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
*/
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
//build_a_remaining_or_selected_array
    public function add_join_tables_to_from_array(
        $from_array,
        $what_we_are_doing,
        $working_arrays,
        $record,
        $bypassed_field_name,
        $model_table
        ){
        //echo('<br>'.__LINE__.__FUNCTION__);
        //$from_array = $this->insure_array_is_qualified($from_array,'short_prefix');
        //var_dump($from_array);
        //echo('<br>'.__LINE__.__FUNCTION__."working_arrays[\$what_we_are_doing]['data']");
        //var_dump($working_arrays[$what_we_are_doing]['data']); // record working_arrays
        //var_dump($working_arrays);
        $table_names = $this->return_table_names();
        //var_dump($working_arrays['maintain_query_joins']['data']);
        foreach ($working_arrays['maintain_query_joins']['data']['joinee_table_names'] 
            as $index => $joinee_table_index) {
            echo($table_names[$joinee_table_index]);
            //$table_name = $working_arrays['maintain_query_joins']['data']['joinee_table_names'][$joinee_table_index];
            $table_name = $table_names[$joinee_table_index];
            $column_names_array = (array) $this->build_column_names_array($table_name,'index'); 
            $prefix = $working_arrays['prefix_tbl_xref'][$table_name];
            $column_names_array = 
            $this->insure_array_is_qualified($column_names_array,$prefix);
            // auto-upgrade before table qualifications were added 20190324
            $from_array = array_merge($from_array,$column_names_array);
            $working_arrays['from_array'] = $from_array;
            //var_dump($column_names_array);
        }
        //var_dump($from_array);
        //$this->show_related_arrays("11010",$working_arrays,$what_we_are_doing,__LINE__);
        //$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
        return $working_arrays;
    }       

function array_unshift_assoc(&$arr, $key, $val){
    // reverses array, adds field at bottom, and reverses it back on the way back
    $arr = array_reverse($arr, true);
    $arr[$key] = $val;
    //var_dump($arr);
    return array_reverse($arr, true);
} 


    public function build_column_names_array($tbl_name,$index_type) {
        //echo ('build_column_names_array'.$tbl_name);exit("exit 99");
        $column_names_array = array();
        $columns = Schema::getColumnListing($tbl_name);
        sort($columns);
        switch($index_type) {
            case 'index':
                # code...
                break;
             case 'name':
                $columns = array_combine($columns, $columns);
                break;
           
            default:
                # code...
                break;
        }

        return $columns;

    }

    public function cleanup_bad_prefixes($requestFieldsArray) {
        $this->debugx('0001',__FILE__,__LINE__,__FUNCTION__);
        var_dump($requestFieldsArray);
        $arr1 = $this->insure_array_is_qualified($requestFieldsArray,"f0");
        var_dump($requestFieldsArray);
 
        //$arr1 = explode ( ",", $requestFieldsArray);
        //strrpos ( string $haystack , mixed $needle [, int $offset = 0 ] ) : int
          $arr1 = $requestFieldsArray;
          $limit = 5;
          %i1 = 0;
          foreach ($arr1 as $key => $json_string) {
            $ir =  strrpos ($json_string ,".");
            $il =  strrpos ($json_string ,".");
            if ($il < $ir){
                do {
                    $i1++;
                    $json_string = substr($json_string,$il);
                    $ir =  stripos ($json_string ,".");
                    $il =  strrpos ($json_string ,".");
                
                } while ($ir <> $il || $i1 >5);
                //$json_string = substr($json_string,$il);
                echo($json_string.__LINE__);
            }
            echo($json_string);
          }
        $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);

    }



    public function return_table_names() {
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
                //$this->show_related_arrays("00110",$working_arrays,$what_we_are_doing,__LINE__);
                //var_dump($working_arrays[$what_we_are_doing]['data']);
                //$this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);
                //for ($i=0; $i<(count($working_arrays[$what_we_are_doing]['data'])); $i++){


    //public function generic_gen_update_form_snippet($id,$working_arrays,$what_we_are_doing){



    public function flip_xref_prefixes($requestFieldsArray){ 
        //echo(__LINE__.__FUNCTION__);
        $table_names = $this->return_table_names();
        var_dump($requestFieldsArray['modifiable_fields_array']);
        $this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);
        $working_arrays['prefix_tbl_xref'] = 
        $this->build_prefix_table_xref($requestFieldsArray,$table_names);
        //  var_dump($working_arrays['prefix_tbl_xref']);
        //echo($requestFieldsArray['modifiable_fields_array']);
        $k2 = -1;$found_key = 0;
        // *****
        // we determine the prefix type by the position of the first match
        // if first_match is zero, new prefix type is 'table'
        $keys_to_replace =array();
        foreach ($working_arrays['prefix_tbl_xref'] as $key => $table_name) {
            $k2++;
            //echo("</br>".$key);
            if (stripos($requestFieldsArray['modifiable_fields_array'],$key)>0){
                if (!$found_key){
                    $found_key = 1;   
                    $first_index = $k2;
                }
                $keys_to_replace[] = $key;
            }
        }
        // *****************
        $new_prefix_type= 'table'; // hoping first index is zero 
        if($found_key && $first_index > 5){
            $new_prefix_type= 'prefix';    
        }
        // *****************
        $the_string = $requestFieldsArray['modifiable_fields_array'];
        echo($first_index.__LINE__);
        foreach ($keys_to_replace as $index => $key) {
            $table_name = $working_arrays['prefix_tbl_xref'][$key];
            $the_string = str_ireplace ($key,$table_name,$the_string );
            //echo("TS ".$the_string);
        }
        $requestFieldsArray['modifiable_fields_array'] = $the_string;
        //var_dump($requestFieldsArray['modifiable_fields_array']);
        return $requestFieldsArray;
     }

    public function gen_update_snippet_from_working_arrays(
        $id,
        $working_arrays,
        $what_we_are_doing,
        $view_files_prefix,
        $generated_files_folder){
        //$this->show_related_arrays("00010",$working_arrays,$what_we_are_doing,__LINE__);
        $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        //$schema = DB::getDoctrineSchemaManager();
        //echo($what_we_are_doing.$id." ".__LINE__);
        switch ($what_we_are_doing) { 
            case "maintain_modifiable_fields":
            case "maintain_browse_fields":  
                break;
            case "ppv_define_business_rules":
               // $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
            case "ppv_define_query":
                //$this->show_related_arrays("11111",$working_arrays,$what_we_are_doing,__LINE__);
                $coming_from = "advanced_query";
            case " ":
            case "maintain_query_joins":
                //$this->show_related_arrays("00110",$working_arrays,$what_we_are_doing,__LINE__);
                //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                $new_array = array_keys($working_arrays[$what_we_are_doing]['field_name_array']);
                $firstField = ($new_array[0]);
                
                //var_dump($working_arrays[$what_we_are_doing]['data']);
                //$this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);

                // i want the first field name
                //$this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);
                $crlf = "\r\n";
                $strx = "";
                $strx .= '<table id="inner_tbl_0_5" class="table_green_lines">';
                
                $strx .= $this->return_html_fieldnames_row($working_arrays,$what_we_are_doing);
                $i = -1;
                // pass all data (drive off first field)
                foreach ($working_arrays[$what_we_are_doing]['data'][$firstField] as 
                    $field_name0 => $values_array) {
                    // each of these is a row
                    $strx .= "<tr>".$crlf; 
                     $i++;
                    foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as 
                        $field_name => $db_name) {
                        switch ($working_arrays[$what_we_are_doing]['field_type_array'][$field_name]) {
                            case 'cascading_select':
                      //$this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);
                             $strx .= 
                            "<td style=\"text-align:center\">".$crlf.
                            "{{ Form::select('".$field_name.$i."',".
                            "$"."working_arrays['".$what_we_are_doing."']['lookups']['".$field_name.$i."'],".
                             
                            "$"."working_arrays['".$what_we_are_doing."']['data']['".$field_name."']['".$i."']".
                            ") }}".
                            $crlf.
                            "</td>".$crlf;
                            break;
                        case 'cascaded_select':
                            $strx .= 
                            "<td style=\"text-align:center\">".$crlf.
                            "{{ Form::select('".$field_name.$i."',".
                            "$"."working_arrays['".$what_we_are_doing."']['lookups']['".$field_name.$i."'],".
                             
                            "$"."working_arrays['".$what_we_are_doing."']['data']['".$field_name."']['".$i."']".
                            ") }}".
                            $crlf.
                            "</td>".$crlf;

                            //$this->show_related_arrays("00110",$working_arrays,$what_we_are_doing,__LINE__);
                            //$this->debugx('0100',__FILE__,__LINE__,__FUNCTION__);
                            break;
                        case 'select':
                            //echo("<br/>".$working_arrays[$what_we_are_doing]['data'][$value][$i]);
                            $strx .= 
                            "<td style=\"text-align:center\">".$crlf.
                            "{{ Form::select('".$field_name.$i."',".
                            "$"."working_arrays['".$what_we_are_doing."']['lookups']['".$field_name."'],".
                             
                            "$"."working_arrays['".$what_we_are_doing."']['data']['".$field_name."']['".$i."']".
                            ") }}".
                            $crlf.
                            "</td>".$crlf;
                            break;
                        case 'text':
                            $strx .= 
                            "<td style=\"text-align:left\">".$crlf.
                            "{{ Form::text('".$field_name.$i."',".
                            "$"."working_arrays['".$what_we_are_doing."']['data']['".$value."']['".$i."']) }}".                                
                            $crlf.
                            "</td>".$crlf;
                            break;
                      } 
                    }
                      $strx .= "</tr>".$crlf;   
                    }  // end for

            }
            //$this->show_related_arrays("00010",$working_arrays,$what_we_are_doing,__LINE__);
            $this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);

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

    public function initialize_for_query_joins($working_arrays) {

        // ************
        // maintain_query_joins
        // ************
         $what_we_are_doing = "maintain_query_joins";
        $working_arrays[$what_we_are_doing]['field_name_array'] = array(
            'join_types'            => 'joins_join_type_array',
            'joinor_field_names'    => 'joins_joinor_field_name_array',
            'joins_r_o_array'       => 'joins_r_o_array',
            'joinee_table_names'    => 'joins_joinee_table_names_array',
            'joinee_field_names'    => 'joins_joinee_field_name_array'
            );
        
        $what_we_are_doing = "maintain_modifiable_fields";
        $working_arrays[$what_we_are_doing]['field_name_array'] = array(
            'join_types'            => 'joins_join_type_array',
            'joinor_field_names'    => 'joins_joinor_field_name_array',
            'joins_r_o_array'       => 'joins_r_o_array',
            'joinee_table_names'    => 'joins_joinee_table_names_array',
            'joinee_field_names'    => 'joins_joinee_field_name_array'
            );
        $working_arrays[$what_we_are_doing]['field_type_array'] = array(
            'join_types'            => 'select',
            'joinor_field_names'    => 'select',
            'joins_r_o_array'       => 'select',
            'joinee_table_names'    => 'cascading_select',
            'joinee_field_names'    => 'cascaded_select'
            );
        
        return($working_arrays);  
    }




    public function move_from_constructor($entity) {
        $this->generated_snippets_array         = $this->get_generated_snippets();

    }


//var_dump($working_arrays);
//$this->MyWorkingArray->show_related_arrays('00010',$working_arrays,$what_we_are_doing,__LINE__);
//var_dump($requestFieldsArray);//$this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);

    public function recombine_joinee_field_types(
        $working_arrays,
        $requestFieldsArray,
        $what_we_are_doing,
        $bypassed_field_name) {
        $this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);
        //var_dump($working_arrays);
        //var_dump($working_arrays[$what_we_are_doing]);
        //var_dump(array_keys($working_arrays[$what_we_are_doing]));
        //var_dump($working_arrays['maintain_query_joins']);
        //var_dump($working_arrays['maintain_query_joins']['field_name_array']);
        //var_dump(array_keys($working_arrays[$what_we_are_doing]['field_name_array']));
        $first_time = 1;
        $new_array = array_keys($working_arrays[$what_we_are_doing]['field_name_array']);
        // i want a numeric index
        //var_dump($new_array);
        //$this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);
        $firstField = ($new_array[0]);
        $itsInTheArray = 1;
        //echo($firstField);$this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);

   //     $itsInTheArray = 1;
        $i = -1;
        // getindexes of those with the default value (whichh isnot saved)
        $bypassed_index_array = array();
        $field_name =$firstField;
        do {
            $i++;
            $derivedName = $field_name . $i;
            if (key_exists($derivedName,$requestFieldsArray)){
                if ($requestFieldsArray[$derivedName] == $bypassed_field_name) {
                    $bypassed_index_array[] = $i;                        
                }   
            }
            else{
                $itsInTheArray = 0;
                //$new_array[$field_name]= json_encode($new_array[$field_name]) ;
                }
            }while ($itsInTheArray);

        //var_dump($bypassed_index_array);$this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);
        foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $field_name => $db_name) {
            $update = 1; 
            $itsInTheArray = 1;
            $i = -1;
            do {
                $i++;
                if (in_array($i,$bypassed_index_array)){
                    // ignore these
                }
                else{
                    $derivedName = $field_name . $i;
                    if (key_exists($derivedName,$requestFieldsArray)){
                        if(isset($requestFieldsArray[$derivedName])){
                          $new_array[$field_name][] = $requestFieldsArray[$derivedName];
                        }                         
                    }
                    else{
                        $itsInTheArray = 0;
                        //new_array[$field_name]= json_encode($new_array[$field_name]) ;
                    }
                }
            }while ($itsInTheArray);
        }
        $last_array = array();
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);    
        foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $field_name => $db_name){
            $last_array [$db_name] = json_encode($new_array[$field_name]);
        }
        //var_dump($last_array);
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);    
        return $last_array;
     }




    public function  show_related_arrays($parmstr,$working_arrays,$what_we_are_doing,$LINE){
        $parma = str_split($parmstr);
        //var_dump($parma);
        //var_dump($working_arrays['related_arrays']);
        //var_dump($working_arrays);
    $working_arrays['related_arrays'] = array(
            '0'  => 'field_name_array',
            '1'  => 'field_type_array',
            '2'  => 'lookups',
            '3'  => 'data',
            '4'  => 'default_values_array'
            );


        echo("<br/>".'<span style="color:#f44242;font-size:150%;">'.__FUNCTION__." "." was called at ".$LINE."<br/>".'what_we_are_doing '."</span>".$what_we_are_doing);
        //var_dump($parma);
        //var_dump($working_arrays['related_arrays']);
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





    public function assign_from_data($working_arrays,$record,$bypassed_field_name,$model_table) {
        //echo("assign_from_data");
        // var_dump($record);
        //var_dump($working_arrays);
        //$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
        //* ******
        // even though we have relational operators and values arrays to worry about,
        // this drives off the number of field_names = to $bypassed_field_name 
        
        // originally we did it just for who you were but not, it seems easiest to size them after we get // the existing arrays. 
        // ****** 

        $working_arrays['maintain_modifiable_fields']['field_name_array']  = array(
            'maintain_modifiable_fields'    => 'modifiable_fields_array'
             //'field_name'    => "maintain_modifiable_fields" 
            //'from_array'    => array(),
            //'to_array'      => array()
        ); 

        $working_arrays['maintain_browse_fields']['field_name_array']  = array(
            'maintain_browse_fields'        => 'browse_select_array'
            //'from_array'    => array(),
            //'to_array'      => array()
            ); 
        $working_arrays['maintain_query_joins']['field_name_array'] = array(
            'join_types'            => 'joins_join_type_array',
            'joinor_field_names'    => 'joins_joinor_field_name_array',
            'joins_r_o_array'       => 'joins_r_o_array',
            'joinee_table_names'    => 'joins_joinee_table_names_array',
            'joinee_field_names'    => 'joins_joinee_field_name_array'
            );
        $working_arrays['maintain_query_joins']['field_type_array'] = array(
            'join_types'            => 'select',
            'joinor_field_names'    => 'select',
            'joins_r_o_array'       => 'select',
            'joinee_table_names'    => 'cascading_select',
            'joinee_field_names'    => 'cascaded_select'
            );
        $working_arrays['maintain_query_joins']['default_values_array'] = array(
            'join_types'            => $bypassed_field_name,
            'joinor_field_names'    => $bypassed_field_name,
            'joins_r_o_array'       => $bypassed_field_name,
            'joinee_table_names'    => $bypassed_field_name,
            'joinee_field_names'    => $bypassed_field_name
            );


        // *************
        // *************
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
        // *************
        // *************
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
        // *************
        // *************
        $prefix = "f";
        foreach ($working_arrays['what_we_are_doing_choices']  as $what_we_are_doing => $name){
            //echo(__LINE__."*".$what_we_are_doing);
            //var_dump($working_arrays[$what_we_are_doing]);
            //var_dump($working_arrays['maintain_query_joins']['field_name_array']);
            //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
            // DECODE ALL DATABASE FIELDS into field_name_array
            switch ($what_we_are_doing) {
                case 'maintain_browse_fields':
                case 'maintain_modifiable_fields':
                case 'maintain_query_joins':
                case 'ppv_define_business_rules':
                case 'ppv_define_query':
                    foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $field => $db_name) {
                        $working_arrays[$what_we_are_doing]['data'][$field] =
                        (array) json_decode($record[$db_name]);
                    }   
                    break;
               }
           //var_dump($working_arrays[$what_we_are_doing]['data']);
           }
           foreach ($working_arrays['what_we_are_doing_choices']  
            as $what_we_are_doing => $name){

               //var_dump($working_arrays['maintain_query_joins']);
            switch ($what_we_are_doing) {
                case 'maintain_browse_fields':
                case 'maintain_modifiable_fields':
                    $table_names = $this->return_table_names();
                    $working_arrays['prefix_tbl_xref'] = 
                        $this->build_prefix_table_xref($working_arrays,$table_names);
                    //var_dump($working_arrays['prefix_tbl_xref']);
                   $model_field_names = (array) $this->build_column_names_array($model_table,'index');
                    $prefix = $working_arrays['prefix_tbl_xref'][$model_table];
                    $from_array = $this->insure_array_is_qualified($model_field_names,$prefix);
                    //echo __LINE__. $prefix ;
                    //var_dump($from_array); // doesnt need sorting
                    //var_dump($working_arrays['from_array']); // doesnt need sorting
                    //var_dump($record);
                    $working_arrays = $this->add_join_tables_to_from_array(
                        $from_array,
                        $what_we_are_doing,
                        $working_arrays,
                        $record,
                        $bypassed_field_name,
                        $model_table
                        );        
                    $from_array = ($working_arrays['from_array']); 
                    $from_array = array_combine($from_array, $from_array);
                    $working_arrays['from_array'] = $from_array;
                    //var_dump($working_arrays['from_array']); // doesnt need sorting
                    //echo(__LINE__.__FUNCTION__); 
                    //$from_array = ($working_arrays['from_array']);
                    //$working_arrays[$what_we_are_doing]['from_array'] = $from_array;
                    $working_arrays = $this->build_a_remaining_or_selected_array(
                    $from_array,
                    $what_we_are_doing,
                    $working_arrays,
                    $record,
                    $bypassed_field_name,
                    $model_table);
                    break;


               }

        }     
       
        //var_dump($working_arrays);
        //var_dump($working_arrays);
         //$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
        $what_we_are_doing = 'maintain_query_joins';

        $working_arrays     = $this->initialize_for_query_joins($working_arrays);
        //var_dump($working_arrays[$what_we_are_doing]);

        $i = -1;

        foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $field => $db_name) {
            $i++;
            switch ($working_arrays[$what_we_are_doing]['field_type_array']) {
                case 'cascading_select':
                    $working_arrays[$what_we_are_doing]['data']['indexed_table_names'.$i] =$db_name;
                    break;
                case 'cascaded_select':
                    $working_arrays
                    [$what_we_are_doing]['data']['indexed_field_names'.$i] =$db_name;
                    break;
                }      
            }
       //var_dump($working_arrays[$what_we_are_doing]);


        //$working_arrays = $this->set_lookup_arrays($working_arrays,$what_we_are_doing,$record,$bypassed_field_name,$model_table);
         // set lookup arrays for each field

        return($working_arrays);
    }


     public function set_lookup_arrays($working_arrays,$what_we_are_doing,$record,$bypassed_field_name,$model_table) {            
          // set lookup arrays for each field
         foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $field => $value) {
            switch ($field) {
                case 'join_types':
                    $working_arrays[$what_we_are_doing]['lookups']['joins_join_type_array'] = array(
                        'not_used'  => 'not_used',
                        'normal'    => 'normal',
                        'left'      => 'left',
                        'right'     => 'right',
                        );
                    break;
                case 'joins_r_o_array':
                    $working_arrays[$what_we_are_doing]['lookups']['joins_r_o_array'] = array(
                        '='  => '=',
                        '>'  => '>',
                        '<'  => '<',
                        '<=' => '<=',
                        '>=' => '>=',
                        );
                    break;
                case 'field_array_names':
                    $working_arrays[$what_we_are_doing]['lookups']['field_array_names'] = array(
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
    }


     public function assign_from_data_old($working_arrays,$record,$bypassed_field_name,$model_table) {
        //echo("assign_from_data");
        // var_dump($record);
        //var_dump($working_arrays);
        //$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
        //* ******
        // even though we have relational operators and values arrays to worry about,
        // this drives off the number of field_names = to $bypassed_field_name 
        
        // originally we did it just for who you were but not, it seems easiest to size them after we get // the existing arrays. 
        // ****** 
        foreach ($this->working_arrays['what_we_are_doing_choices']  as $what_we_are_doing => $name){
            switch ($what_we_are_doing) {
                case 'maintain_browse_fields':
                case 'maintain_modifiable_fields':
                    $working_arrays = $this->bxuild_a_remaining_or_selected_array(
                    $from_array,
                    $what_we_are_doing,
                    $working_arrays,
                    $record,
                    $bypassed_field_name,
                    $model_table);
                    break;
                case 'maintain_query_joins':
                    break;
                case 'ppv_define_business_rules':
                case 'maintain_modifiable_fields':
                    $working_arrays
                    [$what_we_are_doing]['data']['indexed_field_names'.$i] =$db_name;
                    break;
            }      
        }

    // ****** 
        foreach ($this->working_arrays['what_we_are_doing_choices']  as $what_we_are_doing => $name){
            //field_names
            switch ($what_we_are_doing) {
                case 'maintain_browse_fields':
                case 'maintain_modifiable_fields':
                    $working_arrays = $this->xxbxuild_a_remaining_or_selected_array(
                    $from_array,       
                    $what_we_are_doing,
                    $working_arrays,
                    $record,
                    $bypassed_field_name,
                    $model_table);
                    break;
                case 'maintain_query_joins':
                    break;
                case 'ppv_define_business_rules':
                case 'maintain_modifiable_fields':
                    $working_arrays
                    [$what_we_are_doing]['data']['indexed_field_names'.$i] =$db_name;
                    break;
            }      
        }

         
       
        var_dump($working_arrays);
        //var_dump($working_arrays);
         $this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
        $what_we_are_doing = 'maintain_query_joins';
/*        
        foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $field => $db_name
        {
            var_dump($working_arrays);
            //$a1 = json_decode($record[$db_name]);
            //$a1 = (array) $a1;
            //var_dump($a1);
            //$working_arrays[$what_we_are_doing]['data'][$field] = json_decode($record[$db_name]);
        }
*/        
        $working_arrays     = $this->initialize_for_query_joins($working_arrays);
        //var_dump($working_arrays[$what_we_are_doing]);

        $i = -1;
        $working_arrays[$what_we_are_doing]['field_name_array'] = array(
            'join_types'            => 'joins_join_type_array',
            'joinor_field_names'    => 'joins_joinor_field_name_array',
            'joins_r_o_array'       => 'joins_r_o_array',
            'joinee_table_names'    => 'joins_joinee_table_names_array',
            'joinee_field_names'    => 'joins_joinee_field_name_array'
            );
        //var_dump($working_arrays[$what_we_are_doing]);

        foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $field => $db_name) {
            $i++;
            switch ($working_arrays[$what_we_are_doing]['field_type_array']) {
                case 'cascading_select':
                    $working_arrays[$what_we_are_doing]['data']['indexed_table_names'.$i] =$db_name;
                    break;
                case 'cascaded_select':
                    $working_arrays
                    [$what_we_are_doing]['data']['indexed_field_names'.$i] =$db_name;
                    break;
                }      
            }
       //var_dump($working_arrays[$what_we_are_doing]);

        for ($i=0; $i<(count($working_arrays[$what_we_are_doing]['data'])); $i++){
            $working_arrays[$what_we_are_doing]['data'][$field] =
            (array) json_decode($record[$value]);

        }

          
        //$this->show_related_arrays("11110",$working_arrays,$what_we_are_doing,__LINE__);
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

 

         // set lookup arrays for each field
         foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $field => $value) {
            switch ($field) {
                case 'join_types':
                    $working_arrays[$what_we_are_doing]['lookups']['joins_join_type_array'] = array(
                        'not_used'  => 'not_used',
                        'normal'    => 'normal',
                        'left'      => 'left',
                        'right'     => 'right',
                        );
                    break;
                case 'joins_r_o_array':
                    $working_arrays[$what_we_are_doing]['lookups']['joins_r_o_array'] = array(
                        '='  => '=',
                        '>'  => '>',
                        '<'  => '<',
                        '<=' => '<=',
                        '>=' => '>=',
                        );
                    break;
                case 'field_array_names':
                    $working_arrays[$what_we_are_doing]['lookups']['field_array_names'] = array(
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
         $working_arrays[$what_we_are_doing]['xxxshow_related_arrays_index'] = array(
            'field_names'           => 'field_name_array',
            'field_types'           => 'field_type_array',
            'lookups'               => 'lookups',
            'data'                  => 'data',
            'default_values'        => 'default_values_array'
            );

       $working_arrays[$what_we_are_doing]['default_values_array'] = array(
            'join_types'            => 'not_used',
            'joinor_field_names'    => 'not_used',
            'joins_r_o_array'       => '=',
            'joinee_table_names'    => 'not_used',
            'joinee_field_names'    => 'not_used',
            );












       $j = -1;

        //$this->show_related_arrays("11100",$working_arrays,$what_we_are_doing,__LINE__);
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

  
        //var_dump($working_arrays);
        return($working_arrays);
    }

     
    public function build_a_remaining_or_selected_array(
        $from_array,
        $what_we_are_doing,
        $working_arrays,
        $record,
        $bypassed_field_name,
        $model_table
        ) {
        foreach ($working_arrays['what_we_are_doing_choices']  
            as $what_we_are_doing => $name){
             //var_dump($working_arrays[$what_we_are_doing]);
            switch ($what_we_are_doing) {
                case 'maintain_modifiable_fields':
                case 'maintain_browse_fields':
                    $to_array = $working_arrays[$what_we_are_doing]['data'][$what_we_are_doing];
                    //var_dump($working_arrays[$what_we_are_doing]['data']);
                    //echo($what_we_are_doing);
                    //var_dump($to_array);
                    //$to_array = $this->insure_array_is_qualified($to_array,"f0");
                    $to_array = array_combine($to_array,$to_array);
                    $working_arrays[$what_we_are_doing]['to_array'] = $to_array;
                    $requestFieldsArray = $this->cleanup_bad_prefixes($to_array);
                    var_dump($to_array);
                    var_dump($requestFieldsArray);

                    //var_dump($to_array);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                     //var_dump($working_arrays[$what_we_are_doing]['to_array']);
                    //var_dump($working_arrays[$what_we_are_doing]['from_array']);
                    //maintain_modifiable_fields
                    $from_array = array_diff($from_array,$to_array);
                    $working_arrays[$what_we_are_doing]['from_array'] = $from_array;
                    break;
                    }    
                } 
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        return $working_arrays;
    //}
    } 


    public function build_prefix_table_xref($working_arrays,$table_names){
        $working_arrays['prefix_table_xref'] = array();
        $i = 0;
        $array1 = array();
        $short_prefix = "f";
        foreach ($table_names as $key => $table_name) {
            if ($table_name == $this->model_table){
                //$array1[$short_prefix.'0'] = $table_name;
                //$array1["f00"] = $table_name;
                $array1 = $this->array_unshift_assoc($array1, "f0", $table_name);
            }
            else{
                $i++;
                $array1[$short_prefix.$i] = $table_name;
            }
        }
        
        asort($array1);
        //var_dump($array1);
        $array2 = $array1;
        ksort($array2);
        //var_dump($array2);
        $array1 = array_flip($array2);
        ksort($array1);
        //var_dump($array1);
        $array3 = array_merge($array2,$array1);
        
        //var_dump($array3);
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        return $array3;
    } 


    public function insure_array_is_qualified($prefixed_array,$prefix){
        $join_array = array();
        //var_dump($prefixed_array);
        //array_unshift_assoc(&$arr, $key, $val)
        //foreach ($working_arrays['all_field_names'] as $key => $field_name) {
        //$prefix = "f0";
        foreach ($array1 as $key => $field_name) {
            $k = strpos(".",$field_name);
            if ($k > 0)
            {
                return $working_arrays; // already qualified
            }
            else{
                $join_array[] = $prefix.".".$field_name;
            }
            # code...
        }
        //var_dump($join_array);
        //    echo("*".strpos($array[0],".")."*");
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        return $join_array;

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

        $working_arrays     = $this->assign_from_data(
            $working_arrays,
            $record,
            $bypassed_field_name,
            $model_table
        );
        
        //var_dump($working_arrays);  
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        //var_dump($working_arrays);  
        //$working_arrays     = $this->initialize_for_query_joins($working_arrays);
        //$this->show_related_arrays("10010",$working_arrays,$what_we_are_doing,__LINE__);


        $working_arrays = $this->working_arrays_build_query_relational_operators_array(
            $working_arrays,
            $record);
        $column_names   = $this->build_column_names_array($model_table,'name');
        //var_dump($working_arrays);  

        $working_arrays = $this->populate_lookups(
            $what_we_are_doing,
            $working_arrays,
            $model_table,
            $bypassed_field_name);
        //var_dump($working_arrays);  

// */
         //$this->show_related_arrays("10010",$working_arrays,$what_we_are_doing,__LINE__);
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

        if (! is_null($what_we_are_doing)){
            switch ($what_we_are_doing) {
                case 'edit1':
                    # code...
                    break;
                
                default:
                    $pad_ctr = 3;
                    $working_arrays = $this->working_arrays_pad_for_growth(
                    $working_arrays,
                    $pad_ctr,
                    $bypassed_field_name,
                    $what_we_are_doing);
                    //var_dump($what_we_are_doing);  exit() ;
                    switch ($what_we_are_doing) {
                        case 'maintain_query_joins':
                            $working_arrays = $this->pad_lookups_for_maintain_query_joins(    
                            $working_arrays,
                            $pad_ctr,
                            $bypassed_field_name,
                            $what_we_are_doing);
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                    //var_dump($working_arrays[$what_we_are_doing]);   

                    //echo("</br>   * ".$this->pad_ctr."</br>");$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                    //$this->show_related_arrays("00110",$working_arrays,$what_we_are_doing,__LINE__);
                    //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                            # code...
                    break;
            }

        }
        //var_dump($working_arrays);
        return $working_arrays;

}


    public function working_arrays_pad_for_growth($working_arrays,$pad_ctr,$bypassed_field_name,$what_we_are_doing) {
        //var_dump($working_arrays[$what_we_are_doing]['data']);  $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
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
                        //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                        $working_arrays = $this->working_arrays_pad_group(
                            $working_arrays,
                            $what_we_are_doing,
                            $pad_ctr,
                            $bypassed_field_name);
                        //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                        
                    }
                    break;
            } // what we are doing
            //$this->show_related_arrays("00010",$working_arrays,$what_we_are_doing,__LINE__);
            //var_dump($working_arrays[$what_we_are_doing]['data']);
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
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
                //var_dump( $working_arrays[$what_we_are_doing]['data'][$generic_array_name]);
                foreach($working_arrays[$what_we_are_doing]['data'][$generic_array_name] as 
                $index=>$value) {
                    if ($value == $bypassed_field_name){
                        $pad_ctr -= 1;
                        //echo('<br>'.'found pad');$this->debug_exit(__FILE__,__LINE__,0);
                    }
                    
                } // end for
                //var_dump($pad_ctr);$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);      
                return $pad_ctr;
           }
        }
    }

        //var_dump($pad_ctr);$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);      
    }

    public function working_arrays_pad_group($working_arrays,$what_we_are_doing,$pad_ctr,$bypassed_field_name) {
        //$this->show_related_arrays("00010",$working_arrays,$what_we_are_doing,__LINE__);
        //echo(__LINE__.' $pad_ctr'." ".$pad_ctr.'$what_we_are_doing'." ".$what_we_are_doing);
       // if(count($working_arrays[$generic_array_name])>0){
        //$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
        //var_dump($working_arrays[$what_we_are_doing]); // maintain_query_joins 
        echo(__LINE__.' $pad_ctr'." ".$pad_ctr.'$what_we_are_doing'." ".$what_we_are_doing);
        //$this->show_related_arrays("11100",$working_arrays,$what_we_are_doing,__LINE__);
        //$this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);
        //$pad_ctr--;
        if (isset($what_we_are_doing)){
            foreach($working_arrays[$what_we_are_doing]['field_name_array'] as 
            $field_name=>$actual_field_name) {
                for ($i=0; $i < $pad_ctr; $i++) {  
                    $working_arrays[$what_we_are_doing]['data'][$field_name][] =
                    $working_arrays[$what_we_are_doing]['default_values_array'][$field_name];
                }  
            }
        }
        //var_dump($working_arrays[$what_we_are_doing]['data']);
        //$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
        return $working_arrays;
    } 

    public function populate_lookups($what_we_are_doing,$working_arrays,$model_table,$bypassed_field_name) {
        //$schema = DB::getDoctrineSchemaManager();
        //$this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);
        switch ($what_we_are_doing) { 
            case "maintain_modifiable_fields":
            case "maintain_browse_fields":  
                break;
            case "maintain_query_joins":
                    //var_dump($working_arrays);  

                $working_arrays= 
                $this->populate_lookups_for_maintain_query_joins(
                    $what_we_are_doing,
                    $working_arrays,
                    $model_table,
                    $bypassed_field_name);
                //var_dump($working_arrays);  

                break;    
            case "ppv_define_query":
            case "ppv_define_business_rules":
                $working_arrays= $this->populate_lookups_for_queries_or_business_rules(
                $what_we_are_doing,$working_arrays,$model_table,$bypassed_field_name);
                break;        
        } 
        return $working_arrays;
    }

    public function populate_lookups_for_queries_or_business_rules(
        $what_we_are_doing,$working_arrays,$model_table,$bypassed_field_name) {
        foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $key => $value) {
            switch ($key) { 
                case "field_name":
                    $columns = $this->build_column_names_array($model_table,'name');
                    array_unshift($columns,"not_used"); // first
                    //$columns = array_combine(array_values($columns),array_values($columns));
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
                }                   
            }
            return $working_arrays;      
    }

    public function populate_lookups_for_maintain_query_joins(
        $what_we_are_doing,$working_arrays,$model_table,$bypassed_field_name){        
        /*
        // *******************************
        // 
        // ******************************
        table names come from the schema 
        selected_table comes from the database array
       */
    $schema = DB::getDoctrineSchemaManager();
    for ($i=0; $i<(count($working_arrays[$what_we_are_doing]['data'])); $i++){

            //var_dump(array_keys($working_arrays[$what_we_are_doing]));
        foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $field_name => $value) {
            switch ($field_name ) { 
                case "joinee_table_names":
                    //$i++;
                    $table_names = $this->return_table_names();
                    //var_dump($table_names);
                    $working_arrays[$what_we_are_doing]['lookups'] [$field_name.$i] = $table_names;
                    $table_name = $table_names[0];
                    //$this->show_related_arrays("00110",$working_arrays,$what_we_are_doing,__LINE__);
                    //var_dump($working_arrays[$what_we_are_doing]['lookups']);
                    break;
                case "joinee_field_names": // try 2019-02-07
                    // this array has not been padded
                    if (count($working_arrays[$what_we_are_doing]['data'])>0){  
                        //var_dump($working_arrays[$what_we_are_doing]['data']);
                        //var_dump($working_arrays[$what_we_are_doing]['field_name_array']);
                        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                        //var_dump($table_names);
                        // populate_lookups
                        
                        if (empty($table_name)){
                            $table_name = $table_names[0];
                        }
                        $columns = $this->build_column_names_array($table_name,'name');  
                        //echo($table_name."**");var_dump($columns);
                        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                        //var_dump($columns);
                        $derivedName = 'joinee_field_names' . $i;
                        $working_arrays[$what_we_are_doing]['lookups'][$derivedName ] = $columns;
                        //$this->show_related_arrays("00110",$working_arrays,$what_we_are_doing,__LINE__);
                        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

                    }
                  break;
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
                    $name_names = array_combine(array_values($join_ro_arrays),array_values($join_ro_arrays));
                    $working_arrays[$what_we_are_doing]['lookups'] [$field_name] = $name_names;
                   break;
              case "joins_joinee_field_name_array":
                    // this is a select filled by an ajax call so we don't need a     lookup
                    // so i'm gonna comment out all that joins_joinee_field_name_array stuff below
                    $table_name = 
                    $working_arrays[$what_we_are_doing]['lookups'] [$field_name] = $table_names;
                    break;
                case "bypassed_joins_joinee_field_name_array":

                    break; 
                } // end switch $field_name
           } //foreach entry in 'lookups' array
        }

        return $working_arrays;
    }


/*
 SELECT p1.name, p1.sex, p2.name, p2.sex, p1.species
       FROM pet AS p1 INNER JOIN pet AS p2
         ON p1.species = p2.species
         AND p1.sex = 'f' AND p1.death IS NULL
         AND p2.sex = 'm' AND p2.death IS NULL;
*/

    public function pad_lookups_for_maintain_query_joins(
        $working_arrays,
        $pad_ctr,
        $bypassed_field_name,
        $what_we_are_doing){
       
        //$this->debugx('0011',__FILE__,__LINE__,__FUNCTION__);
        //$this->show_related_arrays("00110",$working_arrays,$what_we_are_doing,__LINE__);
        $NoOfLookups = count($working_arrays[$what_we_are_doing]['lookups'] );
        $lookup_keys = array_keys($working_arrays[$what_we_are_doing]['lookups']);
        //The last two (backwards) are a field name array and a table name array
        $field_name_array_name = $lookup_keys[$NoOfLookups-1];
        $field_name_array = 
        $working_arrays[$what_we_are_doing]['lookups'];
        //var_dump($field_name_array_name);
        //var_dump($working_arrays[$what_we_are_doing]['lookups']);
        $table_name_array_name = $lookup_keys[$NoOfLookups-2];
        $table_name_array =   $working_arrays[$what_we_are_doing]['lookups'][$table_name_array_name];

        if (count($working_arrays[$what_we_are_doing]['data']['joinee_table_names']) !=
            count($working_arrays[$what_we_are_doing]['data']['joinee_field_names'])){
            $working_arrays[$what_we_are_doing]['data']['joinee_field_names'][]= "not_used";
        }


        //var_dump($table_name_array_name);
        //(haystack, needle)
        $k = strpos("*".$table_name_array_name,'joinee_table_names');
        if ($k > 0)
        {
            $last_index =  substr($table_name_array_name,strlen('joinee_table_names')) ;
            echo("last_index ".
            $last_index) ;
            $new_index = $last_index + 1;
        }

        // now includes padding
        //$start_index = $NoOfRecs - $pad_ctr -1;

        for ($i=0; $i<($pad_ctr); $i++){
            $index = $new_index + $i;
            //var_dump(array_keys($working_arrays[$what_we_are_doing]));
            //var_dump($field_name_array);
            foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $field_name => $value) {
                switch ($field_name ) { 
                    case "joinee_table_names":
                        
                        //$table_name = $table_names[0];
                        //echo("YYY");
                        //var_dump($working_arrays[$what_we_are_doing]['lookups'][$field_name.'0']);
                        $working_arrays[$what_we_are_doing]['lookups'] [$field_name.$index] = $table_name_array;
                        //echo("zzz");
                        //$this->show_related_arrays("00110",$working_arrays,$what_we_are_doing,__LINE__);
                      //  break;
                    case "joinee_field_names": // try 2019-02-07
                        //echo("zllzz");
                        //$index = $start_index + $i;
                        $working_arrays[$what_we_are_doing]['lookups'][$field_name.$index] = $field_name_array;     
                       
                        break;
                    case "join_types":
                        break;
                    case "joinor_field_names":
                         break;
                    case "joins_r_o_array":
                       break;
                  case "joins_joinee_field_name_array":
                        break;
                    case "bypassed_joins_joinee_field_name_array":
                        break; 
                    } // end switch $field_name
               } //foreach entry in 'lookups' array
            }
        //$this->show_related_arrays("00110",$working_arrays,$what_we_are_doing,__LINE__);
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);


        return $working_arrays;
    }

    public function return_html_fieldnames_row($working_arrays,$what_we_are_doing){
        $crlf = $this->crlf;
        $strx = "<tr>". $crlf; 
        foreach ($working_arrays[$what_we_are_doing]['field_name_array'] as $key => $value) {
            $strx .= "<td style=\"text-align:center\">".$crlf.$value."</td>".$crlf;
        }
        $strx .= "</tr>".$crlf; 
        return $strx; 
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