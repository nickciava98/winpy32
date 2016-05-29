<?php
	print("	<title>
				WinPy32
			</title>
			
			<center>		
				<table>
					<tr>
						<td>
							<img src = 'python.png' width = '100' height = '100'>
						</td>
						
						<td>
							<h1>
								<font face = 'Arial'>
									WinPy32
								</font>
							</h1>
						</td>
						
						<td>
							<img src = 'windows.jpg' width = '100' height = '100'>
						</td>
					</tr>
				</table>
				
				<font face = 'Arial'>
					Crea il file .exe per il tuo software .py
				</font>
				
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
					
					<input style = 'width: 115px' type = 'submit' name = 'invia' value = 'INVIA'>
				</form>");
	
	if(isset($_POST["invia"]))
	{
		if(strpos($_FILES["file"]["name"], ".py") !== false)
		{			
			move_uploaded_file($_FILES["file"]["tmp_name"], "C:/".$_FILES["file"]["name"]);
			
			print(shell_exec("cd C:/ && pyinstaller --onefile ".$_FILES["file"]["name"]));
			
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
			