(function($){
	payplans.admin.violation = {
			violationChange : function(first, last, userid){
			var url = 'index.php?option=com_payplans&view=loginviolation&task=violationChange&violation_from='+first+'&violation_to='+last+'&violation_user_id='+userid;
			var args = {};
			payplans.ajax.go(url, args);
	   }
   };
	
	$(document).ready(function(){
		//reset userid when refreshing the page
		if($("input[name^='isfilter']").val()=='0'){
			$("input[name^='violation_user_id']").val('');
		}
		
		$("input[name^='violationbtn']").live('click',function(){
			var first  = $("input[name^='violation_from']").val();
			var last   = $("input[name^='violation_to']").val();
			var userid = $("input[name^='violation_user_id']").val();
			payplans.admin.violation.violationChange(first, last, userid);
		});
	});
	
})(payplans.jQuery);
