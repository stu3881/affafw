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

use DB;
//use App\Http\Controllers\Schema;

class ProgrammerUtilitiesController extends CRHBaseController
{
        public function __construct(
     
        /**/
        $buttons_in_front               = "",
        $print_orientation              = "",
        $record_type                    = "table_controller", 
        //$db_connection_name             = "blues_main", 
        $db_connection_name             = "", 
        $db_snippet_connection          = "",
        $db_data_connection             = "",
        //$db_snippet_connection          = "",
        $controller_name                = "ProgrammerUtilitiesController", 
        $no_of_blank_entries            = "5", 
        $model                          = "MiscThing", 
        $node_name                      = "programmerUtilities", 
        $report_definition_model_name   = "Report_Definition_Model",


        $model_table                    = "miscThings", 
        $snippet_table                  = "miscThings", 
        $snippet_node_name               = "miscThings", 
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
        $report_definition_id               = 0,
        $store_validation_id                = 0,
        $business_rules_array               = 0,
        $link_parms_array                   = array(),
        $link_strings                       = array(),
        $link_parameters                    = array()

        ) 
        {
        
        parent::__construct();
        //$this->debug_exit(__FILE__,__LINE__,0); echo(" entering constructor");

        //$snippet_table = "miscThings";
        //$defaultConnection = "localhost_stu3881_main";
        //$queryx = $this->get_db_connection_data($snippet_table,$defaultConnection);

        //$this->beforeFilter('csrf', array('on'=>'post'));
        //$this->beforeFilter('admin');

        $this->link_strings = array(
            'tdBegin'   =>"<td class='text_align_left select_red' >",
            
            'link1of4' =>"<a href=\"{{ URL::route(",
            'link2of4' =>"$".'node_name',
            'link3of6' =>".",
            'link4of6' =>"",
            'tdEnd'     =>"</td>"
             );

        $this->link_parameters = array(
            'what_we_are_doing' =>'activating_controller',
            'coming_from'       =>'dynamicMenu0'
            );
         $this->myStrings = array(
            'tdBegin'           =>"<td class='text_align_left select_pink' >",
            'tdEnd'             =>"</td>",
            'linkStrA'          =>"<a href= \"",
            'linkStrC'          =>"\" class='btn mycart-btn-row2'>",
            'linkEnd'           =>'</a>'
            );
      

        $this->db_connection_name              = $db_connection_name;
        $this->db_data_connection              = $db_data_connection;
        $this->db_snippet_connection           = $db_snippet_connection;
        //$this->db_snippet_connection           = "";
       
        $this->model                            = $model;
        $this->model_table                      = $model_table;
        $this->snippet_table                    = $snippet_table;
        $this->snippet_table_key_field_name     = $snippet_table_key_field_name;
        $this->node_name                        = $node_name ;
        $this->snippet_node_name                = $snippet_node_name;
        $this->link_parms_array                 = $this->derive_entity_names_from_table($this->snippet_node_name);

        $this->report_definition_model_name     = $report_definition_model_name;
        //* $this->report_definition_id is the same for all tables
        //* because their node_names change, we need to define where this is
        $this->report_definition_id             =  $this->get_report_definition_id(
            'report_definition',
            $this->snippet_node_name,
            $this->report_definition_model_name
            );



        $this->backup_node                      = $backup_node;
        $this->generated_files_folder           = $generated_files_folder;
        $this->key_field_name                   = $key_field_name;
        $this->bypassed_field_name              = $bypassed_field_name;     
        $this->no_of_blank_entries              = $no_of_blank_entries;

         $this->key_field_array      = array($this->snippet_table_key_field_name=>$this->snippet_table_key_field_name);
        $this->make_sure_table_snippet_exists($this->model_table);
        //$this->debug_exit(__FILE__,__LINE__,0);
        $this->generated_snippets_array        = $this->get_generated_snippets();

       //config
        $this->database_connection_config_path = substr(app_path(),0,strlen(app_path())-4)."/config/";
        
        //controllers
        $node =  "controllers";
         $this->stored_connections_path = substr(app_path(),0,strlen(app_path())-4).'/storage/connections/'. $this->db_connection_name ;

        $this->my_ctr = $my_ctr;
        //routes

        // Automatically adjuested strings begin here  (dont change or remove line)  
        //* everything between here (dont change or remove line) 


        //* and here is generated automatically when file is created (dont change or remove line) 
        // these are derived
 
        $this->view_files_prefix                = $this->views_files_path;
        $this->key_field_array                  = array($this->snippet_table_key_field_name=>$this->snippet_table_key_field_name);
        $this->key_field_name_array             = array($this->snippet_table_key_field_name=>$this->snippet_table_key_field_name);
        $this->make_sure_table_snippet_exists($this->model_table);
        //$this->debug_exit(__FILE__,__LINE__);
        $this->generated_snippets_array         = $this->get_generated_snippets();
        // generated_snippets are arrays that are generated when the properties

       
         //$this->store_validation_id         = $this->report_definition_id;
        //$this->store_validation_id          = $this->report_definition_id;
       


        //$this->required_fields_array            = $this->generated_snippets_array['required_fields_array'];
        //echo $this->view_files_prefix ;exit ("exit in constructor");

    }  // end construct

      /**
     * Execute the query and show the report you just requested
     *
     * @return \Illuminate\Http\Response
     */


 
    public function anchor_boundaries_insert_replace($file_as_string,$insert,$anchor,$boundary_start,$boundary_stop){
        //!! we may want to include or not include boundary start & stop strings
        // currently we strip them both.  if you want them, put them in the insert
        //
        //echo('anchor_boundaries_insert_replace');
        // this looks for the boundary start and stop strings and replaces what's in between them with $insert
        // if they don't exist, we create the boundary strings and wrap them around insert
        // and insert them immediately after the anchor string
        //echo ("length ".strlen($file_as_string));
        //echo("80:".substr($file_as_string,0,80));
        $crlf = "\r\n";
        $needle = $boundary_start;
        $i0 = stripos($file_as_string,$needle);
        //echo "***".$i0."***".$file_as_string."***".$needle."***";exit('4629');
        if ($i0 > 0){
            //echo('found existing node'.$i0);//exit('2809');
            $i1 = strlen($needle);
            $s1 = substr($file_as_string,0,$i0-1).$crlf;
            $needle = $boundary_stop;
            $i0 = stripos($file_as_string,$needle);
            if ($i0 > 0){
                //echo('found end node'.$i0);exit('2809');
                $i1 = strlen($needle);
                //$s2 = $crlf.$boundary_stop.$crlf.substr($file_as_string,$i0+$i1);
                $s2 = $crlf.substr($file_as_string,$i0+$i1);
            }
            else{
                exit("<br>we should have found ".$needle." but didnt<br>".$file_as_string."didnt find boundary stop 5056 ");
            }
        }
        else{  //fist time for this controller so we need to find the anchor
            $needle = $anchor;
            $i0 = stripos($file_as_string,$needle);
            if ($i0 > 0){
                $i1 = strlen($needle);
                //$s1 = substr($file_as_string,0,$i0-1).$crlf;
                //$s1 = substr($file_as_string,0,$i0+$i1).$crlf.$boundary_start.$crlf;
                $s1 = substr($file_as_string,0,$i0+$i1).$crlf;
                $s2 = $crlf.substr($file_as_string,$i0+$i1);
                //echo '*$s1*'.$s1.$model_route_as_string.'$s2'.$s2."***";exit('4650');
            }
            else {
                echo ("fatal error no anchor".$needle."<br>***<br>".$file_as_string."<br>***<br>");exit('<br>4653');
            }
    
        }
        //echo "<br>all three<br>".$s1.$insert.$s2;exit('<br> 4650');
        //echo($s1.$insert.$s2);
        //exit('<br>4653');
        return $s1.$insert.$s2;

    }






     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mainMenu(REQUEST $request,$id,$report_definition_id) {
        //$this->debug_exit(__FILE__,__LINE__,0);echo('mainMenu');
        $main_menu_array = $this->define_main_menu_links();
        $method_parameters_array = $this->define_method_parameters($main_menu_array);
        
        $encoded_method_parameters_array = array();

        $parm1_array = array();
        $parm2_array = array();
        $parm2_array[0] = 'coming_from_programmer_utilities';
        //$parm2_array[20] = 'coming_from_programmer_utilities';

        foreach ($main_menu_array as $option=>$method) {
           $encoded_method_parameters_array[$option][] = $method_parameters_array[$option]['dynamic_method'];
           $encoded_method_parameters_array[$option][] = json_encode($method_parameters_array[$option]);
           //$parm1_array[$option]['parm0'] = $method_parameters_array[$option]['dynamic_method'];
           //$parm1_array[$option]['parm1'] = $method_parameters_array[$option]['dynamic_method'];
           $parm1_array[$option] =  $option;
           //$parm2_array[$option] =  $encoded_method_parameters_array[$option][1];

        }
        //var_dump($parm2_array);
        //$this->debugx('1101',__FILE__,__LINE__,__FUNCTION__);

       //$encoded_method_parameters_array = json_encode($encoded_method_parameters_array);

        return view($this->node_name.'/programmerUtilitiesMenu')
            ->with('menu_array'                 ,$main_menu_array)
            ->with('encoded_method_parameters_string'  , json_encode($encoded_method_parameters_array))
            //->with('method_parameters_array'    ,$decoded_array);
            ->with('node_name'                  ,$this->node_name)
            ->with('method_parameters_array'    ,$method_parameters_array)
            ->with('parm1_array'                ,$parm1_array)
            ->with('parm2_array'                ,json_encode($parm2_array))
            ->with('request'                    ,$request)

            ;
    }
 
     public function define_main_menu_links() {
        // these menu entries are defiend on an adhoc basis
        $main_menu_array = array(
            'configure_an_unconfigured_table'       =>'generic_method_request_2parms',
            'activate_deactivate_table_reporting'   =>'generic_method_request_2parms',
            'reports_with_broken_links'             =>'generic_method_request_2parms',
        );

       return $main_menu_array;
    }

    public function define_method_parameters($main_menu_array) { 
        // initially, these are all the same but as the routines are refined
       //var_dump($main_menu_array);$this->debug1(__FILE__,__LINE__,__FUNCTION__);

        // i create an array for each menu option$
        // the omly field which must be defined is 'what_are_we_doing'
        // ********
        // we need to create an array with 2 entries.one is the first level nagivation,
        // the second is a json encoded string that we can use to pass data back to 
        //*********
        $method_parameters_array = array();
        $decoded_array = array();
        foreach ($main_menu_array as $option=>$method) {
            $method_parameters_array[$option]['actual_method']     = 'generic_method_request_2parms';
            //$method_parameters_array[$option]['actual_method']     = 'generic_method_request_1parm';
            switch ($option) {
                case "configure_an_unconfigured_table":
                    $method_parameters_array[$option]['dynamic_method']         = $option;
                    $method_parameters_array[$option]['what_are_we_doing']      = $option;
                    $method_parameters_array[$option]['parm1']                  = 'parm1';
                    $method_parameters_array[$option]['parm2']                  = 'parm2';
                    break;
                case "activate_deactivate_table_reporting":
                    $method_parameters_array[$option]['dynamic_method']         = $option;
                    $method_parameters_array[$option]['what_are_we_doing']      = $option;
                    $method_parameters_array[$option]['parm1']                  = 'parm1';
                    $method_parameters_array[$option]['parm2']                  = 'parm2';
                   break;
                case "reports_with_broken_links":
                    $method_parameters_array[$option]['dynamic_method']         = $option;
                    $method_parameters_array[$option]['what_are_we_doing']      = $option;
                    $method_parameters_array[$option]['parm1']                  = 'parm1';
                    $method_parameters_array[$option]['parm2']                  = 'parm2';
                    break;
            }
        } //end foreach
       
       //var_dump($method_parameters_array);$this->debugx('0111',__FILE__,__LINE__,__FUNCTION__);
       //return $method_parameters_array;
       return $method_parameters_array;
    }




   public function build_link_array($aord,$table) {
        
        //$this->debug1(__FILE__,__LINE__,__FUNCTION__);
        switch ($aord) {
        case "deactivate":
            $this->build_link("deactivate",$table);
           break;
        case "activate":
            $this->build_link("activate",$table);
           break;
        }
        //return $link_array;
        }



    public function build_link($aord,$table) {       
        //$this->debug1(__FILE__,__LINE__,__FUNCTION__);
        switch ($aord) {
            case "deactivate":
              break;
            case "activate":
              break;
        }
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


   public function mainMenu_generate_routes_snippet(REQUEST $request,$id,$report_definition_id) {
        $this->debug1(__FILE__,__LINE__,__FUNCTION__);

       $record_type                    = "report_definition";
       $linkx = "xx";

       //$main_menu_array = $this->define_main_menu_links();
       //$method_parameters_array = $this->define_method_parameters($main_menu_array);

        return view($this->node_name.'.programmerUtilitiesMenu',$main_menu_array)
            ->with('menu_array'               ,$main_menu_array)
            ->with('method_parameters_array'  ,$method_parameters_array)

            ;
        }

     public function make_sure_table_controller_has_views_folder($extended_app_path,$field_names,$field_values){
        if (!File::isDirectory($extended_app_path."/views")) {
            File::makeDirectory($extended_app_path."/views");
        }
        if (!File::isDirectory($extended_app_path."/views/".$field_values['model_table'])) {
            echo $extended_app_path."/views/".$field_values['model_table'];//exit("tty");
            File::makeDirectory($extended_app_path."/views/".$field_values['model_table'],0777);
            File::makeDirectory($extended_app_path."/views/".$field_values['model_table']."/generated_files",0777);
                    
            $infile = $this->storage_path."/baselines_for_generated_code/baseline_views_folder/baseline_view_pointers";
            $outfile = $extended_app_path."/views/".$field_values['model_table'];
            File::copyDirectory($infile,$outfile);
             
            $infile = $this->storage_path."/baselines_for_generated_code/views/miscThings/generated_files";
            $outfile = app_path()."/views/".$field_values['model_table']."/generated_files";
            File::copyDirectory($infile,$outfile);
        }               
                
        
        return ;
    }

    
    public function mkdir_r($start_node,$dirName,$rights){
        $dirs = explode('/', $dirName);
        $dir=$start_node;
        foreach ($dirs as $part) {
            $dir.=$part.'/';
            if (!is_dir($dir) && strlen($dir)>0){
                mkdir($dir, $rights);
            }
        }
    }
    

    public function maintain_flat_files_for_db_connection($action,$node,$connection_storage_directory,$field_names,$values_array){
        $this->debug0(__FILE__,__LINE__,__FUNCTION__);
        /*
        i know that we must maintain flat files
        */
        //var_dump($field_names);
        //echo("field_names ");var_dump($field_names);
        //exit(" 4530");
        switch ($action) {
            case "table_controller_generators":
                // when a controller definition changes, a subset of what has to be done 
                // for a connection definition is required
                $node = "routes";
                $infile = $this->storage_path."/baselines_for_model_gens/Route.php";
                $insert_string = file_get_contents($infile);
                $insert_string = str_ireplace ('xxx_node_name', $values_array['node_name'] , $insert_string);
                $insert_string = str_ireplace ('xxx_controller_name', $values_array['controller_name'] , $insert_string);
                
                $infile = $this->routes_path."/routes.php";
                $current_routes_file = $this->routes_path."/routes.php";
                $infile = $this->current_routes_file;
                $file_as_string = file_get_contents($infile);
                $file_as_string = $this->anchor_boundaries_insert_replace(
                    $file_as_string,
                    $insert_string,
                    "// Automatically adjuested strings begin here",
                    "// ".$values_array['node_name']." begin_generated_node",
                    "// ".$values_array['node_name']." end_generated_node"
                );
                $outfile = $this->storage_path.'/connections/'.$values_array['db_connection_name']."/routes.php";
                File::put($outfile, $file_as_string);

                //
                $node = "config";
                //
                $node = "models";
                $infile = $this->storage_path."/baselines_for_model_gens/Model.php";
                $file_as_string = file_get_contents($infile);
                $file_as_string = str_ireplace ('$model_table', $values_array['model_table'] , $file_as_string  );
                $file_as_string = str_ireplace ('$model', $values_array['model'], $file_as_string );
                //echo ($file_as_string);
                $output_path_dsn = $this->storage_path.'/connections/'. $values_array['model_table'] .'/models/'.$values_array['model'].'.php';
                File::put($output_path_dsn, $file_as_string);
                //
                $node = "controllers";
                $str = "";
                foreach ($field_names as $field_name){
                    $str .= "$".$field_name.' = "'.$values_array[$field_name].'", ';
                }
                $str = rtrim($str);
                $str = substr($str, 0, -1);
                $infile = $this->storage_path."/baselines_for_model_gens/Controller.php";
                $file_as_string = file_get_contents($infile);
                $file_as_string = str_ireplace ('$controller_name', $values_array['controller_name'] , $file_as_string  );
                $file_as_string = str_ireplace ('//generated_parameter_list', $str , $file_as_string );
                //echo ($file_as_string);
                $output_path_dsn = $this->storage_path.'/connections/'.$values_array['db_connection_name'].'/controllers/'.$values_array['controller_name'].'.php';
                File::put($output_path_dsn, $file_as_string);
                break;
                
            case "initialize":              
                echo ("initialize");//;exit(" 4585");
                // ***************
                $node =  "config";
                    $extended_app_path = $this->storage_path."/connections/".$values_array['db_connection_name'];
                $infile = $this->storage_path."/baselines_for_model_gens/config/database.php";
                $outfile = $this->storage_path."/connections/".$values_array['db_connection_name']."/config/database.php";
                copy($infile,$outfile);
                $file_as_string = file_get_contents($outfile);
                $insert_string = "'default' => '".$values_array['db_connection_name']."',";
                $file_as_string = $this->anchor_boundaries_insert_replace(
                    $file_as_string,
                    $insert_string,
                    "//define_default_connection_anchor",
                    "//default_connection_start",
                    "//default_connection_stop");
                $insert_string = $this->snippet_gen("database_connection",$field_names,$values_array);
                $file_as_string = $this->anchor_boundaries_insert_replace(
                    $file_as_string,
                    $insert_string,
                    "// generated_connections_begin_here",
                    "// ".$values_array['db_connection_name']."_connection_definition_start",
                    "// ".$values_array['db_connection_name']."_connection_definition_stop"
                    );
                //echo ("initialize");exit(" 4606");
                $insert_string = $this->snippet_gen("database_connection",$field_names,$values_array);
                $output_path_dsn = $this->storage_path.'/connections/'.$values_array['db_connection_name']."/config/database.php";
                File::put($output_path_dsn, $file_as_string);
                        // ****************
                // ****************
                $node =  "models";
                $infile = $this->storage_path."/baselines_for_model_gens/Models";
                $outfile = $this->storage_path.'/connections/'.$values_array['db_connection_name']."/models";
                //File::cleanDirectory($outfile);
                File::copyDirectory($infile,$outfile);
                // ****************
                // ****************
                $node =  "controllers";
                $infile = $this->storage_path."/baselines_for_model_gens/baseline_controllers";
                $outfile = $this->storage_path.'/connections/'.$values_array['db_connection_name']."/controllers";
                File::cleanDirectory($outfile);
                File::copyDirectory($infile,$outfile);
                // ****************
                // ****************
                $node =  "routes";
                echo ("init routes file");
                $infile = $this->storage_path."/baselines_for_model_gens/routes.php";
                $file_as_string = file_get_contents($infile);
                $output_path_dsn = $this->storage_path.'/connections/'.$values_array['db_connection_name']."/routes.php";
                $this->add_delete_add_file_as_string($outfile,$file_as_string);
                // ****************
                // **************** "/storage/baselines_for_model_gens/baseline_views_folder/baseline_view_pointers"
                $node =  "views";
                
                $infile = $this->storage_path."/baselines_for_generated_code/baseline_views_folder/baseline_view_pointers";
                $outfile = $this->storage_path.'/connections/'.$values_array['db_connection_name']."/views/miscThings";
                File::copyDirectory($infile,$outfile);
                                   
                $infile = $this->storage_path."/baselines_for_generated_code/views/miscThings/generated_files";
                $outfile = $this->storage_path.'/connections/'.$values_array['db_connection_name']."/views/miscThings/generated_files";
                File::copyDirectory($infile,$outfile);
                //     
                $infile = $this->storage_path."/baselines_for_generated_code/baseline_views_folder/baseline_view_pointers";
                $outfile = $this->storage_path.'/connections/'.$values_array['db_connection_name']."/views/volunteer";
                File::copyDirectory($infile,$outfile);
                $infile = $this->storage_path."/baselines_for_generated_code/views/volunteer/generated_files";
                $outfile = $this->storage_path.'/connections/'.$values_array['db_connection_name']."/views/volunteer/generated_files";
                
                //copy($infile."/*.php",$outfile);
                File::copyDirectory($infile,$outfile);
                break;
            case "update":
                switch ($node) {
                    case "config":
                        $infile = $this->storage_path."/connections/".$values_array['db_connection_name']."/config/database.php";
                        $file_as_string = file_get_contents($infile);
                        $insert_string = "'default' => '".$values_array['db_connection_name']."',";
                        $file_as_string = $this->anchor_boundaries_insert_replace(
                            $file_as_string,
                            $insert_string,
                            "//define_default_connection_anchor",
                            "//default_connection_start",
                            "//default_connection_stop");
                        $output_path_dsn = $this->storage_path.'/connections/'.$values_array['db_connection_name']."/config/database.php";
                        File::put($output_path_dsn, $file_as_string);
                        //define_default_connection_anchor
                        // 
                        break;
                    case "models":
                        $infile = $this->storage_path."/baselines_for_model_gens/Model.php";
                        $file_as_string = file_get_contents($infile);
                        $file_as_string = str_ireplace ('$model_table', $values_array['model_table'] , $file_as_string  );
                        $file_as_string = str_ireplace ('$model', $values_array['model'], Input::get('') , $file_as_string );
                        //echo ($file_as_string);
                        $output_path_dsn = $this->storage_path.'/connections/'. $values_array['model_table'] .'/models/'.$values_array['model'].'.php';
                        File::put($output_path_dsn, $file_as_string);
                        break;
                    case "controllers":
                        $str = "";
                        foreach ($values_array_array as $name=>$value){
                            //echo $name. " * ".Input::get($value);
                            $str .= "$".$name.' = "'.Input::get($value).'", ';
                        }
                        $str = rtrim($str);
                        $str = substr($str, 0, -1);
                        //echo "<br><br>*".$str."*";
                        $infile = $this->storage_path."/baselines_for_model_gens/Controller.php";
                        $file_as_string = file_get_contents($infile);
                        $file_as_string = str_ireplace ('$controller_name', Input::get('controller_name') , $file_as_string  );
                        $file_as_string = str_ireplace ('//generated_parameter_list', $str , $file_as_string );
                        //echo ($file_as_string);
                        $output_path_dsn = $this->storage_path.'/connections/'.$values_array['db_connection_name'].'/controllers/'.$values_array['controller_name'].'Controller.php';
                        File::put($output_path_dsn, $file_as_string);
                        break;
                    case "routes":
                        break;
                }
                break;
            case "update_table_controller":
                echo("update_table_controller ".$node);//exit("exit 4737");
                switch ($node) {
                    case "views":
                        $extended_app_path = $this->storage_path.'/connections/'.$values_array['db_connection_name'];
                        $this->make_sure_table_controller_has_views_folder($extended_app_path,$field_names,$values_array);
                        $extended_app_path = app_path();
                        $this->make_sure_table_controller_has_views_folder($extended_app_path,$field_names,$values_array);
                        break;
                    case "config":
                        echo("config");//exit("exit 4789");
                        
                        break;
                    case "models":
                        $infile = $this->storage_path."/baselines_for_model_gens/Model.php";
                        $file_as_string = file_get_contents($infile);
                        $file_as_string = str_ireplace ('$model_table', $values_array['model_table'] , $file_as_string  );
                        $file_as_string = str_ireplace ('$model', $values_array['model'], $file_as_string );
                        //echo ($file_as_string);
                        $outfile = $this->storage_path.'/connections/'. $values_array['db_connection_name'] .'/models/'.$values_array['model'].'.php';
                        $this->add_delete_add_file_as_string($outfile,$file_as_string);
                        
                        $outfile = app_path().'/Models/'.$values_array['model'].'.php';
                        //$this->add_delete_add_file_as_string($outfile,$file_as_string);
                        echo("add_delete_add_file_as_string ".$outfile);//exit("exit 4757");
                        break;
                    case "controllers":
                        $str = "";
                        
                        foreach ($field_names as $name){
                            //echo $name. " * ".$values_array[$value);
                            $str .= "$".$name.' = "'.$values_array[$name].'", ';
                        }
                         
                        $str = rtrim($str);
                        $str = substr($str, 0, -1);
                        $infile = $this->storage_path."/baselines_for_model_gens/Controller.php";
                        $file_as_string = file_get_contents($infile);
                        $file_as_string = str_ireplace ('$controller_name', $values_array['controller_name'] , $file_as_string  );
                        $file_as_string = str_ireplace ('//generated_parameter_list', $str , $file_as_string );
                        $outfile = $this->storage_path.'/connections/'.$values_array['db_connection_name'].'/controllers/'.$values_array['controller_name'].'.php';
                        $this->add_delete_add_file_as_string($outfile,$file_as_string);
                        
                        $outfile = $this->controllers_path."/".$values_array['controller_name'].'.php';
                        //$this->add_delete_add_file_as_string($outfile,$file_as_string);
                        //echo("add_delete_add_file_as_string ".$outfile);exit("exit 4838");
                        //echo("controllers ");exit("exit 4762");
                        break;
                    case "routes":
                        //echo("add_delete_add_file_as_string "."routes ");exit("exit 4838");
                        $infile = $this->storage_path."/baselines_for_model_gens/Route.php";
                        $insert_string = file_get_contents($infile);
                        $insert_string = str_ireplace ('xxx_node_name', $values_array['node_name'] , $insert_string);
                        $insert_string = str_ireplace ('xxx_controller_name', $values_array['controller_name'] , $insert_string);
                        //
                        $infile = $this->routes_path."/routes.php";
                        $file_as_string = file_get_contents($infile);
                        $file_as_string = $this->anchor_boundaries_insert_replace(
                        $file_as_string,
                        $insert_string,
                        "// GENERATED_CONTROLLERS_START_HERE",
                        "// ".$values_array['node_name']." begin_generated_node",
                        "// ".$values_array['node_name']." end_generated_node"
                        );
                        //echo "routes ".$insert_string;exit(' exit 4861');
                        $outfile = $this->storage_path.'/connections/'.$values_array['db_connection_name']."/routes.php";
                        $this->add_delete_add_file_as_string($outfile,$file_as_string);
                        echo $outfile;
                        //exit('exit 4856');
                        $outfile = $this->routes_path."/routes.php";
                        //$this->add_delete_add_file_as_string($outfile,$file_as_string);
                        echo("add_delete_add_file_as_string ".$outfile);//exit("exit 4757");
                        break;
                }
                break;
            case "change_database_connection":
                // ****************
                $node =  "controllers";
                $outfile = $this->DEHbase_controller_path ."BaseController.php";
                $infile = $this->stored_connections_path. $values_array['db_connection_name']."/controllers/BaseController.php";

                if (File::exists($outfile)){
                    unlink ($outfile);
                    copy($infile,$outfile);
                }
                // ****************
                $node =  "config";
                $infile = $this->stored_connections_path."/".$values_array['db_connection_name']."/config/database.php";
                $outfile = $this->database_connection_config_path."database.php";
                //var_dump($infile);var_dump($outfile);//$this->debug0(__FILE__,__LINE__,__FUNCTION__);
                copy($infile,$outfile);
                // ****************
                $node =  "models";
                $infile = substr(app_path(),0,strlen(app_path())-4).'/storage/connections/'.$values_array['db_connection_name']."/models";
                $outfile = app_path()."/models";
                File::cleanDirectory($outfile);
                File::copyDirectory($infile,$outfile);
                // ****************
                // ****************
                $node =  "routes";
                $infile = substr(app_path(),0,strlen(app_path())-4).'/storage/connections/'.$values_array['db_connection_name']."/routes.php";
                $outfile = $this->routes_path."/routes.php";
                echo($infile."**".$outfile);
                $this->debug1(__FILE__,__LINE__,__FUNCTION__);

                if (File::exists($outfile)){
                    unlink ($outfile);
                    copy($infile,$outfile);
                }
                //echo "we got here";exit("4725");
                
                break;
                
        }  // endswitch $action
        //exit("exit 4548");
        return;
    }


    
        public function array_node_to_array($array) {
        // *****************
        // this converts encoded_strings to arrays
        // ****************

            $array['ppv_define_query']['lookups']['field_names']                = '';
            $array['ppv_define_query']['lookups']['relational_operators']  = '';
            $array['ppv_define_query']['lookups'][0]                        = '';
            $array['ppv_define_query']['lookups'][1]                        = '';
            

            $array['ppv_define_query']['lookups']['field_names']            = '';
            $array['ppv_define_query']['lookups']['relational_operators']  = '';
            $array['ppv_define_query']['lookups'][0]                        = '';
            $array['ppv_define_query']['lookups'][1]                        = '';
            

        foreach ($array as $field) {
            if (is_null($field))    {
                $array[$field] =  array();
            }
            /*
            else{
                $array[$field] =  json_decode($field);
            }
            */
        }
        return $array;

        var_dump($arr);exit("xit 4420");
    }




     /**
     * Execute the query and show the report you just requested
     *
     * @return \Illuminate\Http\Response
     */

    public function execute_report_def_query($report_definition) {
        echo("execute_report_def_query<br>");
        //$this->debug0(__FILE__,__LINE__,__FUNCTION__);
        //var_dump($report_definition);
        $errors = array();
        $message = "";
        $what_we_are_doing = "edit2_build_default_browse";
        if ($report_definition){
            $working_arrays     = $this->working_arrays_construct($report_definition);

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
                $this->debug1(__FILE__,__LINE__,__FUNCTION__);
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
                $this->debug0(__FILE__,__LINE__,__FUNCTION__); 
                //$query_relational_operators_array = $this->build_query_relational_operators_array();
                //$db_result = $this->build_and_execute_query($arr,$this->bypassed_field_name,$query_relational_operators_array);
            }
        } // end of if report_definition


    }





     /**
     * Execute the query and show the report you just requested
     *
     * @return \Illuminate\Http\Response
     */

    public function browseEdit(Request $request, $id, $what_we_are_doing, $coming_from){
        //echo("<br> browseEdit ".$what_we_are_doing.$id.$coming_from);$this->debug_exit(__FILE__,__LINE__,0);
    
        $report_definition          = $this->execute_query_by_report_no($id) ;
        $encoded_business_rules     = $report_definition[0]['business_rules'];

        //$this->business_rules_array = (array) json_decode($report_definition[0]['business_rules']);

        $working_arrays             = $this->working_arrays_construct($report_definition[0]);
        //var_dump($working_arrays);$this->debug1__FILE__,__LINE__,__FUNCTION__);

        $query_relational_operators_array = $this->build_query_relational_operators_array();
        
        if(!$miscThings = $this->build_and_execute_query($working_arrays,$this->bypassed_field_name,$query_relational_operators_array)) {
            echo("<BR>"."query failed");
            $this->debug1(__FILE__,__LINE__,__FUNCTION__);
        }
        
        //var_dump($miscThings[0]);$this->debug_exit(__FILE__,__LINE__,10);
        $encoded_business_rules_field_name_array = array();
        $field_names_array = array();
        $data_array_name = array();
        $data_array_name ["report_name"] = $report_definition[0]->report_name;
        $data_array_name ["record_type"] = $report_definition[0]->record_type;
        $field_names_row_file_name =  "../".$this->node_name.'/'.$this->generated_files_folder.'/'.$report_definition[0]->id.'_browse_select_field_names_row';

        $browse_snippet_file_name ="../".$this->node_name.'/'.$this->generated_files_folder.'/'.$report_definition[0]->id.'_browse_select_display_snippet';


        //echo('<br>after build_and_execute_query');$this->debug_exit(__FILE__,__LINE__,0);
        if($coming_from == 'var_dump'){
            var_dump($miscThings[0]);
            var_dump($report_definition[0]);

          $this->debug_exit(__FILE__,__LINE__,0);  
        }
        //var_dump($browse_snippet_file_name);  $this->debug_exit(__FILE__,__LINE__,0);
        if ($miscThings){         
            //var_dump($miscThings[0]); $this->debug_exit(__FILE__,__LINE__,10);  
            //$miscThings = (array) $miscThings;
            //var_dump($miscThings[0]); $this->debug_exit(__FILE__,__LINE__,0); 
             return view($this->node_name.'.browseEdit',compact('miscThings'))
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
        

 
    public function snippets_gen_browse_select($key_field_name,$key_value) {
        echo 'snippets_gen_browse_select';print_r($_REQUEST);exit("exit 172");
        $nv_array = array(); 
        foreach ($_REQUEST['to'] as $value){
            $nv_array [$value] = $value;
        }
        $array = array();
       
        $array ['browse_select_display_snippet']            = "";
        $array ['browse_select_array']                                  = json_encode($nv_array);
        $array ['merge_browse_select_and_modify_arrays']= json_encode(array_merge ((array) $_REQUEST["to"],$this->generated_snippets_array['modifiable_fields_array']));
        $array ['lookup_name_value_array_gen_by_table'] = json_encode($this->lookup_name_value_array_gen_by_table($this->model_table));
        //print_r($array);exit("exit 184");
        $this->generated_snippets_array_update($key_field_name,$key_value,$array);
        return;
    }



    public function build_column_names_array($tbl_name) {
        //echo ('build_column_names_array'.$tbl_name);exit("exit 99");
        $column_names_array = array();
        $columns = Schema::getColumnListing($tbl_name);
        sort($columns);
        $columns = array_combine($columns, $columns);
        return $columns;

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
    public function create_w_report_idx($report_definition_key) {
        //echo("<br>".$this->store_validation_id . $report_definition_key);$this->debug_exit(__FILE__,__LINE__,1);
        $report_definition  = $this->execute_query_by_report_no($report_definition_key) ;
        $encoded_business_rules = $report_definition[0]['business_rules'];
        $this->business_rules_array = (array) json_decode($report_definition[0]['business_rules']);
        //var_dump($encoded_business_rules);$this->debug_exit(__FILE__,__LINE__,1);
        $snippet_file ="../".$this->node_name.'/'.$this->generated_files_folder.'/'.$report_definition_key.'_modifiable_fields_add';
        //$this->c1($report_definition_key);
         return view($this->node_name.'.create')
            ->with('encoded_business_rules' , $encoded_business_rules)
            ->with('report_definition_key'  , $report_definition_key)
           //->with('report_key'              , $report_definition_key)
            ->with('snippet_file'           , $snippet_file)
            ->with('node_name'              , $this->node_name);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$x = Config::get('dehGlobals.business_rules_array');
        $this->debug_exit(__FILE__,__LINE__,10);  
 
        //echo("<br>".$this->store_validation_id );$this->debug_exit(__FILE__,__LINE__,1);
        $snippet_file ="../".$this->node_name.'/'.$this->generated_files_folder.'/'.$this->store_validation_id.'_modifiable_fields_add.blade.php';
        //
        //"/".$this->report_definition_id.'_modifiable_fields_add.blade.php';
       
         return view($this->node_name.'.create')
        //->with('message'                        , $message)
        ->with('snippet_file'           , $snippet_file)
        ->with('report_definition_key'  , $this->report_definition_id)
        ->with('node_name'              , $this->node_name);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function execute_query_by_report_no($report_no) {
      //echo 'execute_query_by_report_no'.$report_no;//exit("exit");
      $response = MiscThing::where($this->snippet_table_key_field_name, '=', $report_no)
        ->get();
        if ($response){
           return $response;
        }
        else {
            echo 'you have a fatal error<br>';
            $this->debug_exit(__FILE__,__LINE__,1);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gen_tbl_controller_snippet($report_no) {
      //echo 'execute_query_by_report_no'.$report_no;//exit("exit");
      $response = MiscThing::where($this->snippet_table_key_field_name, '=', $report_no)
        ->get();
        if ($response){
           return $response;
        }
        else {
            echo 'you have a fatal error<br>';
            $this->debug_exit(__FILE__,__LINE__,1);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gen_tbl_model_snippet($report_no) {
      //echo 'execute_query_by_report_no'.$report_no;//exit("exit");
      $response = MiscThing::where($this->snippet_table_key_field_name, '=', $report_no)
        ->get();
        if ($response){
           return $response;
        }
        else {
            echo 'you have a fatal error<br>';
            $this->debug_exit(__FILE__,__LINE__,1);
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gen_tbl_route_snippet($report_no) {
      //echo 'execute_query_by_report_no'.$report_no;//exit("exit");
      $response = MiscThing::where($this->snippet_table_key_field_name, '=', $report_no)
        ->get();
        if ($response){
           return $response;
        }
        else {
            echo 'you have a fatal error<br>';
            $this->debug_exit(__FILE__,__LINE__,1);
        }
    }



    public function bld_name_value_lookup_array($table_name) {
        
        $response0 = MiscThing::where('table_name','=', $table_name)
        ->where('record_type','=','name_value_definition')
        ->get(array('field_name','table_name','name','value'));
        $array = array();
        foreach($response0 as $response){
            $array [$response->field_name][$response->name] = $response->value;
        }
        return $array;
    }


    public function getEdit8_array_node_to_array($array) {
        // *****************
        // this converts encoded_strings to arrays
        // ****************

            $array['ppv_define_query']['lookups']['field_names']                = '';
            $array['ppv_define_query']['lookups']['relational_operators']  = '';
            $array['ppv_define_query']['lookups'][0]                        = '';
            $array['ppv_define_query']['lookups'][1]                        = '';
            

            $array['ppv_define_query']['lookups']['field_names']            = '';
            $array['ppv_define_query']['lookups']['relational_operators']  = '';
            $array['ppv_define_query']['lookups'][0]                        = '';
            $array['ppv_define_query']['lookups'][1]                        = '';
            

        foreach ($array as $field) {
            if (is_null($field))    {
                $array[$field] =  array();
            }
            /*
            else{
                $array[$field] =  json_decode($field);
            }
            */
        }
        return $array;

        var_dump($arr);exit("xit 4420");
    }

    public function getEdit8_decode_array_to_array($record,$encoded_string) {
        // *****************
        // this converts encoded_strings to arrays
        // ****************

        //var_dump($encoded_string);
        if (is_null($record->$encoded_string))   {
            $arr = array();
        }else{
            $arr =  (array) json_decode($record->$encoded_string,1);
        }
        return $arr;

        var_dump($arr);exit("xit 4420");
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index(){
        //echo('index');$this->debug_exit(__FILE__,__LINE__,1);
        echo('index');$this->debug_exit(__FILE__,__LINE__,10);
        
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
       $this->debug_exit(__FILE__,__LINE__,0);echo(' indexReports');
       //var_dump($request);
        var_dump($id);
       $record_type                    = "report_definition";
        /*
       $miscThings = MiscThing::where('id','=',$this->report_definition_id )
         ->get();
        */
        $miscThings = MiscThing::where('record_type','=',$record_type)
         ->where('table_name',  '='    ,$this->model_table)
        ->where('node_name',    '='    ,$this->node_name)
        ->orderBy('report_name','asc')
        ->get();
        
        $what_we_are_doing = 'displaying_advanced_edits_screen';
        $working_arrays     = $this->working_arrays_construct($miscThings[0],$what_we_are_doing);
        $record = $miscThings[0];
        $parameters = array('id'=>$id,'what_we_are_doing'=>$what_we_are_doing,'coming_from'=>'indexReports');

        var_dump($this->report_definition_id);$this->debug_exit(__FILE__,__LINE__,10);
        return view($this->node_name.'.indexReports',compact('miscThings'))
            ->with('encoded_report_description' ,json_encode($miscThings))
            ->with('encoded_record'             ,json_encode($record))
             ->with('model_table'               ,$request->input('model_table'))
             ->with('id'                        ,$request->input('id'))
             ->with('report_definition_key'     ,$this->report_definition_id)
             ->with('parameters'                ,$parameters)

            ->with('encoded_working_arrays'     ,json_encode($working_arrays))
            ->with('record'                     ,$record)
            ->with('all_records'                ,$miscThings)
           ->with('report_key'                  ,$this->report_definition_id)
            //->with('report_key'                  ,$request->input('report_key'))
            ->with('node_name'                  ,$this->node_name)
            ->with('snippet_table_key_field_name',$this->snippet_table_key_field_name)
            ->with('snippet_table'               ,$this->snippet_table)
            ;
        }

      /**
     
     *
     */
       
  

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

    public function return_modifiable_fields_array($what_we_are_doing,$id,$modifiable_fields_array) {
        //var_dump($what_we_are_doing);$this->debug_exit(__FILE__,__LINE__,1);
                   //var_dump($modifiable_fields_array);$this->debug_exit(__FILE__,__LINE__,1);

                $array1 = array();
        if (is_null($modifiable_fields_array)){
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
                   $db_result  = MiscThing::where('id','=',$id)->get();
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
        //* *******************
        //
        // use CRHBase
        //
        //* *******************
        echo('<br>this is reportDefMenuEdit node: '.$this->node_name);
        //echo("<br>we moved it to indexReports and then reportDefMenuEdit(here)");
        //echo("<br>".'* '.$id.' * '.$what_we_are_doing.' * '.$coming_from." ** ");$this->debug_exit(__FILE__,__LINE__,0);
        
        $this->debug1(__FILE__,__LINE__,__FUNCTION__);echo("<br>".'* '.$id.' * '.$what_we_are_doing.' * '.$coming_from." ** "); 
        $miscThing = MiscThing::where('id','=',$id)->get();
        //var_dump($miscThing);$this->debug_exit(__FILE__,__LINE__,10);
        $working_arrays     = $this->working_arrays_construct($miscThing[0],$what_we_are_doing);
        //var_dump($miscThing);$this->debug_exit(__FILE__,__LINE__,10);
    switch ($what_we_are_doing) {
        case "maintain_modifiable_fields":
        case "maintain_browse_fields":           
            $column_names_array = (array) $this->build_column_names_array($this->model_table);
            
            //var_dump($working_arrays[$what_we_are_doing]);$this->debug_exit(__FILE__,__LINE__,10);
            $column_names_array = $working_arrays[$what_we_are_doing]['lookups']['field_names'];
            $array_name = $working_arrays[$what_we_are_doing]['field_name_array']['field_name'];
            $to_array = (array) $working_arrays[$what_we_are_doing][$array_name];
            $from_array = array_diff($column_names_array,$to_array);
            $this->debug_exit(__FILE__,__LINE__,10);var_dump($to_array);
            
            //var_dump($working_arrays);$this->debug_exit(__FILE__,__LINE__,1);
            return view($this->model_table.'.select_fields'    ,compact('miscThing'))
                ->with('what_we_are_doing'                  ,$what_we_are_doing)
                ->with('from_array'                         ,$from_array)
                ->with('report_definition_id'               ,$this->report_definition_id)

                ->with('to_array'                           ,$to_array)
                ->with('node_name'                          ,$this->node_name)
                ->with('model_table'                        ,$this->model_table)
                ->with('encoded_record'                     ,$request->input('encoded_record'))
                ->with('encoded_column_names'               ,$request->input('encoded_column_names'))
                ->with('encoded_working_arrays'             ,$request->input('encoded_working_arrays'))
                ->with('message',''
                );
                break;  
        case "ppv_define_query":
        case "ppv_define_business_rules":
            $column_names_array = (array) $this->build_column_names_array($this->model_table);
            //echo('<br>1042: '.$what_we_are_doing);var_dump($miscThing );   
            $this->debug_exit(__FILE__,__LINE__,10);   
            //$working_arrays = 
            $this->working_arrays_fixer($working_arrays,$what_we_are_doing);
            //var_dump($working_arrays [$what_we_are_doing]);$this->debug_exit(__FILE__,__LINE__,0);
            $field_name_array_name = ($working_arrays[$what_we_are_doing]['field_name_array']['field_name']);
            echo("rows ".$field_name_array_name);
            $no_of_rows = count($working_arrays [$what_we_are_doing][$field_name_array_name]);
            
            //echo("rows ".$no_of_rows);
            //var_dump($working_arrays [$what_we_are_doing][$field_name_array_name]);$this->debug_exit(__FILE__,__LINE__,0);
            //var_dump($field_name_array_name);$this->debug_exit(__FILE__,__LINE__,1);

            $blade_routine                          = "ppv_edit_snippet_gen";
            $blade_name                             = "_ppv_edit_snippet";
            $filename = $this->views_files_path."/".$this->generated_files_folder."/".$id.$blade_name.'.blade.php';
            //echo($filename.' name> '.$blade_name.' routine> '.$blade_routine);
            //* FIle
            File::put($filename,$this->$blade_routine($no_of_rows));
            //*
     
 
            //var_dump($working_arrays);$this->debug_exit(__FILE__,__LINE__,1);
            $column_names_array = $working_arrays[$what_we_are_doing]['lookups']['field_names'];
            $column_names_array = array_combine(array_values($column_names_array),$column_names_array);
          
            //$working_arrays['ppv_define_query']['lookups']['field_names'] = array_values($a);
            //var_dump(array_values($a) );$this->debug_exit(__FILE__,__LINE__,1);

            //$working_arrays[$what_we_are_doing]['lookups']['field_names'],
             //$working_arrays[$what_we_are_doing]['lookups']['field_names']);


            $field_name_array_name  = ($working_arrays[$what_we_are_doing]['field_name_array']['field_name']);
            $field_name_array       = ($working_arrays[$what_we_are_doing][$field_name_array_name]);
            $r_o_array_name         = ($working_arrays[$what_we_are_doing]['field_name_array']['r_o']);
            $r_o_array              = ($working_arrays[$what_we_are_doing][$r_o_array_name]);
            //var_dump($working_arrays[$what_we_are_doing][$r_o_array_name]);var_dump($r_o_array);
            $working_arrays[$what_we_are_doing]['lookups'][1] = 
            array_combine(
                $working_arrays[$what_we_are_doing]['lookups'][1],
                $working_arrays[$what_we_are_doing]['lookups'][1]);
           //$this->debug_exit(__FILE__,__LINE__,10);
           $value_array_name       = ($working_arrays[$what_we_are_doing]['field_name_array']['value']);
            $value_array            = ($working_arrays[$what_we_are_doing][$value_array_name]);
        
            echo ($what_we_are_doing);$this->debug_exit(__FILE__,__LINE__,10);
            return view($this->model_table.".ppv_update"    ,compact('miscThing'))
                ->with('what_we_are_doing'                  ,$what_we_are_doing)

                ->with('id'                                 ,$id)
                ->with('request'                            ,$request)
                ->with('report_definition_id'               ,$this->report_definition_id)
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
        }
        //var_dump($miscThing);$this->debug_exit(__FILE__,__LINE__,10);

       return view($this->node_name.'.reportDefMenuEdit',compact('miscThing'))
        ->with('id'                                 ,$id)
        ->with('report_definition_id'               ,$this->report_definition_id)
        ->with('model'                              ,$this->model)
        ->with('node_name'                          ,$this->node_name)
        ->with('what_we_are_doing'                  ,$what_we_are_doing)
        ->with('coming_from'                        ,$coming_from)
       ;
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
                $column_names_array = $working_arrays[$what_we_are_doing]['lookups']['field_names'];
                $index2 = $working_arrays[$what_we_are_doing]['field_name_array']['field_name'];
                $to_array = $working_arrays[$what_we_are_doing][$index2];
                $from_array = array_diff($column_names_array,$to_array);
                //$this->debug_exit(__FILE__,__LINE__,0);var_dump($to_array);
                //var_dump(Input::all());$this->debug_exit(__FILE__,__LINE__,1);
                 //var_dump($working_arrays);$this->debug_exit(__FILE__,__LINE__,0);
                 return view($this->node_name.'.reportDefMenuEdit'    ,compact('miscThing'))
                    ->with('what_we_are_doing'                  ,$what_we_are_doing)
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
                var_dump(Input::all());$this->debug_exit(__FILE__,__LINE__,0);

                $updatex  = DB::connection($this->db_snippet_connection)->table($this->snippet_table)
                ->where($this->snippet_table_key_field_name,    '=', $record[0][$this->snippet_table_key_field_name])
                ->update(array($working_arrays[$what_we_are_doing]['field_name_array']['field_name']=>$encoded_nv_array));

               
                $this->generate_by_list_name($nv_array,$this->model_table);
                //echo ("t41 generate_by_list_name ");$this->debug_exit(__FILE__,__LINE__,0);
                return redirect('admin/'.$this->node_name.'/edit1')
                ->with('message', 'record updated');
                break;                  
        }       
    }




    public function show(REQUEST $request,$id)
    {
        //
        //var_dump($request);
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
        echo('storex');
        var_dump($request->input('encoded_business_rules'));
        //var_dump($request->input::all()); 
        //$this->debug_exit(__FILE__,__LINE__,10);
        $this->debug_exit(__FILE__,__LINE__,10);
        $validation_array = (array) json_decode($request->input('encoded_business_rules'));
        $requestFieldsArray=$request->all(); // important!!
        $this->validate($request,$validation_array);
 
        $miscThing=$request->all(); // important!!
        MiscThing::create($miscThing);
        return redirect('admin/miscThings');
    }






    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idInput
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = 0;  
        $requestFieldsArray=$request->all(); // important!!
        //$this->debug_exit(__FILE__,__LINE__,1);echo('update id: '.$id);
        //$this->debug_exit(__FILE__,__LINE__,0);//var_dump($requestFieldsArray);
        //$this->debug_exit(__FILE__,__LINE__,1);
        if (isset($request->browse_select_array)){
            $update = 1; 
            $request->browse_select_array = $request->to;
            $requestFieldsArray['browse_select_array'] = 
                array_combine($request->to,$request->to);
            $requestFieldsArray['browse_select_array'] =
                json_encode($requestFieldsArray['browse_select_array']); // important!!
            //$objectOrArray = "object";
            $objectOrArray = "array";
            $this->blade_gen_browse_select($id,$objectOrArray);
            }
        if (isset($request->modifiable_fields_array)){
            $update = 1; 
            //var_dump($request);$this->debug_exit(__FILE__,__LINE__,0);
            $request->modifiable_fields_array = $request->to;
            $requestFieldsArray['modifiable_fields_array'] = 
            array_combine($request->to,$request->to);
            $this->blade_gen_simple_add($id,$requestFieldsArray['modifiable_fields_array']);
            //var_dump($requestFieldsArray['modifiable_fields_array']);$this->debug_exit(__FILE__,__LINE__,1);
            $requestFieldsArray['modifiable_fields_array'] =
            json_encode($requestFieldsArray['modifiable_fields_array']); 
             //var_dump($requestFieldsArray['modifiable_fields_array']);$this->debug_exit(__FILE__,__LINE__,10);
            }

        if (isset($request->query_field_name_array)){
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

           // move the common screen names into the specific fields in the table

        }
        //var_dump($requestFieldsArray);$this->debug_exit(__FILE__,__LINE__,10);
        //var_dump($requestFieldsArray['query_r_o_array']);$this->debug_exit(__FILE__,__LINE__,10);


        if (isset($request->business_rules_field_name_array)){
            $update = 1; 
            $requestFieldsArray['business_rules']             = 
            $this->build_validation_array(
                $this->build_business_rules_relational_operators(),
                $request->field_name_array,
                $request->r_o_array,
                $request->value_array);
            $business_rules = $requestFieldsArray['business_rules'];
            $requestFieldsArray['business_rules'] = 
                json_encode($requestFieldsArray['business_rules']);
            $requestFieldsArray['business_rules_field_name_array']    = 
                json_encode($request->field_name_array);
            $requestFieldsArray['business_rules_r_o_array'] = 
                json_encode($request->r_o_array);
            $requestFieldsArray['business_rules_value_array'] = 
                json_encode($request->value_array);
            //var_dump($requestFieldsArray);$this->debug_exit(__FILE__,__LINE__,10);

       }
       // ******
       // update
       // ******
       //'what_we_are_doing' => string 'updating_data_record' 
        //var_dump($requestFieldsArray);$this->debug_exit(__FILE__,__LINE__,0);
        if (!$update) {

            //var_dump($requestFieldsArray);$this->debug_exit(__FILE__,__LINE__,10);
            if ((isset($request->what_we_are_doing)&&$request->what_we_are_doing == 'updating_data_record') ){
                $business_rules = json_decode($requestFieldsArray['wxyz'],1 );
                var_dump($business_rules);$this->debug_exit(__FILE__,__LINE__,0);
                $modifiable_fields_array = json_decode($request->encoded_modifiable_fields_array,1);
                $modifiable_fields_name_values = array_intersect_key($requestFieldsArray, $modifiable_fields_array);
                unset($modifiable_fields_name_values[$this->snippet_table_key_field_name]);
                $requestFieldsArray=$request->all(); // important!!
                $this->validate($request, $business_rules);
                 // valid past here
                //var_dump($modifiable_fields_name_values);$this->debug_exit(__FILE__,__LINE__,10);
     
                $update = 0; 
                    $miscThingsings=MiscThing::find($id);
                    $miscThingsings->update($modifiable_fields_name_values);
                    return redirect('admin/miscThings')
                       ->with('message'      , 'ok ');
            }
        }
         if ($update = 1){
            echo("<br>"." id: ".$id);var_dump($requestFieldsArray);$this->debug_exit(__FILE__,__LINE__,0);
            $miscThingsings=MiscThing::find($id);
            $miscThingsings->update($requestFieldsArray);
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
     public function destroy(REQUEST $request, $id) {
        //
    }



    public function working_arrays_construct($record,$what_we_are_doing) {
        //echo("working_arrays_construct");
        // $working_arrays contains some handy grouping of data and arrays we need for various things
        // we used to define working_arrays based on what we were doing
    include('working_arrays_include.php');
    }

    
}
