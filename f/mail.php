<?
	function diffdate($d1,$d2){
		$h1 = substr($d1,0,2); $h2 = substr($d2,0,2);
		$m1 = substr($d1,3,2); $m2 = substr($d2,3,2);
		$s1 = substr($d1,6,2); $s2 = substr($d2,6,2);
		return abs(($h1*60*60+$m1*60+$s1) - ($h2*60*60+$m2*60+$s2));
	}

	$dt = date("Y-m-d");//�������
	
	$res = query("select * from users where lastsend<'".$dt."' and news=1 and site=".host(1)." limit 1");//�������� 1 email ��� ������� �����
	
	if($row = mysql_fetch_assoc($res)){

		$currenttime = date("H:i:s"); 
		$lastsendtime = @mysql_result(mysql_query("select lastsendtime from projects_mail_hour where id='1'"),0);

		if(diffdate($currenttime,$lastsendtime) > 4){
			
			$mes = "";
			
			//������������ ���������
			$send_messages = mysql_array("select * from projects_mail_mes where mes_dt>'".$row["lastsend"]."' and mes_dt<='".$dt."' and site='".host(1)."' order by mes_dt");
			if(count($send_messages) > 0){
				for($i=0;$i<count($send_messages);$i++){
					$mes .= "<b>".$send_messages[$i]["mes_name"]."</b>";
					$mes .= "<p>".$send_messages[$i]["mes"]."</p>";
				}
			}

			//������������ ������ ����� ��������
			$send_projects = mysql_array("select * from projects where dt>'".$row["lastsend"]."' and dt<='".$dt."' and site like('".regular()."') and ((sflag is null) or sflag<'2') order by dt desc");
			if(count($send_projects) > 0){
				$mes .= "<h3>����� ����������� � ������� ������������� �������� ".host(0).".ru:</h3>";
				$mes .= "<table border=0 cellpadding=0 cellspacing=0>";
				for($i=0;$i<count($send_projects);$i++){
					$mes .= "	
						<tr valign=top>
							<td><a href=".$root.$projects_dir."/".strtolower($send_projects[$i]["id"])."/><img src=".$root.$projects_dir."/".strtolower($send_projects[$i]["id"])."/".strtolower($send_projects[$i]["prev"])." border=0></a></td>
							<td style='padding:10px; background:#f5f5f5;'><a href=".$root.$projects_dir."/".strtolower($send_projects[$i]["id"])."/><b>������ �������� � ".$send_projects[$i]["id"]."</b></a><br>"; 
							if($send_projects[$i]["des"]!="")$mes .= strip_tags($send_projects[$i]["des"]); 
							else $mes .= "����� ��������� ���������� �� ����� ������� �� ������ �������� �� ����� �����."; 
							$mes .= "<br><br><a href=".$root.$projects_dir."/".strtolower($send_projects[$i]["id"])."/>������� �� �������� �������</a></td>
						</tr>
						<tr><td colspan=2>&nbsp;</td></tr>";
				}
				$mes .= "</table>";
			}
				
			//��������
			if($mes != ""){
				query("update users set lastsend='".$dt."' where id='".$row["id"]."'"); // ������ ������� ���� � �������� ���������
				query("update projects_mail_hour set lastsendtime=now() where id=1");	// ������ ������� ��������� �������
				
				$mes = "<h2>������� �������� ������������� �������� ��������� ".host(0).".ru</h2>".$mes;
				$mes .= "<p>���� �� <b><font color=red>��</font></b> ������ �������� ������� c ����� <a href=http://www.".host(0).".ru target=_blank>".host(0).".ru</a>, 
					�� ������ ���������� �� ��� ���� ������� � �������� � ����� ������ ��������.";
				sendmail($row["email"],"������� �������� ������������� �������� ��������� ".host(0).".ru | $dt",$mes,1);
			}
			
		}
	}
?>