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
                              $("#AvgAge").empty();
			                  $('#AvgAge').append('<p>' + response.age + ' ani </p>');
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
			                  $('#VotesCntPoor').append('<p>'+ response.votes_count + 
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
			                  $('#StudiesPercent').append('<p>' + response.basic_perc.toPrecision(2) + 
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
			                  $('#RegionVotes').append('<p>' + response.voters_count + 
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
			                  $('#RegWin').append('<p>' + response.regionwin_party + 
                                                       ' are cele mai multe voturi in '
                                                       + region + '! </p>');
			              }
	    });
    });
});
 
