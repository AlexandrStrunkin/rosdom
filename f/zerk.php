<html>
	<head>
		<title><? 
				if(host(0) != "catalog-domov"){
					if(host(0) != "stroybur")
						echo "����� �������� � ������������ �� ���������: ".implode(", ",$phones);
					else
						echo "������������ �� ���������: ".implode(", ",$phones);
				} 
			?></title>
		<meta http-equiv=content-type content='text/html; charset=windows-1251' />
		<meta name='robots' content='noindex,nofollow' />
		<style>
			.prices{padding-left:10px;}
			.prices .head{background:#ccc; font-weight:bold;}
			.prices .b{font-weight:bold;}
			.prices td{padding:10px; border-bottom:1px solid #aaa;}
			.prices .head td{border-bottom:0;}
			p.prices{color:#999; font-size:12px; margin-bottom:10px;}

			.hint{font-family:tahoma; font-size:12px; color:#0082c4; border-bottom: 1px dashed #0082c4; cursor:pointer; display:inline;}
			.hint1{font-family:tahoma; font-size:12px; color:white; background:#555; width:300px; position:absolute; margin:0 0 0 0px; padding:20px; display:none; line-height:16px; z-index:9;}
			
			#variants{border:1px dotted gray;}
			#variants{overflow:hidden; zoom:1; padding:10px;}
			.var{float:left; margin-right:20px; width:200px; height:250px;}
			.var img{padding:0; margin:0;}
			.var varimg{width:254px;}
			.var a{font-weight:bold;}
			
			#actions{border:1px dotted gray;}
		</style>
	</head>
	<body>
		<? 
			echo "<h1>".$h1."(S) - ���������� �������</h1>"; 
			echo project_p($project)."<br>";
			echo "<h2>�������:</h2>";
				if($project[0]["o_pl"] != "" && $project[0]["o_pl"] != 0)echo "<b>����� �������: ".$project[0]["o_pl"]." �<sup>2</sup></b><br>";
				if($project[0]["g_pl"] != "" && $project[0]["g_pl"] != 0)echo "<b>����� �������: ".$project[0]["g_pl"]." �<sup>2</sup></b><br>";
				if($project[0]["pl_z"] != "" && $project[0]["pl_z"] != 0)echo "<b>������� ���������: ".$project[0]["pl_z"]." �<sup>2</sup></b>";	
			echo "<br><br>";
			if($project_h2_mater1 != "" && $project_h2_mater2 != "")echo project_mater($project,$rashod)."<br>";
			
			if($project_h2_pln != "" && $project_h2_fsd != "")echo project_pln_fsd($project,$pln,$fsd)."<br>";
			
			
			if($project_h2_actions != "")echo project_actions($actions_set)."<br>";
			
			if($project_h2_vars != "")echo project_variants($variants)."<br>";
			
			if($project_h2_prices != "" && $project_h2_prices_table1 != "" && $project_h2_prices_hintword != "" && $project_h2_prices_table2 != "")
				echo project_prices($project[0],$actions_set);
				
			if(host(0) == "postroi")
			echo "
				<h2>����� - �� ������ ���� ������ ���� �������? �� �������� ��� �� ��� ����� ������ ����!</h2>
				<p>
					�������� ��� ���������� <b>������</b> � <b>�������� ������ �� ��� ����� ������ ����</b>.
					����������� ������������� ��� ���, ��������� � ��������� �������� (��������-��������� ��������), ��������� ������ ������������� ���������. �� ��������� �� ����� ����� �� ������������� ��������� ������	�� ������� ������������ ��������������� � ������ ����������.<br>
					<b>��� ���� �� ����� ����� ���� � ������ ���� �������.</b>
				</p>";
				
			if(host(0) != "catalog-domov"){
				echo "<h2>���������� ����������:</h2><p>";
				if(host(0) != "stroybur")
					echo "<b>���� ��������� �������� - �� 1 �� 5 ����.</b><br>
					������ ������ ��� �������� ������ �� ������ �� ���������: <b>".implode(", ",$phones)."</b></br>
					����� �����: <b>������, ��. ����� ���������, �.19, ���� 504.</b><br>
					������� �������� <b>".host(0).".ru</b><br>";
				else
					echo "������ ������ �� ������ �� ���������: <b>".implode(", ",$phones)."</b></br>
						������������ �������� \"��������\": <b>".host(0).".ru</b><br>";
				echo "E-mail: <b>".$info_email."</b></p>";
			}
		?>
		
	</body>
</html>