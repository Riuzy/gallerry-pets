<?php
function forwardChaining($conn, $jawabanUser) {
    $query = "SELECT * FROM rule_base";
    $result = mysqli_query($conn, $query);

    $hasil = null;

    while ($row = mysqli_fetch_assoc($result)) {
        $gejala_rule = explode(",", $row['if_gejala']);
        $then_hewan = $row['then_hewan'];

        $cocok = true;
        foreach ($gejala_rule as $gj) {
            if (!in_array(trim($gj), $jawabanUser)) {
                $cocok = false;
                break;
            }
        }

        if ($cocok) {
            $hasil = $then_hewan;
            break;
        }
    }

    return $hasil;
}
?>