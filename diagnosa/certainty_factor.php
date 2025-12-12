<?php
function combineCF($cf1, $cf2) {
    if ($cf1 >= 0 && $cf2 >= 0) {
        return $cf1 + $cf2 * (1 - $cf1);
    }
    elseif ($cf1 < 0 && $cf2 < 0) {
        return $cf1 + $cf2 * (1 + $cf1);
    }
    else {
        return ($cf1 + $cf2) / (1 - min(abs($cf1), abs($cf2)));
    }
}

function calculateCF($conn, $jawabanUser) {
    $query = "SELECT * FROM rule_diagnosa ORDER BY then_penyakit";
    $result = mysqli_query($conn, $query);

    $cf_results = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $gejala_rule = array_map('trim', explode(",", $row['if_gejala']));
        $penyakit = $row['then_penyakit'];
        $cf_rule = floatval($row['cf_rule']);
        
        $min_cf_gejala = 1.0; 
        $semua_gejala_ada = true;

        foreach ($gejala_rule as $gj_id) {
            $cf_gejala_user = $jawabanUser[$gj_id] ?? 0.0;
            
            if ($cf_gejala_user == 0.0) {
                $semua_gejala_ada = false;
                break; 
            }
            if ($cf_gejala_user < $min_cf_gejala) {
                $min_cf_gejala = $cf_gejala_user;
            }
        }

        if (!$semua_gejala_ada) {
            continue; 
        }
        
        $cf_single = $min_cf_gejala * $cf_rule;
        
        if (!isset($cf_results[$penyakit])) {
            $cf_results[$penyakit] = $cf_single;
        } else {
            $cf_results[$penyakit] = combineCF($cf_results[$penyakit], $cf_single);
        }
    }

    arsort($cf_results);
    
    return $cf_results;
}
?>