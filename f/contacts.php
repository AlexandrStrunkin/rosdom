<?
	include("$common_functions_dir/page1.php");
	
	/*
	//����������� ����� �������� �����
	$mes1 = "";
	if($HTTP_POST_VARS["action"] == "send"){
		$mes = "<h1>C�������� � ����� ".host(0).".ru</h1>";
		$mes .= "<b>�.�.�.:</b> ".$HTTP_POST_VARS["fio"]."<br>";
		$mes .= "<b>E-Mail:</b> ".$HTTP_POST_VARS["email"]."<br>";
		$mes .= "<b>�������:</b> ".$HTTP_POST_VARS["phone"]."<br>";
		$mes .= "<b>���������:</b> ".$HTTP_POST_VARS["message"];
		if(sendmail($info_email,"C�������� � ����� ".host(0).".ru",$mes,0)){
			$HTTP_POST_VARS["fio"] = $HTTP_POST_VARS["email"] = $HTTP_POST_VARS["phone"] = $HTTP_POST_VARS["message"] = "";
			$mes1 = "<font style='color:green; font-weight:bold;'>��������� ����������</font>";
		}
		else $mes1 = "<font style='color:red; font-weight:bold;'>������, ��������� �� ����������</font>";
	}
	$os_form = "
		<form class=os_form action=$REQUEST_URI method=post onsubmit=\"if(fio.value != '' && message.value != ''){action.value='send'; return true;} else{alert('�� ��������� �� ��� ������������ ����. ������������ ���� ������� ������.'); return false;}\">
			<input type=hidden name=action value=''>
			<table>
				<tr><td width=100><b>�.�.�.:</b></td><td><input class=text type=text name=fio value='".$HTTP_POST_VARS["fio"]."'></td></tr>
				<tr><td>E-Mail:</td><td><input class=text type=text name=email value='".$HTTP_POST_VARS["email"]."'></td></tr>
				<tr><td>�������:</td><td><input class=text type=text name=phone value='".$HTTP_POST_VARS["phone"]."'></td></tr>
				<tr><td><b>���������:</b></td><td><textarea name=message>".$HTTP_POST_VARS["message"]."</textarea></td></tr>
				<tr><td></td><td><input type=submit value='���������'> $mes1</td></tr>
			</table>
		</form>";
	$content = str_replace("<!--os_form-->",$os_form,$content);
	*/
	
	//����������� ������ ���������� ���������
	$dillers_list = "";
	//$res = query("select * from dillers where status=1 order by id");
	$res = query("select * from dillers where status=1 and id in('2','46') order by id");
	while($row = mysql_fetch_assoc($res)){
		$dillers_list .= "<p style='border-bottom:1px dotted #aaa; padding-bottom:10px;'>";
		$dillers_list .= "<b>�</b> ".$row["id"]."<br>";
		if($row["region"] != "")$dillers_list .= "<b>������:</b> ".$row["region"]."<br>";
		if($row["name"] != "")$dillers_list .= "<b>�����������:</b> ".$row["name"]."<br>";
		if($row["adress"] != "")$dillers_list .= "<b>�����:</b> ".$row["adress"]."<br>";
		if($row["phones"] != "")$dillers_list .= "<b>�������:</b> ".$row["phones"]."<br>";
		if($row["faxes"] != "")$dillers_list .= "<b>����:</b> ".$row["faxes"]."<br>";
		if($row["site"] != "")$dillers_list .= "<b>����:</b> <noindex><a href=http://www.".$row["site"]." target=_blank>".$row["site"]."</a></noindex><br>";
		if($row["email"] != "")$dillers_list .= "<b>E-Mail:</b> <noindex><a href=mailto:".$row["email"].">".$row["email"]."</a></noindex></p>";
	}
	$content = str_replace("<!--dillers_list-->",$dillers_list,$content);
	
	if(!$nopage)include($t0);
	else header("HTTP/1.1 404 Not Found");
?>