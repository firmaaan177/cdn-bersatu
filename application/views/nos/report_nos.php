<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename='LAPORAN NOS ".date('Y')." - ".$dealer['nama_dealer'].".xls");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Report NOS</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th colspan="13" style="padding:10px;">
                    <p style="margin-bottom:10px;">LAPORAN NOS <?= date('Y') ?></p>
                    <h3 style="margin:0"><?= $dealer['nama_dealer'] ?></h3>
                </th>
            </tr>
            <tr>
                <th>No</th>
                <th>Jenis Audit</th>
                <th>uniqueid</th>
                <th>Panel</th>
                <th>Item</th>
                <th>Sub Item</th>
                <th>Sub Item 2</th>
                <th>Indikator</th>
                <th>Mandatory</th>
                <th>"Exist, Good(+1)"</th>
                <th>"Exist Not Good (-1)"</th>
                <th>"Not exist (0)"</th>
                <th>N/A</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $total_exist_good = 0;
            $total_not_exist_good = 0;
            $total_not_exist = 0;
            $total_na = 0;
            foreach($report_nos as $row) { 
                $exist_good = $this->db->where('id_panel_sub', $row['id_panel_sub'])->where('nilai', 1)->get('nos_audit')->result_array();
                $not_exist_good = $this->db->where('id_panel_sub', $row['id_panel_sub'])->where('nilai', -1)->get('nos_audit')->result_array();
                $not_exist = $this->db->where('id_panel_sub', $row['id_panel_sub'])->where('nilai', 0)->get('nos_audit')->result_array();    
                $na = $this->db->where('id_panel_sub', $row['id_panel_sub'])->where('nilai', 'empty')->get('nos_audit')->result_array();    
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td>NOS</td>
                <td><?= $row['uniqueid'] ?></td>
                <td><?= $row['nama_panel_sub'] ?></td>
                <td><?= $row['item'] ?></td>
                <td><?= $row['sub_item'] ?></td>
                <td><?= $row['sub_item_2'] ?></td>
                <td><?= $row['indikator'] ?></td>
                <td align="center"><?= $row['mandatory'] ?></td>
                <td align="center"><?= $row['nilai'] == '1' ? 'v' : '' ?></td>
                <td align="center"><?= $row['nilai'] == '-1' ? 'v' : '' ?></td>
                <td align="center"><?= $row['nilai'] == '0' ? 'v' : '' ?></td>
                <td align="center"><?= $row['nilai'] == 'empty' ? 'v' : '' ?></td>
            </tr>

            <?php 
             if($row['nilai'] == 1){
                $total_exist_good += count($exist_good);
             }else if($row['nilai'] == -1){
                $total_not_exist_good += count($not_exist_good);
             }else if($row['nilai'] == 0){
                $total_not_exist += count($not_exist);
             }else{
                $total_na += count($na);
             }
            ?>
            <?php } ?>
            <tr>
                <td colspan="8" rowspan="4" align="center">H1 Premises</td>
                <td>TC</td>
                <td><?= $total_exist_good; ?></td>
                <td><?= $total_not_exist_good; ?></td>
                <td><?= $total_not_exist; ?></td>
                <td><?= $total_na; ?></td>
            </tr>
            <tr>
                <td>TP</td>
                <td><?= $tp_eg = $total_exist_good * 1; ?></td>
                <td><?= $tp_tneg = $total_not_exist_good * -1; ?></td>
                <td><?= $tp_tne = $total_not_exist * 0; ?></td>
                <td><?= $total_na * 0; ?></td>
            </tr>
            <tr>
                <td>Result Angka</td>
                <td colspan="4" align="center"> <?= ($total_exist_good + $total_not_exist_good + $total_not_exist)/($tp_eg + $tp_tneg + $tp_tne); ?>%</td>
            </tr>
            <tr>
                <td>H1 Premises Result</td>
            </tr>
        </tbody>
        
	</table>
</body>

</html>