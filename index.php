<?php
	print("	<title>
				WinPy32
			</title>
			<body bgcolor = '#F5F5DC'>
				<center>		
					<table>
						<tr>
							<td>
								<a title = 'Python 3.5' href = 'http://www.python.it/' target = '_blank'><img src = 'python.png' width = '90' height = '90'></a>
							</td>
							
							<td>
								<h1>
									<span style = 'display:inline-block; padding:0px; margin-right:-7px;'>
										<font face = 'Arial' color = '#1E90FF'>
											Win
										</font>
									</span>
									
									<span style = 'display:inline-block; padding:0px; margin-right:-7px;'>
										<font face = 'Arial' color = '#4169E1'>
											P
										</font>
									</span>
									
									<span style = 'display:inline-block; padding:0px; margin-right:-7px;'>
										<font face = 'Arial' color = '#FFD700'>
											y
										</font>
									</span>
									
									<span style = 'display:inline-block; padding:0px; margin-right:-7px;'>
										<font face = 'Arial' color = '#32CD32'>
											3
										</font>
									</span>
									
									<span style = 'display:inline-block; padding:0px; margin-left:-2px;'>
										<font face = 'Arial' color = '#32CD32'>
											2
										</font>
									</span>
								</h1>
							</td>
							
							<td>
								<a title = 'Microsoft Windows 10' href = 'https://www.microsoft.com/it-it/windows/' target = '_blank'><img src = 'windows.png' width = '100' height = '100'></a>
							</td>
						</tr>
					</table>
					
					<a title = 'GNU Affero GPL v3' href = 'http://www.gnu.org/licenses/agpl-3.0.txt' target = '_blank'><img src = 'agplv3.png'></a>
					
					<br><br>
					
					<font face = 'Arial'>
						Crea il file <b>.exe</b> per il tuo software <b>.py</b>
					</font>
					
					<br><br>
					
					<font face = 'Arial'>
						<b>
							<em>
								Powered by
							</em>
						</b>
					</font>
					
					<br>
					
					<a title = 'PyInstaller' href = 'http://www.pyinstaller.org/' target = '_blank'><img src = 'pyinstaller.png'></a>
					
					<br><br>
					
					<a title = 'info' href = 'info.html' target = '_blank'><img src = 'info.png' widht = '50' height = '50'></a>
					
					<br><br>
					
					<form action = '' method = 'post' enctype = 'multipart/form-data'>
						<input type = 'hidden' name = 'MAX_FILE_SIZE' value = '30000'>
						
						<table>
							<tr>
								<td>
									<font face = 'Arial'>
										Carica il file:
									</font>
								</td>
								
								<td>
									<input type = 'file' name = 'file'>
								</td>
							</tr>
						</table>
						
						<br>
						
						<font face = 'Arial'>
							Tipo software
						</font>
						
						<br>
						
						<table>	
							<tr>
								<td>
									<font face = 'Arial'>
										Riga di comando
									</font>
								</td>
								
								<td>
									<input type = 'radio' name = 'tipo' value = 'cli'>
								</td>
							</tr>
							
							<tr>
								<td>
									<font face = 'Arial'>
										Grafica
									</font>
								</td>
								
								<td>
									<input type = 'radio' name = 'tipo' value = 'gui'>
								</td>
							</tr>	
						</table>
						
						<br>
						
						<input style = 'width: 115px' type = 'submit' name = 'invia' value = 'INVIA'>
					</form>");
	
	if(isset($_POST["invia"]) and isset($_POST["tipo"]))
	{
		if(strpos($_FILES["file"]["name"], ".py") !== false)
		{			
			move_uploaded_file($_FILES["file"]["tmp_name"], "C:/".$_FILES["file"]["name"]);
			
			if(strcmp($_POST["tipo"], "cli") == 0)
			{
				print(shell_exec("cd C:/ && pyinstaller --onefile ".$_FILES["file"]["name"]));	
			}
			
			if(strcmp($_POST["tipo"], "gui") == 0)
			{
				print(shell_exec("cd C:/ && pyinstaller --onefile --windowed ".$_FILES["file"]["name"]));
			}
			
			
			$name = "";
			
			for($c = 0; $c < strlen($_FILES["file"]["name"]) - 3; $c++)
			{
				$name = $name.$_FILES["file"]["name"]{$c};				
			}
			
			copy("C:/dist/".$name.".exe", "C:/wamp/www/projects/WinPy32/exe/".$name.".exe");
			
			unlink("C:/".$_FILES["file"]["name"]);
			unlink("C:/".$name.".spec");
						
			print("	<form action = '' method = 'post'>
						<iframe width = '1' height = '1' frameborder = '0' src = 'exe/".$name.".exe'>
							<input id = 'download' style = 'width: 115px' type = 'submit' name = 'scarica' value = 'SCARICA EXE'>
						</iframe>
					</form>");
					
			if(isset($_POST["scarica"]))
			{
				print("	<script>
							$('download').hide();
						</script>");
			}
		}
		
		else
		{
			print("	<script>
						alert('Errore! Caricare un file Python!');
					</script>");
		}
	}
			