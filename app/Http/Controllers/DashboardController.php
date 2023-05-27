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
        $getData = Project::get();
        $data = [];
        foreach ($getData as $key => $value) {
            $arrTemp = [];
            $arrTemp['ID'] = $value->project_id;
            $arrTemp['nama_project'] = $value->project_name;
            $arrTemp['nama_cliet'] = $value->client->client_name;
            $arrTemp['project_start'] = strftime('%d %b %Y', strtotime($value->project_start));
            $arrTemp['project_end'] = strftime('%d %b %Y', strtotime($value->project_end));
            $arrTemp['project_status'] = $value->project_status;
            array_push($data, $arrTemp);
        }

        return json_encode($data);
        // dd($arr);
    }
}
