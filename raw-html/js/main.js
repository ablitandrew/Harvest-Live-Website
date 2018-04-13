$(document).ready(function () {
    // checkbox all
    $('table.table').each(function (i, e) {
        var tableN = $(this);
        $(this).find('.check-all').on('click', function () {
            tableN.find(':checkbox').prop('checked', this.checked);
        });
        $(this).find('.checkbox-action').on('click', function () {
            if ($(this).attr('checked', '')) {
                tableN.find('.check-all').prop('checked', false);
            }
        });
    });
		
		
		//add new customer
		$('.addmore.add-cust').on('click',function(){
				$('.add-new-customer').removeClass('hidden');
				$('.select-customers').addClass('hidden');
		});
		
		$('.add-cust-cancel ').on('click',function(){
				$('.add-new-customer').addClass('hidden');
				$('.select-customers').removeClass('hidden');
		})
		

			
 	
		
		//clone-item-field
		$('.add-item a').each(function(){
			$(this).on('click',function(){
				var tC = $(this).parents('.table-container').find('.item-holder tbody');
					$(this).parent().siblings('.hidden-add-item-clone').find('.item-row').clone(true,true)
					.addClass('cloned-row').find("input:text").val("").end().appendTo(tC)
					
			})
		
		})
		
		//delete-item-field
		$('.remove-item-row').each(function() {
				$(this).on('click',function(e){
						$(this).parents('.cloned-row').remove();
						e.preventDefault();
				})	
		});
		
		
		//toggle area
		 $(".toggle-arrow").each(function(){
			 $(this).on('click',function(){
				 $(this).toggleClass('active');
				 $(this).parent().siblings().slideToggle(400);
				 })
			 });
			 
		
		//clone area
		$('.add-more-area a').each(function(){
			
			
			
			$(this).on('click',function(){
				var n = $(this).parents('.tab-pane').find('.area-container').length+1;
				var tP = $(this).parents('.tab-pane');
				
					$('.hidden-clone .area-for-clone').clone(true,true)
					.addClass('cloned-area last-cloned-area').find("input:text").val("Area "+ n).end().appendTo(tP)
					
			})
		
		
		})
		
		
		
		//remove area
		$('.remove-area a').each(function(){
			$(this).on('click',function(){
				$(this).parents('.area-container').remove();
			})
		});
		
		
		//clone phase
		$('.quote-detail li.add-more-phase a').each(function(){
			 $(this).on('click',function(){
				 var n = $(this).parent().siblings().length+1;
				 var tQ = $(this).parent();
				 var tM = $(this).parents('.nav-tabs').siblings('.tab-content');
				 
				 $('.hidden-clone .tab-title li').clone(true,true)
					.addClass('cloned-element-'+n).find("input:text").val("Phase "+ n).end().find("a").attr("href", "#phase-"+ n).end().insertBefore(tQ)
					
					$('.hidden-clone .tab-pane').clone(true,true).addClass('cloned-element-'+n).attr('id','phase-'+n).appendTo(tM)
					
					
				 })
			 });
			 
			 
		//remove phase
		$('.remove-phase').each(function(){
			$(this).on('click',function(){
				$(this).parent().remove();
			})
		});
		
      
   


});