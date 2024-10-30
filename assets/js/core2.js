var content = document.getElementById('gitcontent');
var gituser = document.getElementById("gitbasevalue");
			
			var remotepost = new XMLHttpRequest();
			remotepost.open('GET', 'https://api.github.com/users/'+gituser.value+'/repos');
			remotepost.onload = function () {
				let ourData = JSON.parse(remotepost.responseText);
				renderHTML(ourData);
				console.log(ourData);
				document.getElementById("imageload").style.display = "none";
				window.clearTimeout(gitmethod);
				
			};
			//Display Error log
			function gitmethod(){
				document.getElementById("errorlog").style.display = "block";
			    document.getElementById("errorlog").innerHTML = "User not found! <br> <b>TRY ANOTHER</b>";
			};

			window.setTimeout(gitmethod, 10000);
			//Loading spinner
			document.getElementById("imageload").style.display = "block";
			remotepost.send();
		
		function renderHTML(data) {
			var htmlstring = "";
			   for (i = 0; i <= 7; i++) {
			   	htmlstring +="<li class='gitlist'><div class='gitcontainer'><h3 class='gith3'>"+data[i].name+"</h3><p class='gitp'>"+data[i].description+"</p><span><small class='gitsmall'><span class='gitspan'></span> <code class='gitcode'>"+data[i].language+"</code></small></span><span class='gitspan2'><a href='"+data[i].html_url+"/archive/"+data[i].default_branch+".zip' class='gitalink'><small class='gitsmall2'><code class='gitcode downgit'>Download</code></small></a></span></div></li>";
			   }
			content.insertAdjacentHTML('beforeend', htmlstring);
			const gitprofile = data[0].owner;
			document.getElementById("githead").innerHTML = "<a class='gitlink' href='https://github.com/"+gitprofile.login+"' target='_blank'>"+gitprofile.login+"</a>";
			console.log(gitprofile.avatar_url);
			document.getElementById("gitpic").src = gitprofile.avatar_url;
		}