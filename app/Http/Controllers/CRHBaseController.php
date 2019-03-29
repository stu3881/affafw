<?php

namespace App\Http\Controllers;

use App\Models\MiscThing;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema; 
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMiscThings;
//use Illuminate\Database\Schema\Builder as Schema;
use DB;
//use App\Http\Controllers\Schema;

class CRHBaseController extends DEHBaseController
{   
        public function __construct(
     
        /**/
        $working_arrays                 = array(),
        $buttons_in_front               = "",
        $print_orientation              = "",
        $record_type                    = "table_controller", 
        //$db_connection_name             = "blues_main", 
        $db_connection_name             = "", 
        $db_snippet_connection          = "",
        $db_data_connection             = "",
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
        //$model_table                    = '#beginModelTable#endModelTable',

        $no_of_blank_entries            = "5", 
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
        $table_names                         = array(),
        $active_controllers                 = array(),
        $view_variables_array               = array(),
        $parm2_array                        = array(),
        $array_of_parm2_array               = array(),
        $MyWorkingArray                     = array()
 

        )
        {
        
        parent::__construct();
        //$this->debug_exit(__FILE__,__LINE__,0); echo(" entering constructor");

        //$snippet_table = "miscThings";
        //$defaultConnection = "localhost_stu3881_main";
        //$queryx = $this->get_db_connection_data($snippet_table,$defaultConnection);

        //$this->beforeFilter('csrf', array('on'=>'post'));
        //$this->beforeFilter('admin');
        
        $this->MyWorkingArray = new  WorkingArray;

        $this->db_connection_name              = $db_connection_name;
        $this->db_data_connection              = $db_data_connection;
        $this->db_snippet_connection           = $db_snippet_connection;
        //$this->db_snippet_connection           = "";
       
        $this->model                            = $model;
        $this->model_table                      = $model_table;
        $this->snippet_model                    = $snippet_model;
        $this->snippet_node_name                = $snippet_node_name;
        $this->snippet_table                    = $snippet_table;
        $this->snippet_table_key_field_name     = $snippet_table_key_field_name;
        $this->node_name                        = $node_name ;
 
        $this->derive_entity_names_from_table($this->node_name); 

        $this->backup_node                      = $backup_node;
        $this->generated_files_folder           = $generated_files_folder;
        $this->key_field_name                   = $key_field_name;
        $this->bypassed_field_name              = $bypassed_field_name;     
        $this->no_of_blank_entries              = $no_of_blank_entries;

        //* *****
        //* PATHS
        //* ***** 
        $this->project_path             = substr(app_path(),0,strlen(app_path())-4);
        $this->controllers_path         = app_path()."/Http/Controllers";
        $this->routes_path              = app_path()."/Http";
        $this->storage_path             = $this->project_path."/storage";
        $this->views_files_path         = $this->project_path."/resources/views/";
        $this->views_files_path_only    = $this->views_files_path;

        // ****** 
        // config
        // ****** 
        $this->database_connection_config_path = $this->project_path."/config/";
        // **********
        // controllers
        // **********
        $node =  "controllers";

        $this->stored_connections_path      = $this->project_path.'/storage/connections/'. $this->db_connection_name ;
        $this->view_files_prefix                = $this->views_files_path;
 
        $this->my_ctr = $my_ctr;
        //routes

        // these are derived
 

        $this->key_field_array = array(
            $this->snippet_table_key_field_name=>$this->snippet_table_key_field_name);
        $this->key_field_name_array = array(
            $this->snippet_table_key_field_name=>$this->snippet_table_key_field_name);
        $this->make_sure_table_snippet_exists($this->model_table);
        //$this->debug_exit(__FILE__,__LINE__);
        $this->generated_snippets_array         = $this->get_generated_snippets();
        // generated_snippets are arrays that are generated when the properties


        // *********************************
        // 
        // THIS IS HOW WE CHANGE CONNECTIONS
        //
        // *********************************
        /*
        $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $project_path     = substr(app_path(),0,strlen(app_path())-4);
        $MiscThing = new MiscThing;
        $MiscThing->setConnection("homestead");
        //$MiscThing->setConnection("blues_main");
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $miscThings = $MiscThing
            ::where('record_type','=','table_controller')
            ->where('controller_name','='    ,"MiscThingsController")
            ->get();
        $this->db_snippet_connection            = $miscThings[0]->db_snippet_connection;
        $this->db_data_connection               = $miscThings[0]->db_data_connection;
      
        //$this->db_snippet_connection            = "homestead";
        //$this->db_data_connection               = "homestead";
 */
 
        // field_name_list_array d//return $an_array;
        //$this->MyWorkingArray->show_related_arrays("11000",$working_arrays,'configure_an_unconfigured_table',__LINE__);
    }


    public function generic_method_activate_entity($entity,$values_array,$msg_array,$link_parms_array,$parm2_array,$node_name) {

        //var_dump($entity);var_dump($values_array);var_dump($msg_array);var_dump($link_parms_array);
        //var_dump($node_name);        $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $project_path     = substr(app_path(),0,strlen(app_path())-4);
        $crlf = "\r\n";
        $crlftab = "\r\n\t";        
        $quote = "'";
       $search_str_array = array(
            'controller_name'   => "@@controller_name@@",
            'model_table'       => "@@model_table@@",
            'model'             => "@@model@@",
            'node_name'         => "@@node_name@@",
            'field_name_string' => "@@field_name_string@@"
            );


        $empty_msg_array['line']     = __LINE__; 
        $empty_msg_array['entity']   = $entity;
        $empty_msg_array['str1']     = "";
        $empty_msg_array['fileName'] = "";
        $empty_msg_array['str2']     = "";
        $empty_msg_array['filefName2']= "";


        $i0 = count($msg_array);
        $msg_array[$i0] = $empty_msg_array;
        $table_names = array('0' => $node_name);
        //$msg_array = array();
        //var_dump($link_parms_array);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);

        //var_dump($msg_array);//$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        echo('entity is: '.$entity);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);

         switch ($entity) { 
            case "model_report_definition":
                //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                if ($miscThing = MiscThing    
                    ::where('record_type',  '=', "report_definition")
                    ->where('report_name','like','%'.'report_definition_model'.'%')
                    ->where('node_name',  '=', $link_parms_array['node_name'])
                    ->get())
                {
                    if ($miscThing->count('items') > 0){
 
                        $msg_array[$i0]['str1'] = $entity . " is present";
                        $msg_array[$i0]['fileName'] = $link_parms_array['node_name'];

                       // $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                        }
                    else{
                       //***** if there aren't any, load the defaults
                        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                        //* *****
                        //$datafile  = DB::connection($this->db_data_connection)->table($link_parms_array['node_name'])
                        //    ->get();
                        //$arr0 =  $this->db_data_connection->getSchemaBuilder()->getColumnListing($link_parms_array['node_name']);
                        //$columns = DB::getSchemaBuilder()->getColumnListing($link_parms_array['node_name']);
                        $columns = Schema::getColumnListing($link_parms_array['node_name']);

                        $second_field = $columns[1];
                        //* *****
                        $report_definition  =  MiscThing
                        ::where('id','=',$this->report_definition_id )
                        ->get();
                        $arr1 = (array) $report_definition[0]['attributes'];
                        //var_dump($arr1);
                        unset($arr1['id']);
                        $encoded_query_field_name_array = "'[".$second_field .',"not_used","not_used","not_used","not_used"]';
                        //echo($second_field);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                      
                        //$arr1['modifiable_fields_array'] = '{$second_field :$second_field }';
                        $encoded_query_field_name_array = array(
                        $second_field, 'not_used', 'not_used', 'not_used', 'not_used');
                        $encoded_query_field_name_array   = json_encode($encoded_query_field_name_array);
                        $arr1['query_field_name_array'] = $encoded_query_field_name_array;

                        $arr1['query_r_o_array'] = array(">","=","=","=","=");
                        $arr1['query_r_o_array'] = json_encode($arr1['query_r_o_array']);

                        $arr1['query_value_array'] = array("","","","","");
                        $arr1['query_value_array'] = json_encode($arr1['query_value_array']);

                        $arr1['browse_select_array'] = array($second_field=>$second_field);
                        $arr1['browse_select_array'] = json_encode($arr1['browse_select_array']);


                        $business_rules_field_name_array = array(
                        'not_used', 'not_used', 'not_used', 'not_used', 'not_used');
                        $arr1['business_rules_field_name_array'] = json_encode($business_rules_field_name_array);
                      
                        $arr1['business_rules_r_o_array'] = array("=","=","=","=","=");
                        $arr1['business_rules_r_o_array'] = json_encode($arr1['business_rules_r_o_array']);

                        $arr1['business_rules_value_array'] = array("","","","","");
                        $arr1['business_rules_value_array'] = json_encode($arr1['business_rules_value_array']);
  
                         $arr1['modifiable_fields_array'] = 
                        array($second_field=>$second_field,
                            "not_used"=>"not_used",
                            "not_used"=>"not_used",
                            "not_used"=>"not_used",
                            "not_used"=>"not_used",
                            "not_used"=>"not_used");
                       $arr1['modifiable_fields_array'] = json_encode($arr1['modifiable_fields_array']);



                        $arr1['node_name'] = $link_parms_array['node_name'];
                        $arr1['table_name'] = $link_parms_array['node_name'];
                        //var_dump($arr1['id']);
                        //var_dump($arr1);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

                        //* *****
                        //* CREATE NEW REPORT DEFINITION
                        //* *****
                        MiscThing::create($arr1);

                        $new_id = $this->get_newest_record_type('report_definition');
                        $report_definition          = $this->execute_query_by_report_no($new_id) ;
                        $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                        //$encoded_business_rules     = $report_definition[0]->business_rules;

                        //$this->business_rules_array = (array) json_decode($report_definition[0]['business_rules']);

                        $working_arrays = $this->MyWorkingArray->working_arrays_initialize(
                            $report_definition[0],
                            'editing_a_data_record',
                            $this->bypassed_field_name,
                            $this->model_table );
                        //var_dump($working_arrays);$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
                        $use_generate_node = 1;
                        $from_info = $this->get_report_definition_id_info($use_generate_node,$link_parms_array);
                        $link_parms_array['report_id'] = $new_id;
                        //this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                        $this->clone_ids_to_node_name($from_info ,$use_generate_node,$link_parms_array);
                        //* *****

                         $msg_array[$i0]['str1'] = $entity." created  for ";
                         $msg_array[$i0]['fileName'] = $link_parms_array['node_name'];
                         }     
                     }

                     //var_dump($arr1['id']);var_dump($arr1);
                    //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
              break;

            case "table_controller":
                //* ********************************
                if ($miscThing = MiscThing    
                ::where('record_type',  '=', "table_controller")
                ->where('node_name',  '=', $link_parms_array['node_name'])
                ->get()){
                   //$this->debugx('0100',__FILE__,__LINE__,__FUNCTION__);
                    if ($miscThing->count('items') == 0){
                        //$this->debug0(__FILE__,__LINE__,__FUNCTION__);echo (' a_table_controller for '.$link_parms_array['node_name'].' is being created');
                        $insert_array = array(
                        'table_reporting_active'    =>1,
                        'record_type'               =>"table_controller",
                        'controller_name'           =>$link_parms_array['controller_name'],        
                        'model'                     =>$link_parms_array['model'],        
                        'model_table'               =>$link_parms_array['model_table'],        
                        'node_name'                 =>$link_parms_array['node_name'],
                        );        
                        $insert = MiscThing
                        ::insert(array($insert_array));
                        //$this->debugx('0100',__FILE__,__LINE__,__FUNCTION__);
                        $msg_array[$i0]['fileName'] = $link_parms_array['node_name'];
                        $msg_array[$i0]['str1']     = " has been created ";

                    }
                    //var_dump($miscThing->count('items'));

                    $updatex = MiscThing::where('record_type',  '=', "table_controller")
                    ->where('node_name',  '=', $link_parms_array['node_name'])
                    ->update(array('table_reporting_active'=>1));                 
                     //$this->debug1(__FILE__,__LINE__,__FUNCTION__);
                    $msg_array[$i0]['fileName'] = $link_parms_array['node_name'];
                    $msg_array[$i0]['str1']     = " has been activated ";

                }
                else{
                    $msg_array[$i0]['fileName'] = $link_parms_array['node_name'];
                    $msg_array[$i0]['str1']     = " is already present ";
                }


                break;
            case "table_controller_file":
                $controller_file = app_path()."/Http/Controllers/".  $link_parms_array['controller_name'].".php";

                if (is_file($controller_file)){
                    $msg_array[$i0]['fileName'] = $controller_file;
                    $msg_array[$i0]['str1']     = " is already present ";
                }
                else{
                    $controller_model_file = app_path()."/Http/Controllers/". "ModelForGeneratedControllers.php";
                    $file_as_string = file_get_contents($controller_model_file);
                    $tmp_array = $search_str_array;
                    unset($tmp_array['field_name_string']);
                    //echo ("<br><br><br>search_str_array");var_dump($tmp_array);var_dump($link_parms_array);
                    $file_as_string = $this->scan_replace_str_value_arrays($file_as_string,$tmp_array,$link_parms_array,'y');
                    File::put($controller_file, $file_as_string);
                    $msg_array[$i0]['fileName'] = $controller_file;
                    $msg_array[$i0]['str1']     = " has been created ";
               }
                break;

            case "model":
               $models_directory = app_path()."/Models/";
               $model_file_name = $models_directory. "generatedModelsModel.php";
               
               if (is_file($model_file_name)){
                    $file_as_string = file_get_contents($model_file_name);
                    //echo ("<br><br><br>file_as_string ");
                    //var_dump($file_as_string);$this->debug1(__FILE__,__LINE__,__FUNCTION__);
                }
                if (is_file($models_directory.$link_parms_array['model'].".php")){
                    $msg_array[$i0]['fileName'] = $models_directory.$link_parms_array['model'].".php";
                    $msg_array[$i0]['str1']     = " already exists ";
                }
                else{
                    //echo "<br>file does not exitst";$this->debug1(__FILE__,__LINE__,__FUNCTION__);
                    $columns = Schema::getColumnListing($link_parms_array['node_name']);
                    array_shift($columns); // always assume 1st element is key and drop it
                    $crlf = "\r\n";
                    $crlftab = "\r\n\t";
                    $quote = "'";
                    $field_name_str = $crlftab;
                    foreach ($columns as $index=>$field_name) {
                        $field_name_str .= $quote.$field_name.$quote.",".$crlftab  ;
                    } 

                     $tmp_array = $link_parms_array;
                    $link_parms_array['field_name_string']   = $field_name_str;
                    
                    //echo ("<br><br><br>file_as_string ".$file_as_string);
                    //echo ("<br><br><br>search_str_array");var_dump($search_str_array);var_dump($link_parms_array);
                    // field_name_string
                    $file_as_string = $this->scan_replace_str_value_arrays($file_as_string,$search_str_array,$link_parms_array,'y');
                    File::put($models_directory.$link_parms_array['model'].".php", $file_as_string);  
                    $msg_array[$i0]['fileName'] = $models_directory.$link_parms_array['model'].".php";
                    $msg_array[$i0]['str1']     = " has been created ";
              
                 }
                //echo ($models_directory.$link_parms_array['model'].".php");
                //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
 
                 break;
            case "routes":
                //* ****************************
                //* first, we need to create the routes (file) for the node
                //* ****************************
                //$this->debug3(__FILE__,__LINE__,__FUNCTION__);echo (" : ".$entity);exit();
                $routes_path = $project_path."/routes/";
                $routes_model_file = $routes_path. "GeneratedRoutesModel.php";
                 if (!is_file($routes_model_file)){
                     $this->debug0(__FILE__,__LINE__,__FUNCTION__);echo " required file MISSING ";echo ($routes_model_file.'<br>');exit();
                }
                $generated_file_name = $routes_path. "generated/".$link_parms_array['node_name'].".php";
                 if (is_file($generated_file_name)){
                    $msg_array[$i0]['fileName'] = $generated_file_name;
                    $msg_array[$i0]['str1']     = " is already present ";
                }
                else{
                    
                    $file_as_string = file_get_contents($routes_model_file);
                    $link_parms_array['field_name_string']   = "";
                    //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);echo (" creating routes file for ".$link_parms_array['node_name']);var_dump($link_parms_array);var_dump($values_array);
                    $file_as_string = $this->scan_replace_str_value_arrays($file_as_string,$values_array,$link_parms_array,'n');
                   //File::put($generated_file_name, $file_as_string);
                    $msg_array[$i0]['fileName'] = $generated_file_name;
                    $msg_array[$i0]['str1']     = " has been created ";
               }    
                break;
            case "routes_include":
                //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                //* ****************************
                //* first, we needed to create the routes (file)
 
                //* ****************************
                //* ****************************
                //* NOW, WEB.PHP HAS TO INCLUDE THAT FILE
                $routes_path = $project_path."/routes/";
                $generated_file_name = $routes_path. "generated/".$link_parms_array['node_name'].".php";
                $routes_web_file    = $project_path."/routes/web.php";
                $file_as_string     = file_get_contents($routes_web_file);
                
                $search_str_array   = array(
                    'start_of_generated_includes' => "//generated_inserts_begin_here" 
                 );
                $values_array = 
                array(
                    'start_of_generated_includes' => 
                    "//generated_inserts_begin_here".$crlftab."@include('".$generated_file_name.
                    "');"
                    );
                // make sure it hasnt already been included
                $i1 = stripos("*".$file_as_string,"@include('".$generated_file_name);
                if ($i1 > 0){
                    //$this->debugx('0100',__FILE__,__LINE__,__FUNCTION__);
                    //echo ("the include in web.php for ".$link_parms_array['node_name'].
                    //    " already exists ");
                     // ok but don't add twice
                    $msg_array[$i0]['fileName'] = $generated_file_name;
                    $msg_array[$i0]['str1']     = " already exists ";

                }
                else{
                    //var_dump($link_parms_array);var_dump($values_array);
                    //var_dump($search_str_array);var_dump($values_array);
                    $file_as_string  = 
                    $this->scan_replace_str_value_arrays($file_as_string,$search_str_array,$values_array,'y');
                    echo (' integrating '.$link_parms_array['node_name'].' into web.php');
                    File::put($routes_web_file, $file_as_string);
                    $msg_array[$i0]['fileName'] = $generated_file_name;
                    $msg_array[$i0]['str1']     = " added include to web.php ";

                }
               //echo " generated_file_name ";echo ($generated_file_name." ". $msg_array[$i0]['str1'] .'<br>');               $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

                break;

            case "views_node_directory":
                $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                $dir_name = $project_path."/resources/views/". $link_parms_array['node_name'];
               //* ***********************
                if (is_dir($dir_name)){
                    //echo($dir_name)  ;  $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                    $msg_array[$i0]['fileName'] = $dir_name;
                    $msg_array[$i0]['str1']     = " already exists ";
                }
                else{
                    //echo($dir_name)  ;  
                    
                    if (mkdir($dir_name)){
                        //echo($dir_name)  ;  $this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
                        //* *****
                        $use_generate_node = 0;
                        $from_info = $this->get_report_definition_id_info($use_generate_node,$link_parms_array);
                        //echo($this->views_files_path_only."*");
                        $from_node = $this->views_files_path_only.'generated_views_directory_model';
                        $to_node = $this->views_files_path_only. $link_parms_array['node_name'];
                        //var_dump($link_parms_array);var_dump($from_info);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                        
                       $this->clone_from_node_to_node($from_node,$to_node);
                        //* *****
                        $msg_array[$i0]['fileName'] = $dir_name;
                        $msg_array[$i0]['str1']     = " has been created ";
                       //echo($dir_name)  ;  $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
 
                    }
                    else{
                        $msg_array[$i0]['str1']     = " create failed for directory ";
                        $msg_array[$i0]['fileName'] = $dir_name;
                        $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                    }
                }
                break;
           case "views_node_gen_directory":
                $dir_name = 
                $project_path."/resources/views/". $link_parms_array['node_name']."/"."generated_files";
                echo($entity. "*".$dir_name)  ;  $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                if (is_dir($dir_name)){
                    $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                    $msg_array[$i0]['str1']     = " directory already exists ";
                    $msg_array[$i0]['fileName'] = $dir_name;
                }
                else{
                    //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                    if (mkdir($dir_name)){
                        $msg_array[$i0]['str1']     = " directory has been created ";
                        $msg_array[$i0]['fileName'] = $dir_name;
                        //echo($dir_name)  ;  $this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
                        //* *****
                        $use_generate_node = 1;
                        $from_info = $this->get_report_definition_id_info($use_generate_node,$link_parms_array);

                   }
                    else{
                        $msg_array[$i0]['str1']     = " create failed for directory ";
                        $msg_array[$i0]['fileName'] = $dir_name;
                        $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                    }
                   
                }
               break;

            } // end of entities switch  
          return $msg_array;
    }  


    public function generic_method_build_array_of_parm2_array($what_are_we_doing,$parm2_array,$table_names,$active_controllers,$view_variables_array,$no_of_fields){
           // ***************************
        //var_dump($parm2_array);
       
        //$this->debugx('0010',__FILE__,__LINE__,__FUNCTION__);
       $array_of_parm2_array = array();
        
       foreach($table_names as $table){
            //echo($what_are_we_doing);$this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);

            switch ($what_are_we_doing) {
                case "configure_an_unconfigured_table":
                    break;
                case "activate_deactivate_table_reporting":
                    if (
                    !in_array('activate',$parm2_array)&&
                    !in_array('de_activate',$parm2_array)&&
                    !in_array('delete_controller',$parm2_array)&&

                    !in_array('remove',$parm2_array)&&
                    !in_array('validate',$parm2_array)){

                        //$this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);
                        for ($i = 1; $i < $no_of_fields; $i++) {
                            $array_of_parm2_array[$table]['parm2_array'][$i]  = $parm2_array;
                            if (!in_array('node_name_follows',$array_of_parm2_array[$table]['parm2_array'][$i])){
                                $array_of_parm2_array[$table]['parm2_array'][$i][]  = 'node_name_follows';
                                $array_of_parm2_array[$table]['parm2_array'][$i][]  = $table;
                                }

                            $array_of_parm2_array[$table]['parm2_array'][$i][]= $view_variables_array[$table]['field'][$i];
 
                        }
                       for ($i = 1; $i < $no_of_fields; $i++) {
                            $array_of_parm2_array[$table]['parm2_array'][$i]    = json_encode($array_of_parm2_array[$table]['parm2_array'][$i]);
                        }
                    }

                    //$this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);
                    break;
                case "reports_with_broken_links":
                    if (in_array($table,$active_controllers)){
                        //echo("<br/>".$table);var_dump($view_variables_array);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

                        if ($no_of_fields > 1){

                            for ($i = 1; $i < $no_of_fields; $i++) {
                                $array_of_parm2_array[$table]['parm2_array'][$i]  = $parm2_array;
                                if (!in_array('node_name_follows',$array_of_parm2_array[$table]['parm2_array'][$i])){
                                    $array_of_parm2_array[$table]['parm2_array'][$i][]  = 'node_name_follows';
                                    $array_of_parm2_array[$table]['parm2_array'][$i][]  = $table;
                                    }

                                $array_of_parm2_array[$table]['parm2_array'][$i][]= $view_variables_array[$table]['field'][$i];
                            }
                            //print_r($array_of_parm2_array); $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                           for ($i = 1; $i < $no_of_fields; $i++) {
                                $array_of_parm2_array[$table]['parm2_array'][$i]    = json_encode($array_of_parm2_array[$table]['parm2_array'][$i]);
                            }
                        }
                    }
                    break;
            } // end switch
         } // end foreach $table

        //var_dump($array_of_parm2_array);//$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        return $array_of_parm2_array;
    }

    public function generic_method_add_link_field_names($parm2_array,$view_variables_array,$table,$no_of_fields) {
        var_dump($active_tables);
        for ($i = 1; $i < $no_of_fields; $i++) {
            $parm2_array[$table][]= $view_variables_array[$table]['field'][$i];
         }
         $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
         return $parm2_array;
    }

    public function generic_method_build_view_variables_array($table_names,$active_tables,$what_are_we_doing,$parm2_array,$no_of_fields) {
        // ***************************
        //var_dump($active_tables);var_dump($table_names);echo( " what_are_we_doing: ".$what_are_we_doing. " no_of_fields: ".$no_of_fields);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        // this builds the row that will be displayed
       $view_variables_array = array();
       foreach($table_names as $table){
             switch ($what_are_we_doing) {
                case "configure_an_unconfigured_table":
                   
                     if (!in_array($table,$active_tables)){
                        $view_variables_array[$table]['what_are_we_doing']  = $what_are_we_doing;
                        $view_variables_array[$table]['field'][0]       = $table;
                        $view_variables_array[$table]['class'][0]       = "text_align_left";
                        $view_variables_array[$table]['field'][1]       = 'configure';
                        $view_variables_array[$table]['class'][1]       = "text_align_left";
                    }
                    break;
                case "activate_deactivate_table_reporting":
                
                    if (
                    !in_array('activate',$parm2_array)&&
                    !in_array('de_activate',$parm2_array)&&
                    //!in_array('delete_controller',$parm2_array)&&
                    !in_array('remove',$parm2_array)&&
                    !in_array('validate',$parm2_array)){
                    //* *** first time thru 
                        $view_variables_array[$table]['what_are_we_doing']  = $what_are_we_doing;
                        if (!in_array($table,$active_tables)){
                            $view_variables_array[$table]['field'][]        = $table;
                            $view_variables_array[$table]['field'][]        = 'activate';
                            $view_variables_array[$table]['field'][]        = 'validate';
                            $view_variables_array[$table]['field'][]        = 'remove';

                            $view_variables_array[$table]['class'][]        = "text_align_left"; 
                            $view_variables_array[$table]['class'][]        = "text_align_left";
                            $view_variables_array[$table]['class'][]        = "text_align_left"; 
                            $view_variables_array[$table]['class'][]        = "text_align_left"; 
                       }
                        else {
                           $view_variables_array[$table]['field'][]        = $table;
                           $view_variables_array[$table]['field'][]        = 'de_activate';
                           $view_variables_array[$table]['field'][]        = 'validate';
                           $view_variables_array[$table]['field'][]        = 'remove';
                           //$view_variables_array[$table]['field'][]        = 'delete_controller';
                          
                           $view_variables_array[$table]['class'][]      = "text_align_left mycart-btn"; // dark blue            
                            $view_variables_array[$table]['class'][]      = "text_align_left mycart-btn"; // dark blue            
                            $view_variables_array[$table]['class'][]      = "text_align_left mycart-btn"; // dark blue            
                            $view_variables_array[$table]['class'][]      = "text_align_left mycart-btn"; // dark blue            
                            //$view_variables_array[$table]['class'][]      = "text_align_left mycart-btn"; // dark blue            
                           }
                        }
                    else{
                        //* *** second time thru
                        $required_entities = $this->generic_method_define_required_entities();
                        //$view_variables_array = $msg_array;
                        var_dump($parm2_array);
                        $table_names = array('0'=>$node_name);
                        $table_names = array($node_name=>$node_name);
                        $msg_array = array();
                        var_dump($link_parms_array);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);

                        foreach ($required_entities as $entity=>$entity_name) {
                            $msg_array = $this->generic_method_validate_entity($entity,$node_name,$msg_array,$search_str_array,$link_parms_array);
                        }

                        //var_dump($msg_array);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                        $view_variables_array = array();
                        for ($i=0; $i<=(count($table_names)); $i++){
                            $view_variables_array[$i]['field'][] = $msg_array[$i]['entity'];
                            $view_variables_array[$i]['field'][] = $msg_array[$i]['str1'];
                            $view_variables_array[$i]['field'][] = $msg_array[$i]['fileName'];
                            $view_variables_array[$i]['field'][] = $msg_array[$i]['str2'];
                        }
                        for ($i=0; $i<=(count($table_names)); $i++){
                            $view_variables_array[$i]['class'][]      = "text_align_left"; 
                            $view_variables_array[$i]['class'][]        = "text_align_left"; 
                            $view_variables_array[$i]['class'][]    = "text_align_left"; 
                            $view_variables_array[$i]['class'][]        = "text_align_left"; 
                         }
                    }
                   break;
                case "reports_with_broken_links":
                   
                    if (in_array($table,$active_tables)){
                        //* only an active table can have broken links
                        $view_variables_array[$table]['what_are_we_doing']  = $what_are_we_doing;
                        
                        $view_variables_array[$table]['field'][] = $table;
                        $view_variables_array[$table]['field'][] = 'cclist_broken_links';
                        $view_variables_array[$table]['field'][] = 'ccremove_broken_links';
                        for ($i = 0; $i < $no_of_fields; $i++) {
                            $view_variables_array[$table]['class'][]       = "text_align_left";
                        }
                    }
                   break;
            } // end switch
            

         } // for each table

        //var_dump($view_variables_array);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        return $view_variables_array;
    }


   public function generic_method_deactivate_entity($entity,$values_array,$msg_array,$link_parms_array,$parm2_array,$node_name) {

        //* *****
        // this one's strange in that we follow the same loop thru the entities table but,
        // the only one we're interested in is the table controller
        // var_dump($entity);var_dump($values_array);var_dump($msg_array);var_dump($link_parms_array);
        //var_dump($node_name);        $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $project_path     = substr(app_path(),0,strlen(app_path())-4);
        $crlf = "\r\n";
        $crlftab = "\r\n\t";
        $quote = "'";
        $i0 = count($msg_array);
 
         //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        switch ($entity) {
            case "routes_include":
                 break;
            case "table_controller_file":
                break;
            case "table_controller":
                 //$updatex = MiscThing::where('record_type',  '=', "table_controller")
                //->where('node_name',  '=', $link_parms_array['node_name'])
                //->update(array('table_reporting_active'=>0));  
                $updatex = MiscThing::where('record_type',  '=', "table_controller")
                ->where('node_name',  '=', $link_parms_array['node_name'])
                ->delete();  
                $msg_array[$i0]['line']   = __LINE__; 
                $msg_array[$i0]['entity']   = $entity;
                $msg_array[$i0]['fileName'] = $link_parms_array['node_name'];
                $msg_array[$i0]['str1']     = " has been de_activated ";

                break;
           case "model_report_definition":
                break;
            case "model":
                 break;
            case "routes":
                break;
            case "views":
                break;
        }   
        return $msg_array;

    }   



   public function generic_method_generate_entities($entity,$table) {   
       $link_parms_array = array(
        'controller_name'   => ucfirst($table).'Controller',
        'model_table'       => ucfirst($table),
        'model'             => ucfirst($table),
        'node_name'         => lcfirst($table),
        'field_name_string' => "" 

        );


        foreach ($link_parms_array as $entity=>$name) {
            switch ($entity) {
                case "controller_name":
                   break;
                case "model_table":
                   break;
                case "model":
                   break;
                case "node_name":
                   break;
            }
        }
                 $file_as_string = $this->anchor_boundaries_insert_replace(
                    $file_as_string,
                    $link_parms_array['model'],
                    "// Automatically adjuested strings begin here",
                    "#beginModel",
                    "#endModel"
                );

                $file_as_string = $this->anchor_boundaries_insert_replace(
                    $file_as_string,
                    $link_parms_array['model_table'],
                    "// Automatically adjuested strings begin here",
                    "#beginModelTable",
                    "#endModelTable"
                );
               $file_as_string = $this->anchor_boundaries_insert_replace(
                    $file_as_string,
                    $link_parms_array['node_name'],
                    "// Automatically adjuested strings begin here",
                    "#beginNodeName",
                    "#endNodeName"
                );



                $this->generic_method_generate_entities('table_controller',$table);
                $this->generic_method_generate_entities('model',$table);
                $this->generic_method_generate_entities('routes',$table);
                $this->generic_method_generate_entities('views',$table);
           
        $this->debug1(__FILE__,__LINE__,__FUNCTION__);
         switch ($entity) {
            case "table_controller":
               $this->insure_node_integrity('controller',$table);
               break;
           case "model_report_definition":
                // ?            
                break;
            case "model":
                $this->insure_node_integrity('model',$table);
                break;
            case "routes":
                $this->insure_node_integrity('routes',$table);
               break;
            case "views":
               
                $this->insure_node_integrity('views',$table);
               break;
        }
    }






    public function generic_method_get_active_tables() {
        // ********
        // ********
       $active_controllers = MiscThing
           ::where('record_type','=','table_controller')
           ->where('table_reporting_active','=',1)
           ->orderBy('node_name')
           ->get();   
        $active_tables = array();

        foreach ($active_controllers as $active_controller) {
            $active_tables[] = $active_controller->node_name;
        } 
        //var_dump($active_tables);$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
        return $active_tables;
    }
    public function generic_method_define_required_entities() {
  
        $required_entities = array(
            'routes'                        => 'routes',     
            'routes_include'                => 'routes_include',     
            'table_controller'              => 'table_controller',     
            'table_controller_file'         => 'table_controller_file',     
            'views_node_directory'          => 'views_node_directory',     
            'views_node_gen_directory'      => 'views_node_gen_directory',     
            'model_report_definition'       => 'model_report_definition',     
            'model'                         => 'model',     
            );

        return $required_entities;
    }


    public function generic_method_node_name_from_parm2_array($parm2_array) {
        
        //var_dump($parm2_array);
        $flip = array_flip($parm2_array);
        if ( array_key_exists ( 'node_name_follows' , $flip )){
            $i = $flip['node_name_follows']+1;
         //echo($flip['node_name_follows']);
        //var_dump($parm2_array[$i]);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);echo(" ".$entity);
        return $parm2_array[$i];
               }

       echo(" "."fatal error in "." xgxeneric_method_node_name_from_parm2_array ");
       //var_dump($parm2_array);//$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
       //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

    }   


    public function generic_method_remove_entity($entity,$node_name,$msg_array,$link_parms_array) {
        //echo(" entity  ".$entity ." node_name  ".$node_name );  var_dump($msg_array);var_dump($link_parms_array);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);echo(" ".$entity);
        $project_path     = substr(app_path(),0,strlen(app_path())-4);
        $crlf = "\r\n";
        $crlftab = "\r\n\t";
        $quote = "'";
        $i0 = 0;

        
        $empty_msg_array['line']     = __LINE__; 
        $empty_msg_array['entity']   = $entity;
        $empty_msg_array['str1']     = "";
        $empty_msg_array['fileName'] = "";
        $empty_msg_array['str2']     = "";
        $empty_msg_array['filefName2']= "";


        $i0 = count($msg_array);
        $msg_array[$i0] = $empty_msg_array;
        echo('entity: '.$entity);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        switch ($entity) {
 
           case "model_report_definition":
                if ($miscThing = MiscThing    
                    ::where('record_type',  '=', "report_definition")
                    ->where('report_name','like','%'.'report_definition_model'.'%')
                    ->where('node_name',  '=', $link_parms_array['node_name'])
                    ->get())
                {
                    if($miscThing->count('items')>0){
                        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                        if ($miscThing = MiscThing    
                            ::where('record_type',  '=', "report_definition")
                            ->where('report_name','like','%'.'report_definition_model'.'%')
                            ->where('node_name',  '=', $link_parms_array['node_name'])
                            ->delete())
                       {
                            $msg_array[$i0]['fileName'] = $link_parms_array['node_name'];
                            $msg_array[$i0]['str1']     = " has been deleted ";
                            //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                            }
                        else{
                            $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

                            }
                        }
                else{
                        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                        $msg_array[$i0]['str1'] = $entity." was not found";
                        $msg_array[$i0]['fileName'] = $link_parms_array['node_name'];
                        //$msg_array[$i0]['str2'] = 'table_controller record MISSING  '.$link_parms_array['node_name'];
                        }
                    }                
                 break;
            case "table_controller_file":
                $controller_file = app_path()."/Http/Controllers/".  $link_parms_array['controller_name'].".php";
                $msg_array[$i0]['fileName'] = $controller_file;
                if (is_file($controller_file)){
                    unlink($controller_file);
                    $msg_array[$i0]['str1']     = " has been deleted ";
                 }
                 else {
                    $msg_array[$i0]['str1']     = " does not exist ";
                 }
                 break;
          case "table_controller":
                //* ********************************
                if ($miscThing = MiscThing    
                ::where('record_type',  '=', "table_controller")
                ->where('node_name',  '=', $link_parms_array['node_name'])
                ->where('table_reporting_active',  '=', 1)
                ->get()){
                    //var_dump($link_parms_array);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                    $updatex = MiscThing::where('record_type',  '=', "table_controller")
                    ->where('node_name',  '=', $link_parms_array['node_name'])
                    ->delete();   

                    $msg_array[$i0]['fileName'] = $link_parms_array['node_name'];
                    $msg_array[$i0]['str1']     = " has been deleted ";
          //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);echo(" ".$entity);
               }
               else {
                    $msg_array[$i0]['fileName'] = $link_parms_array['node_name'];
                    $msg_array[$i0]['str1']     = " doesn't exist ";

               }

                 break;
             
            case "model":
               //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
               $models_directory = app_path()."/Models/";
               $model_file_name = $models_directory. "generatedModelsModel.php";
                $msg_array[$i0]['fileName'] = $models_directory.$link_parms_array['model'].".php";
               
                if (is_file($models_directory.$link_parms_array['model'].".php")){
                    unlink($models_directory.$link_parms_array['model'].".php");
                    $msg_array[$i0]['str1']     = " has been deleted ";
                }
                else{
                    $msg_array[$i0]['str1']     = " does not exist ";
                }
                 break;
                
            case "routes":
                //* ****************************
                //* first, we need to create the routes (file) for the node
                //* ****************************
                $routes_path = $project_path."/routes/";
                $generated_file_name = $routes_path. "generated/".$link_parms_array['node_name'].".php";
                if (is_file($generated_file_name)){
                    unlink($generated_file_name);
                    $msg_array[$i0]['str1']     = " file has been deleted ";
                    $msg_array[$i0]['fileName']     = $generated_file_name;
                   
               }
                else{
                    $msg_array[$i0]['str1']     = " file does not exist ";
                    $msg_array[$i0]['fileName']     = $generated_file_name;


                }
                // $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
               break;
            case "routes_include":
                 //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);echo(" ".$entity);

                $routes_path = $project_path."/routes/";
                $generated_file_name = $routes_path. "generated/".$link_parms_array['node_name'].".php";
                $routes_web_file    = $project_path."/routes/web.php";
                $file_as_string     = file_get_contents($routes_web_file);
                
                $i1 = stripos($file_as_string,"@include('".$generated_file_name);
                if ($i1 > 0){
                    $i2 = stripos(substr($file_as_string,$i1),";");
                    //$this->debugx('0100',__FILE__,__LINE__,__FUNCTION__);
                    //echo ("</br>".$i1."</br></br></br>".substr($file_as_string,0,$i1));
                    //echo ("</br>".$i2."</br></br></br>".substr($file_as_string,$i1+$i2+1));
                   
                    File::put($routes_web_file, substr($file_as_string,0,$i1).substr($file_as_string,$i1+$i2+1));
                    $msg_array[$i0]['str1']     = " has been deleted from ";
                     $msg_array[$i0]['fileName']     = $routes_web_file;
               }
                else{
                    $msg_array[$i0]['str1']     = " string does not exist in ";
                    $msg_array[$i0]['fileName']     = $routes_web_file;
               }

                break;
            case "views_node_directory":
               $dir_name = $project_path."/resources/views/". $link_parms_array['node_name'];
                if (is_dir($dir_name)){
                    $this->rrmdir($dir_name);
                    $msg_array[$i0]['str1']     = " directory has been deleted ";
                    $msg_array[$i0]['fileName']     = $dir_name;
                }
                else{
                    $msg_array[$i0]['fileName']     = $dir_name;
                   $msg_array[$i0]['str1']     = " directory does not exist ";
                }
                break;

            case "views_node_gen_directory":
                $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                $dir_name = $project_path."/resources/views/". $link_parms_array['node_name'].'/generated_files'; 
                if (is_dir($dir_name)){
                    //$this->debug3(__FILE__,__LINE__,__FUNCTION__);
                    //echo (' the generated_files directory is present .... '.$dir_name);
                    $msg_array[$i0]['line'] = __LINE__; 
                    $msg_array[$i0]['entity'] = $entity;
                    $msg_array[$i0]['str1'] = "the generated_files directory has been deleted";
                    $msg_array[$i0]['fileName'] = $dir_name;
                }
                else{
                    //$this->debug3(__FILE__,__LINE__,__FUNCTION__);
                    //echo (' the generated_files directory is MISSING ....'.$dir_name);
                    $this->rrmdir($dir_name);

                    $msg_array[$i0]['line'] = __LINE__; 
                    $msg_array[$i0]['entity'] = $entity;
                    $msg_array[$i0]['str1'] = "the generated_files directory is MISSING";
                    $msg_array[$i0]['fileName'] = $dir_name;

                }                 
            } // end of entities switch  
            return $msg_array;
    } 


    public function generic_method_request_2parms(REQUEST $request,$parm1,$parm2) {
        // ********
        //var_dump($request);
        // *******
        $parm2_array = json_decode($parm2);
        //var_dump($parm1);var_dump($parm2_array);$this->debugx('1101',__FILE__,__LINE__,__FUNCTION__);
        $node_name = $this->generic_method_node_name_from_parm2_array($parm2_array);
        $this->link_parms_array = $this->derive_entity_names_from_table($node_name);
        //var_dump($this->link_parms_array);var_dump($node_name);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        $what_are_we_doing = $parm1;  

        $search_str_array = array(
            'controller_name'   => "@@controller_name@@",
            'model_table'       => "@@model_table@@",
            'model'             => "@@model@@",
            'node_name'         => "@@node_name@@",
            'field_name_string' => "@@field_name_string@@"
            );
        /*$values_array = 
            array(
            'controller_name'   => $link_parms_array['controller_name'],
            'model_table'       => $link_parms_array['model_table'],
            'model'             => $link_parms_array['model'],
            'node_name'         => $link_parms_array['node_name'],
            'field_name_string' => ""
            );
            */
       

        if (!in_array('we_have_done_first_read',$parm2_array))//||(in_array('coming_from_programmer_utilities',$parm2_array)))
        {
            $parm2_array[] = 'we_have_done_first_read';
           
            $table_names = $this->MyWorkingArray->generic_method_get_table_names();
            $this->active_controllers = $this->generic_method_get_active_tables();
            $this->no_of_fields = 3;
            $view_variables_array = $this->generic_method_build_view_variables_array($table_names,$this->active_controllers,$parm1,$parm2_array,$this->no_of_fields);
            //var_dump($parm2_array);$this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);

            $array_of_parm2_array = $this->generic_method_build_array_of_parm2_array($parm1,$parm2_array,$table_names,$this->active_controllers,$view_variables_array,$this->no_of_fields);   
            //var_dump($parm2_array);$this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);
             }
        else { 
            //var_dump($parm2_array);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
            }
        switch ($parm1) {
            case "configure_an_unconfigured_table":
                break;
            case "activate_deactivate_table_reporting":
                if (!in_array('activate'            ,$parm2_array)&&
                    !in_array('de_activate'         ,$parm2_array)&&
                    !in_array('delete_controller'   ,$parm2_array)&&
                    !in_array('remove'              ,$parm2_array)&&
                    !in_array('validate'            ,$parm2_array))
                {
                    $process_fields_as  = 'links';
                    $this->no_of_fields = 4;
                    //$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
                    $view_variables_array = $this->generic_method_build_view_variables_array($table_names,$this->active_controllers,$parm1,$parm2_array,$this->no_of_fields);
                    //var_dump($parm2_array);$this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);
                    $array_of_parm2_array = $this->generic_method_build_array_of_parm2_array($parm1,$parm2_array,$table_names,$this->active_controllers,$view_variables_array,$this->no_of_fields);   
                   //var_dump($array_of_parm2_array);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                   //var_dump($this->active_controllers);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                   //var_dump($view_variables_array);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                 
                }
                else{
                    if (in_array('activate',$parm2_array)){$choice2     = 'activate';}
                    if (in_array('de_activate',$parm2_array)){$choice2  = 'de_activate';}
                    if (in_array('delete_controller',$parm2_array)){$choice2  
                                                                        = 'delete_controller';}
                    if (in_array('remove',$parm2_array)){$choice2       = 'remove';}
                    if (in_array('validate',$parm2_array)){$choice2     = 'validate';}
                    //
                    //$node_name = $this->generic_method_node_name_from_parm2_array($parm2_array);
//$this->link_parms_array = $this->derive_entity_names_from_table($node_name);

                    //var_dump($this->link_parms_array);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                    switch ($choice2) { 
                        case "activate":
                            $array_of_parm2_array = array();
                            $this->no_of_fields = 4;
                            $process_fields_as = 'fields';

                            //$table_names = array('0'=>$node_name);
                            $node_name = $this->generic_method_node_name_from_parm2_array($parm2_array);

                            // link_pams_array is the counterpart of search_str_arrays 
                            //var_dump($node_name);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);  

                            //$active_controllers = $table_names;
                            //* ****
                            $required_entities = $this->generic_method_define_required_entities();
                            $msgs_array = array();
                            foreach ($required_entities as $entity=>$entity_name) {
                                //echo("<br/>".$entity);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                                $msgs_array = $this->generic_method_activate_entity($entity,$search_str_array,$msgs_array,$this->link_parms_array,$parm2_array,$node_name);
                              }
                            $fields = array("entity","str1","fileName","str2");

                              $view_variables_array = array();
                              $i = -1;
                            foreach ($required_entities as $entity=>$entity_name) {
                                $i++;
                                foreach ($fields as $index=>$name) {
                                    $view_variables_array[$i]['field'][] = $msgs_array[$i][$name];
                                     $view_variables_array[$i]['class'][] = 'text_align_left';
                                  }
                            }
                             //echo ("choice 2 ");var_dump($msgs_array);

                            break;
                        case "de_activate":
                            $array_of_parm2_array = array();
                           $process_fields_as = 'fields';
                            $this->no_of_fields = 4;

                            $node_name = $this->generic_method_node_name_from_parm2_array($parm2_array);

                            $table_names = array('0'=>$node_name);
                            $table_names = array($node_name=>$node_name);
                            $active_controllers = $table_names;
                            //var_dump($node_name);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);  

                            
                            //* ****
                            $required_entities = $this->generic_method_define_required_entities();
                            $msgs_array = array();
                            foreach ($required_entities as $entity=>$entity_name) {
                                //echo("<br/>".$entity);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                                $msgs_array = $this->generic_method_deactivate_entity($entity,$search_str_array,$msgs_array,$this->link_parms_array,$parm2_array,$node_name);
                              }
                            var_dump($msgs_array);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);  
                       
                            $fields = array("entity","str1","fileName","line");

                              $view_variables_array = array();
                              $i = 0;
                                foreach ($fields as $index=>$name) {
                                    $view_variables_array[$i]['field'][] = $msgs_array[$i][$name];
                                     $view_variables_array[$i]['class'][] = 'text_align_left';
                                  }
 
                            break;
 
                         case "delete_controller":
                            $array_of_parm2_array = array();
                           $process_fields_as = 'fields';
                            $i0 = count($msg_array);

                            $this->no_of_fields = 4;
                            $table_names = array('0'=>$node_name);
                            $table_names = array($node_name=>$node_name);
                            $active_controllers = $table_names;
                            $link_parms_array = $this->$link_parms_array;
                            //var_dump($node_name);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);  

                            if ($miscThing = MiscThing    
                            ::where('record_type',  '=', "table_controller")
                            ->where('node_name',  '=', $link_parms_array['node_name'])
                            ->delete()){
                            $msg_array[$i0]['line']     = __LINE__; 
                            $msg_array[$i0]['entity']   = $entity;
                            $msg_array[$i0]['fileName'] = $link_parms_array['node_name'];
                            $msg_array[$i0]['str1']     = " has been deleted ";
                        }
                            var_dump($msgs_array);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);  
                            //* *****
                            $fields = array("entity","str1","fileName","line");
                            $view_variables_array = array();
                            $i = 0;
                            foreach ($fields as $index=>$name) {
                                $view_variables_array[$i]['field'][] = $msgs_array[$i][$name];
                                 $view_variables_array[$i]['class'][] = 'text_align_left';
                              }

                            break;

                        case "validate":
                            $array_of_parm2_array = array();
                            $this->no_of_fields = 4;
                            $process_fields_as = 'fields';
                            var_dump($parm2_array);
                            $node_name = $this->generic_method_node_name_from_parm2_array($parm2_array);
//$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);  
                            $table_names = array('0'=>$node_name);
                            $link_parms_array = $this->link_parms_array;
                            //var_dump($link_parms_array);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);  

                            $active_controllers = $table_names;
                            //* ****
                            $required_entities = $this->generic_method_define_required_entities();
                            $msgs_array = array();
                            foreach ($required_entities as $entity=>$entity_name) {
                                $msgs_array = $this->generic_method_validate_entity($entity,$node_name,$msgs_array,$search_str_array,$link_parms_array);
                              }
                              $fields = array("entity","str1",'fileName',"str2");
                              $view_variables_array = array();
                              $i = -1;
                            foreach ($required_entities as $entity=>$entity_name) {
                                $i++;
                                foreach ($fields as $index=>$name) {
                                    $view_variables_array[$i]['field'][] = $msgs_array[$i][$name];
                                     $view_variables_array[$i]['class'][] = 'text_align_left';
                                  }
                            }

                            //var_dump($view_variables_array);var_dump($msgs_array);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);  

                              break;
                        case "remove":
                            $array_of_parm2_array = array();
                            $this->no_of_fields = 4;
                            $process_fields_as = 'fields';
                            //var_dump($parm2_array);
                            $node_name = $this->generic_method_node_name_from_parm2_array($parm2_array);

                            $table_names = array('0'=>$node_name);
                            $link_parms_array = $this->link_parms_array;  
                            //var_dump($link_parms_array);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);  

                            $active_controllers = $table_names;
                            //* ****
                            $required_entities = $this->generic_method_define_required_entities();
                            $msgs_array = array();
                            foreach ($required_entities as $entity=>$entity_name) {
                                $msgs_array = $this->generic_method_remove_entity($entity,$node_name,$msgs_array,$link_parms_array);
                              }

                            $fields = array("entity","str1",'fileName',"str2");
                            $view_variables_array = array();
                            $i = -1;
                            foreach ($required_entities as $entity=>$entity_name) {
                                $i++;
                                foreach ($fields as $index=>$name) {
                                    $view_variables_array[$i]['field'][] = $msgs_array[$i][$name];
                                     $view_variables_array[$i]['class'][] = 'text_align_left';
                                }
                            }


                           //var_dump($view_variables_array);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                            break;
                        } //* end choice2 switch
                        
                    } //* is is 'activate'; 'de_activate', 'remove' or validate }


                break;
            case "reports_with_broken_links":
            //* from activate_de...
            //* from activate_de...
                //var_dump($parm2_array);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                if (!in_array('cclist_broken_links'            ,$parm2_array)&&
                    !in_array('ccremove_broken_links'            ,$parm2_array)
                    )
                {
                    $process_fields_as  = 'links';
                    $this->no_of_fields = 3;
                    //$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
                    $view_variables_array = $this->generic_method_build_view_variables_array($table_names,$this->active_controllers,$parm1,$parm2_array,$this->no_of_fields);
                    //var_dump($parm2_array);$this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);
                    $array_of_parm2_array = $this->generic_method_build_array_of_parm2_array($parm1,$parm2_array,$table_names,$this->active_controllers,$view_variables_array,$this->no_of_fields);   
                   //var_dump($array_of_parm2_array);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                   //var_dump($this->active_controllers);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                    //var_dump($view_variables_array);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                 
                }
                else{ //* the second time thru


                    if (in_array('cclist_broken_links',$parm2_array)){
                        $this->no_of_fields = 2;
                        $process_fields_as = 'fields';
                        $array_of_parm2_array = array();
                        $update_option = "list_broken_links";
                        $node_name = $this->generic_method_node_name_from_parm2_array($parm2_array);
                        $table_names = array($node_name =>$node_name);
                       
                        //$broken_link_files = $this->
                        $view_variables_array = $this->clean_orphan_files($node_name,$update_option);  //2parms
                        //$array_of_parm2_array = $this->generic_method_build_array_of_parm2_array($parm1,$parm2_array,$table_names,$table_names,$view_variables_array,$this->no_of_fields);   

                       //var_dump($view_variables_array);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                        //var_dump($array_of_parm2_array);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

                    }
                    if (in_array('ccremove_broken_links',$parm2_array)){
                        $this->no_of_fields = 1;
                        $process_fields_as = 'fields';
/*                        $view_variables_array = array();

                    $view_variables_array = $this->generic_method_build_view_variables_array($table_names,$this->active_controllers,$parm1,$parm2_array,$this->no_of_fields);
                    //var_dump($parm2_array);$this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);
                    $array_of_parm2_array = $this->generic_method_build_array_of_parm2_array($parm1,$parm2_array,$table_names,$this->active_controllers,$view_variables_array,$this->no_of_fields);   

*/
                        $node_name = $this->generic_method_node_name_from_parm2_array($parm2_array);
                        $update_option = "remove_broken_links";
                        $view_variables_array = $this->clean_orphan_files($node_name,$update_option);  //2parms
                    }
                //var_dump($what_are_we_doing);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
               // $array_of_parm2_array = $this->generic_method_build_array_of_parm2_array($parm1,$parm2_array,$table_names,$this->active_controllers,$view_variables_array,$this->no_of_fields);
               }

                break;
            } // end parm1 switch
        //var_dump($what_are_we_doing);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $required_variables_array = array(
            //'parm2'             => json_encode($decoded_variables_array),
            'node_name'         => $this->node_name,     
            'myStrings'         => $this->myStrings
            );
        //var_dump($view_variables_array);
        //var_dump($parm2_array);
        //$this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);echo(" right before menu0 ");
        if (!isset($array_of_parm2_array)){
            $array_of_parm2_array = array();
        }


            return view($this->node_name.'.dynamicMenu0')
            //* loop thru the view_variables_array
                // VARIABLES WE'RE PASSING TO A VIEW
                ->with('process_fields_as'          ,$process_fields_as)
                ->with('view_variables_array'       ,$view_variables_array)
                ->with('no_of_fields'               ,$this->no_of_fields)
                ->with('array_of_parm2_array'       ,$array_of_parm2_array)
                ->with('report_definition_key'      ,$this->report_definition_id)
                ->with('parm1'                      ,$parm1)
                ->with('what_we_are_doing'          ,$parm1)
                
                ->with('parm2_array'                ,json_encode($parm2_array))
                ->with('required_variables'         ,$required_variables_array);
            }
        



    public function generic_method_validate_entity($entity,$name,$msg_array,$search_str_array,$link_parms_array) {
        //var_dump($link_parms_array);
        //$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);echo(" ".$entity);

        //$this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);echo(" ".$entity);
        $project_path     = substr(app_path(),0,strlen(app_path())-4);
        $crlf = "\r\n";
        $crlftab = "\r\n\t";
       
        $quote = "'";
        
 

        //$search_str_array and $link_parms_array MUST match indexes one for one  
        $controller_file = app_path()."/Http/Controllers/".  $link_parms_array['controller_name'].".php";
        $i0 = count($msg_array);
        $msg_array[$i0]['line']     = __LINE__; 
        $msg_array[$i0]['entity']   = $entity;
        $msg_array[$i0]['str1']     = "";
        $msg_array[$i0]['fileName'] = "";
        $msg_array[$i0]['str2']     = "";
        $msg_array[$i0]['fileName2']= "";

 
        switch ($entity) {

            case "model_report_definition":
                //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                if ($miscThing = MiscThing    
                    ::where('record_type',  '=', "report_definition")
                    ->where('report_name','like','%'.'report_definition_model'.'%')
                    ->where('node_name',  '=', $link_parms_array['node_name'])
                    ->get())
                {
                    if($miscThing->count('items')>0){
                        $msg_array[$i0]['str1'] = $entity ." is present for ";
                        $msg_array[$i0]['fileName'] = $link_parms_array['node_name'];
                        }
                    }
               else{
                    $msg_array[$i0]['str1'] = $entity ." is not present for ";
                    $msg_array[$i0]['fileName'] = $link_parms_array['node_name'];
                 }
                              
                break;
            case "table_controller_file":
                //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                $controller_file = app_path()."/Http/Controllers/".  $link_parms_array['controller_name'].".php";
                if (is_file($controller_file)){
                    $msg_array[$i0]['fileName'] = $controller_file;
                    $msg_array[$i0]['str1']     = " is present ";
               }
                else{
                    //echo ($entity . " is MISSING ....".$controller_file);
                    $msg_array[$i0]['fileName'] = $controller_file;
                    $msg_array[$i0]['str1']     = " is MISSING ";
                 }
                 break;

            case "table_controller":

                //$i0++;
                $msg_array[$i0]['line']     = __LINE__; 
                $msg_array[$i0]['entity']   = $entity;
                $msg_array[$i0]['str1']     = "";
                $msg_array[$i0]['fileName'] = "";
                $msg_array[$i0]['str2']     = "";
                $msg_array[$i0]['fileName2']= "";

                if ($miscThing = MiscThing    
                    ::where('record_type',  '=', "table_controller")
                    ->where('node_name',  '=', $link_parms_array['node_name'])
                    ->get()){
                        if ($miscThing->count('items') == 0){
                            //$this->debug3(__FILE__,__LINE__,__FUNCTION__);
                            //echo ('table_controller record MISSING .... '.$link_parms_array['node_name']);
                             $msg_array[$i0]['str1'] = "is MISSING from the database";
                            $msg_array[$i0]['fileName'] = $controller_file;
                            //$msg_array[$i0]['str2'] = 'table_controller record MISSING  '.$link_parms_array['node_name'];
                            }
                       else{
                            $msg_array[$i0]['str1'] = "database record is present";
                            $msg_array[$i0]['fileName'] = $link_parms_array['node_name'];
                            //$msg_array[$i0]['str2'] = $link_parms_array['node_name'];
                            //$msg_array[$i0]['fileName2'] = "";
                        }
                    }               
                 break;
            case "model":
                $models_directory = app_path()."/Models/";
                $model_file_name = $models_directory. "generatedModelsModel.php";    
                //var_dump($link_parms_array);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                if (is_file($models_directory.$link_parms_array['model'].".php")){
                    $msg_array[$i0]['line'] = __LINE__; 
                    $msg_array[$i0]['entity'] = $entity;
                    $msg_array[$i0]['str1'] = " is present";
                    $msg_array[$i0]['fileName'] = $models_directory.$link_parms_array['model'].".php";
                    
                    $msg_array[$i0]['str2'] = "";
                    $msg_array[$i0]['fileName2'] = "";
                }
                else{
                    $msg_array[$i0]['line'] = __LINE__; 
                    $msg_array[$i0]['entity'] = $entity;
                    $msg_array[$i0]['str1'] = " is missing";
                    $msg_array[$i0]['fileName'] = $models_directory.$link_parms_array['model'].".php";
                    $msg_array[$i0]['str2'] = "";
                    
                    $msg_array[$i0]['fileName2'] = "";
                }
                break;
            case "routes":
                $routes_path = $project_path."/routes/";
                $routes_model_file = $routes_path. "GeneratedRoutesModel.php";
                $generated_file_name = $routes_path."generated/". $link_parms_array['node_name'].".php";
                if (!is_file($routes_model_file)){
                    $this->debug3(__FILE__,__LINE__,__FUNCTION__); //just line-no
                    //echo "<br>"." required file MISSING ....";echo ($routes_model_file.'<br>');
                }
                if (is_file($generated_file_name)){
                    //$this->debug3(__FILE__,__LINE__,__FUNCTION__); //just line-no
                    //echo ($entity . " is present".$generated_file_name);                
                    $msg_array[$i0]['line'] = __LINE__; 
                    $msg_array[$i0]['entity'] = $entity;
                    $msg_array[$i0]['str1'] = " is present";
                    $msg_array[$i0]['fileName'] = $generated_file_name;
                    
                    $msg_array[$i0]['str2'] = "";
                    $msg_array[$i0]['fileName2'] = "";
                }
                else{
                    //echo (" ". $entity . " is MISSING ".".....".$generated_file_name);     
                    $msg_array[$i0]['line'] =  __LINE__; 
                    $msg_array[$i0]['entity'] = $entity;
                    $msg_array[$i0]['str1'] = " is missing";
                    $msg_array[$i0]['fileName'] = $generated_file_name;
                    
                    $msg_array[$i0]['str2'] = "";
                    $msg_array[$i0]['fileName2'] = "";
                }
                //* ****************************
                //* first, we need to create the routes (file)
                //File::put($generated_file_name, $file_as_string);
                //* ****************************
                //* ****************************
                break;
            case "routes_include":
                //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                //* NOW, WEB.PHP HAS TO INCLUDE THAT FILE
                $routes_path = $project_path."/routes/";
                $routes_model_file = $routes_path. "GeneratedRoutesModel.php";
                $generated_file_name = $routes_path."generated/". $link_parms_array['node_name'].".php";
                //$i0++;
                $msg_array[$i0]['line']     = "";
                $msg_array[$i0]['entity']   = "";
                $msg_array[$i0]['str1']     = "";
                $msg_array[$i0]['fileName'] = "";
                $msg_array[$i0]['str2']     = "";
                $msg_array[$i0]['fileName2']= "";

                $values_array = 
                array(
                    'start_of_generated_includes' => 
                    "//generated_inserts_begin_here".$crlftab."@include('".$generated_file_name.
                    "');"
                    );
                $routes_web_file    = $project_path."/routes/web.php";
                $file_as_string     = file_get_contents($routes_web_file);
                
                $search_str_array   = array(
                    'start_of_generated_includes' => "//generated_inserts_begin_here" 
                 );
                // make sure it hasnt already been included
                $i1 = stripos("*".$file_as_string,"@include('".$generated_file_name);
                if ($i1 > 0){
                    //$this->debug3(__FILE__,__LINE__,__FUNCTION__);
                    //echo (" ...."."@include('".$generated_file_name);
                    $msg_array[$i0]['line'] = __LINE__; 
                    $msg_array[$i0]['entity'] = $entity;
                    $msg_array[$i0]['str1'] = "include is present in web.php for";
                    $msg_array[$i0]['fileName'] = $routes_path."generated/".
                    $link_parms_array['node_name'].".php";
                    //$msg_array[$i0]['fileName2'] = $link_parms_array['node_name'].".php";
                }
                else{
                    //$this->debug3(__FILE__,__LINE__,__FUNCTION__);
                    //echo ("include is MISSING .... in web.php for ".$link_parms_array['node_name'].
                    //" @include('".$generated_file_name); 
                    $msg_array[$i0]['line'] = __LINE__; 
                    $msg_array[$i0]['entity'] = $entity;
                    $msg_array[$i0]['str1'] = "include is MISSING in web.php";
                    $msg_array[$i0]['fileName'] = $routes_path."generated/".
                    $link_parms_array['node_name'].".php";
                   //$this->debug1(__FILE__,__LINE__,__FUNCTION__);echo (' integrating '.$link_parms_array['node_name'].' into web.php');
                    //File::put($routes_web_file, $file_as_string);
                }  
 
                break;
                
            case "views_node_directory":
                $dir_name = $project_path."/resources/views/". $link_parms_array['node_name'];
                //echo("<br> * dir_name: ".$dir_name);
                if (is_dir($dir_name)){
                    //$this->debug3(__FILE__,__LINE__,__FUNCTION__);
                    //echo ('the views directory is present ....'.$dir_name);
                     $msg_array[$i0]['line'] = __LINE__; 
                    $msg_array[$i0]['entity'] = $entity;
                    $msg_array[$i0]['str1'] = "the views directory is present";
                    $msg_array[$i0]['fileName'] = $project_path."/resources/views/".$link_parms_array['node_name'];
     
               }
                else{
                    //$this->debug3(__FILE__,__LINE__,__FUNCTION__); //just line-no
                    //echo ('the views directory '.'is MISSING ....'.$dir_name);
                    $msg_array[$i0]['line'] = __LINE__; 
                    $msg_array[$i0]['entity'] = $entity;
                    $msg_array[$i0]['str1'] = "the views directory '.'is MISSING";
                    $msg_array[$i0]['fileName'] = $project_path."/resources/views/".$link_parms_array['node_name'];
    
                }  
               break;
                
            case "views_node_gen_directory":

                $dir_name = $project_path."/resources/views/". $link_parms_array['node_name'].'/generated_files'; 
                if (is_dir($dir_name)){
                    //$this->debug3(__FILE__,__LINE__,__FUNCTION__);
                    //echo (' the generated_files directory is present .... '.$dir_name);
                    $msg_array[$i0]['line'] = __LINE__; 
                    $msg_array[$i0]['entity'] = $entity;
                    $msg_array[$i0]['str1'] = "the generated_files directory is present";
                    $msg_array[$i0]['fileName'] = $project_path."/resources/views/".
                    $link_parms_array['node_name'].'/generated_files'; 
                    $msg_array[$i0]['fileName2'] = "";
     
                }
                else{
                    //$this->debug3(__FILE__,__LINE__,__FUNCTION__);
                    //echo (' the generated_files directory is MISSING ....'.$dir_name);
                    $msg_array[$i0]['line'] = __LINE__; 
                    $msg_array[$i0]['entity'] = $entity;
                    $msg_array[$i0]['str1'] = "the generated_files directory is MISSING";
                    $msg_array[$i0]['fileName'] = $dir_name;

                }                 
                break;
            }   

      
            return $msg_array;
       
     }




    
        public function array_node_to_array($array) {
        // *****************
        // this converts encoded_strings to arrays
        // ****************

            //$array['ppv_define_query']['lookups']['field_names']                      = '';
            //$array['ppv_define_query']['lookups']['relational_operators']             = '';
            $array['ppv_define_query']['lookups']['columns_w_bypass']                 = '';
            $array['ppv_define_query']['lookups']['query_relational_operators_array'] = '';
        foreach ($array as $field) {
            if (is_null($field))    {
                $array[$field] =  array();
            }
        }
        return $array;
    }


   public function derive_entity_names_from_table($table) {       
        //echo ('table: '.$table);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $link_parms_array = array(
            'controller_name'   => ucfirst($table).'Controller',
            'model_table'       => $table,
            'model'             => ucfirst($table),
            'node_name'         => lcfirst($table)
            );
         if (substr($link_parms_array['model'],strlen($table)-1,1) == 's') {
            $link_parms_array['model'] = substr($link_parms_array['model'],0,strlen($table)-1);
        }
        //var_dump($link_parms_array);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        return $link_parms_array;
   }



     /**
     * Execute the query and show the report you just requested
     *
     * @return \Illuminate\Http\Response
     */

    public function execute_report_def_query($report_definition) {
        echo("execute_report_def_query<br>");
        //$this->debug_exit(__FILE__,__LINE__,10);
        //var_dump($report_definition);
        $errors = array();
        $message = "";
        $what_we_are_doing = "edit2_build_default_browse";
        if ($report_definition){
            $working_arrays     = $this->MyWorkingArray->working_arrays_initialize($report_definition,$what_we_are_doing,$this->bypassed_field_name,$this->model_table );

            //var_dump($report_definition[0]);
            if (is_null($report_definition[0]->browse_select_array) ){
                $errors['browse error1'] = 'must define browse-fields first (use key-edit button)';
                $message = $errors['browse error1'] ."<br>";
            }
            if (is_null($report_definition[0]->query_field_name_array) ){
                $errors['browse error2'] = 'must define query first (use key-edit button)';
                $message .= $errors['browse error2'];
            }
            if (count($errors)> 0){
                //exit('exit 2469');
                $field_name_array = array();
                $generated_snippets_array = array();
                //return View::to($this->node_name . "/edit1")
                $this->debug_exit(__FILE__,__LINE__,1); 
                return redirect('admin/'.$this->node_name.'/edit1')
                    ->with('snippet_table'                  , $this->snippet_table)
                    ->with('model_table'                    , $this->model_table)
                    ->with('node_name'                      , $this->node_name)
                    ->with('generated_files_folder'         , $this->generated_files_folder)
                    ->with('field_name_array'               , $field_name_array)
                    ->with('snippet_table_key_field_name'   , $this->snippet_table_key_field_name)
                    ->with('message'                        , $message)
                    ->withErrors($errors);
            }
            else {
                $arr = array();
                foreach($working_arrays['ppv_define_query']['field_name_array'] as $name=>$array_name){
                    $arr[] = $working_arrays['ppv_define_query'][$array_name]; 
                }      
                $arr = $working_arrays['ppv_define_query']['field_name_array']['r_o'];
                var_dump($arr); $this->debug_exit(__FILE__,__LINE__,1);   
                //$query_relational_operators_array = $this->build_query_relational_operators_array();
                
            }
        } // end of if report_definition


    }





     /**
     * Execute the query and show the report you just requested
     *
     * @return \Illuminate\Http\Response
     */

    public function browseEdit(Request $request, $id, $what_we_are_doing, $coming_from){
        //var_dump($id);  
        $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        $report_definition          = $this->execute_query_by_report_no($id) ;
        $encoded_business_rules     = $report_definition[0]->business_rules;
        $working_arrays             = $this->MyWorkingArray->working_arrays_initialize($report_definition[0],$what_we_are_doing,$this->bypassed_field_name,$this->model_table);
        //var_dump($report_definition[0]);  $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

        $query_relational_operators_array = $this->build_query_relational_operators_array();
        $what_we_are_doing = 'edit1';
        if(!$miscThings = $this->build_and_execute_query($working_arrays,$this->bypassed_field_name,$query_relational_operators_array,$what_we_are_doing)) {
            echo("<BR>"."query failed");$this->debug_exit(__FILE__,__LINE__,10);
        }
        
        //var_dump($miscThings[0]);
        //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        $encoded_business_rules_field_name_array = array();
        $field_names_array = array();
        $data_array_name = array();
        $data_array_name ["report_name"] = $report_definition[0]->report_name;
        $data_array_name ["record_type"] = $report_definition[0]->record_type;
        $field_names_row_file_name =  "../".$this->node_name.'/'.$this->generated_files_folder.'/'.$report_definition[0]->id.'_browse_select_field_names_row';

        $browse_snippet_file_name ="../".$this->node_name.'/'.$this->generated_files_folder.'/'.$report_definition[0]->id.'_browse_select_display_snippet';



       //var_dump($browse_snippet_file_name);  $this->debug_exit(__FILE__,__LINE__,0);
        if ($miscThings){         
            //var_dump($miscThings[0]); $this->debug_exit(__FILE__,__LINE__,10);  
            //$miscThings = (array) $miscThings;
            //var_dump($miscThings[0]); $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
 
             //return view($this->node_name.'.browseEdit',compact('miscThings'))
             return view('miscThings'.'.browseEdit',compact('miscThings'))
            ->with('browse_select_field_count'  ,count($miscThings))
            ->with('node_name'                  ,$this->node_name)             
            ->with('field_names_row_file_name'  , $field_names_row_file_name)
            ->with('browse_snippet_file_name'   , $browse_snippet_file_name)
            ->with('report_key'                 , $id)
            ->with('model_table'                ,$this->model_table)
            ->with('key_field_name'             ,'id')
            ->with('key_field_value'            , $id)
            ->with('all_records'                , $miscThings)
            ->with('use_table_in_record'        ,'n')
            ->with('record_table_name'          , $this->model_table)
            ->with('encoded_business_rules'     , $encoded_business_rules)

           ->with('report_definition_key'     , $id)

             
            ;
             $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);

         //return view('miscThings.edit2_default_browse',$miscThings);
        }
        else {
            echo 'you have a fatal error<br>';
            $this->debug_exit(__FILE__,__LINE__,1);
        }
  
        if($miscThings = MiscThing::distinct('record_type')->get()){
          //$miscThings = MiscThing::where($this->snippet_table_key_field_name, '=', $id)->get();
          //$this->debug_exit(__FILE__,__LINE__,0);   
          //echo("<br> report_name<br>".$miscThings[0]->report_name."**");
          //var_dump($miscThings[0]);
          //$this->debug_exit(__FILE__,__LINE__,10);  
        }
    }

    public function initialize_query($distinct_regular,$field_name,$r_o,$v) {
    // *****************
    // this initializes the query pointing to the correct model
    // ****************
        $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        switch ($distinct_regular) { 
            case "distinct":
                $query = MiscThing::distinct()->select($field_name);
                echo("MiscThing::distinct()->select(".$field_name.")");
                break;
            case "regular":
                $query = MiscThing::where($field_name,$r_o,$v);
                echo("MiscThing::where(".$field_name.",". $r_o. ",".$v.")");
                //$this->debug0(__FILE__,__LINE__,__FUNCTION__);

                 break;
       }   
       return $query;

    } 

    public function build_and_execute_query(
        $working_arrays,
        $bypassed_field,
        $query_relational_operators_array,
        $what_we_are_doing) {
        //echo("<br>b uild_and_execute_query");
        //print_r($working_arrays);
        //$this->MyWorkingArray->show_related_arrays("11000",$working_arrays,$what_we_are_doing,__LINE__);
        //$this->MyWorkingArray->show_related_arrays("11000",$working_arrays,'ppv_define_query',__LINE__);
        //show_related_arrays field_name_array, field_type_array, lookups, default_values_array, data
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        //
        // *******
        // this guy does a lot
        // *****
        //$fieldName_r_o_value_array);
        //var_dump($working_arrays['ppv_define_query']);
 
        //var_dump(array_keys($working_arrays['ppv_define_query']));
        //var_dump(array_keys($working_arrays['ppv_define_query']['field_name_array']));
        
        $field_name_array      = $working_arrays['ppv_define_query']['data']['query_field_name_array'];
        //$r_o_array_name        = $working_arrays['ppv_define_query']['field_name_array']['r_o'];
        $r_o_array             = $working_arrays['ppv_define_query']['data']['query_r_o_array'];
                if(is_numeric($r_o_array[0])){
                    $new_r_o_array = array();
                    foreach ($r_o_array as $index=>$value){
                        $new_r_o_array[] =
                        $query_relational_operators_array[$value];
                    }
                    //var_dump(array_keys($new_r_o_array));
                    //var_dump(array_values($new_r_o_array));
                    $r_o_array = $new_r_o_array;
                }

        //$value_array_name      = $working_arrays['ppv_define_query']['field_name_array']['value'];
        $value_array           = $working_arrays['ppv_define_query']['data']['query_value_array'];
        //*/
        //var_dump($working_arrays['ppv_define_query']);
        //var_dump($field_name_array);
        //var_dump($r_o_array );
        //var_dump($value_array_name  );
        //var_dump($working_arrays['ppv_define_query']['query_field_name_array']);
        //var_dump($working_arrays['query_field_name_array']);
        
        //var_dump($value_array  );
        //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        //* ********************
        $dash_gt = " ->";
        $first_time = 1;
        //echo $this->model;$this->debug1(__FILE__,__LINE__,__FUNCTION__);
        $executing_distinct = 0;
        $model = $this->node_name;
        //var_dump($field_name_array);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        //var_dump(array_values($field_name_array));
        //$this->MyWorkingArray->show_related_arrays("11000",$working_arrays,$what_we_are_doing,__LINE__);
        //$this->MyWorkingArray->show_related_arrays("11000",$working_arrays,'ppv_define_query',__LINE__);
 
        foreach ($field_name_array as $index=>$field_name) {
             //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
            $value = $field_name;
           if ($field_name <> $bypassed_field){
                $r_o = $r_o_array [$index];
                $v = $value_array[$index];
                $v = $this->convert_string_variables_to_variables($v);
                //echo("ro ". $r_o );
                //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                switch ($r_o) {
                    case "distinct":
                        if ($first_time){
                            $first_time = 0;
                            $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                            $query = $this->initialize_query('distinct',$field_name,$r_o,$v);
                        }
                        else {
                            $query->where($field_name,$r_o,$v);
                             echo("->where(".$field_name." $r_o ".$v.")");
                        }
                        break;
                    case "=":
                    case "<>":
                    case ">":
                    case "<":
                    case "<=":
                    case ">=":
                        if ($first_time){
                            $first_time = 0;
                            
                            $query = $this->initialize_query('regular',$field_name,$r_o,$v);
                        }
                        else {
                            $query->where($field_name,$r_o,$v);
                            echo("->where(".$field_name." $r_o ".$v.")");
                            //$this->debug1(__FILE__,__LINE__,__FUNCTION__);

                        }
                        break;
                    }
  //echo $this->model;$this->debug0(__FILE__,__LINE__,__FUNCTION__);    
                switch ($r_o) {
                    //case  "join":
                    case "join":
                        //DB::table('name')->join('table', 'name.id', '=', 'table.id')
                        //->select('name.id', 'table.exmail');       
                        //case  "where":
                    case "like":
                        $query->where($field_name,$r_o,$v);
                         echo(' ->where('.$field_name.','.$r_o . ','. $v .')');
                        break;
                    case "whereBetween":
                        $query->whereBetween($field_name,$value);
                         echo(' ->whereBetween('.$field_name.','.$aord.')');
                        break;
                    case "whereNull":
                        $query->whereNull($field_name);
                         echo(' ->whereNull('.$field_name.')');
                        break;
                    case "whereNotNull":
                        $query->whereNotNull($field_name);
                         echo(' ->whereNotNull('.$field_name.')');
                        break;
                    case  "groupBy":
                            $query->groupBy($field_name);
                             echo(' ->groupBy('.$field_name.')');
                            break;

                    case "orderBy":
                          $aord = "ASC";
                            $query->orderBy($value);
                            echo(' ->orderBy('.$value.','.$aord.')');
                       
                        break;
                    case "orderByDesc":
                        $aord = "DESC";     
                            $query->orderBy($value,$aord);
                            echo(' ->orderBy('.$value.','.$aord.')');
                        
                        break;
                    case "distinct":
                        $executing_distinct = 1;
                        //$distinct_value = $value;
                        //$query->distinct();
                        //echo(" ->distinct()");
                       
                        break;
                    case "xgetArray":
                        //$query->get();
                        break;
                } // end switch      

 
            } // end of not bypassed

            
        }  // end foreach
        return $query->get();
    }   // end of b uild_and_execute_query        


    public function build_and_execute_query_old(
        $working_arrays,
        $bypassed_field,
        $query_relational_operators_array,
        $what_we_are_doing) {
        //echo("<br>b uild_and_execute_query");
        //print_r($working_arrays);
        //$this->MyWorkingArray->show_related_arrays("11000",$working_arrays,$what_we_are_doing,__LINE__);
        //$this->MyWorkingArray->show_related_arrays("11000",$working_arrays,'ppv_define_query',__LINE__);
        //show_related_arrays field_name_array, field_type_array, lookups, default_values_array, data
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        //
        // *******
        // this guy does a lot
        // *****
        //$fieldName_r_o_value_array);
        //var_dump($working_arrays['ppv_define_query']);
 
        //var_dump(array_keys($working_arrays['ppv_define_query']));
        //var_dump(array_keys($working_arrays['ppv_define_query']['field_name_array']));
        
        $field_name_array      = $working_arrays['ppv_define_query']['data']['query_field_name_array'];
        //$r_o_array_name        = $working_arrays['ppv_define_query']['field_name_array']['r_o'];
        $r_o_array             = $working_arrays['ppv_define_query']['data']['query_r_o_array'];
                if(is_numeric($r_o_array[0])){
                    $new_r_o_array = array();
                    foreach ($r_o_array as $index=>$value){
                        $new_r_o_array[] =
                        $query_relational_operators_array[$value];
                    }
                    //var_dump(array_keys($new_r_o_array));
                    //var_dump(array_values($new_r_o_array));
                    $r_o_array = $new_r_o_array;
                }

        //$value_array_name      = $working_arrays['ppv_define_query']['field_name_array']['value'];
        $value_array           = $working_arrays['ppv_define_query']['data']['query_value_array'];
        //*/
        //var_dump($working_arrays['ppv_define_query']);
        //var_dump($field_name_array);
        //var_dump($r_o_array );
        //var_dump($value_array_name  );
        //var_dump($working_arrays['ppv_define_query']['query_field_name_array']);
        //var_dump($working_arrays['query_field_name_array']);
        
        //var_dump($value_array  );
        //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        //* ********************
        $dash_gt = " ->";
        $first_time = 1;
        //echo $this->model;$this->debug1(__FILE__,__LINE__,__FUNCTION__);
        $executing_distinct = 0;
        $model = $this->node_name;
        //var_dump($field_name_array);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        //var_dump(array_values($field_name_array));
        //$this->MyWorkingArray->show_related_arrays("11000",$working_arrays,$what_we_are_doing,__LINE__);
        //$this->MyWorkingArray->show_related_arrays("11000",$working_arrays,'ppv_define_query',__LINE__);
 
        foreach ($field_name_array as $index=>$field_name) {
             //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
            $value = $field_name;
           if ($field_name <> $bypassed_field){
                $r_o = $r_o_array [$index];
                $v = $value_array[$index];
                $v = $this->convert_string_variables_to_variables($v);
                //echo("ro ". $r_o );
                //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                switch ($r_o) {
                    case "distinct":
                        if ($first_time){
                            $first_time = 0;
                            $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                            $query = $this->initialize_query('distinct',$field_name,$r_o,$v);
                        }
                        else {
                            $query->where($field_name,$r_o,$v);
                             echo("->where(".$field_name." $r_o ".$v.")");
                        }
                        break;
                    case "=":
                    case "<>":
                    case ">":
                    case "<":
                    case "<=":
                    case ">=":
                        if ($first_time){
                            $first_time = 0;
                            
                            $query = $this->initialize_query('regular',$field_name,$r_o,$v);
                        }
                        else {
                            $query->where($field_name,$r_o,$v);
                            echo("->where(".$field_name." $r_o ".$v.")");
                            //$this->debug1(__FILE__,__LINE__,__FUNCTION__);

                        }
                        break;
                    }
  //echo $this->model;$this->debug0(__FILE__,__LINE__,__FUNCTION__);    
                switch ($r_o) {
                    //case  "join":
                    case "join":
                        //DB::table('name')->join('table', 'name.id', '=', 'table.id')
                        //->select('name.id', 'table.exmail');       
                        //case  "where":
                    case "like":
                        $query->where($field_name,$r_o,$v);
                         echo(' ->where('.$field_name.','.$r_o . ','. $v .')');
                        break;
                    case "whereBetween":
                        $query->whereBetween($field_name,$value);
                         echo(' ->whereBetween('.$field_name.','.$aord.')');
                        break;
                    case "whereNull":
                        $query->whereNull($field_name);
                         echo(' ->whereNull('.$field_name.')');
                        break;
                    case "whereNotNull":
                        $query->whereNotNull($field_name);
                         echo(' ->whereNotNull('.$field_name.')');
                        break;
                    case  "groupBy":
                            $query->groupBy($field_name);
                             echo(' ->groupBy('.$field_name.')');
                            break;

                    case "orderBy":
                          $aord = "ASC";
                            $query->orderBy($value);
                            echo(' ->orderBy('.$value.','.$aord.')');
                       
                        break;
                    case "orderByDesc":
                        $aord = "DESC";     
                            $query->orderBy($value,$aord);
                            echo(' ->orderBy('.$value.','.$aord.')');
                        
                        break;
                    case "distinct":
                        $executing_distinct = 1;
                        //$distinct_value = $value;
                        //$query->distinct();
                        //echo(" ->distinct()");
                       
                        break;
                    case "xgetArray":
                        //$query->get();
                        break;
                } // end switch      

 
            } // end of not bypassed

            
        }  // end foreach
        return $query->get();
    }   // end of b uild_and_execute_query        


    public function clean_orphan_files($node_name,$update_option) {
        //$field_name_array = (array) json_decode(Input::get('encoded_field_name_array'));
        $active_report_ids = $this->get_active_reports_for_table($node_name); 
        $path_to_files = $this->views_files_path_only .$node_name."/"."generated_files";
        //echo (" ptf ".$path_to_files.'%'.$node_name.'%'.$this->views_files_path.'%%'.$this->views_files_path_only);
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

        if ($handle = opendir($path_to_files)) {
            //echo "Directory handle: $handle\n";
            //echo "Entries:\n";
            $stra = "xxx";
            $view_variables_array = array();
            //var_dump($active_report_ids);$this->debugx('1110',__FILE__,__LINE__,__FUNCTION__);
            /* This is the correct way to loop over the directory. */
            $i1 = 0; 
            while (false !== ($entry = readdir($handle))) {
                $i = strpos($entry,'_');
                if ($i >0) {
                    $stra = substr($entry,0,$i);
                    if (is_numeric($stra)){
                        if (in_array($stra,$active_report_ids)){
                            //echo ('<br/>'. 'good '.$entry ." will not be deleted"."<br>");
                        }
                        else {
                            //echo $path_to_files."/".$entry . " will be deleted"."<br>";
                            if ($update_option == "remove_broken_links"){
                                $view_variables_array[$node_name][ $path_to_files.'/'.$entry] = $entry;
                                unlink($path_to_files."/".$entry);
                                $i1++;
                                //$view_variables_array[$i1]['field'][] = $msgs_array[$i][$name];
                                $view_variables_array[$i1]['field'][] = $path_to_files."/".$entry;
                                $view_variables_array[$i1]['class'][] = 'text_align_left';
                                $view_variables_array[$i1]['field'][] = "was deleted";
                                $view_variables_array[$i1]['class'][] = 'text_align_left';

                            }
                            else{
                                $i1++;
                                //$view_variables_array[$i1]['field'][] = $msgs_array[$i][$name];
                                $view_variables_array[$i1]['field'][] = $path_to_files."/".$entry;
                                $view_variables_array[$i1]['class'][] = 'text_align_left';
                                $view_variables_array[$i1]['field'][] = "will be deleted";
                                $view_variables_array[$i1]['class'][] = 'text_align_left';
                       
                            }

                           //echo ('<br/>'." will be deleted ".$entry );
                             
                        }
                    }
                }
            }
            closedir($handle);
        }
        return $view_variables_array;
    } 
    

    public function snippets_gen_browse_select($key_field_name,$key_value) {
        echo 'snippets_gen_browse_select';print_r($_REQUEST);exit("exit 172");
        $nv_array = array(); 
        foreach ($_REQUEST['to'] as $value){
            $nv_array [$value] = $value;
        }
        $array = array();
       
        $array ['browse_select_display_snippet']            = "";
        $array ['browse_select_array']                  = json_encode($nv_array);
        $array ['merge_browse_select_and_modify_arrays']= json_encode(array_merge ((array) $_REQUEST["to"],$this->generated_snippets_array['modifiable_fields_array']));
        $array ['lookup_name_value_array_gen_by_table'] = json_encode($this->lookup_name_value_array_gen_by_table($this->model_table));
        //print_r($array);exit("exit 184");
        $this->generated_snippets_array_update($key_field_name,$key_value,$array);
        return;
    }



    /**
     * get data necessary for reporting and load it into a single array
     * copied from putEdit2new
     *
     * @return array
     */



        public function decode_array_to_array($record,$encoded_string) {
        // *****************
        // this converts encoded_strings to arrays
        // ****************

        //var_dump($encoded_string);
        if (is_null($record[0][$encoded_string]))   {
            $arr = array();
        }else{
            $arr =  (array) json_decode($record[0][$encoded_string],1);
        }
        return $arr;

        var_dump($arr);exit("xit 4420");
    }



        public function decode_object_field_to_array($obj,$field_name) {
            //echo("decode_object_field_to_array".$obj->$field_name);var_dump($obj);$this->debug_exit(__FILE__,__LINE__,0);
            $x = json_decode($obj->$field_name,1);
            if (is_array($x)){
                return $x;
            }
            return null;
        }   


    public function xkloneRecord($insert,$data_record)    {
        echo('should always be defined in controller it extends');
        $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

    }


    public function editUpdate(
        Request $request, 
        $id, 
        $what_we_are_doing, 
        $coming_from,
        $report_definition_key){
        //$this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);
        echo("<br> crheditUpdate... ".
            ' what_we_are_doing: '. $what_we_are_doing.
            ", id: ".$id.
            ', coming_from: '.$coming_from.
            ', report_definition_key: '.$report_definition_key);
        if (!empty($what_we_are_doing)) {
            $this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);
            $report_definition  = $this->model_get_id($this->snippet_model,$report_definition_key);
            $working_arrays     = $this->MyWorkingArray->working_arrays_initialize($report_definition[0],$what_we_are_doing,$this->bypassed_field_name,$this->model_table);
            switch ($what_we_are_doing) { 
                case "klone_record":
                    $this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);
                    $this->kloneRecord($id);                     
                    break;
                case "edit2_default_add":
                case "edit2new":
                case "edit2_default_edit":
                case "editing_a_data_record":
                    $this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);
                    //$request->input('data_key');
                    //var_dump(Input::all()); $this->debug_exit(__FILE__,__LINE__,0);
                    //$report_definition  = $this->execute_query_by_report_no($id);
                    $modifiable_fields_array = $working_arrays['maintain_modifiable_fields']['modifiable_fields_array'];
                    var_dump($modifiable_fields_array);
                     //var_dump($modifiable_fields_array);
$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                    $lookups_array['field_name'] = $this->MyWorkingArray->build_column_names_array($this->model_table);
                    //var_dump($modifiable_fields_array); $this->debug_exit(__FILE__,__LINE__,10);

                    $fieldname_name_value_array = $this->bld_name_value_lookup_array($this->model_table);
                    //$lookups_array = $this->bld_name_value_lookup_array('shows');
                    $lookups_array = array_merge($lookups_array,$fieldname_name_value_array);
                    //var_dump($id); 
                    //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                    $MiscThing  = $this->model_get_id($this->model,$id);
                    //$MiscThing  = MiscThing::where('id','=',$id)->get();
                    if($MiscThing){
                        $array1  = $this->return_modifiable_fields_array($what_we_are_doing,$report_definition_key,$modifiable_fields_array); 
                      //echo('id' .$id);
                       //var_dump($MiscThing[0]);
                       //var_dump($modifiable_fields_array);
                        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

                        $snippet_string = $this->snippet_gen_modifiable_fields(
                            $modifiable_fields_array,
                            $lookups_array,
                            $array1);
                            }   


                        $fnam = $this->view_files_prefix."/".$this->generated_files_folder."/".$id.'_snippet_string.blade.php';
                       //var_dump($fnam);$this->debug_exit(__FILE__,__LINE__,01);
                        echo("</br>"."writing ***".$fnam);$this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);

                        $this->write_file_from_string($fnam,$snippet_string);
    

                        $edit_snippet_file_name ="../".$this->node_name.'/'.$this->generated_files_folder.'/'.$MiscThing[0]->id.'_snippet_string';
                        //$edit_snippet_file_name = $fnam;
                        //debug_exit(__FILE__,__LINE__,1);   
                        $passed_to_view_array                                   = array();
                        $passed_to_view_array['edit_snippet_file_name']         = $edit_snippet_file_name;
                        $passed_to_view_array['id']                             = $id;
                        $passed_to_view_array['report_definition_key']          = $report_definition_key;
                        $passed_to_view_array['coming_from']                    = $coming_from;

                        $passed_to_view_array['encoded_modifiable_fields_array'] = 
                            json_encode($modifiable_fields_array);
                        $passed_to_view_arra2newy['data_key']                   = $request->input('data_key');
                        $passed_to_view_array['encoded_input']                  = $request->input('encoded_input');
                        $passed_to_view_array['snippet_name']                   ='_modifiable_fields_getEdit_snippet';
                        $passed_to_view_array['qqqq']                           = 
                            ($report_definition[0]['business_rules']);
                        $passed_to_view_array['report_definition']              = $report_definition[0];
                        $passed_to_view_array['record']                         = $MiscThing[0];
                        $passed_to_view_array['encoded_report_definition']      = json_encode($report_definition[0]);       
                        $passed_to_view_array['snippet_string']                 = $snippet_string;      
                        $passed_to_view_array['lookups_array']                  = $lookups_array;       
                        //echo("*".$request->input('coming_from')."*");$this->debug_exit(__FILE__,__LINE__,0);
                        //var_dump($passed_to_view_array['record']);$this->debug_exit(__FILE__,__LINE__,1);      
                // *****
                // return to view
                // *****
                        //var_dump($this->model);

                        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                        return view($this->node_name.'.editUpdate',compact('miscThings'))
                        ->with('model'              ,$this->model)            
                        ->with('node_name'          ,$this->node_name)            
                       ->with('passed_to_view_array',$passed_to_view_array);            
                        break;          
                case "edit2_default_update":
                //case "updating_data_record": // defined in editUpdate
                    //echo("<BR>".$what_we_are_doing);$this->debug_exit(__FILE__,__LINE__,10);
                    //var_dump($request);$this->debug_exit(__FILE__,__LINE__,1);
                    $requestFieldsArray=$request->all(); // important!!

                    //var_dump($working_arrays['ppv_define_business_rules']['business_rules_r_o_array']);
                    //var_dump($this->build_business_rules_relational_operators());$this->debug_exit(__FILE__,__LINE__,1);
                    var_dump($requestFieldsArray);$this->debug_exit(__FILE__,__LINE__,1);

                    //$validator = Validator::make(Input::all(), $business_rules_array); //update
                    if ( $validator->fails() ) {
                        $errors = $validator->messages();
                        $this->debug_exit(__FILE__,__LINE__,1);
                        //return redirect()->back(); 
                        //return redirect('public/admin/'.$this->node_name.'/editUpdate')
                        return View::make($this->node_name.'/editUpdate')
                            //->with('passed_to_view_array' ,$passed_to_view_array);            

                        //->withErrors($errors)
                        ->withInput();
                          //return $validator->errors()->all();
                        //return back()->withErrors($errors)->withInput();
                    }
                    
                    //$this->debug_exit(__FILE__,__LINE__,1);
                    $a = 'encoded_modifiable_fields_array';
                    $Inputo = json_decode(json_encode(Input::all()),0);
                    $modifiable_fields_array = $this->decode_object_field_to_array($Inputo,$a);
                    var_dump($modifiable_fields_array);var_dump($request);
                    $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                    switch ($request->input('coming_from')) {
                        
                        case "edit2_browse_add_button":
                         echo($what_we_are_doing);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                            $updatex  = DB::connection($this->db_data_connection)->table($this->model_table)
                                ->insert($modifiable_fields_name_values);
                            break;
                        case "edit2_edit_button":
                         echo($what_we_are_doing);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                           $updatex  = DB::connection($this->db_data_connection)->table($this->model_table)
                                ->where($this->key_field_name,  '=', $request->input('data_key'))
                                ->update($modifiable_fields_name_values);
                            break;
                    }


                return redirect('admin/'.$this->node_name.'/edit1')
                ->with('message', 'record updated')
                ->with('message', 'validation has been bypassed');
                break;

                    default:
                        echo($what_we_are_doing);
                        echo("<br>"."what we are doing is improperly assigned");
                        $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

                        break;
                } // end switch what we are doing
        } // what we are doing is not empty   
    } // end of edit update
 



    public function editUpdate_blade_files_gen($report_key,$objOrArray) {
        //echo ('<br>editUpdate_blade_files_gen<br><br>'.$report_key);$this->debug_exit(__FILE__,__LINE__,10);

        $fnam = $this->view_files_prefix."/".$this->generated_files_folder."/".$report_key.'_editUpdate_snippet.blade.php';
        File::put($fnam,$this->editUpdate_snippet_gen($this->model,$_REQUEST["to"],'version1',$objOrArray));
        //$fnam = $this->view_files_prefix."/".$this->generated_files_folder."/".$report_key.'_browse_select_field_names_row.blade.php';
        //File::put($fnam, $this->blade_gen_browse_select_field_names_row($this->model,$_REQUEST["to"]));
   }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


                   // not currently called
    public function xclone_id_to_node($from_id,$name_values_array,$node_name,$from_folder,$to_folder) {
 
        //* *****
        // this takes the id passed to it and creates a copy of that report in the given node
        // the name_values_array replaces old values with node_name specific changes
        // we derive the $from_folder to $folder
        // we get the last node from the node name of the from_id 
        //* *****
        echo($from_id);

        //var_dump($link_parms_array);
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $MiscThing  =  MiscThing
        ::where('id','=',$from_id)->get();
        if($MiscThing){
            $arr1 = (array) $MiscThing[0]['attributes'];
            $from_array = array(
                'report_id'=>$from_id,
                'node_name'=>$arr1['node_name']
            );
            echo($from_array['node_name']." *** ".$generated_dir." *** ");$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
            $from_folder = $views_files_path_only .  $from_array['node_name']."/".$generated_dir;

           unset($arr1['id']);
            //$arr1 = array_merge ($arr1,$name_values_array);
            //var_dump($arr1);//var_dump($views_files_path);
            //$this->debug1(__FILE__,__LINE__,__FUNCTION__);
           // MiscThing::create($arr1);
            switch ($arr1['record_type']) { 
                case "report_definition":
                    echo($from_folder." *** "." *** ");$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                    $new_id = $this->get_newest_record_type('report_definition');
                    $to_array   = array(
                        'report_id'=>strval($new_id),
                        'node_name'=>$new_values_array ['node_name']
                    );
                    $to_folder = $views_files_path .  $to_array['node_name']."/".$generated_dir;

                    //echo("<BR>".$to_folder."*".$from_folder);
                    //echo("** from_array  **"); var_dump($from_array);
                    //echo("** to_array  **"); 
                    var_dump($to_array);
                    //var_dump($from_array);
                    $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
     
                    $x = $this->partial_folder_clone_w_scanrepl($from_folder,$to_folder,$from_array,$to_array,'y');
                    
                    break;
            }         
        }
        return $new_id;
        return redirect('admin/miscThings');
    }


    public function get_report_definition_id_info($use_generate_node,$link_parms_array) {
        //var_dump($link_parms_array); var_dump($this->report_definition_id);

        //$this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);
        $reports_to_clone_array = array(
             $this->report_definition_model_name =>$this->report_definition_id  
              );
        $from_id = $this->report_definition_id;
        $report_definition  =  MiscThing
        ::where('id','=',$this->report_definition_id )
        ->get();
        //***** if there aren't any, load the defaults
        $arr1 = (array) $report_definition[0]['attributes'];
        //var_dump($arr1);

        if ($report_definition->count('items') > 0){
            //***** for each default_report 
            $from_array = array(
                'report_id'=>$from_id,
                'node_name'=>$arr1['node_name'],
                'attributes' => $report_definition[0]['attributes'],
                'from_folder'=>""
                );
            if ($use_generate_node){
                $from_array['from_folder'] = $this->views_files_path_only. $from_array['node_name'] ."/"."generated_files";
            }
            else{
                $from_array['from_folder'] = $this->views_files_path_only . $from_array['node_name'];
            
            }
            //var_dump($this->views_files_path);var_dump($this->views_files_path_only);            
            //echo("* ".$use_generate_node);
            //var_dump($from_array['from_folder']);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
            return $from_array;
        }
    }

    public function clone_from_node_to_node($from_folder,$to_folder) {
        // except directories
        //var_dump($from_folder); var_dump($to_folder);

        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        if ($handle = opendir($from_folder)) {
             /* This is the correct way to loop over the directory. */
            while (false !== ($file_name = readdir($handle))) {
                     //echo ("<br>".$to_string_array['report_id']);
                if(!(is_dir($from_folder."/".$file_name))) {
                   //echo("<br>".$to_folder."/".$file_name." was created ");
                    //echo("<br>".$to_folder."/".$file_name);//$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                    copy($from_folder."/".$file_name,$to_folder."/".$file_name);
                    //$this->debugx('0100',__FILE__,__LINE__,__FUNCTION__);echo($to_folder."/".$file_name." was created ");
                }

            }
        }
        return redirect('admin/miscThings');
    }



    public function clone_ids_to_node_name($from_info,$use_generate_node,$link_parms_array) {
        // part of the model_report_definition
        
        $reports_to_clone_array = array(
             $this->report_definition_model_name =>$this->report_definition_id  
              );
        //var_dump($reports_to_clone_array);// var_dump($this->report_definition_id);
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

        $from_id = $from_info['report_id'];
        $from_folder = $from_info['from_folder'];

        $generated_dir = "generated_files";
        $displayYN = "n";
        $link_parms_array['to_folder'] = $this->views_files_path_only. $link_parms_array['node_name']."/"."generated_files";
        foreach ($reports_to_clone_array as $index => $from_id) {
            // jusst once to seed report files and directories
            //$this->clone_id_to_node($from_id,$new_values_array,$new_values_array['node_name'],$from_folder,$to_folder); 
            
            //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
            $this->partial_folder_clone_w_scanrepl($from_folder,$link_parms_array['to_folder'],$from_info,$link_parms_array,$displayYN);

        }
            return redirect('admin/miscThings');
    }




    public function create()
    {
        //$x = Config::get('dehGlobals.business_rules_array');
        $this->debug_exit(__FILE__,__LINE__,10);  
 
        //echo("<br>".$this->store_validation_id );$this->debug_exit(__FILE__,__LINE__,1);
        //$snippet_file ="../".$this->node_name.'/'.$this->generated_files_folder.'/'.$this->store_validation_id.'_modifiable_fields_add';

        $snippet_file = $this->node_name."/".$this->generated_files_folder."/".$this->report_definition_id.
        '_modifiable_fields_add.blade.php';
        //File::put($snippet_file,$this->$blade_routine($no_of_rows));
        $report_definition = 
        $this->execute_query_by_report_no($$this->report_definition_id) ;
        $encoded_business_rules     = $report_definition[0]->business_rules;
        $modifiable_fields_array    = $report_definition[0]->modifiable_fields_array;
        $snippet_file ="../".$this->node_name.'/'.$this->generated_files_folder.'/'.
        $report_definition_key.'_modifiable_fields_add';  
        $this->blade_gen_simple_add($this->report_definition_id,$modifiable_fields_array);
         echo($report_definition_key.$this->node_name);
        return view($this->node_name.'.create')
            ->with('encoded_business_rules' , $report_definition[0]->business_rules)
            ->with('modifiable_fields_array' , 
                $report_definition[0]->modifiable_fields_array)
            ->with('report_definition_key'  , $report_definition_key)
            ->with('snippet_file'           , $snippet_file)
            ->with('node_name'              , $this->node_name
            );         return view($this->node_name.'.create')
        //->with('message'                , $message)
        ->with('snippet_file'           , $snippet_file)
        ->with('report_definition_key'  , $this->report_definition_id)
        ->with('node_name'              , $this->node_name);

    }

 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create_w_report_id(REQUEST $request, $report_definition_key) {
        $requestFieldsArray=$request->all();
        //var_dump($report_definition_key);
        
        $link_parms_array = $this->link_parms_array;
        //var_dump($request);echo($report_definition_key);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);   
        
        //echo $this->node_name;//$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);    
        $miscThing = MiscThing    
 
            ::where('record_type',  '=', "report_definition")
            ->where('node_name',  '=', $link_parms_array['node_name'])
            ->get();
            //->orderBy('created_at','DESC')
            //->orderBy('created_at')

        $msgs_array = array();
        $search_str_array = array(
            'controller_name'   => "@@controller_name@@",
            'model_table'       => "@@model_table@@",
            'model'             => "@@model@@",
            'node_name'         => "@@node_name@@",
            'field_name_string' => "@@field_name_string@@"
            );
        //echo("<br/>".$this->node_name);
        $link_parms_array = $this->link_parms_array; 
        //var_dump($link_parms_array);

        $this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);
        $parm2_array = array();
        $parm2_array[1]  = $report_definition_key;
        echo($this->node_name. $this->get_report_definition_id(
        'report_definition',
        $this->node_name,
        'xxx'));
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $required_entities = array(
            'model_report_definition'       => 'model_report_definition'
            );
        // we're only doing one ... 'model_report_definition'
        foreach ($required_entities as $entity=>$entity_name) {
            //echo("<br/>".$entity);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
            $msgs_array = $this->generic_method_activate_entity($entity,$search_str_array,$msgs_array,$this->link_parms_array,$parm2_array,$this->node_name);
            }

        $coming_from = "create_w_report_id";
        $id = $report_definition_key;
       return view($this->node_name.'.reportDefMenuEdit',compact('miscThing'))
        ->with('id'                                 ,$id)
        ->with('report_definition_id'               ,$report_definition_key)
        ->with('model'                              ,$this->model)
        ->with('node_name'                          ,$this->node_name)
        ->with('report_name'                        ,$miscThing[0]['report_name'])
        ->with('what_we_are_doing'                  ,'updating_report_name')
        ->with('coming_from'                        ,$coming_from)
       ;

        $report_definition = 
        $this->execute_query_by_report_no($report_definition_key) ;
        //var_dump($report_definition);$this->debug_exit(__FILE__,__LINE__,1);
        $encoded_business_rules     = $report_definition[0]->business_rules;
        
        $snippet_file ="../".$this->node_name.'/'.$this->generated_files_folder.'/'.
        $report_definition_key.'_modifiable_fields_add';  
        echo($report_definition_key.$this->node_name);
        return view($this->node_name.'.create')
            ->with('encoded_business_rules' , $report_definition[0]->business_rules)
            ->with('modifiable_fields_array' , 
                $report_definition[0]->modifiable_fields_array)
            ->with('report_definition_key'  , $report_definition_key)
            ->with('snippet_file'           , $snippet_file)
            ->with('node_name'              , $this->node_name
            );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response conn
     */
    public function execute_query_by_report_no($report_no) {
      //echo 'execute_query_by_report_no'.$report_no.$this->snippet_table_key_field_name;$this->debug_exit(__FILE__,__LINE__,0);
        $response  = $this->model_get_id($this->snippet_model,$report_no);
      //$response = DB::connection($this->db_snippet_connection)
        //->table($this->snippet_table)
        //->where($this->snippet_table_key_field_name, '=', $report_no)
        //->get();
        if ($response){
           return $response;
        }
        else {
            echo 'you have a fatal error<br>';
            $this->debug_exit(__FILE__,__LINE__,1);
        }
    }


    public function bld_name_value_lookup_array($table_name) {
        
        $response0 = MiscThing
        ::where('table_name','=', $table_name)
        ->where('record_type','=','name_value_definition')
        ->get(array('field_name','table_name','name','value'));
        $array = array();
        foreach($response0 as $response){
            $array [$response->field_name][$response->name] = $response->value;
        }
        return $array;
    }


    public function xclone_generated_files_to_node_name($node_name) {
        if ($handle = opendir($this->views_files_path."/".$node_name."/generated_files")) {
            echo "Directory handle: $handle\n";
            echo "Entries:\n";
            $new_id = $this->get_newest_record_type('report_definition');
            $this->debug1(__FILE__,__LINE__,__FUNCTION__);
            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                $haystack = "*" . $entry;
                $i0 = stripos($haystack,$needle);
                echo "$entry\n";
              $new_id = $this->get_newest_record_type('report_definition');
          }
        }
    }
 

    public function get_active_reports_for_table($node_name) {
    $array = array();
    $response = MiscThing
    ::where('record_type','=','report_definition')
    //->where('table_name','=',$this->model_table)
    ->where('node_name','=',$node_name)
    ->get(array($this->snippet_table_key_field_name));
    if ($response){
        foreach ($response as $record) {
            $snippet_table_key_field_name = $this->snippet_table_key_field_name;
            $array [] = $record->$snippet_table_key_field_name;
        }
    }
    //echo("<br><br>array 98");var_dump($array);exit("98");
    return $array;
    }
    



    public function get_newest_record_type($record_type) {
        $report_definition  = 
            MiscThing
            ::where('record_type','=',$record_type)
            ->orderBy('created_at'     ,'desc')
            ->get();
        echo ($report_definition[0]['id']);
        //$this->debug1(__FILE__,__LINE__,__FUNCTION__);
        return $report_definition[0]['id'];
    }


   public function get_report_definition_id(
        $record_type,
        $node_name,
        $like_report_name
        ) {
        //echo 'get_report_definition_id';
        //$this->debug_exit(__FILE__,__LINE__,10);
        $response = MiscThing
            ::where('record_type','=',$record_type)
            ->where('node_name','='     ,$this->snippet_node_name)
            //->where('report_name','like','%'.$like_report_name.'%')
            ->get();

        if ($response){
            //var_dump($response[0]['id']);$this->debug_exit(__FILE__,__LINE__,10);
            return $response[0]['id'];
        }
        else {
            echo 'you have a fatal error<br>';
            $this->debug_exit(__FILE__,__LINE__,1);
        }
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index(){
        //echo('index');$this->debug_exit(__FILE__,__LINE__,1);
        //echo('index');$this->debug_exit(__FILE__,__LINE__,10);
        
        //var_dump($this->field_name_list_array);
       $record_type                    = "report_definition";
       $miscThings = MiscThing::where('record_type','=',$record_type)
         ->where('table_name','='    ,$this->model_table)
        ->where('node_name','='     ,$this->node_name)
        ->orderBy('report_name'     ,'asc')
        ->get();

        return view($this->node_name.'.indexReports',compact('miscThings'))
            ->with('all_records',$miscThings)
            ->with('report_definition_key',$this->report_definition_id)
            ->with('encoded_report_description' ,json_encode($miscThings))
            ->with('node_name'                  ,$this->node_name)
            ->with('snippet_table_key_field_name',$this->snippet_table_key_field_name)
            ->with('snippet_table'                ,$this->snippet_table)
            //->with('snippet_model'                 ,$this->snippet_model)

            ->with('snippet_node_name'            ,$this->snippet_node_name)         
            ->with('model_table'                  ,$this->model_table)         
            ;
            
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexRecords() {
       echo(' indexRecords');$this->debug_exit(__FILE__,__LINE__,0);
        
        var_dump($this->node_name);
       $record_type                    = "report_definition";
       $miscThings = MiscThing::where('record_type','=',$record_type)
         ->where('table_name',  '='    ,$this->model_table)
        ->where('node_name',    '='    ,$this->node_name)
        ->orderBy('report_name','asc')
        ->get();

        return view($this->node_name.'.indexRecords',compact('miscThings'))
            ->with('encoded_report_description' ,json_encode($miscThings))
            ->with('node_name'                  ,$this->node_name)
            ->with('snippet_table_key_field_name',$this->snippet_table_key_field_name)
            ->with('snippet_table'               ,$this->snippet_table)
            ;
        }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexReports(REQUEST $request,$id,$report_definition_id) {
       //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);echo(' indexReports');
       // var_dump($id);
       $record_type                    = "report_definition";
   
        if($miscThings = MiscThing::where('record_type','=',$record_type)
            ->where('table_name',  '='    ,$this->model_table)
            ->where('node_name',    '='    ,$this->node_name)
            ->orderBy('report_name','asc')
            ->get()){
            if ($miscThings->count('items') == 0){
                // there are NO reports so go to new report screen
                echo(' no aft reports'.$report_definition_id);//$this->debug_exit(__FILE__,__LINE__,0);
                $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                $request = "";
                $this->create_w_report_id($report_definition_id);
                //$this->debug_exit(__FILE__,__LINE__,1);echo(' no reports');
            }
            else{         // jn1bj1cp8jw188286  vin
                //$what_we_are_doing = 'displaying_advanced_edits_screen';
                $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);

                $what_we_are_doing = $request['what_we_are_doing'];
                //$this->MyWorkingArray->show_related_arrays("10010",$this->MyWorkingArray->working_arrays,$what_we_are_doing,__LINE__);
      
                $this->working_arrays     = $this->MyWorkingArray->working_arrays_initialize($miscThings[0],$what_we_are_doing,$this->bypassed_field_name,$this->model_table);
                $record = $miscThings[0];
                //var_dump($this->report_definition_id);
                // var_dump($miscThings);
                $parameters = array('id'=>$id,'what_we_are_doing'=>$what_we_are_doing,'coming_from'=>'indexReports');
                //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                //$this->debug_exit(__FILE__,__LINE__,10);
                return view($this->node_name.'.indexReports',compact('miscThings'))
                    ->with('encoded_report_description'     ,json_encode($miscThings))
                    ->with('encoded_record'                 ,json_encode($record))
                    ->with('model_table'                    ,$request->input('model_table'))
                    ->with('id'                             ,$request->input('id'))
                    ->with('report_definition_id'           ,$this->report_definition_id)
                    ->with('parameters'                     ,$parameters)
                    ->with('encoded_working_arrays'         ,json_encode($this->working_arrays))
                    ->with('record'                         ,$record)
                    ->with('all_records'                    ,$miscThings)
                    ->with('snippet_model'                  ,$this->snippet_model)
                    ->with('snippet_node_name'              ,$this->snippet_node_name)         

                    ->with('report_key'                     ,$this->report_definition_id)
                    //->with('report_key'                     ,$request->input('report_key'))
                    ->with('node_name'                      ,$this->node_name)
                    ->with('snippet_table_key_field_name'   ,$this->snippet_table_key_field_name)
                    ->with('snippet_table'                  ,$this->snippet_table)
                    ;
            }
        //exit("exit 837"); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function justModifiable($id,$working_arrays,$what_we_are_doing,$request)
    {
        //       
        $this->debug_exit(__FILE__,__LINE__,10);

        $x = "maintain_modifiable_fields";
        //switch (Input::get('edit4_option')) {
        switch ($x) {
            case "maintain_modifiable_fields":
            case "field_list_select":
                $what_we_are_doing = "maintain_modifiable_fields";
                var_dump($working_arrays[$what_we_are_doing]['from_array']);
                $column_names_array = $working_arrays[$what_we_are_doing]['lookups']['field_names'];
                $index2 = $working_arrays[$what_we_are_doing]['field_name_array']['field_name'];
                $to_array = $working_arrays[$what_we_are_doing][$index2];
                $from_array = array_diff($column_names_array,$to_array);





                //$this->debug_exit(__FILE__,__LINE__,0);var_dump($to_array);
                //var_dump(Input::all());$this->debug_exit(__FILE__,__LINE__,1);
                 //var_dump($working_arrays);$this->debug_exit(__FILE__,__LINE__,0);
                 return view($this->node_name.'.reportDefMenuEdit'    ,compact('miscThing'))
                    ->with('coming_from'                  ,'coming_from')
                     ->with('what_we_are_doing'                 ,$what_we_are_doing)
                    ->with('from_array'                         ,$from_array)
                    ->with('to_array'                           ,$to_array)
                     ->with('message'                           ,'')
                     ;
                    var_dump($working_arrays);$this->debug_exit(__FILE__,__LINE__,0);
                break;  
            case "update_field_list":
                $nv_array = array();
                if (array_key_exists('to',Input::all())) {
                    $nv_array   = array_combine(Input::get('to'), Input::get('to'));
                }                                   
                $encoded_nv_array = json_encode($nv_array);
                $edit4_return_option = "field_list_save";
                var_dump(Input::all());$this->debug_exit(__FILE__,__LINE__,10);

                $updatex  = DB::connection($this->db_snippet_connections_array)->table($this->snippet_table)
                ->where($this->snippet_table_key_field_name,    '=', $record[0][$this->snippet_table_key_field_name])
                ->update(array($working_arrays[$what_we_are_doing]['field_name_array']['field_name']=>$encoded_nv_array));

               
                $this->generate_by_list_name($nv_array,$this->model_table);
                //echo ("t41 generate_by_list_name ");$this->debug_exit(__FILE__,__LINE__,0);
                return redirect('admin/'.$this->node_name.'/edit1')
                ->with('message', 'record updated');
                break;                  
        }       
    }

     /**
     
     *
     */
       
    public function model_get_id($model,$id){
        //echo ("modelx ".$model);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        switch ($model) {
            case 'MiscThing':
                $model_get_id = MiscThing::where('id','=',$id)  
                ->get();
                break;
            case model:
                $model_get_id = $model::where('id','=',$id)  
                ->get();
                break;
         }
        return $model_get_id;
    }
         




    public function ppv_edit_snippet_gen($no_of_rows){
        //echo(" ppv_edit_snippet_gen ".$no_of_rows."<br>");$this->debug_exit(__FILE__,__LINE__,0);
       // this generates the code to create a three column table 
        // the first two are pulldowns with a selected value
        // the last one is a single field
        // ***  
        // IT'S ALL JUST STRINGS!
        // ***
        // This is what your input view will look like the next time you load it

        $crlf = "\r\n";
        $strx = "";
        $j = -1;
        for ($i=0; $i<($no_of_rows); $i++){
            $j++;
            $strx .=
                "<tr>".$crlf; // start a new row
            $strx .= // first field is always field_name lookup
                "<td style='text-align:left'>".$crlf.
                //"{{ Form::select('field_name_array[]', $"."first_lookup_array_name,$"."field_name_array[".$j."]) }}".$crlf.
                "{{ Form::select('field_name_array[]', $"."first_lookup_array,$"."field_name_array[".$j."]) }}".$crlf.
                //"{{ Form::select('field_name_array[]', ".$lookups['field_name'].",".$field_name_array[$j].") }}".$crlf.
                "</td>".$crlf;
            $strx .= // second field is always relational operator
                    "<td style=\"text-align:left\">".$crlf.
                    "{{ Form::select('r_o_array[]', $"."second_lookup_array,$"."r_o_array[".$j."]) }}".$crlf.
                    "</td>".$crlf;
            $strx .= // third field is always user supplied value there ain't no lookup
                "<td style=\"text-align:left\">".$crlf.
                "{{ Form::text('value_array[]', $"."value_array[".$j."]) }}".$crlf.
                "</td>".$crlf;
            $strx .=
            "</tr>".$crlf;  // end the row
        }  // end for
        return $strx;       
    }




    function new_radio_button_include_exclude($rows,$array1,$field) {
        //print_r($array1);debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $str1 = "";
        $taskIndex = "";
        $rowcount = -1;
        foreach ($rows as $myrow){
            $rowcount ++;
            $n1 = $myrow[$field];
            $radioA = 'radioA' . $rowcount;
            //$radioA = 'radioA' . '[]';
            //"<td> <input type='text' name='taskIndex[]' value='$n1'>" . "</input></td>".
            $taskIndex .= "<input type='readonly' name='taskIndex[]' value='$n1'>" . "</input>";
            //echo '<br>'.$radioA.' x ';
            if (in_array($myrow[$field], $array1)){
                //echo '<br>match'.'row '. $rowcount.' x ' . $myrow[$field];
                $str2 =
                "<input type='radio' name=$radioA value='Include'  CHECKED >volunteer".
                "<input type='radio' name=$radioA value='Exclude'>reset";
            } else {
                //echo '<br>row '. $rowcount . ' nomatch '. $myrow[$field];
                $str2 =
                "<input type='radio' name=$radioA value='Include'  >volunteer".
                "<input type='radio' name=$radioA value='Exclude' CHECKED >reset";
            }
            
            $str3 = $myrow[$field];
            //echo '$str3 <br>'.$str3.$n1;
            $str1 .="<tr>".
            "<td>" . $rowcount . "</td>".
            "<td>" . $str2 . "</td>".
            "<td>" .$myrow['volunteer'] .   "</td>".
            "</tr>";
            //echo '<br>'.$str1;
            //echo '<br>'.$str2;

        }
        return $str1;
    }


     public function blade_gen_browse_select_field_names_row($model,$field_name_array) {
        //echo '<br>blade_gen_browse_select_field_names_row';//exit("exit 99");
        $crlf = "\r\n";
        //$crlf = "";
        $strx = "<tr>". $crlf;
        $strx .= "<td>". "#"."</td>". $crlf;
        foreach($field_name_array as $name=>$value) {
            $strx .= "<td>" . $value . "</td>". $crlf;
        }
        $strx .= "</tr>". $crlf;

        return $strx;
    }


    public function recreate_snippet_file(
        $modifiable_fields_array,
        $lookups_array,
        $array1,
        $report_definition_key
        ){                 
        $snippet_string = 
        $this->snippet_gen_modifiable_fields( // in deh
            $modifiable_fields_array,
            $lookups_array,
            $array1);                   
        $this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);
        $fnam = $this->view_files_prefix."/".$this->generated_files_folder."/".$report_definition_key.'_snippet_string.blade.php';
       //var_dump($fnam);$this->debug_exit(__FILE__,__LINE__,01);
        echo("</br>"."writing ***".$fnam);$this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);

        $this->write_file_from_string($fnam,$snippet_string);
        return $snippet_string;
        //$this->debugx('1100',__FILE__,__LINE__,__FUNCTION__);
     }

    public function return_modifiable_fields_array($what_we_are_doing,$id,$modifiable_fields_array) {
        //var_dump($what_we_are_doing);//$this->debug_exit(__FILE__,__LINE__,1);
        //var_dump($modifiable_fields_array);$this->debug_exit(__FILE__,__LINE__,1);

        $array1 = array();
        if (is_null($modifiable_fields_array)){ echo "null modifiable_fields_array";
            return $array1;
        }
         switch ($what_we_are_doing) { 
            case "adding_a_data_record":
            case "edit2_default_add":
            case "editing_a_data_record":
            case "edit2_default_edit":
            case "edit2new":
                /*foreach ($modifiable_fields_array as $name=> $value) {
                    $array1[$value] = "";
                }*/
            switch ($what_we_are_doing) { 
                case "editing_a_data_record":
                case "edit2_default_edit":
                case "edit2new":

                    //echo($what_we_are_doing);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                    //$db_result  = MiscThing::where('id','=',$id)->get();
                    $db_result  = $this->model_get_id($this->model,$id);
                    $working_arrays = $this->MyWorkingArray->working_arrays_initialize($db_result[0],$what_we_are_doing,$this->bypassed_field_name,$this->model_table);
                    $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                    $modifiable_fields_array = $working_arrays['maintain_modifiable_fields']['modifiable_fields_array'];


                   $array1 = array();
                   if (is_null($modifiable_fields_array)){
                        return $array1;
                    }

                   if($db_result){
                    //var_dump($modifiable_fields_array);$this->debug_exit(__FILE__,__LINE__,1);
                    foreach ($modifiable_fields_array as $name=> $value) {
                        $array1[$value] = $db_result[0]->$value;
                    }

                   }
                    break;
                }
            }
            //var_dump($db_result);$this->debug_exit(__FILE__,__LINE__,1);
            return $array1;
    }

    /**
     * 4 functions maintain 4 entities
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function reportDefMenuEdit(REQUEST $request,$id,$what_we_are_doing,$coming_from){
        $requestFieldsArray=$request->all();
        $miscThing      = MiscThing::where('id','=',$id)->get();
        //$this->MyWorkingArray->show_related_arrays("10010",$this->MyWorkingArray->working_arrays,$what_we_are_doing,__LINE__);
        $record = (array) $miscThing[0];//var_dump($record );
        $record = $record["\0*\0" . 'attributes'];
        //var_dump($record);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);  
        $working_arrays = $this->MyWorkingArray->working_arrays_initialize(
            $record,
            $what_we_are_doing,
            $this->bypassed_field_name,
            $this->model_table);
        //echo(__LINE__);
        //var_dump($working_arrays['maintain_modifiable_fields']);
        
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);    
        //var_dump($working_arrays);
        //echo("wwad ".$what_we_are_doing);
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        //$this->MyWorkingArray->show_related_arrays("11110",$working_arrays,$what_we_are_doing,__LINE__);
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        switch ($what_we_are_doing) {
            case "maintain_query_joins":
                $just_the_names_array = 
                ($working_arrays[$what_we_are_doing]['field_name_array']);
                break;            
            case "ppv_define_query":
              $just_the_names_array = 
                ($working_arrays[$what_we_are_doing]['field_name_array']);
                break;            
            case "ppv_define_business_rules":
              $just_the_names_array = 
                ($working_arrays[$what_we_are_doing]['field_name_array']);
                break;
        }
                //var_dump($working_arrays[$what_we_are_doing]);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);  
        //var_dump($working_arrays[$what_we_are_doing]);
        //exit("<br/>exit".__LINE__.$what_we_are_doing);

        // ***** main *****
        switch ($what_we_are_doing) {
            case "maintain_query_joins":
            case "ppv_define_query":
            case "ppv_define_business_rules":
                //$this->MyWorkingArray->show_related_arrays("00010",$working_arrays,$what_we_are_doing,__LINE__);
                $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);//echo("['lookups'] keys ");
                $html_str = $this->MyWorkingArray->gen_update_snippet_from_working_arrays($id,$working_arrays,$what_we_are_doing,$this->view_files_prefix,$this->generated_files_folder);
                $encoded_field_name_array = json_encode($working_arrays[$what_we_are_doing]['field_name_array']);

                 $this->debugx('0110',__FILE__,__LINE__,__FUNCTION__);
                 return view($this->model_table.".query_joins_update"    ,compact('miscThing'))
                    ->with('what_we_are_doing'              ,$what_we_are_doing)
                    ->with('working_arrays'                 ,$working_arrays)       
                    ->with('report_definition_id'            ,$id)
                    //->with('bladetest'                       ,$hidden_html_fields)
                    ->with('encoded_field_name_array'        ,$encoded_field_name_array)
                    ->with('id'                              ,$id)
                    ->with('request'                         ,$request)
                    ->with('generated_strings'               ,$html_str)
                    ->with('generated_files_folder'          ,$this->generated_files_folder)
                    ->with('coming_from'                     ,$coming_from)
                    ->with('node_name'                       ,$this->node_name)
                    ->with('model_table'                     ,$this->model_table)
                    ->with('message'                         ,'')
                    ;
                    break;  
            }     

       switch ($what_we_are_doing) {
             case "maintain_modifiable_fields":
             case "maintain_browse_fields":  
                //var_dump($working_arrays[$what_we_are_doing]['from_array']);
                $to_array = $working_arrays[$what_we_are_doing]['to_array'];
                $from_array = $working_arrays[$what_we_are_doing]['from_array'];
                
                //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                $field_name = $working_arrays['remaining_or_selected_groups'][$what_we_are_doing];
                switch ($coming_from) {
                case 'select_fields':
                        //var_dump($coming_from);
                        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                        break;
                case 'reportDefMenuEdit':

                    return view($this->model_table.'.select_fields'    ,compact('miscThing'))
                        ->with('request'                            ,$request->input('encoded_record'))
                        ->with('what_we_are_doing'                  ,$what_we_are_doing)
                        ->with('report_definition_id'               ,$id)
                        ->with('field_name'                         ,$field_name)            
                        ->with('from_array'                         ,$from_array)
                        ->with('to_array'                           ,$to_array)
                        ->with('node_name'                          ,$this->node_name)
                        ->with('model'                              ,$this->model)
                        ->with('model_table'                        ,$this->model_table)
                        ->with('message',''
                        );
                    $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

                    } // coming_from
                    break;  
            case "maintain_query_joins":
                    break;  
            case "ppv_define_business_rules":
                break;
            case "ppv_define_query":
                //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                //var_dump($working_arrays['ppv_define_business_rules']['field_name_array']);
                switch ($what_we_are_doing) {
                    case 'ppv_define_query':
                        $just_the_names_array = 
                            json_encode($working_arrays['ppv_define_query']['field_name_array']);
                        break;
                    case 'ppv_define_business_rules':
                         $just_the_names_array = 
                         json_encode($working_arrays['ppv_define_business_rules']['field_name_array']);
                        break;
                 }
                var_dump($just_the_names_array );$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                $column_names_array = 
                    (array) $this->MyWorkingArray->build_column_names_array($this->model_table);
                $field_name_array_name = ($working_arrays[$what_we_are_doing]['field_name_array']['field_name']);
                //echo("rows ".$field_name_array_name);
                $no_of_rows = count($working_arrays [$what_we_are_doing]['data'][$field_name_array_name]);
                
                $blade_routine                          = "ppv_edit_snippet_gen";
                $blade_name                             = "_ppv_edit_snippet";
                $filename = $this->views_files_path."/".$this->generated_files_folder."/".$id.$blade_name.'.blade.php';
                echo("<br/>did not write ".$filename.' name> '.$blade_name.' routine> '.$blade_routine);
                //* FIle
 //               File::put($filename,$this->$blade_routine($no_of_rows));
                //*
         
     
                //var_dump($working_arrays[$what_we_are_doing]);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                //var_dump($working_arrays[$what_we_are_doing]['lookups']);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                $this->debugx('0100',__FILE__,__LINE__,__FUNCTION__);
                $column_names_array = $working_arrays[$what_we_are_doing]['lookups']['field_name'];
                //$column_names_array = array_combine(array_values($column_names_array),$column_names_array);

                // **********************
                //$field_name_array_name  =                 ($working_arrays[$what_we_are_doing]['field_name_array']['field_name']);
                $field_name_array       = 
                    ($working_arrays[$what_we_are_doing]['lookups']['field_name']);
                //$field_name_array       =                ($working_arrays[$what_we_are_doing]['field_name_array']['field_name']);
                //$r_o_array_name         =                 ($working_arrays[$what_we_are_doing]['field_name_array']['r_o']);
                //var_dump($working_arrays[$what_we_are_doing]);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                $r_o_array =  $working_arrays[$what_we_are_doing]['lookups']['r_o'];
                //$r_o_array = $working_arrays[$what_we_are_doing][$r_o_array_name];
                //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                //$working_arrays[$what_we_are_doing]['lookups'][1] = array_combine(                $working_arrays[$what_we_are_doing]['lookups'][1],                $working_arrays[$what_we_are_doing]['lookups'][1]);
               //$this->debug_exit(__FILE__,__LINE__,10);
               $value_array_name       = 
                    ($working_arrays[$what_we_are_doing]['field_name_array']['value']);
                $value_array            = 
                    ($working_arrays[$what_we_are_doing][$value_array_name]);
                // ***************
                return view($this->model_table.".ppv_update"    ,compact('miscThing'))
                    ->with('what_we_are_doing'                  ,$what_we_are_doing)
                    ->with('just_the_names_array'                ,$just_the_names_array)
                    ->with('report_definition_id'               ,$id)

                    ->with('id'                                 ,$id)
                    ->with('request'                            ,$request)
                    ->with('first_lookup_array'                 ,$working_arrays[$what_we_are_doing]['lookups'][0])
                    ->with('second_lookup_array'                ,$working_arrays[$what_we_are_doing]['lookups'][1])
                    ->with('field_name_array'                   ,$field_name_array)
                    ->with('r_o_array'                          ,$r_o_array)
                    ->with('value_array'                        ,$value_array)
                    ->with('generated_files_folder'             ,$this->generated_files_folder)
                    ->with('coming_from'                        ,$coming_from)
                    ->with('node_name'                          ,$this->node_name)
                    ->with('model_table'                        ,$this->model_table)
                    ->with('message'                            ,'')
                    ;
                    break;
            }
        //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);

       return view($this->node_name.'.reportDefMenuEdit',compact('miscThing'))
        ->with('id'                                 ,$id)
        ->with('report_definition_id'               ,$this->report_definition_id)
        ->with('model'                              ,$this->model)
        ->with('node_name'                          ,$this->node_name)
        ->with('what_we_are_doing'                  ,'updating_report_name')
        ->with('coming_from'                        ,$coming_from)
       ;
    }


    /**
     * 4 functions maintain 4 entities
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */




    // clone_file_snippets($from_id,$newest_id);
 
    public function partial_folder_clone_w_scanrepl($from_folder,$to_folder,$from_string_array,$to_string_array,$displayYN) {
        //* *************
        // it's partial because we only grab it if the report_key in from_string_array is found in the name 
        //  
        //var_dump($from_string_array);
        //var_dump($to_string_array);
        //echo(" **** "." from_folder ".$from_folder." **** "." to_folder ".$to_folder." **** ");$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        if ($handle = opendir($from_folder)) {
             /* This is the correct way to loop over the directory. */
            while (false !== ($file_name = readdir($handle))) {
                     //echo ("<br>".$to_string_array['report_id']);
                $i1 = stripos( "*".$file_name , strval($from_string_array['report_id']));
                if ($i1 == 1){
                    $file_as_string = file_get_contents( $from_folder.'/'.$file_name);
                    //$file_as_string = $this->scan_replace_str_value_arrays($file_as_string,$from_string_array,$to_string_array,'y');
                    $i2 = strlen(strval($from_string_array['report_id']));
                   //echo('xxx'.$file_name.'xxx');
                    //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                    //var_dump($to_string_array);//var_dump($from_string_array);
                    $new_file_name = $to_folder.'/'.$to_string_array['report_id'].substr($file_name,$i2);
                    //echo('file_name '.$file_name.'new_file_name '.$new_file_name);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                    File::put($new_file_name, $file_as_string);

                    //echo("<br>".$new_file_name." was created ");
                }
             }
        }
    }


    public function rrmdir($dir) {
       if (is_dir($dir)) {
         $objects = scandir($dir);
         foreach ($objects as $object) {
           if ($object != "." && $object != "..") {
             if (filetype($dir."/".$object) == "dir") $this->rrmdir($dir."/".$object); else unlink($dir."/".$object);
           }
         }
         reset($objects);
         rmdir($dir);
       }
    } 
     public function scan_replace_str_value_arrays($search_string,$search_str_array,$value_str_array,$displayYN){
        foreach ($search_str_array as $entity=>$search_str) {
            if ($displayYN == 'y'){
               //echo("<br> ".$search_str_array[$entity] ." will be replaced by ". $value_str_array[$entity])."*";
               $displayYN = 'n';
            }
             $search_string = str_ireplace ($search_str_array[$entity], $value_str_array[$entity] , $search_string);
        }  
        return  $search_string;       
     }



    public function show(REQUEST $request,$id)
    {
        $requestFieldsArray=$request->all(); // important!!
        var_dump($requestFieldsArray);
        echo("who sent us here". " show ".$id); $this->debug_exit(__FILE__,__LINE__,10);

    }


    public function simple_data_connection_query_by_key($key_field_value,$type) {
        //echo("simple_data_connection_query_by_key *".$key_field_value."*".$type."*");
        //echo($this->key_field_name);$this->debug_exit(__FILE__,__LINE__,1);
        if ($db_result = DB::connection($this->db_data_connection)->table($this->model_table)
        ->where($this->key_field_name ,'=',$key_field_value)
        ->get()) {
            switch ($type) {
                case 'obj':
                    return $db_result;
                    break;
                case 'array':
                    return $db_result = json_decode(json_encode($db_result),1);
                    break;
                default:
                    return $db_result;
                    break;
            }
        }
        else{
            echo($this->db_data_connection." * ".$this->model_table." * ".$this->key_field_name." * ".$key_field_value);
            $this->debug_exit(__FILE__,__LINE__,1);
        }

    }   

    public function store(REQUEST $request) {
        //$this->debug1(__FILE__,__LINE__,__FUNCTION__);
        //var_dump($request->input('encoded_business_rules'));
        $requestFieldsArray     = $request->all(); // important!!
        $validation_array       = (array) json_decode($request->input('encoded_business_rules'));
        $modifiable_fields_array = (array) json_decode($request->input('modifiable_fields_array'));
        var_dump($modifiable_fields_array); $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        unset($modifiable_fields_array['id']);
        
        
        $new_values_array = array(
            'model'         => $link_parms_array['model'],
            'node_name'     => $link_parms_array['node_name'],
            'table_name'    => $link_parms_array['node_name']
            );
        $array1 = array_intersect_key($requestFieldsArray,$modifiable_fields_array);
        $array3 = array_intersect_key($new_values_array,$modifiable_fields_array);
        $array2 = array_merge($array1,$array3);
        $this->validate($request,$validation_array);
        $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
       
        //$new_id = $this->clone_id_to_node($requestFieldsArray['id'],$array2, $new_values_array['node_name'],$from_folder,$to_folder);
        //$this->debug_exit(__FILE__,__LINE__,10);

        $snippet_file = $this->node_name."/".$this->generated_files_folder."/".$this->report_definition_id.
        '_modifiable_fields_add.blade.php';
        //File::put($snippet_file,$this->$blade_routine($no_of_rows));
        $report_definition = 
        $this->execute_query_by_report_no($this->report_definition_id) ;
        $encoded_business_rules     = $report_definition[0]->business_rules;
        $modifiable_fields_array    = (array) json_decode($report_definition[0]->modifiable_fields_array);
        $snippet_file ="../".$this->node_name.'/'.$this->generated_files_folder.'/'.
        $this->report_definition_id.'_modifiable_fields_add';  

        unset($modifiable_fields_array['id']);
        //var_dump($array3);var_dump($modifiable_fields_array);$this->debug_exit(__FILE__,__LINE__,10);
        $this->blade_gen_simple_add($this->report_definition_id,$modifiable_fields_array);

        return redirect()->route($new_values_array['node_name'].'.indexReports',[
            'id' => $new_id,
            'reportDefinitionKey'=>$requestFieldsArray['report_definition_id']
            ]);

        //return redirect('admin/miscThings');
    }


    public function stor_w_rules_array(REQUEST $request) {
        echo('stor_w_rules_array');
        $this->debug_exit(__FILE__,__LINE__,10);
        $validation_array = json_decode($encoded_business_rules);
        $modifiable_fields_array = json_decode($modifiable_fields_array);
        //$requestFieldsArray=$request->all(); // important!!
        $this->validate($request,$validation_array);
        $updatex  = DB::connection($this->db_snippet_connection)->table($this->model_table)->insert($modifiable_fields_array);

        $miscThing=$request->all(); // important!!
        MiscThing::create($miscThing);
        return redirect('admin/miscThings');
    }


    public function just_the_ones_we_want(REQUEST $request,$encoded_business_rules) {
        echo('just_the_ones_we_want');
        $this->debug_exit(__FILE__,__LINE__,10);
        $validation_array = json_decode($encoded_business_rules);
        //$requestFieldsArray=$request->all(); // important!!
        $this->validate($request,$validation_array);
        $updatex  = DB::connection($this->db_snippet_connection)->table($this->model_table)->insert($modifiable_fields_name_values);

        $miscThing=$request->all(); // important!!
        MiscThing::create($miscThing);
        return redirect('admin/miscThings');
    }

    public function updateGetRedirect($key_field_name,$id,$requestFieldsArray,$request,$what_we_are_doing){
        $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        // miscThings uses it's own 2018-09-01
        //$requestFieldsArray=$request->all(); // important!!
        var_dump($requestFieldsArray);
            
            $miscThing = MiscThing::where($key_field_name,  '=', $id)
            ->update($requestFieldsArray);
            $miscThing = MiscThing::where($key_field_name,  '=', $id)
            ->get();
            return($miscThing);
    }


    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idInput
     * @return \Illuminate\Http\Response
     */
    public function update(REQUEST $request, $id)
    {
        //* *********************
        // the request has every field we need but many we dont
        // running array_intersect_key against an array of the fields we want
        // will return an array of ONLY the data we want from the request
        // **********************
        
        
        $requestFieldsArray=$request->all();
        //var_dump($requestFieldsArray);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        if (!array_key_exists('what_we_are_doing',$requestFieldsArray)) {
           $requestFieldsArray['what_we_are_doing'] = 'updating_report_name';
         }
        $what_we_are_doing = $requestFieldsArray['what_we_are_doing'] ;

        if (array_key_exists('coming_from',$requestFieldsArray)) {
           $coming_from = $requestFieldsArray['coming_from'] ;
         }
         else{
            $coming_from = 'coming_from';//$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
         }
        
        $update = 0;  
        //var_dump ($requestFieldsArray) ;
        //var_dump($requestFieldsArray);$this->debug_exit(__FILE__,__LINE__,10);
        //var_dump($requestFieldsArray['encoded_modifiable_fields_array']);$this->debug_exit(__FILE__,__LINE__,10);
        switch ($what_we_are_doing) {
          
           case "editUpdate":
                $update = 1;
                // this is the guy that needs validation
                $just_the_ones_we_want = array_flip((array) json_decode($requestFieldsArray['encoded_modifiable_fields_array']));
                
                //var_dump($just_the_ones_we_want);$this->debug_exit(__FILE__,__LINE__,10);
                 break; 
             case "updating_report_definition":
                break; 
            case "updating_report_name":
               $update = 1; 
               $requestFieldsArray['just_the_names_array'] = array('report_name');
         
                $just_the_ones_we_want = $requestFieldsArray['just_the_names_array'] ;
                $just_the_ones_we_want = array_flip($just_the_ones_we_want);
                break;  

           case "maintain_query_joins":
                //this is supposed to be a database field
                $update = 1; 
                //var_dump($requestFieldsArray['field_name_array']);$this->debug_exit(__FILE__,__LINE__,10);
                //var_dump($requestFieldsArray);$this->debug_exit(__FILE__,__LINE__,10);
                $requestFieldsArray['maintain_query_joins'] = 
                json_encode(array_combine($request->to,$request->to));
                //* ******************
                $objectOrArray = "array";
                $this->blade_gen_browse_select($id,$objectOrArray);
                $just_the_ones_we_want = array(
                    'maintain_query_joins'=> 'maintain_query_joins'
                    );
                break;  

           case "maintain_modifiable_fields":
                $update = 1; 
                //var_dump($requestFieldsArray['field_name_array']);$this->debug_exit(__FILE__,__LINE__,10);
                //var_dump($requestFieldsArray);$this->debug_exit(__FILE__,__LINE__,10);
                $requestFieldsArray['modifiable_fields_array'] = 
                json_encode(array_combine($request->to,$request->to));
                //* ******************
                $objectOrArray = "array";
                $this->blade_gen_browse_select($id,$objectOrArray);
                $just_the_ones_we_want = array(
                    'modifiable_fields_array'=> 'modifiable_fields_array'
                    );
                break;  

            case "maintain_browse_fields":           
                $update = 1; 
                $requestFieldsArray['browse_select_array'] = 
                json_encode(array_combine($request->to,$request->to));
                $objectOrArray = "array";
                $this->blade_gen_browse_select($id,$objectOrArray);
                $just_the_ones_we_want = array('browse_select_array'=> 'browse_select_array');
                break;  
            case "ppv_define_query":
                $update = 1; 
                $new_r_o_array = $request->r_o_array;
                if(is_numeric($request->r_o_array[0])){
                    $new_r_o_array = array();
                    $query_relational_operators_array = $this->build_query_relational_operators_array();
                    foreach ($request->r_o_array as $index=>$value){
                        $new_r_o_array[] =
                        $query_relational_operators_array[$value];
                    }
                }
                $requestFieldsArray = array(
                    'query_field_name_array'    => json_encode($request->field_name_array),
                    'query_r_o_array'           => json_encode($new_r_o_array),
                    'query_value_array'         => json_encode($request->value_array)
                    );
                $just_the_ones_we_want = $requestFieldsArray;

                break;  
            case "ppv_define_business_rules":
                echo(__FILE__.__LINE__.'<br>');//exit();
                $update = 1; 
                //var_dump($request);//var_dump($working_arrays);
 

                $requestFieldsArray['business_rules']             = 
                $this->build_validation_array(
                    $this->build_business_rules_relational_operators(),
                    $request->field_name_array,
                    $request->r_o_array,
                    $request->value_array);
                var_dump($requestFieldsArray);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                $business_rules = $requestFieldsArray['business_rules'];
                $request->business_rules = 
                    json_encode($requestFieldsArray['business_rules']);
                $requestFieldsArray['business_rules'] = 
                    json_encode($requestFieldsArray['business_rules']);
                $requestFieldsArray['business_rules_field_name_array']    = 
                    json_encode($request->field_name_array);
                $requestFieldsArray['business_rules_r_o_array'] = 
                    json_encode($request->r_o_array);
                $requestFieldsArray['business_rules_value_array'] = 
                    json_encode($request->value_array);


                $just_the_ones_we_want = (array) json_decode($requestFieldsArray['just_the_names_array']);
                $just_the_ones_we_want = array_flip($just_the_ones_we_want);
                 //echo(' array_intersect_key($requestFieldsArray,$arr2 ' );var_dump($arr2);            $this->debug_exit(__FILE__,__LINE__,10);
                break;  
        } 
        //$requestFieldsArray=$request->all(); // create an array of all fields on the form
        //$this->debug_exit(__FILE__,__LINE__,1);echo('update id: '.$id);
        // ******
       // update
       // ******
        if ($update){  
            $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
            $requestFieldsArray = array_intersect_key($requestFieldsArray,
            $just_the_ones_we_want);
            //var_dump($request);$this->debug_exit(__FILE__,__LINE__,10);
            //$validation_array = json_decode($encoded_business_rules);
            switch ($request->what_we_are_doing) {
             case "editUpdate":
                // this is the guy that needs validation
                $rules_array =  (array) json_decode($request->encoded_business_rules);
                //var_dump($rules_array);
                //$this->debug_exit(__FILE__,__LINE__,10);
                $this->validate($request,$rules_array);
                //var_dump($just_the_ones_we_want);//var_dump($request);
                //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                break; 
            }
            
            var_dump($what_we_are_doing);
            $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
            $this->updateGetRedirect($this->key_field_name,$id,$requestFieldsArray,$request,$what_we_are_doing);
// No!!!

            //var_dump($coming_from);var_dump($what_we_are_doing);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
            switch ('k'.$what_we_are_doing) {
                case 'maintain_modifiable_fields':
                case 'maintain_browse_fields':
                    switch ($coming_from) {
                        case 'select_fields':
                            echo($id);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                            $miscThing = $this->execute_query_by_report_no($this->report_definition_id) ;
                            //var_dump($coming_from);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                           return view($this->node_name.'.reportDefMenuEdit',compact('miscThing'))
                            ->with('id'                    ,$id)
                            ->with('report_definition_id'  ,$this->report_definition_id)
                            ->with('model'                 ,$this->model)
                            ->with('node_name'             ,$this->node_name)
                            ->with('what_we_are_doing'     ,'updating_report_name')
                            ->with('coming_from'           ,$coming_from)
                           ;
                            break;
                        }
                case "ppv_define_query":
                case "ppv_define_business_rules":
                    switch ($what_we_are_doing) {
                        case 'ppv_define_query':
                            echo($coming_from.$id);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                            $miscThing = $this->execute_query_by_report_no($this->report_definition_id) ;
                            var_dump($coming_from);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                           return view($this->node_name.'.reportDefMenuEdit',compact('miscThing'))
                            ->with('id'                    ,$id)
                            ->with('report_definition_id'  ,$this->report_definition_id)
                            ->with('model'                 ,$this->model)
                            ->with('node_name'             ,$this->node_name)
                            ->with('what_we_are_doing'     ,'updating_report_name')
                            ->with('coming_from'           ,$coming_from)
                           ;
                            break;
                        }

                    var_dump($coming_from);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                   return redirect()->route('miscThings.browseEdit', 
                        ['id' => $request['report_definition_key'],
                        'what_we_are_doing' => 'what_we_are_doing',
                        'coming_from' => 'editUpdate'
                        ]);
                    break;
 
                default:
                    var_dump($coming_from);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                          return view($this->node_name.'.reportDefMenuEdit',compact('miscThing'))
                            ->with('id'                    ,$id)
                            ->with('report_definition_id'  ,$this->report_definition_id)
                            ->with('model'                 ,$this->model)
                            ->with('node_name'             ,$this->node_name)
                            ->with('what_we_are_doing'     ,'updating_report_name')
                            ->with('coming_from'           ,$coming_from)
                           ;
                 
                    return redirect()->route('miscThings.browseEdit', 
                        ['id' => $request['report_definition_key'],
                        'what_we_are_doing' => 'what_we_are_doing',
                        'coming_from' => 'editUpdate'
                        ]);
                    break;
                }
 
            }
        if (!$update) {

            var_dump($requestFieldsArray);$this->debug_exit(__FILE__,__LINE__,10);
            if ((isset($request->what_we_are_doing)&&$request->what_we_are_doing == 'updating_data_record') ){
                $business_rules = json_decode($requestFieldsArray['wxyz'],1 );
                var_dump($business_rules);$this->debug_exit(__FILE__,__LINE__,0);
                $modifiable_fields_array = json_decode($request->encoded_modifiable_fields_array,1);
                $modifiable_fields_name_values = array_intersect_key($requestFieldsArray, $modifiable_fields_array);
                unset($modifiable_fields_name_values[$this->snippet_table_key_field_name]);
                $requestFieldsArray=$request->all(); // important!!
                $this->validate($request, $business_rules);
                 // valid past here
                $update = 0; 
                $this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
                    $miscThingsings=MiscThing::find($id);
                    $miscThingsings->update($modifiable_fields_name_values);
                    return redirect('admin/miscThings')
                       ->with('message'      , 'ok ');
            }
        }

                return redirect('admin/miscThings')
                ->with('message'      , 'record updated ');
    }

    //
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function xdestroy(REQUEST $request, $id)
    {
         $this->debug_exit(__FILE__,__LINE__);

        $this->authorize('destroy', $MiscThing);

        $MiscThing->delete();

        //return redirect('/tasks');
        return;

    }



    public function destroy(REQUEST $request, $id) {
       //echo($id.$this->snippet_node_name);$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
        $requestFieldsArray=$request->all();
        var_dump($requestFieldsArray) ;
        $what_we_are_doing = $requestFieldsArray['what_we_are_doing'];
        $coming_from = $requestFieldsArray['coming_from'];
        $coming_from_node = $requestFieldsArray['coming_from_node'];

        switch ($what_we_are_doing) {
        case 'delete_report':
            switch ($coming_from) {
            case 'indexReports':
            //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
                $update_option = "remove_broken_links";
                $view_variables_array = $this->clean_orphan_files($coming_from_node,$update_option);  //2parms
                //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
            break;
            }
        break;
        }
        $file = MiscThing::where('id', $id)->first(); // File::find($id)
        if($file) {
            //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
            //$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
            $file->delete();
            //$this->debugx('1111',__FILE__,__LINE__,__FUNCTION__);
            $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
            return redirect()->route($coming_from_node.'.indexReports',[
            'id' => $requestFieldsArray['report_definition_id'],
            'reportDefinitionKey'=>$requestFieldsArray['report_definition_id']
            ]);
            $this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
        }

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
