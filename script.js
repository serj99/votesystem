$(document).ready(function() {
    $("#BttnGenAvgAge").click(function() {
        var party = $("#party").val();
        console.log("here"); 
        $.ajax({
	        type    	: 'POST', //method type
	        url     	: 'getage.php', //form processing file url
	        data 	    : { 'party' : party },
	        dataType 	: 'json',
	        success 	: function(response) {
                              var age = parseFloat(response.age);
                              age = age.toFixed(1);
                              $("#AvgAge").empty();
			                  $('#AvgAge').append( "<p class='green_message'>" + age + ' ani </p>');
			              }
	    });
    });
    $("#BttnGenVotesCntPoor").click(function() {
        console.log("here");
        $.ajax({
	        type    	: 'POST', //method type
	        url     	: 'getvotes_poor.php', //form processing file url
	        dataType 	: 'json',
	        success 	: function(response) {
                              $("#VotesCntPoor").empty();
			                  $('#VotesCntPoor').append("<p class='green_message'>"+ response.votes_count + 
                                                        ' voturi din ' + response.poorest_county + 
                                                        ', cel mai sarac judet din tara!</p>');
			              }
	    });
    });
    
    $("#BttnGenStudiesPercent").click(function() {
        console.log("here");
        $.ajax({
	        type    	: 'POST', //method type
	        url     	: 'get_studies.php', //form processing file url
	        dataType 	: 'json',
	        success 	: function(response) {
                              $("#StudiesPercent").empty();
			                  $('#StudiesPercent').append("<p class='green_message'>" + response.basic_perc.toPrecision(2) + 
                                                        ' % din votanti au studii inferioare, pe cand doar ' +
                                                        + response.higher_perc.toPrecision(2) + ' % au studii superioare!</p>');
			              }
	    });
    });
    
    $("#BttnGenRegionVotes").click(function() {
        var region = $("#region").val();
        console.log("here"); 
        $.ajax({
	        type    	: 'POST', //method type
	        url     	: 'get_regionvotes.php', //form processing file url
	        data 	    : { 'region' : region },
	        dataType 	: 'json',
	        success 	: function(response) {
                              $("#RegionVotes").empty();
			                  $('#RegionVotes').append("<p class='green_message'>" + response.voters_count + 
                                                       ' votanti sunt din regiunea '
                                                       + region + '! </p>');
			              }
	    });
    });
    $("#BttnGenRegWin").click(function() {
        var region = $("#region_maj").val();
        console.log("here"); 
        $.ajax({
	        type    	: 'POST', //method type
	        url     	: 'get_regionwin.php', //form processing file url
	        data 	    : { 'region' : region },
	        dataType 	: 'json',
	        success 	: function(response) {
                              $("#RegWin").empty();
			                  $('#RegWin').append("<p class='green_message'>" + response.regionwin_party + 
                                                       ' are cele mai multe voturi in '
                                                       + region + '! </p>');
			              }
	    });
    });
    
    $("#BttnDelCandid").click(function() {
        var candid_id = $("#candid_to_del").val();
        var candid_name = $("#candid_to_del option:selected").text();
        console.log("here");
        $.ajax({
	        type    	: 'POST', //method type
	        url     	: 'del_candid.php', //form processing file url
            data        : { 'candid_id' : candid_id },
	        dataType 	: 'json',
	        success 	: function(response) {
                              //location.reload(true);
                              $("#MssgDelCandid").empty();
                              if(response.success == 1)
			                      $('#MssgDelCandid').append("<p id='green_message'>" 
                                                              + candid_name + 
                                                             " a fost sters cu succes din baza" +
                                                             " de date! </p>");
                              else 
			                      $('#MssgDelCandid').append("<p id='red_message'>" + 
                                                             'Eroare!' + response.success +
                                                             ' </p>');
			                 setTimeout(function() { location.reload() },3500);
			              }
	    });
    });
    
    $("#BttnDelParty").click(function() {
        var party = $("#party_to_del").val();
        console.log("here");
        $.ajax({
	        type    	: 'POST', //method type
	        url     	: 'del_party.php', //form processing file url
            data        : { 'party' : party },
	        dataType 	: 'json',
	        success 	: function(response) {
                              //location.reload(true);
                              $("#MssgDelParty").empty();
                              if(response.success == 1)
			                      $('#MssgDelParty').append("<p id='green_message'>Partidul " 
                                                              + party + 
                                                             " a fost sters cu succes din baza" +
                                                             " de date! </p>");
                              else 
			                      $('#MssgDelParty').append("<p id='red_message'>" + 
                                                             'Eroare!' + response.success +
                                                             ' </p>');
			              setTimeout(function() { location.reload() },3500);
                        }
	    });
    });
    $('#candidate').change(function() {
        var candid_id = $("#candidate").val();
        $.ajax({ 
            url: 'autoselect_getparty.php',
            data: { "candid_id" : candid_id },
            dataType: "json",
            type: 'post',
            success: function(result) {
                        //$("#party option[value='" + result.party + "']").prop("selected", true);
                        $("#party").val(result.party);
                     }
        });
                    
    });
    $('#party').change(function() {
        var party = $("#party").val();
        $.ajax({ 
            url: 'autoselect_getcandid.php',
            data: { "party" : party },
            type: 'post',
            dataType: "json",
            success: function(result) {
                        //$("#candidate option[value=" + result.candid_id + "]").prop("selected", true);
                        $('#candidate').val(result.candid_id);
                     }
        });
    });
});
 
