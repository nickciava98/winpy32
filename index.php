<?php
	print("	<title>
				WinPy32
			</title>
			
			<center>		
				<table>
					<tr>
						<td>
							<a href = 'http://www.python.it/' target = '_blank'>
								<img src = 'python.png' width = '100' height = '100'>
							</a>
						</td>
						
						<td>
							<h1>
								<font face = 'Arial'>
									WinPy32
								</font>
							</h1>
						</td>
						
						<td>
							<a href = 'https://www.microsoft.com/it-it/windows/' target = '_blank'>
								<img src = 'windows.jpg' width = '100' height = '100'>
							</a>
						</td>
					</tr>
				</table>
				
				<a href = 'http://www.gnu.org/licenses/agpl-3.0.txt' target = '_blank'>
					<img src = 'agplv3.png'>
				</a>
				
				<br><br>
				
				<font face = 'Arial'>
					Crea il file .exe per il tuo software .py
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
				
				<a href = 'http://www.pyinstaller.org/' target = '_blank'>
					<img src = 'pyinstaller.png'>
				</a>
				
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
						
			print("	<form action = 'exe/".$name.".exe' method = 'post'>
						<input style = 'width: 115px' type = 'submit' name = 'scarica' value = 'SCARICA EXE'>
					</form>");
		}
		
		else
		{
			print("	<script>
						alert('Errore! Caricare un file Python!');
					</script>");
		}
	}
			