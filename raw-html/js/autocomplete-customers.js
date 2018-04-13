$(function(){
	
	$('#customer-autosuggest').autocomplete({
    lookup: customerData, // see autocomplete-json-data.js
    onSelect: function (suggestion) {
      var thehtml = '<div class="contact-customer col-md-12">'+
			'<h4>' + suggestion.value + '</h4>'+
			'<h5>' + suggestion.data + '</h5>'+
			'<p>' + suggestion.custAddress + '</p>'+
			'<ul><li><span>Office:</span> ' + suggestion.custPhOffice + '</li><li><span>Mobile:</span> ' + suggestion.custPhMobile + '</li><li><span>Fax:</span> ' + suggestion.custPhFax + '</li><li><span>Email:</span> ' + suggestion.custEmail + '</li></ul></div><span class="addmore change-cust"><a>Change Customer</a></span>';
      $('#autosuggest-result').html(thehtml);
			$('.select-customers').addClass('hidden');
			
			//change customer
			$('.change-cust a').on('click',function(){
				$('.select-customers').removeClass('hidden');
				$('#autosuggest-result').html('');
				$('#customer-autosuggest').val('')
			});
			
			
			
			
    }
  });
	
});