var start_updating = 0, start_inserting = 1, start_updating_stock = 1, one_percent;

function upload_files(){
	//set cover
	document.getElementById("loading_part").style.display = 'block';
	
	var data = new FormData();
	//files.length i file[] idu za mulitple files upload
	var ins = document.getElementById('file').files.length;
	for (var x = 0; x < ins; x++) {
	    data.append("file[]", document.getElementById('file').files[x]);
	}

	var xml = new XMLHttpRequest();
	xml.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	console.log(this.responseText);
	    	if(this.responseText == 1){
	    		document.getElementById("update_files").style.display = 'none';
	    		start_updating = 1;
	    		chart2.init("CircleChart_2", 0);
	    		//get one percent of files included in file
	    		crate_message("Datoteka uspješno spremljena");
	    		create_id();
	    		//update_files();
	    	}
	    }
	};
	xml.open('POST', 'includes/insert_files.php');
	//xml.setRequestHeader('Cache-Control', 'no-cache');
	xml.send(data);
}

function create_id(){
	var xml = new XMLHttpRequest();
	xml.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	crate_message("Sinhronizacija sifre sa ID-om uspješno završena");
	    	//temporary
	    		delete_from_file_table();
	    }
	};
	
	xml.open('GET', 'includes/create_id.php');
	xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xml.send();
}

function delete_from_file_table(){
	var xml = new XMLHttpRequest();
	xml.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	crate_message("Tabela uspješno obrisana");
	    	crate_message("Počinjemo kopiranje datoteke..");
	    	crate_progres();

	    	//temporary
	    	create_from_file();
	    }
	};
	
	xml.open('GET', 'includes/delete_from_file_table.php');
	xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xml.send();
}

function create_from_file(){
	var xml = new XMLHttpRequest();
	xml.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	console.log(this.responseText);
	    	if(this.responseText == "The filename web.xls is not readable"){
	    		crate_message('Čitanje datoteke nije moguće. <a href="update.php?what=update">POKUŠAJTE PONOVO</a> !');
	    		return;
	    	}else{
	    		if(start_inserting && start_inserting <= 100){
		    		set_progres(start_inserting);
	    			start_inserting++;
	    			create_from_file();
	    			//update_filees();
	    		}else{
	    			crate_message("Datoteka uspješno očitana i spremljena.");
	    			get_one_percent();
	    		}
	    	} 

    		/*

    		if(this.responseText){
    			console.log("File read succesifully");
    			get_one_percent();
    		}else{
    			console.log("Failed to read file !!");
    		} */
	    }
	};
	
	xml.open('POST', 'includes/create_from_file.php');
	xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xml.send("percent="+(start_inserting - 1));
}


function get_one_percent(){
	var xml = new XMLHttpRequest();
	xml.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
    		console.log('One percent is : ' + this.responseText);
    		one_percent = this.responseText;
    		crate_message("U datoteci se nalazi približno " + (one_percent * 100) + ' artikala.');
  			crate_message("Počinjem osvježavanje datoteke ..");  		
    		crate_progres_2();
    		//temporary
    		refresh_stock();
	    }
	};
	
	xml.open('GET', 'includes/get_one_percent.php');
	xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xml.send();
}

//update table stock with article_id and stock_status
function refresh_stock(){
	var xml = new XMLHttpRequest();
	xml.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
    		if(this.responseText){
    			console.log(this.responseText);
    			if(start_updating_stock && start_updating_stock <= 100){
		    		set_progres_2(start_updating_stock);
					start_updating_stock++;
					refresh_stock();
					//update_filees();
				}else{
					crate_message("Tabela stock uspješno osvježena");
	    			crate_message("Počinjemo sinhronizaciju artikala ..");
					
					update_filees();
				}

    			
    		}else{
    			crate_message("Problem sa osvježavanjem tabele !");
    		}
	    }
	};
	
	xml.open('POST', 'includes/update_stock.php');
	xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xml.send("percent="+(start_updating_stock - 1));
}




function update_filees(){
	var xml = new XMLHttpRequest();
	xml.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
    		document.getElementById("loading_part").style.display = 'block';
    		chart2.init("CircleChart_2", start_updating);

    		//console.log(this.responseText);
    		var newNode = document.createElement('div');      
			newNode.innerHTML = this.responseText;
			document.getElementById("table_of_updated").style.display = 'block';
    		document.getElementById("table_of_updated").appendChild(newNode);


    		if(start_updating && start_updating <= 101){
    			console.log('Percents : ' + start_updating);
    			start_updating++;
    			update_filees();
    		}else{
    			document.getElementById("loading_part").style.display = 'none';
    		}

	    }
	};
	
	xml.open('POST', 'includes/update_again.php');
	xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xml.send("percent="+(start_updating - 1)+"&one_percent="+one_percent);
}


function crate_message(message){
	var wrapper = document.getElementById("additional_options");
	wrapper.scrollTop = wrapper.scrollHeight;
	
	var div = document.createElement("div");
	div.className = "show_user";

	var p = document.createElement("p");
	p.innerHTML = message;
	div.appendChild(p);

	wrapper.appendChild(div);
}


function set_progres(percents){
	var wrapper = document.getElementById("progres_bar");
	wrapper.style.display = 'block';
	var percents_num = document.getElementById("percent_number");
	percents_num.innerHTML = 'Progres [ '+percents+'% ]';

	//set width of bar
	var wrapper_bar = document.getElementById("progress");

	var main_bar = document.getElementById("final_progress");
	main_bar.style.width = (((wrapper_bar.clientWidth * percents) / 100) + 'px');
}


function crate_progres(){
	var wrapper = document.getElementById("additional_options");
	wrapper.scrollTop = wrapper.scrollHeight;

	var div = document.createElement("div");
	div.className = "show_user";
	div.id = "progres_bar";

	var p = document.createElement("p");
	p.id = "percent_number";
	p.innerHTML = 'Progres [ 0% ]';


	var p_1 = document.createElement("p");
	p_1.id = "open";
	var p_2 = document.createElement("p");
	p_2.id = "closed";

	div.appendChild(p_1);
	div.appendChild(p);
	div.appendChild(p_2);

	var progres_wrapper = document.createElement("div");
	progres_wrapper.id = "progress";

	var final_progress = document.createElement("div");
	final_progress.id = "final_progress";

	progres_wrapper.appendChild(final_progress);

	div.appendChild(progres_wrapper);

	wrapper.appendChild(div);

}


function set_progres_2(percents){
	var wrapper = document.getElementById("progres_bar2");
	wrapper.style.display = 'block';
	var percents_num = document.getElementById("percent_number2");
	percents_num.innerHTML = 'Progres [ '+percents+'% ]';

	//set width of bar
	var wrapper_bar = document.getElementById("progress2");

	var main_bar = document.getElementById("final_progress2");
	main_bar.style.width = (((wrapper_bar.clientWidth * percents) / 100) + 'px');
}


function crate_progres_2(){
	var wrapper = document.getElementById("additional_options");

	var div = document.createElement("div");
	div.className = "show_user";
	div.id = "progres_bar2";

	var p = document.createElement("p");
	p.id = "percent_number2";
	p.innerHTML = 'Progres [ 0% ]';


	var p_1 = document.createElement("p");
	p_1.id = "open2";
	var p_2 = document.createElement("p");
	p_2.id = "closed2";

	div.appendChild(p_1);
	div.appendChild(p);
	div.appendChild(p_2);

	var progres_wrapper = document.createElement("div");
	progres_wrapper.id = "progress2";

	var final_progress = document.createElement("div");
	final_progress.id = "final_progress2";

	progres_wrapper.appendChild(final_progress);

	div.appendChild(progres_wrapper);

	wrapper.appendChild(div);

}