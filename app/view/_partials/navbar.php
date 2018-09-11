<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="?"><img src="http://aulavirtual.senati.edu.pe/logo.png" style="max-height:30px;"></a>
	    </div>
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">		        
	      	<!--
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ejemplos <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="?k=index/hola">Hola mundo</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="?k=index/otra_plantilla">Otra plantilla</a></li>
	          </ul>
	        </li>
	    	-->
	      </ul>		      
	      <ul class="nav navbar-nav navbar-right">		        
	        <form class="navbar-form navbar-left">
		        <div class="form-group" style="padding-top: 6px;">
		          <span style="color:#fff;font-weight:400"><?= $v->get('full_name') ?></span>
		        </div>
		    </form>		        
	      </ul>
	    </div>
	  </div>
</nav>