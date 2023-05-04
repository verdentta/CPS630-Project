<?php require 'redirect.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>DB Maintenance</title>
	<link rel="icon" href="images/logo-favicon-white.png">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<style>
		/* Styling for the drop-down menu */
		.dropdown {
			position: relative;
			display: inline-block;
		}
		
		.dropdown-content {
			display: none;
			position: absolute;
			z-index: 1;
			background-color: #f9f9f9;
			min-width: 160px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			padding: 12px 16px;
		}
		
		.dropdown:hover .dropdown-content {
			display: block;
		}

		/* Styling for the menu options */
		.dropdown-content a {
			display: block;
			color: #000;
			padding: 8px 0;
			text-decoration: none;
			transition: background-color 0.3s;
		}
		
		.dropdown-content a:hover {
			background-color: #f1f1f1;
		}
        /* Styling for the dialog box */
		.dialog {
			position: fixed;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			background-color: #fff;
			border: 1px solid #ccc;
			padding: 20px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
			z-index: 100;
			width: 800px;
    		height: 400px;
			overflow: auto;
			
			
		}
		
		.dialog-overlay {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: rgba(0, 0, 0, 0.5);
			z-index: 99;
		}
		
		/* Styling for the buttons */
		.dialog-buttons {
			display: flex;
			justify-content: space-between;
			margin-top: 20px;
			background-color: #007bff;
			
			color: #fff;
			border: none;
			padding: 10px 20px;
			border-radius: 4px;
			cursor: pointer;
			transition: background-color 0.3s;
			margin: auto;
		}
		
		.dialog-buttons:hover {
			background-color: #0069d9;
		}

		.dialog-close-wrapper {
			position: absolute;
			bottom: 0;
			right: 0;
			padding: 20px;
		}

		.back-btn {
			background-color: #4d2d52ff;
			color: white;
			border: none;
			margin-left: 20px;
			display: inline;
			text-align: center;
			padding: 5px;
		}
		
		.back-btn:hover {
			background-color: #9395d3ff;
		}
	</style>
</head>
<body>


<!-- Drop-down menu -->
<div style="display: inline-block;">
<h1 style="float: left; padding: 0px 20px;">Data Base Maintain Mode</h1>
<!-- Drop-down menu -->
<div style="float: left; padding: 22px 20px; " class="dropdown">
	<button class="dialog-buttons">DB Maintain</button>
	<div class="dropdown-content">
		<a href="#" onclick="openDialog('Select')">Select</a>
		<a href="#" onclick="openDialogInsert('Insert')">Insert</a>
		<a href="#" onclick="openDialogDelete('Delete')">Delete</a>
		<a href="#" onclick="openDialogUpdate('Update')">Update</a>
	</div>
</div>
 
</div>

<!-- Dialog box -->
<div class="dialog-overlay" style="display: none;"></div>
<div class="dialog" style="display: none;"> 
		<!-- //SELECT -->
		<div id="dialog" style="display: none;">
			<h2>Select</h2>
			<select id="first-dropdown"></select>
			<select id="second-dropdown"></select>
			<button onclick="submit_Select()">Generate</button>
			<div id="SelectTable-container"></div>
			<div class="dialog-close-wrapper">
				<button class="dialog-buttons" onclick="closeDialog()">Close</button>
			</div>
			
		</div>

		<!-- //INSERT -->
	<div id="dialogInsert" style="display: none;">
		<form id="my-form">
			<h2>Insert</h2>
			<select id="my-select"><option value="">None</option></select>
			<div id="InsertColumnLabels"></div>
		</form>
		<button id="submit-btn">Submit</button>
		<div style="color: blue;" id="insertStatus"></div>
		<div class="dialog-close-wrapper">
			<button class="dialog-buttons" onclick="closeDialogInsert()">Close</button>
		</div>
	</div>

		<!-- //DELETE -->
		<div id="dialogDelete" style="display: none;">
			<form id="my-form">
				<h2>Delete</h2>
				<label >Select Table</label>
				<select  id="selectTables_Delete"><option value="">None</option></select>
				<div id="InsertID2"></div>
			</form>
			<button onclick="deleteRecord()">Delete record</button>
			<div style="color: blue;" id="insertStatusDelete"></div>
			<div class="dialog-close-wrapper">
				<button class="dialog-buttons" onclick="closeDialogDelete()">Close</button>
			</div>
		</div>

		<!-- //UPDATE -->
	<div id="dialogUpdate" style="display: none;">
		<form id="my-form">
			<h2>Update</h2>
			<label >Select Table</label>
			<select  id="selectTables_Update"><option value="">None</option></select>
			<div id="InsertID"></div>
		</form>
		<button onclick="getUpdateColumns()">View Columns</button>
		<div id="displayUpdateColumns"></div>
		<div style="color: blue;" id="insertStatusUpdate"></div>
		<div class="dialog-close-wrapper">
			<button class="dialog-buttons" onclick="closeDialogUpdate()">Close</button>
		</div>
	</div>



</div>
<div class="dialog" style="display: none;"> 
	
</div>


	<script>
		 var dialog = document.querySelector('.dialog');
		var dialogOverlay = document.querySelector('.dialog-overlay');
		function openDialog() {
			dialog.style.display = 'block';
			dialogOverlay.style.display = 'block';
			$('#dialog').show();
		}
		function openDialogInsert() { //2-Insert
			dialog.style.display = 'block';
			dialogOverlay.style.display = 'block';
			$('#dialogInsert').show();
		}
		function openDialogDelete() { //3-Delete
			dialog.style.display = 'block';
			dialogOverlay.style.display = 'block';
			$('#dialogDelete').show();
		}
		function openDialogUpdate() { //4-Update
			dialog.style.display = 'block';
			dialogOverlay.style.display = 'block';
			$('#dialogUpdate').show();
		}
		

		function closeDialog() {
			dialog.style.display = 'none';
			dialogOverlay.style.display = 'none';
			$('#dialog').hide();
		}
		function closeDialogInsert() { //2-Insert
			dialog.style.display = 'none';
			dialogOverlay.style.display = 'none';
			document.getElementById("my-form").reset();
			$('#dialogInsert').hide();
		}
		function closeDialogDelete() { //4-Delete
			dialog.style.display = 'none';
			dialogOverlay.style.display = 'none';
			//document.getElementById("my-form").reset();
			$('#dialogDelete').hide();
		}
		function closeDialogUpdate() { //4-Update
			dialog.style.display = 'none';
			dialogOverlay.style.display = 'none';
			//document.getElementById("my-form").reset();
			$('#dialogUpdate').hide();
		}
		


//-SELECT-------------------------------------------------------------------------------------------------------------------------------------------
		//Generate Button -> Display the Select Table
		function submit_Select() {
			var firstDropdownValue = $('#first-dropdown').val();
			var secondDropdownValue = $('#second-dropdown').val();
			$.get('http://localhost/CPS630Project/Phase01/server/APIs/select.php?table=' + firstDropdownValue + '&column=' + secondDropdownValue, function(data) {
				var table = '<table><thead><tr>';
				for (var key in data[0]) {
					table += '<th>' + key + '</th>';
				}
				table += '</tr></thead><tbody>';
				for (var i = 0; i < data.length; i++) {
					table += '<tr>';
					for (var key in data[i]) {
						table += '<td>' + data[i][key] + '</td>';
					}
					table += '</tr>';
				}
				table += '</tbody></table>';
				$('#SelectTable-container').html(table);
			});
		}

		// Populate 1st Drop-down
		$(document).ready(function() {
			$.get('http://localhost/CPS630Project/Phase01/server/APIs/select.php/getTables', function(data) {
				var options = '';
				for (var i = 0; i < data.length; i++) {
					options += '<option value="' + data[i] + '">' + data[i] + '</option>';
				}
				$('#first-dropdown').html(options);
			});
		});

		// Populate 2nd Drop-down
		$('#first-dropdown').on('change', function() {
			var selectedOption = $(this).val();
			console.log(selectedOption);
			$.get('http://localhost/CPS630Project/Phase01/server/APIs/select.php/getColumns?table=' + selectedOption, function(data) {
				var options = '<option value="*">All</option>';
				for (var i = 0; i < data.length; i++) {
					options += '<option value="' + data[i] + '">' + data[i] + '</option>';
				}
				$('#second-dropdown').html(options);
			});
		});
//-INSERT-------------------------------------------------------------------------------------------------------------------------------------------
		//gets the Tables for 2-Insert
		const select = document.getElementById('my-select');
		const url = 'http://localhost/CPS630Project/Phase01/server/APIs/select.php/getTables';
		fetch(url)
			.then(response => response.json())
			.then(data => {
			data.forEach(item => {
				const option = document.createElement('option');
				option.value = item;
				option.text = item;
				select.appendChild(option);
			});
			})
			.catch(error => console.error(error));

		//2-Insert
		//For INSERT DIALOG, variable keeps track of what was selected
		let selectedInsertTable=null;
			// Add event listener to the select element
		select.addEventListener('change', function() {
		// Get the selected value
		selectedInsertTable = select.value;
		console.log(selectedInsertTable); // display the selected value in the console
		insertStatus.textContent="";
		insertStatusUpdate.textContent="";
		insertStatusDelete.textContent="";
		});


		$(document).ready(function() {
			$("#my-select").on('change', function() {
				$.getJSON("http://localhost/CPS630Project/Phase01/server/APIs/insert.php/getColumns?table="+selectedInsertTable, function(labels) {
				var html = "";
				$.each(labels, function(index, label) {
					html += '<label for="' + label + '">' + label + '</label>';
					html += '<input type="text" id="' + label + '" name="' + label + '"><br>';
				});
				$("#InsertColumnLabels").html(html);
				});
			});

		
		});

		
		$(document).ready(function() {
			$("#submit-btn").click(function() {
				// Get table name from input field
				var table = $("#table-name").val();

				// Create columns object from form inputs
				var columns = {};
				$("form").find("input").each(function() {
					var name = $(this).attr("name");
					var value = $(this).val();
					columns[name] = value;
				});

				// Convert columns object to JSON string
				var columnsJson = JSON.stringify(columns);
				var tables = selectedInsertTable 
				var insertStatus = document.getElementById("insertStatus"); 
				
				// Call API with table and columns parameters
				$.ajax({
					url: "http://localhost/CPS630Project/Phase01/server/APIs/insert.php",
					type: "GET",
					data: {
						table: tables,
						columns: columnsJson
					},
					success: function(result) {
						console.log(result);
						insertStatus.textContent = "Success: A row inserted into "+result.substring(result.indexOf("Table:"), result.indexOf("<br>"));;
						
					},
					error: function(xhr, status, error) {
						console.error(error);
						insertStatus.textContent = "Incorrect Entry: Please try again with appropraite parameters. ";
					}
				});
			});
		});
//-UPDATE-------------------------------------------------------------------------------------------------------------------------------------------

//gets the Tables for 4-Update
const select1 = document.getElementById('selectTables_Update');
		const url1 = 'http://localhost/CPS630Project/Phase01/server/APIs/update.php/getTables';
		fetch(url1)
			.then(response => response.json())
			.then(data => {
			data.forEach(item => {
				const option = document.createElement('option');
				option.value = item;
				option.text = item;
				select1.appendChild(option);
			});
			})
			.catch(error => console.error(error));

		//2-Update
		//For Update DIALOG, variable keeps track of what was selected
		let selectedUpdateTable=null;
			// Add event listener to the select element
		select1.addEventListener('change', function() {
				// Get the selected value
				selectedUpdateTable = select1.value;
				console.log(selectedUpdateTable); // display the selected value in the console
				getIDLabel(selectedUpdateTable);
				
				//UpdateStatus.textContent="";
		});

	
		var inputIDValue="";
		function getIDLabel(selectedUpdateTable) {
			const url = 'http://localhost/CPS630Project/Phase01/server/APIs/update.php/getID?table='+selectedUpdateTable;
			fetch(url)
				.then(response => response.json())
				.then(data => {
				const fetchedString = data
				inputIDValue = data
				console.log("fetched ID is: "+data);


				var label = data;
				var html = '<label for="' + label + '">' + label + '</label>';
				html += '<input type="text" id="IDInput" name="' + label + '">';

				$("#InsertID").html(html);


				})
				.catch(error => console.error(error));
		}


		function getUpdateColumns(){
			var inputValue = document.getElementById("IDInput").value;
			console.log(inputValue);
			


			const url = 'http://localhost/CPS630Project/Phase01/server/APIs/update.php/getRecord?table='+selectedUpdateTable+'&id='+inputValue;
			fetch(url)
				.then(response => response.json())
				.then(data => {
				
					let html = "";

							// Loop through each object in the data array
							data.forEach((obj) => {
									// Loop through each key in the object
									Object.keys(obj).forEach((key) => {
									// Create a label element for the key
									html += `<label style="display: block">${key}</label>`;

									// Create an input element for the value
									html += `<input type="text" name="${key}" value="${obj[key]}">`;

									// Add a line break after the label
									//html += "<br>";
									});
							});
							// Add a submit button to the form
							html += '<button type="submit">Update</button>';

							// Set the HTML of the form container
							$("#displayUpdateColumns").html(`<form id="updateForm">${html}</form>`);

							// Add an event listener to the form submit button
							$('#updateForm').submit(function(e) {
								e.preventDefault(); // prevent the form from submitting

								// Serialize the form inputs into an array of objects
								var formData = $(this).serializeArray();

								// Log the serialized form data to the console
								console.log(formData);
								const obj = formData.reduce((result, item) => {
								result[item.name] = item.value;
								return result;
								}, {});

								console.log(obj);
								var objectReturn = JSON.stringify(obj);
								console.log(objectReturn);
								var insertStatusUpdate = document.getElementById("insertStatusUpdate"); 
								// Call API with table and columns parameters
								$.ajax({
									url: "http://localhost/CPS630Project/Phase01/server/APIs/update.php", //table="+selectedUpdateTable+'&id='+inputValue,
									type: "GET",
									data: {
										table: selectedUpdateTable,
										columns: objectReturn,
										key: inputIDValue,
										id: inputValue,
		
									},
									success: function(result) {
										
										insertStatusUpdate.textContent = "Success: Updated Table "+result.substring(result.indexOf("Table:"), result.indexOf("<br>"));;
										
									},
									error: function(xhr, status, error) {
										console.error(error);
										insertStatusUpdate.textContent = "Incorrect Entry: Please try again with appropraite parameters.";
									}
								});

							});

				})
				.catch(error => console.error(error));

		}

//-DELETE-------------------------------------------------------------------------------------------------------------------------------------------


//gets the Tables for 4-Delete
const select2 = document.getElementById('selectTables_Delete');
		const url2 = 'http://localhost/CPS630Project/Phase01/server/APIs/update.php/getTables';
		fetch(url2)
			.then(response => response.json())
			.then(data => {
			data.forEach(item => {
				const option = document.createElement('option');
				option.value = item;
				option.text = item;
				select2.appendChild(option);
			});
			})
			.catch(error => console.error(error));

		//2-Delete
		//For Delete DIALOG, variable keeps track of what was selected
		let selectedDeleteTable=null;
			// Add event listener to the select element
		select2.addEventListener('change', function() {
				// Get the selected value
				selectedDeleteTable = select2.value;
				console.log(selectedDeleteTable); // display the selected value in the console
				getIDLabel2(selectedDeleteTable);
				
				
		});

	
		var fetchedID;
		function getIDLabel2(selectedDeleteTable) {
			const url = 'http://localhost/CPS630Project/Phase01/server/APIs/update.php/getID?table='+selectedDeleteTable;
			fetch(url)
				.then(response => response.json())
				.then(data => {
				const fetchedString = data
				console.log("fetched ID is: "+data);
				fetchedID=data

				var label = data;
				var html = '<label for="' + label + '">' + label + '</label>';
				html += '<input type="text" id="IDInput2" name="' + label + '">';

				$("#InsertID2").html(html);


				})
				.catch(error => console.error(error));
		}

		function deleteRecord(){
			const inputValue = document.getElementById("IDInput2").value;
			var insertStatusDelete = document.getElementById("insertStatusDelete"); 
		//	const url = 'http://localhost/CPS630Project/Phase01/server/APIs/delete.php?table='+selectedDeleteTable+'&idName='+idname+'&idValue'+selectedDeleteTable;
			$.ajax({
									url: "http://localhost/CPS630Project/Phase01/server/APIs/delete.php",
									type: "GET",
									data: {
										table: selectedDeleteTable,
										idName: fetchedID,
										idValue: inputValue,
									},
									success: function(result) {
										
										insertStatusDelete.textContent = "Success: Deleted Record ";
										
									},
									error: function(xhr, status, error) {
										console.error(error);
										insertStatusDelete.textContent = "Error: Unable to delete Record";
									}
								});
		}


	</script>

<div>
	<button class="back-btn" onclick="window.location.href='home.php'">&#60; Go Back Home</button>
</div>
	
</body>
</html>

