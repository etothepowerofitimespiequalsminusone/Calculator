<?php  
 //If "result_status" is not set, most likely the user has opened the
 // view.php file directly. We don't want to allow this.
 if (!isset($result_status))
 {
      header("Location: index.php");
 }
?><!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Loan calculator">
	<meta name="author" content="">
	<title>Leasing Calculator</title>

	<!-- Bootstrap core CSS -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="calculate.css" rel="stylesheet">
    </head>

    <body>
        
	<div class="container">
            <form class="form-signin" method="GET">
		
		<?php 
                $result_status = $_SESSION['result'];
                $result_message = $_SESSION['message'];
		if ($result_status == "OK") { ?>
		<div class="panel panel-success">
		    <div class="panel-heading">
		    <h4>Calculate result</h4>
		    </div>
		    <div class="panel-body">
		    <p>
                        Monthly payment:   
                        <?php echo htmlspecialchars($result_message)?>
                    </p>
		    </div>
		    
		</div>
		<?php } elseif ($result_status == "ERROR") {?>
		<div class="panel panel-warning">
		    <div class="panel-heading">
		    <h4>Problem detected!</h4>
		    </div>
		    <div class="panel-body">
			<p><?php echo htmlspecialchars($result_message)?></p>
		    </div>
		    
		</div>
		<?php } ?>
		<h2 class="form-signin-heading">Please, fill values</h2>
		<div class="form-group">
		    <input type="number" name="cost" id="cost_field" class="form-control" placeholder="Vehicle cost, EUR" autofocus/>
                </div>
                <div class="form-group">
                    <input type="number" name="down" id="down_field" class="form-control" placeholder="Down payment, EUR">		
                </div>
                <div class="form-group">
                    <input type="number" name="period" id="period_field" class="form-control" placeholder="Length of lease in months">		
                </div>  
                <div class="form-group">
                    <input type="number" name="interest" id="interest_field" class="form-control" placeholder="Additional yearly interest rate, %" >		
                </div>                   
                <div class="form-group">
		    <select class="form-control" >
			<option disabled="disabled" selected="selected">Select Euribor</option>
			<?php 
			foreach ($available_periods as $period) {
			    echo '<option value="'.$period.'">' . $period . '</option>'."\r\n";
			}
			?>
		    </select>
                </div>
                <div class="form-group">
                    <input type="number" name="residual" id="residual_field" class="form-control" placeholder="Vehicle residual value, EUR">
		</div>

		<button class="btn btn-lg btn-primary btn-block" type="submit">Calculate</button>
		
	    </form>

	</div> <!-- /container -->

    </body>
</html>
