<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Report extends Model
{
    public function get_summary_report($start_date='', $end_date = '', $division = '', $district = '' , $facility = '', $groupBy = ''){
        $where = $where2 = "";
        if($start_date != "" && $end_date != ""){
            $where = "AND (p.test_date BETWEEN '".$start_date."' AND '".$end_date."')";
        }

        if(!empty($division)){
          $where2 .= " AND fl.division_code IN (".implode(',', $division).") ";
        }

        if(!empty($district)){
          $where2 .= " AND fl.district_code IN (".implode(',', $district).") ";
        }

        if(!empty($facility)){
          $where2 .= " AND fl.short_code IN ('".implode("','", $facility)."') ";
        }
        if(!empty($groupBy)){
            if($groupBy == 4) {$group_by = "fl.division_code"; $group_by1 = "sub.division_code";}
            if($groupBy == 1) {$group_by = "fl.division_code, fl.district_code"; $group_by1 = "sub.division_code, sub.district_code";}
            if($groupBy == 3) {$group_by = "p.facility_id";$group_by1 = "sub.facility_id";}
            if($groupBy == 2) {$group_by = "p.facility_id, p.test_date";$group_by1="sub.facility_id, sub.test_date";}
        }else{
            $group_by = "p.facility_id, p.test_date";
            $group_by1="sub.facility_id, sub.test_date";
        }

         $result =  DB::select("SELECT 
                                    geo.division, 
                                    geo.district, 
                                    geo.upazilla,
                                    sub.*
                                    FROM
                                    (
                                        SELECT 
                                        fl.name facility_name, fl.division_code, fl.district_code, fl.thana_code,
                                        p.facility_id,
                                        DATE_FORMAT(p.test_date, '%d/%m/%Y') test_date,
                                        COUNT(*) AS number_of_sample_tested,
                                        SUM(CASE WHEN (reason_for_mtb = 8 AND tb_case_subcategory IN (1,2)) 
                                         OR (reason_for_mtb = 9 AND others_subcategory IN (1,2) AND tb_case_subcategory IN (1,2)) 
                                         OR (reason_for_mtb = 10 AND tb_case_subcategory IN (1,2))
                                         OR (reason_for_mtb = 11 AND tb_case_subcategory IN (1,2))
                                      THEN 1 ELSE 0 END) AS presumptive_ds_tb_detected,
                                        SUM(CASE WHEN ((reason_for_mtb = 8 AND tb_case_subcategory IN (1,2)) 
                                         OR (reason_for_mtb = 9 AND others_subcategory IN (1,2) AND tb_case_subcategory IN (1,2)) 
                                         OR (reason_for_mtb = 10 AND tb_case_subcategory IN (1,2))
                                         OR (reason_for_mtb = 11 AND tb_case_subcategory IN (1,2)))
                                         AND xpert_result IN (1,2)
                                      THEN 1 ELSE 0 END) AS ds_tb_only_mtb_detected,
                                        SUM(CASE WHEN ((reason_for_mtb = 8 AND tb_case_subcategory IN (1,2)) 
                                         OR (reason_for_mtb = 9 AND others_subcategory IN (1,2) AND tb_case_subcategory IN (1,2)) 
                                         OR (reason_for_mtb = 10 AND tb_case_subcategory IN (1,2))
                                         OR (reason_for_mtb = 11 AND tb_case_subcategory IN (1,2)))
                                         AND xpert_result = 2
                                      THEN 1 ELSE 0 END) AS ds_tb_rr_tb_detected,
                                        SUM(CASE WHEN reason_for_mtb IN (1,2,3,4,5,6,7) 
                                        OR (reason_for_mtb = 8 AND tb_case_subcategory = 3) 
                                        OR (reason_for_mtb = 9 AND others_subcategory IN (1,2) AND tb_case_subcategory = 3)
                                        OR (reason_for_mtb = 9 AND others_subcategory = 3 AND tb_case_subcategory IN (1,2))
                                        OR (reason_for_mtb = 10 AND tb_case_subcategory = 3)
                                      THEN 1 ELSE 0 END) AS presumptive_dr_tb_detected,
                                        SUM(CASE WHEN (reason_for_mtb IN (1,2,3,4,5,6,7) 
                                        OR (reason_for_mtb = 8 AND tb_case_subcategory = 3) 
                                        OR (reason_for_mtb = 9 AND others_subcategory IN (1,2) AND tb_case_subcategory = 3)
                                        OR (reason_for_mtb = 9 AND others_subcategory = 3 AND tb_case_subcategory IN (1,2))
                                        OR (reason_for_mtb = 10 AND tb_case_subcategory = 3))
                                        AND xpert_result IN (1,2)
                                      THEN 1 ELSE 0 END) AS drtb_only_mtb_detected,
                                        SUM(CASE WHEN (reason_for_mtb IN (1,2,3,4,5,6,7) 
                                        OR (reason_for_mtb = 8 AND tb_case_subcategory = 3) 
                                        OR (reason_for_mtb = 9 AND others_subcategory IN (1,2) AND tb_case_subcategory = 3)
                                        OR (reason_for_mtb = 9 AND others_subcategory = 3 AND tb_case_subcategory IN (1,2))
                                        OR (reason_for_mtb = 10 AND tb_case_subcategory = 3))
                                        AND xpert_result = 2
                                      THEN 1 ELSE 0 END) AS dr_tb_rr_tb_detected,
                                        SUM(CASE WHEN xpert_result = 5 THEN 1 ELSE 0 END) AS invalid_no_result_error
                                        FROM patient p
                                        INNER JOIN facility AS fl ON (fl.short_code = p.facility_id ".$where2.")
                                        WHERE p.status = 2 AND p.deleted_status = 0 ".$where."
                                        GROUP BY ".$group_by."
                                        ORDER BY ".$group_by."
                                    ) sub 
                                    LEFT JOIN tbl_geocode AS geo ON geo.division_code = sub.division_code AND geo.district_code=sub.district_code AND geo.upazilla_code=sub.thana_code
                                    GROUP BY ".$group_by1."
                                    ORDER BY ".$group_by1);
          return $result;
    }

    public function get_patients_report($start_date='', $end_date = '', $division = '', $district = '' , $facility = ''){
      $where = $where2 = "";
      if($start_date != "" && $end_date != ""){
          $where = "AND (p.test_date BETWEEN '".$start_date."' AND '".$end_date."')";
      }

      if(!empty($division)){
        $where .= " AND fl.division_code IN (".implode(',', $division).") ";
      }

      if(!empty($district)){
        $where .= " AND fl.district_code IN (".implode(',', $district).") ";
      }

      if(!empty($facility)){
        $where .= " AND fl.short_code IN ('".implode("','", $facility)."') ";
      }
      $result = DB::table("patient as p")
                  ->selectRaw("p.*, fl.name as facility_name, rea.name as reason_name, res.name result_name")
                  ->leftjoin("facility as fl","fl.short_code","=","p.facility_id")
                  ->leftjoin("ref_reason as rea","rea.id","=","p.reason_for_mtb")
                  ->leftjoin("ref_result as res","res.id","=","p.xpert_result")
                  ->whereRaw("deleted_status= 0 ".$where)
                  ->get();
      return $result;
    }

    public function get_patients_report_mdr($start_date='', $end_date = '', $division = '', $district = '' , $facility = ''){
      $where = $where2 = "";
      if($start_date != "" && $end_date != ""){
          $where = "AND (p.test_date BETWEEN '".$start_date."' AND '".$end_date."')";
      }

      if(!empty($division)){
        $where .= " AND fl.division_code IN (".implode(',', $division).") ";
      }

      if(!empty($district)){
        $where .= " AND fl.district_code IN (".implode(',', $district).") ";
      }

      if(!empty($facility)){
        $where .= " AND fl.short_code IN ('".implode("','", $facility)."') ";
      }
      $result = DB::table("patient as p")
                  ->selectRaw("p.*, mdr.address, mdr.address_of_referring_unit, mdr.tb_registration_number, mdr.enrollment_status, mdr.enrollment_date, mdr.current_status, mdr.remarks, fl.name as facility_name, rea.name as reason_name, res.name result_name")
                  ->join("patient_mdr as mdr","mdr.pid","=","p.pid")
                  ->leftjoin("facility as fl","fl.short_code","=","p.facility_id")
                  ->leftjoin("ref_reason as rea","rea.id","=","p.reason_for_mtb")
                  ->leftjoin("ref_result as res","res.id","=","p.xpert_result")
                  ->whereRaw("p.deleted_status= 0 AND mdr.deleted_status = 0 ".$where)
                  ->get();
      return $result;
    }

  function geocode_division_parameter()
  {
    $result = DB::select("SELECT DISTINCT division_code, division FROM tbl_geocode ORDER BY division_code");
    return $result;
  }

  function get_geocode_parameter_data($type ='', $code = array())
  {
    $str_code = implode(',', $code);
    if($type == "division"){
      $qqq = DB::select("SELECT DISTINCT district_code, district FROM tbl_geocode WHERE division_code IN (".$str_code.") ORDER BY district_code");    
    }
    if($type == "district"){
      $qqq = DB::select("SELECT DISTINCT short_code, name FROM facility WHERE district_code IN (".$str_code.") ORDER BY short_code");     
    }

    if(count($qqq) > 0) { return $qqq;}
    else { return array(); }
  }
}