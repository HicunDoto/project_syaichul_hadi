<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;

class DashboardController extends Controller
{
    public function index()
    {   
        setlocale(LC_ALL, 'IND');
        $draw = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : 1;
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;

        $getData = Project::get();
        $arr = [];
        foreach ($getData as $key => $value) {
            $arrTemp = [];
            $arrTemp[] = '<td><input class="form-check-input" type="checkbox" data-value="'.$value->project_id.'" value="" id="checkbox-1" style="margin-left:20px; position: inherit;"></td>';
            $arrTemp[] = '<td><a href="#" data-id="'.$value->project_id.'">Edit</a></td>';
            $arrTemp[] = '<td>'.$value->project_name.'</td>';
            $arrTemp[] = '<td>'.$value->client->client_name.'</td>';
            $arrTemp[] = '<td>'.strftime('%d %b %Y', strtotime($value->project_start)).'</td>';
            $arrTemp[] = '<td>'.strftime('%d %b %Y', strtotime($value->project_end)).'</td>';
            $arrTemp[] = '<td>'.$value->project_status.'</td>';
            array_push($arr, $arrTemp);
        }

		$result = array(
            'data' => $arr,
            'colomn_sort' => "",
            'params_arr' => '',
            'recordsTotal' => $getData->count()??0,
            'recordsFiltered' => $getData->count()??0,
            'sql' => '',
            'arr_show' => [],
            'draw' => $draw,
            'start_from' => $start
        );
        return json_encode($result);
        // dd($arr);
    }
}
