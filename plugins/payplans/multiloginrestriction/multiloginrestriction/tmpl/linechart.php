<?php
/**
* @copyright		Copyright (C) 2009 - 2012 Ready Bytes Software Labs Pvt. Ltd. All rights reserved.
* @license			http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @package			PayPlans
* @subpackage		multiloginrestrcition
* @contact 			payplans@readybytes.in
* website			http://www.jpayplans.com
* Technical Support : Forum -	http://www.jpayplans.com/support/support-forum.html
*/
if(defined('_JEXEC')===false) die();
?>
<div>
  		<div class="pull-left pp-gap-top20">
  				<h4><?php echo XiText::_('COM_PAYPLANS_MULTILOGIN_RESTRICTION_MONTHLY_LOGIN_VIOLATIONS');?></h4>
  		</div>
  		<div id="areachart3">
  			<svg class="pp-linechart-draw"> </svg>
  		</div>
</div>
 
 <script type="text/javascript">
nv.addGraph(function() {
	  var chart = nv.models.lineChart();

	  chart.xAxis // chart sub-models (ie. xAxis, yAxis, etc) when accessed directly, return themselves, not the partent chart, so need to chain separately
	  		.tickFormat(function(d) {
		               return d3.time.format('%d-%b')(new Date(d))
		             });
    
	  chart.yAxis
//	      .axisLabel('Voltage (v)')
	      .tickFormat(d3.format(',.2f'));

	  d3.select('#areachart3 svg')
	      .datum(sinAndCosr())
	    .transition().duration(500)
	      .call(chart);

	  //TODO: Figure out a good way to do this automatically
	  //nv.utils.windowResize(chart.update);
	  //nv.utils.windowResize(function() { d3.select('#areachart3 svg').call(chart) });
	  return chart;
	});

	function sinAndCosr() {
	  var sin = [],
	      cos = [];
	  
	  	var records = eval(<?php echo $results;?>);
		for(dated in records){
			var violations = records[dated]['violations'];
			var actualdate = new Date(dated*1000);
		  	sin.push({x:actualdate , y: violations}); //the nulls are to show how defined works 
		}

	  return [
	    {
	      area: true,
	      values: sin,
	      key: "violations", // XITODO : use language token
	      color: "#FFBB78"
	    }
	  ];
	}
</script>
