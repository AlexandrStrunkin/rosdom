<?
	//����� ����� ���� ��� projects
	
	$total = @mysql_result(mysql_query($q1), 0);// ����� ��������
	
	if(isset($bartype) && $bartype == 1) 
		$page = isset($_GET["page"]) ? $_GET["page"] : 0;
	else { 
		if(preg_match('/^[0-9]+$/', $v[$n-1])) $page = $v[$n-1]-1;
		else $page = 0;
	}

	//���� � URL ������� �������� ��������� �� ���������� �������� -> 404
	if($v[1] != "sravn" && $v[1] != "otl" && $total > 0) {
		if($page < 0 || ($page + 1) > ceil($total/$in_page) || $v[$n-1] == '1') {
			header('HTTP/1.0 404 not found');
			exit;
		}
	}

	//������ ����� ���������� ��� ���������� � �����������, ���������� � <head>
	$paginatorLinks = "";
	if($total > $in_page) {
		if($page > 0 && ($page + 1) <= ceil($total/$in_page)) { 
			if($bartype == 2) $paginatorLinks .= "<link rel='prev' href='" . $url . ($page > 1 ? $page . "/" : "") . "'>"; 
			else  $paginatorLinks .= "<link rel='prev' href='" . $url . ($page - 1) . "'>"; 
		}
		if($page >= 0 && ($page + 1) < ceil($total/$in_page)) {
			if($bartype == 2) $paginatorLinks .= "<link rel='next' href='" . $url . ($page + 2) . "/'>";
			else  $paginatorLinks .= "<link rel='next' href='" . $url . ($page + 1) . "'>"; 
		}
	}

	$res = query($q2 . get_limit($page, $total, $in_page));
	
	$content = "";
	
	if(host(0) == "postroi")$content .= "
		<p class=colprj>
			����� ���������� <a href=/$projects_dir/>������������� �������� � ��������</a>: <b class=total>".query1("select count(id) from projects where $commonwhere")."</b><br>
			���������� <a href=/>�������� �����</a> � ������ ���������: <b class=total1>$total</b>
		</p>";
	
	
	/* ������ ��� ������� */
	$res_a = query("select * from $pages where dir='$dir' and site='".host(1)."'"); 
	$content_a = '';
	if($row_a = mysql_fetch_assoc($res_a)){
		
		if($page > 0) $pageNumberAdd = " (���. " . ($page + 1) . ")";
		else $pageNumberAdd = "";

		$title = $row_a["title1"] . $pladd . $pageNumberAdd;
		$keywords = $row_a["keyw"];
		$description = $row_a["des"]  . $pladd . $pageNumberAdd;
		$h1 = $row_a["name"] . $pladd;
		
		if($page <= 0 && !(strpos($REQUEST_URI, "do150") > 0 || strpos($REQUEST_URI, "ot150do250") > 0 || strpos($REQUEST_URI, "ot250do400") > 0  || strpos($REQUEST_URI, "ot400") > 0))
			$content_a = $row_a["content"];//���� ������ ������ ��������
		mysql_free_result($res_a);
	}
	
	if(host(0) == "postroi") {
		
		if($v[0] == "search") {
			$content .= "
				<noindex>
					<form id='srch' action='/search/' method='get'>
						<table>
							<tr>
								<td style='width:10%;'>����� (���):</td>
								<td style='width:20%'><input type='text' name='num' value='" . (isset($_GET['num']) ? $_GET['num'] : '') . "'></td>
								<td style='width:10%;'>�������� (��):</td>
								<td style='width:20%'>
									<input type='text' name='gabx' value='" . (isset($_GET['gabx']) ? $_GET['gabx'] : '') . "' style='width:30%' /> x
									<input type='text' name='gaby' value='" . (isset($_GET['gaby']) ? $_GET['gaby'] : '') . "' style='width:30%' />
								</td>
								<td style='width:10%;'>��������:</td>
								<td style='width:20%'>
									<select name='mansarda'>
										<option value='0'>�� �����</option>
										<option value='1'" . ((isset($_GET['mansarda']) && $_GET['mansarda'] == '1')?" selected":"") . ">����</option>
										<option value='2'" . ((isset($_GET['mansarda']) && $_GET['mansarda'] == '2')?" selected":"") . ">���</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>�������:</td>
								<td>
									<select name='pl'>
										<option value='0'>�� �����</option>";
										for($i = 0; $i < 4; $i++)
											$content .= selected((isset($_GET['pl']) ? $_GET['pl'] : ''), ($i+1), $pl[$i][0]);
										$content .= "
									</select>
								</td>
								<td>������:</td>
								<td>
									<select name='flores'>
										<option value='0'>�� �����</option>";
										for($i = 1; $i < 6; $i++)
											$content .= selected((isset($_GET['flores']) ? $_GET['flores'] : ''), $i, $i);
										$content .= "
									</select>
								</td>
								<td>������:</td>
								<td>
									<select name='cokol'>
										<option value='0'>�� �����</option>
										<option value='1'" . ((isset($_GET['cokol']) && $_GET['cokol'] == '1')?" selected":"") . ">����</option>
										<option value='2'" . ((isset($_GET['cokol']) && $_GET['cokol'] == '2')?" selected":"") . ">���</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>��������:</td>
								<td>
									<input type='checkbox' name='k'" . ((isset($_GET['k']) && $_GET['k'] == 'on')?" checked":"") . " /> ������<br /> 
									<input type='checkbox' name='p'" . ((isset($_GET['p']) && $_GET['p'] == 'on')?" checked":"") . " /> ���������<br />
									<input type='checkbox' name='d'" . ((isset($_GET['d']) && $_GET['d'] == 'on')?" checked":"") . " /> ������<br /> 
									<input type='checkbox' name='s'" . ((isset($_GET['s']) && $_GET['s'] == 'on')?" checked":"") . " /> ������<br />
								</td>
								<td>���������:</td>
								<td>
									<input type='checkbox' name='garage'" . ((isset($_GET['garage']) && $_GET['garage'] == 'on')?" checked":"") . " /> �����<br /> 
									<input type='checkbox' name='sauna'" . ((isset($_GET['sauna']) && $_GET['sauna'] == 'on')?" checked":"") . " /> �����<br />
									<input type='checkbox' name='waterpool'" . ((isset($_GET['waterpool']) && $_GET['waterpool'] == 'on')?" checked":"") . " /> �������<br />
								</td>
								<td colspan='2'>
									<a onclick=$('#srch').submit() class='show_all w'><b class='show_all_left fl'></b><b class='show_all_center fl'>������</b><b class='show_all_right fl'></b></a>
								</td>
							</tr>
						</table>
					</form>
				</noindex>";
		}
		else $content .= "<hr />";
	}
	
	$content .= "<div class=bar>" . draw_bar($page, $total, $in_page, $url, isset($bartype) ? $bartype : '');

	//������ �� �������
	if(host(0) == "postroi" || host(0) == "rosdom") {
		if($v[0] == $projects_dir && ($v[1] == "p" || $v[1] == "k" || $v[1] == "d" || $v[1] == "s")) {
			$content .= "<div class='plbuttons'>
				<a href='/$projects_dir/" . $v[1] . "/do150/' " . 		((!isset($v[2]) || $v[2] == "do150") ? "class='plbuttonsel'":"class='plbutton'") . ">�� 150 �<sup>2</sup></a>
				<a href='/$projects_dir/" . $v[1] . "/ot150do250/' " . 	((!isset($v[2]) || $v[2] == "ot150do250") ? "class='plbuttonsel'":"class='plbutton'") . ">�� 150 �� 250 �<sup>2</sup></a>
				<a href='/$projects_dir/" . $v[1] . "/ot250do400/' " . 	((!isset($v[2]) || $v[2] == "ot250do400") ? "class='plbuttonsel'":"class='plbutton'") . ">�� 250 �� 400 �<sup>2</sup></a>
				<a href='/$projects_dir/" . $v[1] . "/ot400/' " . 		((!isset($v[2]) || $v[2] == "ot400") ? "class='plbuttonsel'":"class='plbutton'") . ">�� 400 �<sup>2</sup></a>
				</div>";
		}
	}
	
	$content .= "</div><br>";
	
	//����� ��������
	if(host(0) == "postroi")$mode = 1; 
	else $mode = 0;
	
	if(isset($v[1]) && $v[1] == 'sravn' && $mode && $total > 0) {
		
		/******************************************************************************************************************************/
		
		$content .= "<div id='sravn_div' style='overflow:scroll;height:1000px;cursor:move;' unselectable='on' onselectstart='return false;'>";
		
		$sravn_array = array(
			'������ �'									=>	array('id'),
			'����� �������'								=>  array('o_pl'),
			'����� �������'								=>	array('g_pl'),
			'������� ���������'							=>	array('pl_z'),
			'������������'								=>	array('', 'p.jpg', " style='width:300px'"),
			'��������'									=>	array('des'),
			'���������'									=>	array('mater'),
			'������ �������� ����������'	=>	array('matsname'),
				
			'���� ���������� �����'				=>	array('', '0.gif', " style='width:300px'"),
			'���� ������� �����'					=>	array('', '1.gif', " style='width:300px'"),
			'���� ������� �����'					=>	array('', '2.gif', " style='width:300px'"),
			'���� �������� �����'					=>	array('', '3.gif', " style='width:300px'"),
			'���� ���������� �����'				=>	array('', '4.gif', " style='width:300px'"),
			'���� ������ �����'						=>	array('', '5.gif', " style='width:300px'"),
			'���� ����������� �����'			=>	array('', 'm.gif', " style='width:300px'"),
			
			'�����, ��� �������'					=>	array('', 'f-sm.gif',	" style='width:200px'"),
			'�����, ��� �����'						=>	array('', 'l-sm.gif',	" style='width:200px'"),
			'�����, ��� ������'						=>	array('', 'r-sm.gif',	" style='width:200px'"),
			'�����, ��� �����'						=>	array('', 'z-sm.gif',	" style='width:200px'"),
				
			'����'												=>	array('pr0')
		);
		
		$content .= "<table cellspacing='0' cellpadding='0'>";
		
		foreach($sravn_array as $sa_key => $sa_val) {
			$showRow = false;
			$content_tmp = "<tr valign='top'>";
			mysql_data_seek($res, 0); $i = 0; 
			while($row = mysql_fetch_assoc($res)) {
				
				$content_tmp .= "<td class='srcn_col_" . $i++ . "'>";
				if($sa_val[0] != '') {
					if($sa_val[0] == 'id') 
						$content_tmp .= "<img src='/i2/del.png' class='delsravn' id='del_" . strtolower($row[$sa_val[0]]) . 
							"' onclick=\"$('#otl_dks_span').load('/ajaxotloj.php','m=del&p=dks_" . strtolower($row[$sa_val[0]]) . "');\" /><br />";
					
					$content_tmp .= "<b>" . $sa_key . ":</b><br />";
					
					if($row[$sa_val[0]] != '' || $sa_val[0] == 'id' || $sa_val[0] == 'pr0') {
						$showRow = true;
						if($sa_val[0] == 'id') $content_tmp .= "<a href='/" . $projects_dir . "/" . strtolower($row['id']) . "/' target=_blank>" . strtoupper($row[$sa_val[0]]) . "</a></td>";
						elseif($sa_val[0] == 'matsname') $content_tmp .= "<table>" . $row[$sa_val[0]] . "</table>";
						elseif($sa_val[0] == 'pr0') { 
							
							$content_tmp .= project_prices($row, actions($row["name"],$row["dt"])); 
						}
						else $content_tmp .= $row[$sa_val[0]] . "</td>";
					}
					else $content_tmp .= "�� �������</td>";
				} 
				else {
					$src = $projects_dir . "/" . strtolower($row['id']) . "/" . $sa_val[1];
					$content_tmp .= "<b>" . $sa_key . ":</b><br />";
					if(file_exists($src)) {
						$showRow = true;
						$content_tmp .= "<img src='/" . $src . "'" . $sa_val[2] . " ondrag='return false' ondragdrop='return false' ondragstart='return false' /></td>";
					}
					else $content_tmp .= "���</td>";
				}				
			}

			$content_tmp .= "</tr>";
			if($showRow) 
				$content .= $content_tmp;
		}
		
		$content .= "</table>";
		$content .= "</div>";
		
		/******************************************************************************************************************************/
	}	
	else {
		$content .= "<div class='projects'" . ((isset($v[1]) && $v[1] == 'otl')?"style='padding-top:10px'":"") . ">";
		while($row = mysql_fetch_assoc($res)){
			if(host(0) == "proekty-kvadrat")$content .= breif1($row,$mode);
			else if(host(0) == "postroi") $content .= breif2($row,$mode);
			else $content .= breif($row,$mode);
		}
		$content .= "</div>";
		
		$content .= "<div class='bar'>" . draw_bar($page,$total,$in_page,$url,2) . "</div><br />";
	}
	
	if($total == 0 && $v[0] == 'search') 
		$content .= "<p>������ �������� ������ �� ������������� �� ���� ������. ���������� �������� �������.</p>";
	if((host(0) == "postroi") && $total > 0)$content .= "<hr class='seconh_hr' />";
	
	$content .= $content_a;
	
	//��������� ����
	//if(host(0) == "postroi") $content .= implode("",file("t/bbb.php"));
	
?>