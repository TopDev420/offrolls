(function($) {
    // Autocomplete
    $('input[name=\'search\']').autocomplete({
      'source': function(request, response) {
        var searchVal = request;
        var searchQuery = '';
        $cur = $(this);
        var stringPos = searchVal.lastIndexOf(',');
        searchQuery = searchVal.substr((stringPos + 1), searchVal.length);
        
        // console.log(stringPos + ' - ' + searchQuery);
        if(searchQuery.length > 1){
            // console.log(stringPos + ' - ' + searchQuery);
            $.ajax({
              url: $base_url +'candidate/search/autocomplete/' + searchQuery,
              type: 'post',
              dataType: 'json',
              success: function(json) {
                response($.map(json, function(item) {
                  return {
                    label: item['name'],
                    value: item['name']
                  }
                }));
              },
            });
        } else {
            $cur.parent().find('.dropdown-menu.autocomplete').hide();
        }
      },
      'select': function(item) {
        //Get Searched string form input
        var searchVal = $cur.val();
        stringPos = searchVal.lastIndexOf(',');
        searchedStr = searchVal.substr(0, (stringPos + 1));
        svalue =  searchedStr + item['label'] + ',';
        
        $cur.val(svalue).focus();

      }
    });
    
    //Search Submit
    $('#jobSearch').submit(function(e){
        e.preventDefault();
        var $cur = $(this);
        var csq = '';
        var searchQuery = $cur.find('input[name=\'search\']').val();
        if(searchQuery){
            csq = '?csq=' + encodeURIComponent(searchQuery);
        }
        
        window.location.href = $base_url + 'candidate/search/jobs'+ csq;
    });
  })(window.jQuery);